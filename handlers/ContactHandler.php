<?php

class ContactHandler
{
    public function handle(): void
    {
        $this->requirePost();

        $data = $this->collectData();
        $errors = $this->validate($data);

        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['old_input'] = $data;
            $_SESSION['flash_error'] = 'Prosím oprav chyby vo formulári.';

            header('Location: ' . BASE_URL . 'pages/contact.php');
            exit;
        }

        $db = getDbConnection();
        if (!$db) {
            $_SESSION['flash_error'] = 'Chyba databázy. Skús to neskôr.';
            $_SESSION['old_input'] = $data;
            header('Location: ' . BASE_URL . 'pages/contact.php');
            exit;
        }

        $saved = $this->saveMessage($db, $data);

        if (!$saved) {
            $_SESSION['flash_error'] = 'Správu sa nepodarilo uložiť.';
            $_SESSION['old_input'] = $data;
            header('Location: ' . BASE_URL . 'pages/contact.php');
            exit;
        }

        // Voliteľne: jednoduchý e-mail (ak nechceš, môžeš tento blok vyhodiť)
       # $this->sendNotificationEmail($data);

        unset($_SESSION['old_input'], $_SESSION['form_errors']);
        $_SESSION['flash_success'] = 'Správa bola úspešne odoslaná.';

        header('Location: ' . BASE_URL . 'pages/thankyou.php');
        exit;
    }

    private function requirePost(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . 'pages/contact.php');
            exit;
        }
    }

    private function collectData(): array
    {
        return [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'subject' => trim($_POST['subject'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'gdpr' => $_POST['gdpr'] ?? null,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
        ];
    }

    private function validate(array $data): array
    {
        $errors = [];

        if (mb_strlen($data['name']) < 2) {
            $errors['name'] = 'Meno musí mať aspoň 2 znaky.';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Zadaj platný e-mail.';
        }

        if (mb_strlen($data['subject']) < 3) {
            $errors['subject'] = 'Predmet musí mať aspoň 3 znaky.';
        }

        if (mb_strlen($data['message']) < 10) {
            $errors['message'] = 'Správa musí mať aspoň 10 znakov.';
        }

        if (empty($data['gdpr'])) {
            $errors['gdpr'] = 'Musíš súhlasiť so spracovaním osobných údajov.';
        }

        return $errors;
    }

    private function saveMessage(PDO $db, array $data): bool
    {
        $sql = 'INSERT INTO contact_messages (name, email, subject, message, ip_address, user_agent)
                VALUES (:name, :email, :subject, :message, :ip, :ua)';

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':subject' => $data['subject'],
            ':message' => $data['message'],
            ':ip' => $data['ip_address'],
            ':ua' => $data['user_agent'],
        ]);
    }

    private function sendNotificationEmail(array $data): void
    {
        // Ak hosting nemá mail() nastavené, nič sa nepokazí – handler ide ďalej.
        $to = CONTACT_EMAIL;
        $subject = 'Nová správa z formulára: ' . $data['subject'];

        $body = "Meno: {$data['name']}\n"
            . "Email: {$data['email']}\n"
            . "Predmet: {$data['subject']}\n\n"
            . "Správa:\n{$data['message']}\n";

        $headers = 'From: noreply@localhost' . "\r\n"
            . 'Reply-To: ' . $data['email'] . "\r\n"
            . 'X-Mailer: PHP/' . phpversion();

        @mail($to, $subject, $body, $headers);
    }
}
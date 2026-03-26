<?php
/**
 * Contact Form Handler
 * TODO šablóna - doplniť implementáciu
 */

// TODO 1: Načítaj konfiguráciu a helper funkcie.
// require_once __DIR__ . '/../config/config.php';
// require_once __DIR__ . '/../includes/functions.php';

// TODO 2: Spusť session (ak ešte nebeží), aby šli ukladať flash správy.

// TODO 3: Povoľ iba POST request. Pri inom requeste presmeruj na contact stránku.

// TODO 4: Načítaj polia z formulára (name, email, subject, message, gdpr).
// TODO 5: Dáta očisti/sanitizuj pred validáciou.

// TODO 6: Priprav pole $errors a doplň validácie pre všetky polia.
// - name: min. dĺžka
// - email: validný formát
// - subject: min. dĺžka
// - message: min. dĺžka
// - gdpr: musí byť zaškrtnuté

// TODO 7: Ak sú chyby, ulož ich do session a vráť používateľa späť na formulár.

// TODO 8: Pri úspechu odošli e-mail (alebo iné notifikácie).
// - nastav príjemcu
// - priprav predmet a telo správy
// - nastav hlavičky (From, Reply-To)
// - spracuj výsledok odoslania

// TODO 9: Ulož success/error flash správu do session.

// TODO 10: Presmeruj používateľa na thank-you stránku (alebo späť na contact podľa výsledku).

// Dočasne vráť 501, aby bolo jasné, že handler ešte nie je implementovaný.
http_response_code(501);
echo 'Contact handler TODO: implement processing flow.';

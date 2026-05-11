<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'Contact';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="contact-section py-5 mt-5 flex-grow-1">
    <div class="hero-bg-glow top-right"></div>
    <div class="hero-bg-glow bottom-left"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5 reveal">
                    <span class="status-badge">
                        <span class="status-dot"></span>
                        Get In Touch
                    </span>
                    <h1 class="display-4 fw-bold mb-3"><span class="text-primary">Get In</span> <span class="text-gradient">Touch</span></h1>
                    <p class="text-muted lead">Have a question or want to <span class="text-purple">work together</span>? Drop me a message!</p>
                </div>

                <div class="alert alert-dismissible mb-4 reveal" role="alert" style="background: var(--accent-subtle); border: 1px solid var(--accent-border); color: var(--text-primary);">
                    <i class="bi bi-info-circle me-2 text-purple"></i>
                    <strong>Tip:</strong> I usually respond within 24 hours. For a faster response, use email.
                    <button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
                </div>

                <div class="glass-panel reveal">
                    <form action="../handlers/contact-handler.php" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="name" class="form-label">
                                <i class="bi bi-person me-2"></i>Name
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-glass"
                                id="name"
                                name="name"
                                placeholder="Your name"
                                required
                                minlength="2"
                                maxlength="50"
                            >
                            <div class="invalid-feedback">
                                Please enter your name (min. 2 characters).
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                            <input
                                type="email"
                                class="form-control form-control-glass"
                                id="email"
                                name="email"
                                placeholder="your@email.com"
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="form-label">
                                <i class="bi bi-chat-left-text me-2"></i>Subject
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-glass"
                                id="subject"
                                name="subject"
                                placeholder="Message subject"
                                required
                                minlength="3"
                                maxlength="120"
                            >
                            <div class="invalid-feedback">
                                Please enter a subject (min. 3 characters).
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="form-label">
                                <i class="bi bi-chat-dots me-2"></i>Message
                            </label>
                            <textarea
                                class="form-control form-control-glass"
                                id="message"
                                name="message"
                                rows="5"
                                placeholder="Write your message..."
                                required
                                minlength="10"
                                maxlength="1000"
                            ></textarea>
                            <div class="invalid-feedback">
                                Please write a message (min. 10 characters).
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="gdpr"
                                    name="gdpr"
                                    required
                                >
                                <label class="form-check-label" for="gdpr">
                                    I agree to the processing of personal data in accordance with
                                    <a href="#" class="text-purple">GDPR</a> and
                                    <a href="#" class="text-purple">privacy policy</a>.
                                </label>
                                <div class="invalid-feedback">
                                    You must agree to the processing of personal data.
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-purple btn-lg">
                                <i class="bi bi-send"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <div class="row mt-5 g-4 reveal">
                    <div class="col-md-4">
                        <div class="contact-info-card">
                            <div class="text-purple mb-2"><i class="bi bi-envelope fs-3"></i></div>
                            <h6>Email</h6>
                            <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-card">
                            <div class="text-purple mb-2"><i class="bi bi-geo-alt fs-3"></i></div>
                            <h6>Location</h6>
                            <p class="mb-0"><?php echo CONTACT_LOCATION; ?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info-card">
                            <div class="text-purple mb-2"><i class="bi bi-github fs-3"></i></div>
                            <h6>GitHub</h6>
                            <a href="<?php echo GITHUB_URL; ?>" target="_blank">@WeXxQ-o</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>

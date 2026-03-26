<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'Contact';
include '../includes/header.php';
include '../includes/navbar.php';
?>
    
    <!-- hlavná kontaktná sekcia -->
    <section class="contact-section py-5 mt-5 flex-grow-1">
        <!-- fialové glowy na pozadí pre efekt -->
        <div class="hero-bg-glow top-right"></div>
        <div class="hero-bg-glow bottom-left"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <span class="status-badge">
                            <span class="status-dot"></span>
                            Get In Touch
                            </span>
                        <h1 class="display-4 fw-bold mb-3">Get In <span class="text-gradient">Touch</span></h1>
                        <p class="text-muted lead">Have a question or want to work together? Drop me a message!</p>
                    </div>
                    
                    <!-- Alert -->
                    <!-- kreatívny bod -->
                    <div class="alert alert-dismissible fade show mb-4" role="alert" style="background: rgba(138, 43, 226, 0.15); border: 1px solid rgba(138, 43, 226, 0.3); color: #fff;">
                        <i class="bi bi-info-circle me-2 text-purple"></i>
                        <strong>Tip:</strong> I usually respond within 24 hours. For a faster response, use email.
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <!-- kontaktný formulár v sklenenom paneli -->
                    <div class="glass-panel">
                        <form action="../handlers/contact-handler.php" method="GET" class="needs-validation" novalidate>
                            
                            <!-- pole pre meno -->
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
                                    pattern="[A-Za-zÀ-ž\s]+"
                                    title="Enter a valid name (letters only)"
                                >
                                <div class="invalid-feedback">
                                    Please enter your name (min. 2 characters, letters only).
                                </div>
                            </div>
                            
                            <!-- pole pre email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <input 
                                    type="email" 
                                    class="form-control form-control-glass" 
                                    id="email" 
                                    name="email"
                                    placeholder="example@email.com"
                                    required
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    title="Enter a valid email address"
                                >
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>
                            
                            <!-- pole pre správu -->
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
                            
                            <!-- GDPR checkbox -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="gdpr" 
                                        name="gdpr"
                                        required
                                    >
                                    <label class="form-check-label text-muted small" for="gdpr">
                                        I agree to the processing of personal data in accordance with 
                                        <a href="#" class="text-purple">GDPR</a> and 
                                        <a href="#" class="text-purple">privacy policy</a>.
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree to the processing of personal data to submit the form.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- tlačidlo pre odoslanie -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-purple btn-lg">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                            
                        </form>
                    </div>
                    
                    <!-- kontaktné informácie pod formulárom -->
                    <div class="row mt-5 text-center">
                        <div class="col-md-4 mb-3">
                            <div class="text-purple mb-2"><i class="bi bi-envelope fs-3"></i></div>
                            <h6>Email</h6>
                            <a href="mailto:example@email.com" class="text-muted small">example@email.com</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-purple mb-2"><i class="bi bi-telephone fs-3"></i></div>
                            <h6>Phone</h6>
                            <a href="tel:+421900000000" class="text-muted small">+421 900 000 000</a>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-purple mb-2"><i class="bi bi-github fs-3"></i></div>
                            <h6>GitHub</h6>
                            <p class="text-muted small">@WeXxQ-o</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
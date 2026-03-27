<?php
require_once '../config/config.php';
require_once '../includes/functions.php';

$pageTitle = 'FAQ';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<section class="faq-section py-5 mt-5 flex-grow-1">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="status-badge">
                <span class="status-dot"></span>
                Questions & Answers
            </span>
            <h1 class="display-4 fw-bold"><span class="text-primary">Frequently Asked</span> <span class="text-purple">Questions</span></h1>
            <p class="text-muted mt-3 mx-auto" style="max-width: 600px;">Everything you need to know about <span class="text-purple">working with me</span>, my skills, and how we can <span class="text-purple">collaborate</span> on your next project.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- General Questions -->
                <div class="faq-section-group mb-5 reveal">
                    <div class="faq-section-header">
                        <div class="faq-section-icon">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <h3>General <span class="text-purple">Questions</span></h3>
                    </div>

                    <div class="faq-grid">
                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <h4>Are you available for freelance work?</h4>
                            <p>Yes! I'm currently open to freelance projects and collaborations. Whether it's a small website or a larger web application, I'd love to discuss how I can help bring your ideas to life.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <h4>What are your typical response times?</h4>
                            <p>I usually respond to inquiries within 24-48 hours. For urgent projects, please mention it in your message and I'll prioritize getting back to you as quickly as possible.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h4>Where are you based?</h4>
                            <p>I'm based in Slovakia but I work remotely with clients worldwide. Time zones are never an issue - I'm flexible and can adjust my schedule to accommodate different regions.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-translate"></i>
                            </div>
                            <h4>What languages do you speak?</h4>
                            <p>I'm fluent in Slovak and English, which allows me to communicate effectively with international clients and work on projects for diverse audiences.</p>
                        </div>
                    </div>
                </div>

                <!-- Technical Questions -->
                <div class="faq-section-group mb-5 reveal">
                    <div class="faq-section-header">
                        <div class="faq-section-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h3>Technical <span class="text-purple">Expertise</span></h3>
                    </div>

                    <div class="faq-grid">
                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h4>What technologies do you work with?</h4>
                            <p>I specialize in front-end development with HTML, CSS, JavaScript, and Bootstrap. I also work with back-end technologies like PHP and Python, and I'm comfortable with Git version control.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-phone"></i>
                            </div>
                            <h4>Do you build responsive websites?</h4>
                            <p>Absolutely! Every website I build is fully responsive and mobile-friendly. I ensure your site looks great and functions perfectly on all devices, from smartphones to large desktop screens.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-palette"></i>
                            </div>
                            <h4>Can you help with design?</h4>
                            <p>Yes! While I'm primarily a developer, I have a good eye for design and can create clean, modern interfaces. If you have existing designs, I can bring them to life with pixel-perfect accuracy.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                            <h4>Do you learn new technologies?</h4>
                            <p>Definitely! I'm passionate about learning and staying up-to-date with new tools and frameworks. If your project requires something I haven't worked with yet, I'm eager to learn it.</p>
                        </div>
                    </div>
                </div>

                <!-- Working Together -->
                <div class="faq-section-group mb-5 reveal">
                    <div class="faq-section-header">
                        <div class="faq-section-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>Working <span class="text-purple">Together</span></h3>
                    </div>

                    <div class="faq-grid">
                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <h4>How do I get started?</h4>
                            <p>Simply reach out through the <a href="contact.php">contact form</a> with details about your project. Include what you're looking to build, your timeline, and any specific requirements you have in mind.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-calendar"></i>
                            </div>
                            <h4>What's your typical project timeline?</h4>
                            <p>Timeline varies based on project complexity. A simple website might take 1-2 weeks, while larger projects could take several weeks or months. I'll provide a detailed timeline after discussing your needs.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h4>How do you communicate during projects?</h4>
                            <p>I believe in clear, regular communication. We can stay in touch via email, Discord, or your preferred platform. I provide regular updates and am always available for questions or feedback.</p>
                        </div>

                        <div class="faq-item">
                            <div class="faq-item-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4>Do you offer post-launch support?</h4>
                            <p>Yes! I provide ongoing support and maintenance after your project launches. Whether it's bug fixes, updates, or new features, I'm here to help your project succeed long-term.</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="faq-cta-section text-center reveal">
                    <div class="faq-cta-card">
                        <div class="faq-cta-icon">
                            <i class="bi bi-send"></i>
                        </div>
                        <h2>Still have questions?</h2>
                        <p>Don't hesitate to reach out! I'm always happy to discuss your project and answer any questions you might have.</p>
                        <a href="contact.php" class="btn btn-purple btn-lg">
                            <i class="bi bi-envelope"></i>
                            Get in Touch
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>

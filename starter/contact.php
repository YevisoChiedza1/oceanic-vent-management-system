<?php
/**
 * Hydrothermal Vent Database - Contact Page
 */
require_once 'includes/db.php';
$pageTitle = 'Contact Us';

$message_sent = false;

// PHP Processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $comment = htmlspecialchars($_POST['comment']);

    // Implement a success flag
    if (!empty($name) && !empty($email) && !empty($comment)) {
        $message_sent = true;
    }
}

require_once 'includes/header.php';
?>

<main class="container">
    <section class="form-section">
        <h2 id="heading">Get In Touch</h2>
        <p id="intro">Have questions about the Western Pacific vents? Send us a message.</p>

        <?php if ($message_sent): ?>
            <div class="success-message">
                <p>Thank you, <?php echo $name; ?>! Your message has been received.</p>
                <a href="index.php">Return to Home</a>
            </div>
        <?php else: ?>
            <form id="contactForm" action="contact.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name">
                    <span id="nameError" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email">
                    <span id="emailError" class="error"></span>
                </div>

                <div class="form-group">
                    <label for="comment">Message:</label>
                    <textarea id="comment" name="comment" rows="5"></textarea>
                    <span id="commentError" class="error"></span>
                </div>

                <button type="submit" class="btn-submit">Send Message</button>
            </form>
        <?php endif; ?>
    </section>
</main>

<script src="js/validation.js"></script>

<?php require_once 'includes/footer.php'; ?>
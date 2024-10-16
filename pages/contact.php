<?php
include '../templates/header.php';
?>

        <section class="contact-form">
            <h2>Contact Form</h2>
            <form action="../php/submit_form.php" method="post">
                <form action="../php/submit_form.php" method="POST">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                    
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email">
                    
                    <label for="message">Message:</label>
                    <textarea id="message" name="message"></textarea>
                    
                    <button type="submit">Submit</button>
                </form>
                
            </form>
        </section>

        <section class="contact-info">
            <h2>Get in Touch</h2>
            <p>If you have any questions or suggestions, feel free to reach out to us through the contact form below or connect with us via social media.</p>
            <div class="contact-details">
                <div class="contact-item">
                    <h3>Email Us</h3>
                    <p><a href="mailto:imadak999@gmail.com">imadak999@gmail.com</a></p>
                </div>
                <div class="contact-item">
                    <h3>Call Us</h3>
                    <p><a href="tel:+918097814934">+91 8097814934</a></p>
                </div>
                <div class="contact-item">
                    <h3>WhatsApp</h3>
                    <p><a href="https://wa.me/8097814934" target="_blank"><i class="fab fa-whatsapp"></i> +91 8097814934</a></p>
                </div>
                <div class="contact-item">
                    <h3>Instagram</h3>
                    <p><a href="https://instagram.com/@_offx.imxd" target="_blank"><i class="fab fa-instagram"></i> @_offx.imxd</a></p>
                </div>
                <div class="contact-item">
                    <h3>Visit Us</h3>
                    <p>Worli, Mumbai, India</p>
                </div>
            </div>
        </section>

        <section class="social-media">
            <h2>Follow Us</h2>
            <p>Stay updated with our latest news and updates on social media.</p>
            <div class="social-media">
        <a href="https://github.com/perivo" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
        <a href="https://in.linkedin.com/in/ivo-pereira-ix3" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
        <a href="https://www.instagram.com/theblackcatguy" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/919403765835" target="_blank" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
    </div>
        </section>
    </main>

<!-- Go to Top Button -->
<a href="#" class="go-to-top" id="go-to-top">
    <i class="fas fa-arrow-up"></i>
</a>
<footer>
    <p>&copy; <?php echo date("Y"); ?> GreenHub. All rights reserved.</p>
  
</footer>
</body>
</html>



<style>
    /* styles.css */

    /* Smooth Scrolling */
html {
    scroll-behavior: smooth;
}

/* Contact Info Section */
.contact-info {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    margin: 20px 0;
}

.contact-info h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

.contact-info p {
    font-size: 1em;
    line-height: 1.6;
}

.contact-details {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.contact-item {
    flex: 1;
    min-width: 200px;
    background: white;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.contact-item h3 {
    font-size: 1.2em;
    margin-bottom: 5px;
}

.contact-item a {
    color: #00a859;
    text-decoration: none;
    font-size: 1em;
}

.contact-item a i {
    margin-right: 8px;
}

.contact-item a:hover {
    text-decoration: underline;
}

/* Contact Form Section */
.contact-form {
    padding: 20px;
    background: #ffffff;
    border-radius: 8px;
    margin: 20px 0;
}

.contact-form h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

.contact-form form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-form label {
    font-size: 1em;
    margin-bottom: 5px;
}

.contact-form input, .contact-form textarea {
    padding: 10px;
    font-size: 1em;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.contact-form button {
    padding: 10px;
    font-size: 1em;
    background-color: #00a859;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.contact-form button:hover {
    background-color: #009c6b;
}

/* Social Media Section */
.social-media {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    margin: 20px 0;
}

.social-media h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}

.social-media p {
    font-size: 1em;
    margin-bottom: 10px;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-icon {
    font-size: 1.5em;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.social-icon:hover {
    color: #00a859;
}

/* Responsive Design */
@media (max-width: 768px) {
    .contact-details {
        flex-direction: column;
    }
}

</style>
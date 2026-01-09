<footer class="new-footer">

    <div class="footer-top">
        <h2>Stay Connected, Stay Updated with UNNify!</h2>
        <form action="#" method="POST" class="newsletter-form">
            <input type="email" name="email" placeholder="Enter your email" required>
            <button type="submit"><i class='bx bx-send'></i></button>
        </form>
    </div>

    <div class="footer-main">
        <div class="footer-box">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="/campus_buy_and_sell/index.php">Home</a></li>
                <li><a href="/campus_buy_and_sell/listings/market.php">Marketplace</a></li>
                <li><a href="/campus_buy_and_sell/contact.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-box">
            <h4>Support</h4>
            <ul>
                <li><a href="/campus_buy_and_sell/faq.php">FAQs</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="/campus_buy_and_sell/contact.php">Help Desk</a></li>
            </ul>
        </div>

        <div class="footer-box">
            <h4>Contact</h4>
            <p>📞 +234 903 848 8526</p>
            <p>📧 support@unnify.com</p>

            <div class="social-icons">
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-whatsapp'></i></a>
                <a href="#"><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2025 UNNify | Built for UNN Community with ❤️</p>
    </div>
</footer>

<button class="dark-toggle" id="darkToggle">🌓</button>

<script>
    const toggle = document.getElementById("darkToggle");

    toggle.addEventListener("click", () => {
        const isDark = document.body.getAttribute("data-theme") === "dark";

        if (isDark) {
            document.body.removeAttribute("data-theme");
            localStorage.setItem("theme", "light");
        } else {
            document.body.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
        }
    });

    // On page load, set theme from localStorage
    if (localStorage.getItem("theme") === "dark") {
        document.body.setAttribute("data-theme", "dark");
    }
</script>

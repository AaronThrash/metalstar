    </main>

    <footer class="site-footer">
        <div class="footer-inner">
            <nav class="footer-nav">
                <a href="/#chapters">CHAPTERS</a>
                <span class="footer-nav-divider">|</span>
                <a href="/about">ABOUT</a>
                <span class="footer-nav-divider">|</span>
                <a href="/summary">SUMMARY</a>
                <span class="footer-nav-divider">|</span>
                <a href="/prologue">PROLOGUE</a>
            </nav>
            <p class="footer-copy">&copy; 1989-2026 Metalstar All Rights Reserved | Aaron Hill</p>
        </div>
    </footer>

    <script src="/assets/js/main.js"></script>
    <?php if (!empty($extra_js)): ?>
    <script src="/assets/js/<?= $extra_js ?>"></script>
    <?php endif; ?>

<?php
// Output full JSON-LD schema from seo.php
require __DIR__ . '/seo.php';
?>

</body>
</html>

</main>

<footer class="footer-container">
    <p>&copy; <?php echo date('Y'); ?> ÌTÀN ÒRÌṢÀ. All rights reserved. <span>
            <?php
            $a11y_page = get_page_by_path('accessibility');
            $a11y_url = $a11y_page ? get_permalink($a11y_page->ID) : '#';
            ?>
            <a href="<?php echo esc_url($a11y_url); ?>">Accessibility Statement</a>
        </span></p>

</footer>

</body>

</html>
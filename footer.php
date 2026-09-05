</main>

<footer class="footer-container">
    <p>&copy; <?php echo date('Y'); ?> ÌTÀN ÒRÌṢÀ. All rights reserved. <span>
            <?php
            $a11y_page = get_page_by_path('accessibility');
            $privacy_policy = get_page_by_path('privacy-policy');
            $a11y_url = $a11y_page ? get_permalink($a11y_page->ID) : '#';
            $privacy_url = $privacy_policy ? get_permalink($privacy_policy->ID) : '#';
            ?>
            <a href="<?php echo esc_url($a11y_url); ?>">Accessibility Statement</a>
            <a href="<?php echo esc_url($privacy_url); ?>">Privacy Policy</a>

        </span></p>

</footer>

</body>

</html>
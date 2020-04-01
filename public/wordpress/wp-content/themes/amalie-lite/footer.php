<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package Amalie
 * @since Amalie 1.0
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
            <a href="<?php echo esc_url( __( 'https://www.anarieldesign.com/amalie-lite-free-wordpress-theme/', 'amalie' ) ); ?>"><?php printf( __( 'Theme: %1$s.', 'amalie' ), 'Amalie Lite designed by Anariel Design' ); ?></a>
        </div>
        <!-- .site-info -->
	</footer><!-- .site-footer -->
    
    </div><!-- .site-content -->

</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
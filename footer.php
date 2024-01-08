<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Superb Pixels
 */

?>


<footer id="colophon" class="site-footer clearfix">


	<?php if (is_active_sidebar('footerwidget-1')) : ?>
		<div class="content-wrap">
			<div class="site-footer-widget-area">
				<?php dynamic_sidebar('footerwidget-1'); ?>
			</div>
		</div>

	<?php endif; ?>

	
	<div class="site-info">
		<?php if (get_theme_mod('footer_copyright_text')) : ?>
			<?php echo wp_kses_post(get_theme_mod('footer_copyright_text')) ?>
		<?php else : ?>
			&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>
			<!-- Delete below lines to remove copyright from footer -->
			<span class="footer-info-right">
				<?php echo __(' | WordPress Theme by', 'superb-pixels') ?> <a href="<?php echo esc_url('https://superbthemes.com/', 'superb-pixels'); ?>" rel="nofollow noopener"><?php echo __(' SuperbThemes', 'superb-pixels') ?></a>
			</span>
			<!-- Delete above lines to remove copyright from footer -->

		<?php endif; ?>
	</div><!-- .site-info -->

	<?php if (get_theme_mod('footer_go_to_top_hide') == '1') : ?>
	<?php else : ?>
		<a id="goTop" class="to-top" href="#" title="<?php esc_attr_e('To Top', 'superb-pixels'); ?>">
			<i class="fa fa-angle-double-up"></i>
		</a>
	<?php endif; ?>


</footer><!-- #colophon -->


<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>

</html>
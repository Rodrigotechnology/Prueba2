<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Superb Pixels
 */

use SuperbThemesCustomizer\CustomizerControls;

$superb_pixels_is_related_posts = isset($args['is_related_posts']) && !!$args['is_related_posts'];
$superb_pixels_hide_author_byline = !!$superb_pixels_is_related_posts;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-entry fbox'); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title">', '</h1>');
		else :
			the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;
		?>
		<?php
		if ('post' === get_post_type()) : ?>
			<div class="entry-meta">
				<div class="blog-data-wrapper">
					<div class='post-meta-inner-wrapper'>
						<?php if (!$superb_pixels_hide_author_byline) : ?>
							<span class="post-author-img">
								<?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
							</span>
							<span class="post-author-data">
								<?php the_author(); ?><?php esc_html_e(', ', 'superb-pixels'); ?>
							<?php endif; ?>
							<?php superb_pixels_posted_on(); ?>
							<?php if (!$superb_pixels_hide_author_byline) : ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'superb-pixels'),
			'after'  => '</div>',
		));

		if (is_single()) : ?>
			<?php if (get_theme_mod('show_posts_categories_tags') == '') : ?>
				<div class="category-and-tags">
					<?php the_category(' '); ?>
					<?php if (has_tag()) : ?>
						<?php the_tags('', ''); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>


	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
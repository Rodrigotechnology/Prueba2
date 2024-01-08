<?php

use SuperbThemesCustomizer\CustomizerControls;

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Superb Pixels
 */
$superb_pixels_is_related_posts = isset($args['is_related_posts']) && !!$args['is_related_posts'];
$superb_pixels_is_posts_shortcode = isset($args['is_posts_shortcode']) && !!$args['is_posts_shortcode'];
$superb_pixels_hide_author_byline = !!$superb_pixels_is_related_posts;
$superb_pixels_featured_image_style = CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE);
$superb_pixels_has_post_thumbnail = \has_post_thumbnail();
$superb_pixels_thumbnail_url = $superb_pixels_has_post_thumbnail ? get_the_post_thumbnail_url(get_the_id(), 'superb-pixels-noresize') : get_template_directory_uri() . "/src/images/featured-placeholder.png";
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-entry fbox blogposts-list'); ?>>
	<?php if ($superb_pixels_has_post_thumbnail || get_theme_mod(CustomizerControls::BLOGFEED_FEATURED_IMAGE_PLACEHOLDER) == '1') : ?>
		<div class="featured-img-box">
			<a href="<?php the_permalink() ?>" class="featured-thumbnail" rel="bookmark" <?php if ($superb_pixels_featured_image_style === CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE) {
																								echo 'style="background-image: url(' . esc_url($superb_pixels_thumbnail_url) . ')"';
																							} ?>>
				<?php
				if ($superb_pixels_featured_image_style === CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) {
				?>
					<span class="featured-img-bg-blur" <?php echo 'style="background-image: url(' . esc_url($superb_pixels_thumbnail_url) . ')"'; ?>></span>
				<?php
				}
				?>
				<?php $superb_pixels_category = get_the_category();
				if (is_array($superb_pixels_category) && count($superb_pixels_category) > 0) {
				?>
					<span class="featured-img-category">
						<?php echo esc_html($superb_pixels_category[0]->cat_name); ?>
					</span>
				<?php } ?>
				<?php if ($superb_pixels_featured_image_style !== CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE) {
					if ($superb_pixels_has_post_thumbnail) {
						the_post_thumbnail('superb-pixels-noresize');
					} elseif (get_theme_mod(CustomizerControls::BLOGFEED_FEATURED_IMAGE_PLACEHOLDER) == '1') {
						echo '<img src="' . esc_url($superb_pixels_thumbnail_url) . '" />';
					}
				} ?>
			</a>
		<?php else : ?>
			<div class="no-featured-img-box">
			<?php endif; ?>
			<?php if (is_sticky()) : ?>
				<div class="blogpost-is-sticky-icon<?php if ($superb_pixels_has_post_thumbnail) : echo " blogpost-is-sticky-icon-has-featured-image";
													endif; ?>">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pinned" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2C3E50" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path d="M9 4v6l-2 4v2h10v-2l-2 -4v-6" />
						<line x1="12" y1="16" x2="12" y2="21" />
						<line x1="8" y1="4" x2="16" y2="4" />
					</svg>
				</div>
			<?php endif; ?>
			<div class="content-wrapper">
				<header class="entry-header">
					<?php
					if ($superb_pixels_is_related_posts) :
						the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');
					elseif (!$superb_pixels_is_posts_shortcode && is_singular()) :
						the_title('<h1 class="entry-title">', '</h1>');
					else :
						the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
					endif; ?>
					<?php if ('post' === get_post_type()) : ?>
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
					<?php
					endif; ?>
				</header><!-- .entry-header -->

				<div class="entry-content">

					<?php if ($superb_pixels_is_related_posts || get_theme_mod('show_except_or_full') == '') : ?>
						<?php the_excerpt(); ?>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>

					<?php
					wp_link_pages(array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'superb-pixels'),
						'after'  => '</div>',
					));
					?>

				</div>
				<?php if ($superb_pixels_is_related_posts || get_theme_mod('show_except_or_full') == '') : ?>
					<a class="read-story" href="<?php the_permalink() ?>">
						<?php ($superb_pixels_is_related_posts ? esc_html_e('Read More', 'superb-pixels') : esc_html_e('Continue Reading', 'superb-pixels')); ?>
					</a>
				<?php endif; ?>
			</div>

			</div>

</article><!-- #post-<?php the_ID(); ?> -->
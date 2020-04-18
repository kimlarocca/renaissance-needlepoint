<?php
// Search template

get_header();

$zass_sidebar_choice = apply_filters('zass_has_sidebar', '');

if ($zass_sidebar_choice != 'none') {
	$zass_has_sidebar = is_active_sidebar($zass_sidebar_choice);
} else {
	$zass_has_sidebar = false;
}

$zass_offcanvas_sidebar_choice = apply_filters('zass_has_offcanvas_sidebar', '');

if ($zass_offcanvas_sidebar_choice != 'none') {
	$zass_has_offcanvas_sidebar = is_active_sidebar($zass_offcanvas_sidebar_choice);
} else {
	$zass_has_offcanvas_sidebar = false;
}

$zass_sidebar_classes = array();
if ($zass_has_sidebar) {
	$zass_sidebar_classes[] = 'has-sidebar';
}
if ($zass_has_offcanvas_sidebar) {
	$zass_sidebar_classes[] = 'has-off-canvas-sidebar';
}

// Sidebar position
$zass_sidebar_classes[] =  apply_filters('zass_left_sidebar_position_class', '');

$zass_show_title_background = zass_get_option('show_blog_title_background');
$zass_title_background_image = zass_get_option('blog_title_background_imgid');

if ($zass_title_background_image) {
	$zass_img = wp_get_attachment_image_src($zass_title_background_image, 'full');
	$zass_title_background_image = $zass_img[0];
}
?>
<div id="content" <?php if (!empty($zass_sidebar_classes)) echo 'class="' . esc_attr(implode(' ', $zass_sidebar_classes)) . '"'; ?> >
	<div id="zass_page_title" class="zass_title_holder <?php if ($zass_show_title_background && $zass_title_background_image): ?>title_has_image<?php endif; ?>">
		<?php if ($zass_show_title_background && $zass_title_background_image): ?><div class="zass-zoomable-background" style="background-image: url('<?php echo esc_url($zass_title_background_image) ?>');"></div><?php endif; ?>
		<div class="inner fixed">
			<!-- BREADCRUMB -->
			<?php zass_breadcrumb() ?>
			<!-- END OF BREADCRUMB -->
			<!-- TITLE -->
			<h1 class="heading-title"><?php printf(esc_html__('Search Results for: %s', 'zass'), '<span>' . get_search_query() . '</span>'); ?></h1>
			<!-- END OF TITLE -->
		</div>
	</div>
	<div class="inner">
		<!-- CONTENT WRAPPER -->
		<div id="main" class="fixed box box-common">
			<div class="content_holder">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<!-- BLOG POST -->
						<?php get_template_part('content', get_post_format()); ?>
						<!-- END OF BLOG POST -->

						<?php
					endwhile;
				else:
					?>
					<?php get_template_part('content', 'none'); ?>
				<?php endif; ?>
			</div>
			<!-- SIDEBARS -->
			<?php if ($zass_has_sidebar): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			<?php if ($zass_has_offcanvas_sidebar): ?>
				<?php get_sidebar('offcanvas'); ?>
			<?php endif; ?>
			<!-- END OF IDEBARS -->
			<div class="clear"></div>

			<!-- PAGINATION -->
			<div class="box box-common">
				<?php
				if (function_exists('zass_pagination')) : zass_pagination();
				else :
					?>

					<div class="navigation group">
						<div class="alignleft"><?php next_posts_link(esc_html__('Next &raquo;', 'zass')) ?></div>
						<div class="alignright"><?php previous_posts_link(esc_html__('&laquo; Back', 'zass')) ?></div>
					</div>

				<?php endif; ?>
			</div>
			<!-- END OF PAGINATION -->

		</div>
		<!-- END OF CONTENT WRAPPER -->
	</div>
</div>
<?php
get_footer();

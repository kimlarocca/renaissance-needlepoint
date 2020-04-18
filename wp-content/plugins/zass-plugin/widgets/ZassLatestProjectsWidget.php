<?php
defined( 'ABSPATH' ) || exit;

/**
 * Zass latest projects widget class
 */
class ZassLatestProjectsWidget extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'zass_latest_projects_widget', 'description' => esc_html__("List your projects with configurable options.", 'zass-plugin'));
		parent::__construct('zass_latest_projects', esc_html__('Zass Latest Projects', 'zass-plugin'), $widget_ops);
		$this->alt_option_name = 'widget_latest_projects';

		add_action('save_post', array($this, 'flush_widget_cache'));
		add_action('deleted_post', array($this, 'flush_widget_cache'));
		add_action('switch_theme', array($this, 'flush_widget_cache'));
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('zass_widget_latest_projects', 'widget');

		if (!is_array($cache)) {
			$cache = array();
		}

		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		if (isset($cache[$args['widget_id']])) {
			echo esc_attr($cache[$args['widget_id']]);
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Latest Projects', 'zass-plugin') : $instance['title'], $instance, $this->id_base);
		if (empty($instance['number']) || !$number = absint($instance['number'])) {
			$number = 10;
		}

		$r = new WP_Query(array('post_type' => 'zass-portfolio', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish'));

		if ($r->have_posts()) :
			?>
			<?php echo wp_kses_post($before_widget); ?>
			<?php if ($title): ?>
				<?php echo wp_kses_post($before_title . $title . $after_title); ?>
			<?php endif; ?>
			<ul class="post-list fixed">
				<?php while ($r->have_posts()) : $r->the_post(); ?>
					<?php if (has_post_thumbnail()): ?>
						<li>
							<a href="<?php esc_url(the_permalink()) ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID() ); ?>">
								<?php the_post_thumbnail('zass-general-small-size'); ?>
							</a>
						</li>
					<?php endif; ?>
				<?php endwhile; ?>
			</ul>
			<?php echo wp_kses_post($after_widget); ?>
			<?php
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('zass_widget_latest_projects', $cache, 'widget');
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get('alloptions', 'options');
		if (isset($alloptions['widget_latest_projects'])) {
			delete_option('widget_latest_projects');
		}

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('zass_widget_latest_projects', 'widget');
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'zass-plugin'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of projects to show:', 'zass-plugin'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

		<?php
	}

}

add_action('widgets_init', 'zass_register_zass_latest_projects_widget');
if (!function_exists('zass_register_zass_latest_projects_widget')) {

	function zass_register_zass_latest_projects_widget() {
		register_widget('ZassLatestProjectsWidget');
	}

}
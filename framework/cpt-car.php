<?php
/*
 * Car CPT
 */

function autoart_car_register()
{
	$cpt_slug = get_theme_mod('autoart_car_slug');

	if (isset($cpt_slug) && $cpt_slug != '') {
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'cars';
	}

	$labels = array(
		'name'               => esc_html__('Cars', 'autoart'),
		'singular_name'      => esc_html__('Car', 'autoart'),
		'add_new'            => esc_html__('Add New', 'autoart'),
		'add_new_item'       => esc_html__('Add New Car', 'autoart'),
		'all_items'          => esc_html__('All Cars', 'autoart'),
		'edit_item'          => esc_html__('Edit Car', 'autoart'),
		'new_item'           => esc_html__('Add New Car', 'autoart'),
		'view_item'          => esc_html__('View Item', 'autoart'),
		'search_items'       => esc_html__('Search Cars', 'autoart'),
		'not_found'          => esc_html__('No car(s) found', 'autoart'),
		'not_found_in_trash' => esc_html__('No car(s) found in trash', 'autoart')
	);

	$args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => true,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'show_in_rest' 		=> false,
		'supports'        => array('title', 'editor', 'thumbnail', 'comments')
	);

	add_filter('enter_title_here',  'autoart_car_change_default_title');

	register_post_type('car', $args);
}
add_action('init', 'autoart_car_register', 1);


function autoart_car_taxonomy()
{
	register_taxonomy(
		"car_body",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Body', 'autoart'),
			"singular_label" => __('Body', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_condition",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Condition', 'autoart'),
			"singular_label" => __('Condition', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_make",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Make', 'autoart'),
			"singular_label" => __('Make', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_model",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Model', 'autoart'),
			"singular_label" => __('Model', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_fuel_type",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Fuel Type', 'autoart'),
			"singular_label" => __('Fuel Type', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_transmission",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Transmission', 'autoart'),
			"singular_label" => __('Transmission', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_door",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Door', 'autoart'),
			"singular_label" => __('Door', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_engine",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Engine', 'autoart'),
			"singular_label" => __('Engine', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_cylinder",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Cylinder', 'autoart'),
			"singular_label" => __('Cylinder', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_color",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => __('Color', 'autoart'),
			"singular_label" => __('Color', 'autoart'),
			"rewrite"        => true
		)
	);

	register_taxonomy(
		"car_categories",
		array("car"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
		'car_tag',
		'car',
		array(
			'hierarchical'  => false,
			'label'         => __('Tags', 'autoart'),
			'singular_name' => __('Tag', 'autoart'),
			'rewrite'       => true,
			'query_var'     => true
		)
	);
}
add_action('init', 'autoart_car_taxonomy', 1);

function autoart_car_change_default_title($title)
{
	$screen = get_current_screen();

	if ('car' == $screen->post_type)
		$title = esc_html__("Enter the car's name here", 'autoart');

	return $title;
}


function autoart_car_edit_columns($car_columns)
{
	$car_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'autoart'),
		"thumbnail"              => esc_html__('Thumbnail', 'autoart'),
		"car_categories" 			 => esc_html__('Categories', 'autoart'),
		"date"                   => esc_html__('Date', 'autoart'),
	);
	return $car_columns;
}
add_filter('manage_edit-car_columns', 'autoart_car_edit_columns');

function autoart_car_column_display($car_columns, $post_id)
{

	switch ($car_columns) {

			// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);

			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
			}
			if (isset($thumb)) {
				echo wp_kses_post($thumb);
			} else {
				echo esc_html__('None', 'autoart');
			}
			break;

			// Display the car tags in the column view
		case "car_categories":
			if ($category_list = get_the_term_list($post_id, 'car_categories', '', ', ', '')) {
				echo wp_kses_post($category_list);
			} else {
				echo esc_html__('None', 'autoart');
			}
			break;
	}
}
add_action('manage_car_posts_custom_column', 'autoart_car_column_display', 10, 2);

/* Create Cars Wishlist Page */
function autoart_car_create_pages_support()
{
	$cars_wishlist_page = get_posts(array(
		'title' => 'Cars Wishlist',
		'post_type' => 'page',
		'post_status'    => 'any'
	));

	if (count($cars_wishlist_page) == 0) {
		wp_insert_post(array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'post_title' => 'Cars Wishlist',
			'post_content' => 'Cars Wishlist Page.',
			'post_name' => 'cars-wishlist',
		));
	}

	$cars_wishlist_page = get_posts(array(
		'title' => 'Cars Compare',
		'post_type' => 'page',
		'post_status'    => 'any'
	));

	if (count($cars_wishlist_page) == 0) {
		wp_insert_post(array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'post_title' => 'Cars Compare',
			'post_content' => 'Cars Compare Page.',
			'post_name' => 'cars-compare',
		));
	}
}
add_action('init', 'autoart_car_create_pages_support', 1);

/* Cars wishlist */
function autoart_is_wishlist($post_id)
{
	if (isset($_COOKIE['carwishlistcookie']) && $_COOKIE['carwishlistcookie'] != '') {
		$car_wishlist = explode(',', $_COOKIE['carwishlistcookie']);

		if (in_array((string)$post_id, $car_wishlist)) {
			return true;
		} else {
			return false;
		}
	}
}

/* Cars compare */
function autoart_is_compare($post_id)
{
	if (isset($_COOKIE['carcomparecookie']) && $_COOKIE['carcomparecookie'] != '') {
		$car_compare = explode(',', $_COOKIE['carcomparecookie']);

		if (in_array((string)$post_id, $car_compare)) {
			return true;
		} else {
			return false;
		}
	}
}

/* Cars filter */
function autoart_end_meta_value($end = 'max', $meta_key = '')
{
	if (empty($meta_key)) {
		return;
	}

	$query_args = array(
		'post_type' => 'car',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'meta_key' => $meta_key,
		'orderby' => 'meta_value_num',
		'order' => $end == 'max' ? 'DESC' : 'ASC',
	);

	$wp_query = new \WP_Query($query_args);
	if ($wp_query->have_posts()) {
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			if (function_exists('get_field')) {
				return get_field($meta_key, get_the_ID());
			}
		}
	}

	return 0;
}

function autoart_list_meta_value($meta_key = '')
{
	if (empty($meta_key)) {
		return;
	}

	$value_arr = array();

	$query_args = array(
		'post_type' => 'car',
		'post_status' => 'publish',
		'meta_key' => $meta_key,
	);

	$wp_query = new \WP_Query($query_args);
	if ($wp_query->have_posts()) {
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			if (function_exists('get_field')) {
				$meta_value = get_field($meta_key, get_the_ID());
				if (!empty($meta_value) && !in_array($meta_value, $value_arr)) {
					$value_arr[] = $meta_value;
				}
			}
		}
	}

	return $value_arr;
}

function autoart_cars_field_slider_html($meta_key = '', $field_title = '', $field_min_value = '', $field_max_value = '', $field_range_step = 1, $field_number_format = false)
{
	if (empty($meta_key)) {
		return;
	}

	$min_value = autoart_end_meta_value('min', $meta_key);
	$max_value = autoart_end_meta_value('max', $meta_key);

	if ($min_value == $max_value) {
		return;
	}

	$start_min_value = !empty($field_min_value) ? $field_min_value : $min_value;
	$start_max_value = !empty($field_max_value) ? $field_max_value : $max_value;

?>
	<input type="hidden" id="<?php echo 'bt_field_min_value_' . $meta_key; ?>" name="<?php echo esc_attr($meta_key)  . '_min'; ?>" value="<?php echo esc_attr($field_min_value); ?>">
	<input type="hidden" id="<?php echo 'bt_field_max_value_' . $meta_key; ?>" name="<?php echo esc_attr($meta_key) . '_max'; ?>" value="<?php echo esc_attr($field_max_value); ?>">

	<div class="bt-form-field bt-field-type-slider <?php echo 'bt-field-' . $meta_key; ?>" data-meta-key="<?php echo esc_attr($meta_key); ?>" data-range-min="<?php echo intval($min_value); ?>" data-range-max="<?php echo intval($max_value); ?>" data-start-min="<?php echo intval($start_min_value); ?>" data-start-max="<?php echo intval($start_max_value); ?>" data-range-step="<?php echo intval($field_range_step); ?>" " data-number-format="<?php echo intval($field_number_format); ?>">
		<?php
		if (!empty($field_title)) {
			echo '<div class="bt-field-title">' . $field_title . '</div>';
		}
		?>
		<div id="<?php echo 'bt_field_slider_' . $meta_key; ?>" class="bt-field-slider"></div>
		<div class="bt-labels-slider">
			<span id="<?php echo 'bt_min_value_' . $meta_key; ?>" class="bt-min-value"></span>
			<span id="<?php echo 'bt_max_value_' . $meta_key; ?>" class="bt-max-value"></span>
		</div>
	</div>
<?php
}

function autoart_cars_field_select_range_html($meta_key = '', $field_title = '', $field_value = '', $field_step = 10)
{
	if (empty($meta_key)) {
		return;
	}

	$min_value = autoart_end_meta_value('min', $meta_key);
	$max_value = autoart_end_meta_value('max', $meta_key);

	if ($min_value == $max_value) {
		return;
	}

?>
	<div class="bt-form-field bt-field-type-select <?php echo 'bt-field-' . $meta_key; ?>">
		<select name="<?php echo esc_attr($meta_key); ?>">
			<option value="">
				<?php
				if (!empty($field_title)) {
					echo esc_html($field_title);
				} else {
					echo esc_html('Select', 'autoart');
				}
				?>
			</option>
			<?php
			$step_value = array(1, 10, 50, 100, 200, 500, 1000, 2000, 5000, 10000, 20000, 50000, 100000);
			$start_value = 0;

			for ($i = 0; $i <= count($step_value); $i++) {
				$end_value = $field_step * $step_value[$i];
				if ($i == count($step_value) || $end_value > $max_value) {
					if ($field_value == $start_value . '-over') {
			?>
						<option value="<?php echo esc_attr($start_value . '-over'); ?>" selected="selected">
							<?php echo esc_html__('Over ', 'autoart') . number_format($start_value, 0); ?>
						</option>
					<?php
					} else {
					?>
						<option value="<?php echo esc_attr($start_value . '-over'); ?>">
							<?php echo esc_html__('Over ', 'autoart') . number_format($start_value, 0); ?>
						</option>
					<?php
					}
					break;
				} else {
					if ($field_value == $start_value . '-' . $end_value) {
					?>
						<option value="<?php echo esc_attr($start_value . '-' . $end_value); ?>" selected="selected">
							<?php echo number_format($start_value, 0) . ' - ' . number_format($end_value, 0); ?>
						</option>
					<?php
					} else {
					?>
						<option value="<?php echo esc_attr($start_value . '-' . $end_value); ?>">
							<?php echo number_format($start_value, 0) . ' - ' . number_format($end_value, 0); ?>
						</option>
			<?php
					}
				}
				$start_value = $end_value;
			}
			?>
		</select>
	</div>
	<?php
}

function autoart_cars_field_select_number_html($meta_key = '', $field_title = '', $field_value = '')
{
	if (empty($meta_key)) {
		return;
	}

	$value_arr = autoart_list_meta_value($meta_key);

	if (!empty($value_arr)) {
	?>
		<div class="bt-form-field bt-field-type-select <?php echo 'bt-field-' . $meta_key; ?>">
			<select name="<?php echo esc_attr($meta_key); ?>">
				<option value="">
					<?php
					if (!empty($field_title)) {
						echo esc_html($field_title);
					} else {
						echo esc_html('Select', 'autoart');
					}
					?>
				</option>
				<?php foreach ($value_arr as $value) { ?>
					<?php if ($value == $field_value) { ?>
						<option value="<?php echo esc_attr($value); ?>" selected="selected">
							<?php echo esc_html($value); ?>
						</option>
					<?php } else { ?>
						<option value="<?php echo esc_attr($value); ?>">
							<?php echo esc_html($value); ?>
						</option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	<?php
	}
}

function autoart_cars_field_select_html($slug = '', $field_title = '', $field_value = '')
{
	if (empty($slug)) {
		return;
	}

	$terms = get_terms(array(
		'taxonomy' => $slug,
		'hide_empty' => true
	));

	if (!empty($terms)) {
	?>
		<div class="bt-form-field bt-field-type-select <?php echo 'bt-field-' . $slug; ?>">
			<select name="<?php echo esc_attr($slug); ?>">
				<option value="">
					<?php
					if (!empty($field_title)) {
						echo esc_html($field_title);
					} else {
						echo esc_html('Select', 'autoart');
					}
					?>
				</option>
				<?php foreach ($terms as $term) { ?>
					<?php if ($term->slug == $field_value) { ?>
						<option value="<?php echo esc_attr($term->slug); ?>" selected="selected">
							<?php echo esc_html($term->name); ?>
						</option>
					<?php } else { ?>
						<option value="<?php echo esc_attr($term->slug); ?>">
							<?php echo esc_html($term->name); ?>
						</option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	<?php
	}
}

function autoart_cars_field_radio_html($slug = '', $field_title = '', $field_value = '')
{
	if (empty($slug)) {
		return;
	}

	$terms = get_terms(array(
		'taxonomy' => $slug,
		'hide_empty' => true
	));

	$field_title_default = !empty($field_title) ? $field_title : 'Choose';

	if (!empty($terms)) { ?>
		<div class="bt-form-field bt-field-type-radio <?php echo 'bt-field-' . $slug; ?>">
			<div class="item-radio">
				<input type="radio" name="<?php echo esc_attr($slug); ?>" value="" checked>
				<label for="<?php echo esc_html($field_title_default) ?>"> <?php echo esc_html($field_title_default) ?> </label>
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 520 520" fill="currentColor">
					<path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"></path>
				</svg>
			</div>

			<?php foreach ($terms as $term) { ?>
				<?php if ($term->slug == $field_value) { ?>
					<div class="item-radio">
						<input type="radio" name="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($term->slug); ?>" checked>
						<label for="<?php echo esc_html($term->name); ?>"> <?php echo esc_html($term->name); ?> </label>
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 520 520" fill="currentColor">
							<path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"></path>
						</svg>
					</div>
				<?php } else { ?>
					<div class="item-radio">
						<input type="radio" name="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($term->slug); ?>">
						<label for="<?php echo esc_html($term->name); ?>"> <?php echo esc_html($term->name); ?> </label>
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 520 520" fill="currentColor">
							<path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"></path>
						</svg>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php }
}

function autoart_cars_field_multiple_html($slug = '', $field_title = '', $field_value = '')
{
	if (empty($slug)) {
		return;
	}

	$terms = get_terms(array(
		'taxonomy' => $slug,
		'hide_empty' => true
	));

	if (!empty($terms)) {
	?>
		<div class="bt-form-field bt-field-type-multi" data-name="<?php echo esc_attr($slug); ?>">
			<?php
			if (!empty($field_title)) {
				echo '<div class="bt-field-title">' . $field_title . '</div>';
			}
			?>

			<div class="bt-field-list">
				<?php foreach ($terms as $term) { ?>
					<div class="<?php echo (str_contains($field_value, $term->slug)) ? 'bt-field-item checked' : 'bt-field-item' ?>">
						<a href="#" data-slug="<?php echo esc_attr($term->slug); ?>">
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 520 520" fill="currentColor">
									<path d="M79.423 240.755a47.529 47.529 0 0 0-36.737 77.522l120.73 147.894a43.136 43.136 0 0 0 36.066 16.009c14.654-.787 27.884-8.626 36.319-21.515L486.588 56.773a6.13 6.13 0 0 1 .128-.2c2.353-3.613 1.59-10.773-3.267-15.271a13.321 13.321 0 0 0-19.362 1.343q-.135.166-.278.327L210.887 328.736a10.961 10.961 0 0 1-15.585.843l-83.94-76.386a47.319 47.319 0 0 0-31.939-12.438z"></path>
								</svg>
							</span>
							<?php echo esc_html($term->name); ?>
						</a>
					</div>
				<?php } ?>
			</div>

			<input type="hidden" name="<?php echo esc_attr($slug); ?>" value="<?php echo esc_attr($field_value); ?>">
		</div>
	<?php
	}
}

function autoart_cars_pagination($current_page, $total_page)
{
	if (1 >= $total_page) {
		return;
	}

	ob_start();
	?>
	<nav class="bt-pagination bt-car-pagination" role="navigation">
		<?php if (1 != $current_page) { ?>
			<a class="prev page-numbers" href="#" data-page="<?php echo esc_attr($current_page - 1); ?>"><svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"></path>
				</svg> <?php echo esc_html__('Prev', 'autoart'); ?></a>
		<?php } ?>

		<?php
		for ($i = 1; $i <= $total_page; $i++) {
			if (7 > $total_page) {
				if ($i == $current_page) {
					echo '<span class="page-numbers current">' . $i . '</span>';
				} else {
					echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
				}
			} else {
				if ($i == $current_page) {
					echo '<span class="page-numbers current">' . $i . '</span>';
				}

				if (5 > $current_page) {
					if ($i != $current_page && $i < $current_page + 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page + 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == $total_page) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}

				if ($total_page - 4 < $current_page) {
					if ($i != $current_page && $i > $current_page - 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page - 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == 1) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}

				if ($total_page - 4 >= $current_page && 5 <= $current_page) {
					if ($i != $current_page && $i > $current_page - 3 && $i < $current_page + 3) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $current_page - 3 || $i == $current_page + 3) {
						echo '<span class="page-numbers dots">...</span>';
					}

					if ($i == 1) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}

					if ($i == $total_page) {
						echo '<a class="page-numbers" href="#" data-page="' . $i . '">' . $i . '</a>';
					}
				}
			}
		}
		?>

		<?php if ($total_page != $current_page) { ?>
			<a class="next page-numbers" href="#" data-page="<?php echo esc_attr($current_page + 1); ?>"><?php echo esc_html__('Next', 'autoart'); ?> <svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"></path>
				</svg></a>
		<?php } ?>
	</nav>
	<?php
	return ob_get_clean();
}

function autoart_cars_query_args($params = array(), $limit = 12)
{
	$query_args = array(
		'post_type' => 'car',
		'post_status' => 'publish',
		'posts_per_page' => $limit
	);

	if (isset($params['current_page']) && $params['current_page'] != '') {
		$query_args['paged'] = absint($params['current_page']);
	}

	if (isset($params['search_keyword']) && $params['search_keyword'] != '') {
		$query_args['s'] = $params['search_keyword'];
	}

	if (isset($params['sort_order']) && $params['sort_order'] != '') {
		if ($params['sort_order'] == 'date_high' || $params['sort_order'] == 'date_low') {
			$query_args['orderby'] = 'date';

			if ($params['sort_order'] == 'date_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}

		if ($params['sort_order'] == 'mileage_high' || $params['sort_order'] == 'mileage_low') {
			$query_args['meta_key'] = 'car_mileage';
			$query_args['orderby'] = 'meta_value_num';

			if ($params['sort_order'] == 'mileage_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}

		if ($params['sort_order'] == 'price_high' || $params['sort_order'] == 'price_low') {
			$query_args['meta_key'] = 'car_price';
			$query_args['orderby'] = 'meta_value_num';

			if ($params['sort_order'] == 'price_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}
	}

	$query_tax = array();

	if (isset($params['car_categories']) && $params['car_categories'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_categories',
			'field' => 'slug',
			'terms' => explode(',', $params['car_categories'])
		);
	}

	if (isset($params['car_body']) && $params['car_body'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_body',
			'field' => 'slug',
			'terms' => explode(',', $params['car_body'])
		);
	}

	if (isset($params['car_condition']) && $params['car_condition'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_condition',
			'field' => 'slug',
			'terms' => explode(',', $params['car_condition'])
		);
	}

	if (isset($params['car_make']) && $params['car_make'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_make',
			'field' => 'slug',
			'terms' => explode(',', $params['car_make'])
		);
	}

	if (isset($params['car_model']) && $params['car_model'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_model',
			'field' => 'slug',
			'terms' => explode(',', $params['car_model'])
		);
	}

	if (isset($params['car_fuel_type']) && $params['car_fuel_type'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_fuel_type',
			'field' => 'slug',
			'terms' => explode(',', $params['car_fuel_type'])
		);
	}

	if (isset($params['car_transmission']) && $params['car_transmission'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_transmission',
			'field' => 'slug',
			'terms' => explode(',', $params['car_transmission'])
		);
	}

	if (isset($params['car_door']) && $params['car_door'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_door',
			'field' => 'slug',
			'terms' => explode(',', $params['car_door'])
		);
	}

	if (isset($params['car_engine']) && $params['car_engine'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_engine',
			'field' => 'slug',
			'terms' => explode(',', $params['car_engine'])
		);
	}

	if (isset($params['car_color']) && $params['car_color'] != '') {
		$query_tax[] = array(
			'taxonomy' => 'car_color',
			'field' => 'slug',
			'terms' => explode(',', $params['car_color'])
		);
	}

	if (!empty($query_tax)) {
		$query_args['tax_query'] = $query_tax;
	}

	$query_meta = array();

	if (isset($params['car_mileage_min']) && $params['car_mileage_min'] != '' && isset($params['car_mileage_max']) && $params['car_mileage_max'] != '') {
		$query_meta['mileage_clause'] = array(
			'relation' => 'AND',
			array(
				'key'     => 'car_mileage',
				'value'   => absint($params['car_mileage_min']),
				'compare' => '>=',
				'type'    => 'numeric'
			),
			array(
				'key'     => 'car_mileage',
				'value'   => absint($params['car_mileage_max']),
				'compare' => '<',
				'type'    => 'numeric'
			)
		);
	}

	if (isset($params['car_mileage']) && $params['car_mileage'] != '') {
		$mileage = explode('-', $params['car_mileage']);

		if ($mileage[1] == 'over') {
			$query_meta['mileage_clause'] = array(
				array(
					'key'     => 'car_mileage',
					'value'   => absint($mileage[0]),
					'compare' => '>=',
					'type'    => 'numeric'
				)
			);
		} else {
			$query_meta['mileage_clause'] = array(
				'relation' => 'AND',
				array(
					'key'     => 'car_mileage',
					'value'   => absint($mileage[0]),
					'compare' => '>=',
					'type'    => 'numeric'
				),
				array(
					'key'     => 'car_mileage',
					'value'   => absint($mileage[1]),
					'compare' => '<',
					'type'    => 'numeric'
				)
			);
		}
	}

	if (isset($params['car_price_min']) && $params['car_price_min'] != '' && isset($params['car_price_max']) && $params['car_price_max'] != '') {
		$query_meta['price_clause'] = array(
			'relation' => 'AND',
			array(
				'key'     => 'car_price',
				'value'   => absint($params['car_price_min']),
				'compare' => '>=',
				'type'    => 'numeric'
			),
			array(
				'key'     => 'car_price',
				'value'   => absint($params['car_price_max']),
				'compare' => '<',
				'type'    => 'numeric'
			)
		);
	}

	if (isset($params['car_price']) && $params['car_price'] != '') {
		$price = explode('-', $params['car_price']);

		if ($price[1] == 'over') {
			$query_meta['price_clause'] = array(
				array(
					'key'     => 'car_price',
					'value'   => absint($price[0]),
					'compare' => '>=',
					'type'    => 'numeric'
				)
			);
		} else {
			$query_meta['price_clause'] = array(
				'relation' => 'AND',
				array(
					'key'     => 'car_price',
					'value'   => absint($price[0]),
					'compare' => '>=',
					'type'    => 'numeric'
				),
				array(
					'key'     => 'car_price',
					'value'   => absint($price[1]),
					'compare' => '<',
					'type'    => 'numeric'
				)
			);
		}
	}

	if (isset($params['car_year_min']) && $params['car_year_min'] != '' && isset($params['car_year_max']) && $params['car_year_max'] != '') {
		$query_meta['year_clause'] = array(
			'relation' => 'AND',
			array(
				'key'     => 'car_year',
				'value'   => absint($params['car_year_min']),
				'compare' => '>=',
				'type'    => 'numeric'
			),
			array(
				'key'     => 'car_year',
				'value'   => absint($params['car_year_max']),
				'compare' => '<',
				'type'    => 'numeric'
			)
		);
	}

	if (isset($params['car_year']) && $params['car_year'] != '') {
		$query_meta['year_clause'] = array(
			array(
				'key'     => 'car_year',
				'value'   => absint($params['car_year']),
				'compare' => '=',
				'type'    => 'numeric'
			)
		);
	}

	if (isset($params['car_dealer']) && $params['car_dealer'] != '') {
		$query_meta['dealer_clause'] = array(
			array(
				'key'     => 'car_dealer',
				'value'   => absint($params['car_dealer']),
				'compare' => '=',
				'type'    => 'numeric'
			)
		);
	}

	if (!empty($query_meta)) {
		$query_args['meta_query'] = $query_meta;
		$query_args['relation'] = 'AND';
	}

	return $query_args;
}

function autoart_cars_filter()
{
	$archive_page = get_field('car_archive_page', 'options');
	$limit = !empty($archive_page['number_posts']) ? $archive_page['number_posts'] : 12;
	$query_args = autoart_cars_query_args($_POST, $limit);
	$wp_query = new \WP_Query($query_args);
	$current_page = isset($_POST['current_page']) && $_POST['current_page'] != '' ? absint($_POST['current_page']) : 1;
	$total_page = $wp_query->max_num_pages;

	$paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
	$prev_posts = ($paged - 1) * $wp_query->query_vars['posts_per_page'];
	$from = 1 + $prev_posts;
	$to = count($wp_query->posts) + $prev_posts;
	$of = $wp_query->found_posts;

	// Update Results Block
	ob_start();
	if ($of > 0) {
		printf(esc_html__('Showing %s - %s of %s results', 'autoart'), $from, $to, $of);
	} else {
		echo esc_html__('No results', 'autoart');
	}
	$output['results'] = ob_get_clean();

	// Update Layout view
	$view = isset($_POST['view_type']) && $_POST['view_type'] != '' ? $_POST['view_type'] : '';
	$output['view'] = $view;

	// Update Loop Post
	if ($wp_query->have_posts()) {
		ob_start();
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			get_template_part('framework/templates/car', 'style', array('image-size' => 'medium_large'));
		}

		$output['items'] = ob_get_clean();
		$output['pagination'] = autoart_cars_pagination($current_page, $total_page);
	} else {
		$output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
		$output['pagination'] = '';
	}

	wp_reset_postdata();

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_autoart_cars_filter', 'autoart_cars_filter');
add_action('wp_ajax_nopriv_autoart_cars_filter', 'autoart_cars_filter');

/* Cars Grid List */
function autoart_cars_grid_list_query_args($params = array(), $orderby = 'date', $order = 'DESC', $limit = 12, $category = array(), $category_exclude = array())
{
	$query_args = array(
		'post_type' => 'car',
		'post_status' => 'publish',
		'oderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $limit
	);

	if (!empty($category)) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' 		=> 'car_categories',
				'terms' 		=> $category,
				'field' 		=> 'term_id',
				'operator' 		=> 'IN'
			)
		);
	}
	if (!empty($category_exclude)) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' 		=> 'car_categories',
				'terms' 		=> $category_exclude,
				'field' 		=> 'term_id',
				'operator' 		=> 'NOT IN'
			)
		);
	}
	if (isset($params['current_page']) && $params['current_page'] != '') {
		$query_args['paged'] = absint($params['current_page']);
	}

	if (isset($params['sort_order']) && $params['sort_order'] != '') {
		if ($params['sort_order'] == 'date_high' || $params['sort_order'] == 'date_low') {
			$query_args['orderby'] = 'date';

			if ($params['sort_order'] == 'date_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}

		if ($params['sort_order'] == 'mileage_high' || $params['sort_order'] == 'mileage_low') {
			$query_args['meta_key'] = 'car_mileage';
			$query_args['orderby'] = 'meta_value_num';

			if ($params['sort_order'] == 'mileage_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}

		if ($params['sort_order'] == 'price_high' || $params['sort_order'] == 'price_low') {
			$query_args['meta_key'] = 'car_price';
			$query_args['orderby'] = 'meta_value_num';

			if ($params['sort_order'] == 'price_high') {
				$query_args['order'] = 'DESC';
			} else {
				$query_args['order'] = 'ASC';
			}
		}
	}
	return $query_args;
}
function autoart_cars_grid_list_filter()
{
	$orderby = isset($_POST['orderby']) && $_POST['orderby'] != '' ? $_POST['orderby'] : 'date';
	$order = isset($_POST['order']) && $_POST['order'] != '' ? $_POST['order'] : 'DESC';
	$posts_per_page = isset($_POST['posts_per_page']) && $_POST['posts_per_page'] != '' ? $_POST['posts_per_page'] : 6;
	$category = isset($_POST['category']) && $_POST['category'] != '' ? explode(',', $_POST['category']) : array();
	$category_exclude = isset($_POST['category_exclude']) && $_POST['category_exclude'] != '' ? explode(',', $_POST['category_exclude']) : array();


	$query_args = autoart_cars_grid_list_query_args($_POST, $orderby, $order, $posts_per_page, $category, $category_exclude);
	$wp_query = new \WP_Query($query_args);

	$thumbnail_size = isset($_POST['thumbnail_size']) && $_POST['thumbnail_size'] != '' ? $_POST['thumbnail_size'] : 'medium_large';
	$layout_style = isset($_POST['layout_style']) && $_POST['layout_style'] != '' ? $_POST['layout_style'] : 'default';
	$current_page = isset($_POST['current_page']) && $_POST['current_page'] != '' ? absint($_POST['current_page']) : 1;
	$total_page = $wp_query->max_num_pages;

	$paged = !empty($wp_query->query_vars['paged']) ? $wp_query->query_vars['paged'] : 1;
	$prev_posts = ($paged - 1) * $wp_query->query_vars['posts_per_page'];
	$from = 1 + $prev_posts;
	$to = count($wp_query->posts) + $prev_posts;
	$of = $wp_query->found_posts;

	// Update Results Block
	ob_start();
	if ($of > 0) {
		printf(esc_html__('Showing %s - %s of %s results', 'autoart'), $from, $to, $of);
	} else {
		echo esc_html__('No results', 'autoart');
	}
	$output['results'] = ob_get_clean();

	// Update Layout view
	$view = isset($_POST['view_type']) && $_POST['view_type'] != '' ? $_POST['view_type'] : '';
	$output['view'] = $view;

	// Update Loop Post
	if ($wp_query->have_posts()) {
		ob_start();
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			if ($layout_style  == 'default') {
				get_template_part('framework/templates/car', 'style', array('image-size' => $settings['thumbnail_size']));
			} elseif ($layout_style == 'style1') {
				get_template_part('framework/templates/car', 'style1', array('image-size' => $settings['thumbnail_size']));
			} else {
				get_template_part('framework/templates/car', 'style2', array('image-size' => $settings['thumbnail_size']));
			}
		}

		$output['items'] = ob_get_clean();
		$output['pagination'] = autoart_cars_pagination($current_page, $total_page);
	} else {
		$output['items'] = '<h3 class="not-found-post">' . esc_html__('Sorry, No results', 'autoart') . '</h3>';
		$output['pagination'] = '';
	}

	wp_reset_postdata();

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_autoart_cars_grid_list_filter', 'autoart_cars_grid_list_filter');
add_action('wp_ajax_nopriv_autoart_cars_grid_list_filter', 'autoart_cars_grid_list_filter');

function autoart_cars_wishlist()
{
	if (isset($_POST['carwishlistcookie']) && !empty($_POST['carwishlistcookie'])) {
		$car_ids = explode(',', $_COOKIE['carwishlistcookie']);
		$output['count'] = count($car_ids);

		ob_start();
		foreach ($car_ids as $key => $id) {
	?>
			<div class="bt-table--row bt-car-item">
				<div class="bt-table--col bt-car-remove">
					<a href="#" data-id="<?php echo esc_attr($id); ?>" class="bt-car-remove-wishlist">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
							<path d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"></path>
							<path d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM336 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM176 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"></path>
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
							<path d="M493.815 70.629c-11.001-1.003-20.73 7.102-21.733 18.102l-2.65 29.069C424.473 47.194 346.429 0 256 0 158.719 0 72.988 55.522 30.43 138.854c-5.024 9.837-1.122 21.884 8.715 26.908 9.839 5.024 21.884 1.123 26.908-8.715C102.07 86.523 174.397 40 256 40c74.377 0 141.499 38.731 179.953 99.408l-28.517-20.367c-8.989-6.419-21.48-4.337-27.899 4.651-6.419 8.989-4.337 21.479 4.651 27.899l86.475 61.761c12.674 9.035 30.155.764 31.541-14.459l9.711-106.53c1.004-11.001-7.1-20.731-18.1-21.734zM472.855 346.238c-9.838-5.023-21.884-1.122-26.908 8.715C409.93 425.477 337.603 472 256 472c-74.377 0-141.499-38.731-179.953-99.408l28.517 20.367c8.989 6.419 21.479 4.337 27.899-4.651 6.419-8.989 4.337-21.479-4.651-27.899l-86.475-61.761c-12.519-8.944-30.141-.921-31.541 14.459L.085 419.637c-1.003 11 7.102 20.73 18.101 21.733 11.014 1.001 20.731-7.112 21.733-18.102l2.65-29.069C87.527 464.806 165.571 512 256 512c97.281 0 183.012-55.522 225.57-138.854 5.024-9.837 1.122-21.884-8.715-26.908z"></path>
						</svg>
					</a>
				</div>
				<div class="bt-table--col bt-car-thumb">
					<a href="<?php echo get_the_permalink($id); ?>" class="bt-thumb">
						<div class="bt-cover-image">
							<?php echo get_the_post_thumbnail($id, 'medium'); ?>
						</div>
					</a>
				</div>
				<div class="bt-table--col bt-car-title">
					<h3 class="bt-title">
						<a href="<?php echo get_the_permalink($id); ?>">
							<?php echo get_the_title($id); ?>
						</a>
					</h3>
					<div class="bt-car-meta-mobile">
						<div class="bt-price-mobile">
							<?php
							$price = get_field('car_price', $id);

							if (!empty($price)) {
								echo '<span>$' . number_format($price, 0) . '</span>';
							} else {
								echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
							}
							?>
						</div>
						<div class="bt-stock-mobile">
							<?php
							$stock = get_field('car_stock_status', $id);
							echo '<span>' . str_replace('_', ' ', $stock) . '</span>';
							?>
						</div>
					</div>
				</div>
				<div class="bt-table--col bt-car-price">
					<?php
					$price = get_field('car_price', $id);

					if (!empty($price)) {
						echo '<span>$' . number_format($price, 0) . '</span>';
					} else {
						echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
					}
					?>
				</div>
				<div class="bt-table--col bt-car-stock">
					<?php
					$stock = get_field('car_stock_status', $id);
					echo '<span>' . str_replace('_', ' ', $stock) . '</span>';
					?>
				</div>
				<div class="bt-table--col bt-car-seller">
					<?php
					$dealer = get_field('car_dealer', $id);
					if (!empty($dealer)) {
						echo '<a href="' . get_the_permalink($dealer) . '" class="bt-seller-btn">' . __('Contact', 'autoart') . '</a>';
					} else {
						echo '<a href="/contact-us/" class="bt-seller-btn">' . __('Contact', 'autoart') . '</a>';
					}
					?>
				</div>
			</div>
		<?php
		}
		$output['items'] = ob_get_clean();
	} else {
		$output['items'] = '<div class="bt-no-results">' . __('Post not found!', 'autoart') . '<a href="/cars/">' . __('Back To All Cars', 'autoart') . '</a></div>';
	}

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_autoart_cars_wishlist', 'autoart_cars_wishlist');
add_action('wp_ajax_nopriv_autoart_cars_wishlist', 'autoart_cars_wishlist');

function autoart_mini_wishlist()
{
	if (isset($_POST['carwishlistcookie']) && !empty($_POST['carwishlistcookie'])) {
		$car_ids = explode(',', $_COOKIE['carwishlistcookie']);
		$output['count'] = count($car_ids);


		ob_start();
		foreach ($car_ids as $key => $id) {
		?>
			<div class="bt-mini-wishlist--item">
				<div class="bt-car-remove">
					<a href="#" data-id="<?php echo esc_attr($id); ?>" class="bt-car-remove-mini-wishlist">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
							<path d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"></path>
							<path d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM336 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM176 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"></path>
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
							<path d="M493.815 70.629c-11.001-1.003-20.73 7.102-21.733 18.102l-2.65 29.069C424.473 47.194 346.429 0 256 0 158.719 0 72.988 55.522 30.43 138.854c-5.024 9.837-1.122 21.884 8.715 26.908 9.839 5.024 21.884 1.123 26.908-8.715C102.07 86.523 174.397 40 256 40c74.377 0 141.499 38.731 179.953 99.408l-28.517-20.367c-8.989-6.419-21.48-4.337-27.899 4.651-6.419 8.989-4.337 21.479 4.651 27.899l86.475 61.761c12.674 9.035 30.155.764 31.541-14.459l9.711-106.53c1.004-11.001-7.1-20.731-18.1-21.734zM472.855 346.238c-9.838-5.023-21.884-1.122-26.908 8.715C409.93 425.477 337.603 472 256 472c-74.377 0-141.499-38.731-179.953-99.408l28.517 20.367c8.989 6.419 21.479 4.337 27.899-4.651 6.419-8.989 4.337-21.479-4.651-27.899l-86.475-61.761c-12.519-8.944-30.141-.921-31.541 14.459L.085 419.637c-1.003 11 7.102 20.73 18.101 21.733 11.014 1.001 20.731-7.112 21.733-18.102l2.65-29.069C87.527 464.806 165.571 512 256 512c97.281 0 183.012-55.522 225.57-138.854 5.024-9.837 1.122-21.884-8.715-26.908z"></path>
						</svg>
					</a>
				</div>
				<div class="bt-car-thumb">
					<a href="<?php echo get_the_permalink($id); ?>" class="bt-thumb">
						<div class="bt-cover-image">
							<?php echo get_the_post_thumbnail($id, 'medium'); ?>
						</div>
					</a>
				</div>
				<div class="bt-car-infor">
					<h3 class="bt-car-title">
						<a href="<?php echo get_the_permalink($id); ?>">
							<?php echo get_the_title($id); ?>
						</a>
					</h3>
					<div class="bt-car-price">
						<?php
						$price = get_field('car_price', $id);

						if (!empty($price)) {
							echo '<span>$' . number_format($price, 0) . '</span>';
						} else {
							echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
						}
						?>
					</div>
				</div>
			</div>
	<?php
		}
		$output['items'] = ob_get_clean();
	} else {
		$output['count'] = 0;
		$output['items'] = '<div class="bt-no-results">' . __('Please, add your first item to the wishlist.', 'autoart') . '</a></div>';
	}

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_autoart_mini_wishlist', 'autoart_mini_wishlist');
add_action('wp_ajax_nopriv_autoart_mini_wishlist', 'autoart_mini_wishlist');

function autoart_cars_compare()
{
	$car_ids = array();
	$output['count'] = 0;
	$car_ids = array();

	$ex_items = count($car_ids) < 3 ? 3 - count($car_ids) : 0;
	if (isset($_POST['carcomparecookie']) && !empty($_POST['carcomparecookie'])) {
		$car_ids = explode(',', $_COOKIE['carcomparecookie']);
		$output['count'] = count($car_ids);
	}
	$ex_items = count($car_ids) < 3 ? 3 - count($car_ids) : 0;

	ob_start();
	
	foreach ($car_ids as $key => $id) { 
		?>
			<div class="bt-table--row bt-car-item">
				<div class="bt-table--col bt-car-information">
					<div class="bt-car-remove">
						<a href="#" data-id="<?php echo esc_attr($id); ?>" class="bt-car-remove-compare">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
								<path d="M424 64h-88V48c0-26.467-21.533-48-48-48h-64c-26.467 0-48 21.533-48 48v16H88c-22.056 0-40 17.944-40 40v56c0 8.836 7.164 16 16 16h8.744l13.823 290.283C87.788 491.919 108.848 512 134.512 512h242.976c25.665 0 46.725-20.081 47.945-45.717L439.256 176H448c8.836 0 16-7.164 16-16v-56c0-22.056-17.944-40-40-40zM208 48c0-8.822 7.178-16 16-16h64c8.822 0 16 7.178 16 16v16h-96zM80 104c0-4.411 3.589-8 8-8h336c4.411 0 8 3.589 8 8v40H80zm313.469 360.761A15.98 15.98 0 0 1 377.488 480H134.512a15.98 15.98 0 0 1-15.981-15.239L104.78 176h302.44z"></path>
								<path d="M256 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM336 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16zM176 448c8.836 0 16-7.164 16-16V224c0-8.836-7.164-16-16-16s-16 7.164-16 16v208c0 8.836 7.163 16 16 16z"></path>
							</svg>
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
								<path d="M493.815 70.629c-11.001-1.003-20.73 7.102-21.733 18.102l-2.65 29.069C424.473 47.194 346.429 0 256 0 158.719 0 72.988 55.522 30.43 138.854c-5.024 9.837-1.122 21.884 8.715 26.908 9.839 5.024 21.884 1.123 26.908-8.715C102.07 86.523 174.397 40 256 40c74.377 0 141.499 38.731 179.953 99.408l-28.517-20.367c-8.989-6.419-21.48-4.337-27.899 4.651-6.419 8.989-4.337 21.479 4.651 27.899l86.475 61.761c12.674 9.035 30.155.764 31.541-14.459l9.711-106.53c1.004-11.001-7.1-20.731-18.1-21.734zM472.855 346.238c-9.838-5.023-21.884-1.122-26.908 8.715C409.93 425.477 337.603 472 256 472c-74.377 0-141.499-38.731-179.953-99.408l28.517 20.367c8.989 6.419 21.479 4.337 27.899-4.651 6.419-8.989 4.337-21.479-4.651-27.899l-86.475-61.761c-12.519-8.944-30.141-.921-31.541 14.459L.085 419.637c-1.003 11 7.102 20.73 18.101 21.733 11.014 1.001 20.731-7.112 21.733-18.102l2.65-29.069C87.527 464.806 165.571 512 256 512c97.281 0 183.012-55.522 225.57-138.854 5.024-9.837 1.122-21.884-8.715-26.908z"></path>
							</svg>
						</a>
					</div>
					<div class="bt-car-thumb">
						<a href="<?php echo get_the_permalink($id); ?>">
							<div class="bt-cover-image">
								<?php echo get_the_post_thumbnail($id, 'medium'); ?>
							</div>
						</a>
					</div>
					<h3 class="bt-car-title">
						<a href="<?php echo get_the_permalink($id); ?>">
							<?php echo get_the_title($id); ?>
						</a>
					</h3>
					<div class="bt-car-price">
						<?php
							$price = get_field('car_price', $id);

							if(!empty($price)) {
								echo '<span>$' . number_format($price, 0) . '</span>';
							} else {
								echo '<a href="#">' . esc_html__('Call for price', 'autoart') . '</a>';
							}
						?>
					</div>
				</div>
				<div class="bt-table--col bt-car-body">
					<?php
						$body = get_the_terms( $id, 'car_body' );

						if(!empty($body)) {
							$term = array_pop($body);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-condition">
					<?php
						$condition = get_the_terms( $id, 'car_condition' );

						if(!empty($condition)) {
							$term = array_pop($condition);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-mileage">
					<?php
						$mileage = get_field('car_mileage', $id);

						if(!empty($mileage)) {
							echo '<span class="bt-value">' . number_format($mileage, 0) . esc_html__(' km', 'autoart') . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-engine-size">
					<?php
						$engine = get_the_terms( $id, 'car_engine' );

						if(!empty($engine)) {
							$term = array_pop($engine);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-fuel-type">
					<?php
						$fuel_type = get_the_terms( $id, 'car_fuel_type' );

						if(!empty($fuel_type)) {
							$term = array_pop($fuel_type);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-door">
					<?php
						$door = get_the_terms( $id, 'car_door' );

						if(!empty($door)) {
							$term = array_pop($door);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-year">
					<?php
						$year = get_field('car_year', $id);

						if(!empty($year)) {
							echo '<span class="bt-value">' . $year . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-cylinder">
					<?php
						$cylinder = get_the_terms( $id, 'car_cylinder' );

						if(!empty($cylinder)) {
							$term = array_pop($cylinder);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-transmission">
					<?php
						$transmission = get_the_terms( $id, 'car_transmission' );

						if(!empty($transmission)) {
							$term = array_pop($transmission);
							echo '<span class="bt-value">' . $term->name . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-color">
					<?php
						$color_term = get_the_terms( $id, 'car_color' );
						$color_arr = array();
						if(!empty($color_term)) {
							foreach ($color_term as $color) {
								$color_arr[] = $color->name;
							}
						}

						if(!empty($color_arr)) {
							echo '<span class="bt-value">' . implode(', ', $color_arr) . '</span>';
						} else {
							echo '<span class="bt-value">' . esc_html__('N/A', 'autoart') . '</span>';
						}
					?>
				</div>
				<div class="bt-table--col bt-car-features">
					<?php $features = get_field('car_features', $id); ?>

					<?php if(!empty($features)) { ?>
						<div class="bt-feature-list">
							<?php foreach($features as $feature) { ?>
					<div class="bt-feature-item">
						<svg width="26" height="26" viewBox="0 0 26 26" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8948 0.536215C14.3234 0.190003 13.6681 0.00695801 13 0.00695801C12.3319 0.00695801 11.6766 0.190003 11.1053 0.536215L2.574 5.70696C2.03639 6.03272 1.59185 6.49158 1.28329 7.03924C0.974733 7.5869 0.812585 8.20486 0.8125 8.83346V17.1665C0.812585 17.7951 0.974733 18.413 1.28329 18.9607C1.59185 19.5084 2.03639 19.9672 2.574 20.293L11.1053 25.4637C11.6766 25.8099 12.3319 25.993 13 25.993C13.6681 25.993 14.3234 25.8099 14.8948 25.4637L23.426 20.293C23.9636 19.9672 24.4082 19.5084 24.7167 18.9607C25.0253 18.413 25.1874 17.7951 25.1875 17.1665V8.83346C25.1874 8.20486 25.0253 7.5869 24.7167 7.03924C24.4082 6.49158 23.9636 6.03272 23.426 5.70696L14.8948 0.536215ZM16.6075 9.29496C16.7191 9.17522 16.8536 9.07918 17.0031 9.01257C17.1526 8.94596 17.314 8.91014 17.4777 8.90725C17.6413 8.90437 17.8038 8.93447 17.9556 8.99577C18.1074 9.05706 18.2452 9.1483 18.3609 9.26403C18.4767 9.37976 18.5679 9.51761 18.6292 9.66937C18.6905 9.82112 18.7206 9.98367 18.7177 10.1473C18.7148 10.311 18.679 10.4723 18.6124 10.6218C18.5458 10.7713 18.4497 10.9059 18.33 11.0175L11.83 17.5175C11.6015 17.7457 11.2917 17.8739 10.9688 17.8739C10.6458 17.8739 10.336 17.7457 10.1075 17.5175L6.8575 14.2675C6.64222 14.0364 6.52502 13.7309 6.53059 13.4151C6.53616 13.0994 6.66407 12.7981 6.88736 12.5748C7.11066 12.3515 7.41191 12.2236 7.72765 12.2181C8.04339 12.2125 8.34897 12.3297 8.58 12.545L10.9688 14.9337L16.6075 9.29496Z"/>
						</svg>
						<?php echo '<span>' . $feature['label'] . '</span>'; ?>
					</div>
					<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php 
	}

	if($ex_items > 0) {
		for ($i=0; $i < $ex_items; $i++) {
			?>
				<div class="bt-table--row bt-car-item">
					<div class="bt-table--col bt-car-add-compare">
						<div class="bt-car-thumb">
							<a href="/cars/">
								<div class="bt-cover-image">
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" fill="currentColor">
										<path d="M256 512a25 25 0 0 1-25-25V25a25 25 0 0 1 50 0v462a25 25 0 0 1-25 25z"></path>
										<path d="M487 281H25a25 25 0 0 1 0-50h462a25 25 0 0 1 0 50z"></path>
									</svg>
								</div>
							</a>
						</div>
						<h3 class="bt-car-title">
							<a href="/cars/">
								<?php echo __('Add Car To Compare', 'autoart'); ?>
							</a>
						</h3>
					</div>
					<div class="bt-table--col bt-car-body"></div>
					<div class="bt-table--col bt-car-condition"></div>
					<div class="bt-table--col bt-car-mileage"></div>
					<div class="bt-table--col bt-car-engine-size"></div>
					<div class="bt-table--col bt-car-fuel-type"></div>
					<div class="bt-table--col bt-car-door"></div>
					<div class="bt-table--col bt-car-year"></div>
					<div class="bt-table--col bt-car-cylinder"></div>
					<div class="bt-table--col bt-car-transmission"></div>
					<div class="bt-table--col bt-car-color"></div>
					<div class="bt-table--col bt-car-features"></div>
				</div>
			<?php
		}
	}
	
	$output['items'] = ob_get_clean();

	wp_send_json_success($output);

	die();
}
add_action('wp_ajax_autoart_cars_compare', 'autoart_cars_compare');
add_action('wp_ajax_nopriv_autoart_cars_compare', 'autoart_cars_compare');
/* query id elementor upcoming */
function bt_custom_upcoming_cars_query($query)
{
	if (isset($query)) {
		$meta_query = array(
			array(
				'key' => 'car_featured_status',
				'value' => 'upcoming',
				'compare' => '='
			)
		);

		$query->set('post_type', 'car');
		$query->set('meta_query', $meta_query);
	}
}
add_action('elementor/query/bt_upcoming_cars', 'bt_custom_upcoming_cars_query');
/* query id elementor trending */
function bt_custom_trending_cars_query($query)
{
	if (isset($query)) {
		$meta_query = array(
			array(
				'key' => 'car_featured_status',
				'value' => 'trending',
				'compare' => '='
			)
		);

		$query->set('post_type', 'car');
		$query->set('meta_query', $meta_query);
	}
}
add_action('elementor/query/bt_trending_cars', 'bt_custom_trending_cars_query');
/* query id elementor popular */
function bt_custom_popular_cars_query($query)
{
	if (isset($query)) {
		$meta_query = array(
			array(
				'key' => 'car_featured_status',
				'value' => 'popular',
				'compare' => '='
			)
		);

		$query->set('post_type', 'car');
		$query->set('meta_query', $meta_query);
	}
}
add_action('elementor/query/bt_popular_cars', 'bt_custom_popular_cars_query');

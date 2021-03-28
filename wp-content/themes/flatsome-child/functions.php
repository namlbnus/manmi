<?php
//Child Theme Functions File
function neda_scripts() {
	
	wp_enqueue_style('bootstrap.min-css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('stylecss', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('tiny-slider-css', get_stylesheet_directory_uri() . '/css/tiny-slider.css');
	
	wp_enqueue_script('jquery', get_stylesheet_directory_uri() . '/js/jquery-3.3.1.min.js');
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js');
	wp_enqueue_script('slider-js', get_stylesheet_directory_uri() . '/js/tiny-slider.js');
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js');

}
add_action( 'wp_footer', 'neda_scripts' );


function manmi_custom_post_type (){
	$labels = array(
		'name' => 'Khách hàng tiêu biểu',
		'singular_name' => 'Khách hàng',
		'add_new' => 'Thêm khách hàng',
		'All_items' => 'Tất cả khách hàng',
		'add_new_item' => 'Thêm khách hàng mới',
		'edit_item' => 'Sửa khách hàng',
		'new_item' => 'Khách hàng mới',
		'View_item' => 'Xem khách hàng',
		'search_item' => 'Tìm khách hàng',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array (
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon'           => 'dashicons-format-status',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('khach-hang',$args);
}
add_action ('init', 'manmi_custom_post_type');


function manmi_products_custom_post_type (){
	$labels = array(
		'name' => 'Sản phẩm',
		'singular_name' => 'Sản phẩm',
		'add_new' => 'Thêm sản phẩm',
		'All_items' => 'Tất cả sản phẩm',
		'add_new_item' => 'Thêm sản phẩm mới',
		'edit_item' => 'Sửa sản phẩm',
		'new_item' => 'Sản phẩm mới',
		'View_item' => 'Xem sản phẩm',
		'search_item' => 'Tìm sản phẩm',
		'not_found' => 'No items found',
		'not_found_in_trash' => 'No items found in trash',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array (
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon'   => 'dashicons-store',
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
		),
		//'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('san-pham',$args);
}
add_action ('init', 'manmi_products_custom_post_type');

function manmi_custom_taxonomies(){

	//add new taxonomy hierarchical
	$labels = array (
		'name' => 'Chuyên mục sản phẩm',
		'singular_name' => 'Tên chuyên mục sản phẩm',
		'search_items' => 'Search Types',
		'all_items' => 'All Types',
		'parent_item' => 'Parrent Type',
		'Parent_item_colon' => 'Parent Type:',
		'edit_item' => 'Edit Type',
		'update_item' => 'Update Type',
		'add_new_item' => 'Add New Type',
		'new_item_name' => 'New Type Name',
		'Menu_name' => 'Chuyên mục sản phẩm',		
	);
	$args = array (
		'hierarchical' => true,
		'labels' => $labels, 
		'show_ui' => true, 
		'show_admin_column' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'query_var'=> true,
		
		//mysite.com/development
		//mysite.com/type/development
	);
	
	register_taxonomy ('chuyen-muc', array('san-pham'), $args);
	
}

add_action ('init', 'manmi_custom_taxonomies');

function create_shortcode_khach_hang() {

	$args = array('post_type' => 'khach-hang' );                                           
	$the_query = new WP_Query( $args );

	ob_start();

	if ( $the_query->have_posts() ) {

		$html = '<div id="hr5-slide">';
		$html .= '<div class="hr5-container">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$html .= '<div class="item">';
			$html .= '<div class="item-content">';
			$html .= '<div class="item-top">';
			$html .= '<div class="image">';
			$html .= '<img src="'.get_the_post_thumbnail_url().'">';
			$html .= '</div>';
			$html .= '<div class="info">';
			$html .= '<h4>'. get_the_title() .'</h4>';
			$html .= '<span>'. get_the_excerpt() .'</span>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="item-bottom">';
			$html .= '<p>'.get_the_content().'</p>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
		wp_reset_postdata();
	}

	$list_post = ob_get_contents();
	ob_end_clean();
	return $list_post;
}
add_shortcode('khach-hang', 'create_shortcode_khach_hang');


function create_shortcode_san_pham() {

	$the_query = new WP_Query( array(
		'post_type' => 'san-pham',
		'tax_query' => array(
			array (
				'taxonomy' => 'chuyen-muc',
				'field' => 'slug',
				'terms' => 'san-pham-noi-bat'
			)
		),
	) );
	ob_start();

	if ( $the_query->have_posts() ) {
		$the_query->the_post();
		$html = '<div id="hr3-slide">';
		$html .= '<div class="hr3-container">';
		for ( $i=0;$i<6;$i++) {
			
			$html .= '<div class="item">';
			$html .= '<div class="item-content">';
			$html .= '<div class="item-top">';
			$html .= '<div class="image">';
			$html .= '<img src="'.get_the_post_thumbnail_url().'">';
			$html .= '</div>';
			$html .= '<div class="info-wrap">';
			$html .= '<div class="info">';
			$html .= '<span><img src="/wp-content/uploads/2021/03/Group.png">Lượt thỉnh:</span>';
			$html .= '<span>'. get_field("luot_thinh") .'</span>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="item-bottom">';
			$html .= '<h4>'.get_the_title().'</h4>';
			$html .= '<p class="sale-price">'.get_field("gia_sale").'</p>';
			$html .= '<p class="regular-price">'.get_field("gia_thuong").'</p>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
		$html .= '</div>';

		echo $html;
		wp_reset_postdata();
	}

	$list_post = ob_get_contents();
	ob_end_clean();
	return $list_post;
}
add_shortcode('san-pham', 'create_shortcode_san_pham');
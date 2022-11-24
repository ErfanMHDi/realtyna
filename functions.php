<?php
/*
Plugin Name: RealTyna
Description: RealTyna Test Plugin! <br> This Plugin will add <strong>Movie</strong> Post Type and <strong>Genre</strong> Taxonomy to your WP Env (using ACF). it also supports "<strong>[MovieList]</strong>" ShortCode and also it has a widget for showing the Movies count (<strong>Movie Counter</strong>). all the posts are available throught WP API.
Version: 1.0
Requires at least: 6.0
Author: ErfanMHDi
Author URI: https://ErfanMHDi.com/
Text Domain: realtyna
*/

if ( !defined( 'ABSPATH' ) ) {
	http_response_code( 404 );
	die();
}

// ACF - Include
define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . '/includes/acf/');
define( 'MY_ACF_URL', plugins_url( '/includes/acf/' , __FILE__ ));
include_once( MY_ACF_PATH . 'acf.php' );
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}

// ACF - Field Registration
if( function_exists('acf_add_local_field_group') ) {

	acf_add_local_field_group(array(
		'key' => 'group_637cb2e5d7161',
		'title' => 'Movies',
		'fields' => array(
			array(
				'key' => 'field_637cb54507ca7',
				'label' => 'Description',
				'name' => 'description',
				'aria-label' => '',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'rows' => '',
				'placeholder' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_637cb2e607ca6',
				'label' => 'Extra Info',
				'name' => 'extra_info',
				'aria-label' => '',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'rows' => '',
				'placeholder' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_637cb55507ca8',
				'label' => 'Genre',
				'name' => 'genre',
				'aria-label' => '',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'genre',
				'add_term' => 1,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
				'field_type' => 'multi_select',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array(
				'key' => 'field_637cb56d07ca9',
				'label' => 'Tags',
				'name' => 'tags',
				'aria-label' => '',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'post_tag',
				'add_term' => 1,
				'save_terms' => 1,
				'load_terms' => 1,
				'return_format' => 'id',
				'field_type' => 'multi_select',
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'movie',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

}	

// Register Post Type: Movies
function register_movie_pt() {
	$labels = [
		"name" => esc_html__( "Movies", "twentytwentyone" ),
		"singular_name" => esc_html__( "Movie", "twentytwentyone" ),
		"menu_name" => esc_html__( "My Movies", "twentytwentyone" ),
		"all_items" => esc_html__( "All Movies", "twentytwentyone" ),
		"add_new" => esc_html__( "Add new", "twentytwentyone" ),
		"add_new_item" => esc_html__( "Add new Movie", "twentytwentyone" ),
		"edit_item" => esc_html__( "Edit Movie", "twentytwentyone" ),
		"new_item" => esc_html__( "New Movie", "twentytwentyone" ),
		"view_item" => esc_html__( "View Movie", "twentytwentyone" ),
		"view_items" => esc_html__( "View Movies", "twentytwentyone" ),
		"search_items" => esc_html__( "Search Movies", "twentytwentyone" ),
		"not_found" => esc_html__( "No Movies found", "twentytwentyone" ),
		"not_found_in_trash" => esc_html__( "No Movies found in trash", "twentytwentyone" ),
		"parent" => esc_html__( "Parent Movie:", "twentytwentyone" ),
		"featured_image" => esc_html__( "Featured image for this Movie", "twentytwentyone" ),
		"set_featured_image" => esc_html__( "Set featured image for this Movie", "twentytwentyone" ),
		"remove_featured_image" => esc_html__( "Remove featured image for this Movie", "twentytwentyone" ),
		"use_featured_image" => esc_html__( "Use as featured image for this Movie", "twentytwentyone" ),
		"archives" => esc_html__( "Movie archives", "twentytwentyone" ),
		"insert_into_item" => esc_html__( "Insert into Movie", "twentytwentyone" ),
		"uploaded_to_this_item" => esc_html__( "Upload to this Movie", "twentytwentyone" ),
		"filter_items_list" => esc_html__( "Filter Movies list", "twentytwentyone" ),
		"items_list_navigation" => esc_html__( "Movies list navigation", "twentytwentyone" ),
		"items_list" => esc_html__( "Movies list", "twentytwentyone" ),
		"attributes" => esc_html__( "Movies attributes", "twentytwentyone" ),
		"name_admin_bar" => esc_html__( "Movie", "twentytwentyone" ),
		"item_published" => esc_html__( "Movie published", "twentytwentyone" ),
		"item_published_privately" => esc_html__( "Movie published privately.", "twentytwentyone" ),
		"item_reverted_to_draft" => esc_html__( "Movie reverted to draft.", "twentytwentyone" ),
		"item_scheduled" => esc_html__( "Movie scheduled", "twentytwentyone" ),
		"item_updated" => esc_html__( "Movie updated.", "twentytwentyone" ),
		"parent_item_colon" => esc_html__( "Parent Movie:", "twentytwentyone" ),
	];
	$args = [
		"label" => esc_html__( "Movies", "twentytwentyone" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "movie",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => [ "slug" => "movie", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-editor-video",
		"supports" => [ "title", "thumbnail" ],
		"taxonomies" => [ "post_tag", "genre" ],
		"show_in_graphql" => false,
	];
	register_post_type( "movie", $args );
}
add_action( 'init', 'register_movie_pt' );

// Register Taxonomy: Genres
function register_genre_tax() {
	$labels = [
		"name" => esc_html__( "Genres", "twentytwentyone" ),
		"singular_name" => esc_html__( "Genre", "twentytwentyone" ),
		"menu_name" => esc_html__( "Genres", "twentytwentyone" ),
		"all_items" => esc_html__( "All Genres", "twentytwentyone" ),
		"edit_item" => esc_html__( "Edit Genre", "twentytwentyone" ),
		"view_item" => esc_html__( "View Genre", "twentytwentyone" ),
		"update_item" => esc_html__( "Update Genre name", "twentytwentyone" ),
		"add_new_item" => esc_html__( "Add new Genre", "twentytwentyone" ),
		"new_item_name" => esc_html__( "New Genre name", "twentytwentyone" ),
		"parent_item" => esc_html__( "Parent Genre", "twentytwentyone" ),
		"parent_item_colon" => esc_html__( "Parent Genre:", "twentytwentyone" ),
		"search_items" => esc_html__( "Search Genres", "twentytwentyone" ),
		"popular_items" => esc_html__( "Popular Genres", "twentytwentyone" ),
		"separate_items_with_commas" => esc_html__( "Separate Genres with commas", "twentytwentyone" ),
		"add_or_remove_items" => esc_html__( "Add or remove Genres", "twentytwentyone" ),
		"choose_from_most_used" => esc_html__( "Choose from the most used Genres", "twentytwentyone" ),
		"not_found" => esc_html__( "No Genres found", "twentytwentyone" ),
		"no_terms" => esc_html__( "No Genres", "twentytwentyone" ),
		"items_list_navigation" => esc_html__( "Genres list navigation", "twentytwentyone" ),
		"items_list" => esc_html__( "Genres list", "twentytwentyone" ),
		"back_to_items" => esc_html__( "Back to Genres", "twentytwentyone" ),
		"name_field_description" => esc_html__( "The name is how it appears on your site.", "twentytwentyone" ),
		"parent_field_description" => esc_html__( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "twentytwentyone" ),
		"slug_field_description" => esc_html__( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "twentytwentyone" ),
		"desc_field_description" => esc_html__( "The description is not prominent by default; however, some themes may show it.", "twentytwentyone" ),
	];
	$args = [
		"label" => esc_html__( "Genres", "twentytwentyone" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'genre', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "genre",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "genre", [ "movie" ], $args );
}
add_action( 'init', 'register_genre_tax' );

// Disablign Gutenberg for Movies //
add_filter('use_block_editor_for_post_type', 'disable_gutenberg_movies', 10, 2);
function disable_gutenberg_movies($current_status, $post_type) {
    if ($post_type === 'movie') return false;
    return $current_status;
}

// Hide Initial Tax Box
add_action( 'admin_menu' , 'hide_tax_box' );
function hide_tax_box() {
	remove_meta_box( 'tagsdiv-genre' , 'movie' , 'side' ); 
	remove_meta_box( 'tagsdiv-post_tag' , 'movie' , 'side' ); 
}

// Movie List Shortcode
function movie_list_shortcode() {
	$loop = new WP_Query( array( 'post_type' => 'movie' ) ); 
	if ($loop) {
	?>
		<p><strong>Movie List:</strong></p>
		<ul>
		<?php
		while ( $loop->have_posts() ) { 
			$loop->the_post(); 
		?>
			<li>
				<?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?>
			</li>
			<?php 
		}
		?>
		</ul>
		<?php
	}
}
add_shortcode('MovieList','movie_list_shortcode');


// Movie Counter Widget - Register
class movie_counter_widget extends WP_Widget {

	//- Creation
    function __construct() {
        parent::__construct(
            'movie_counter_widget',
            __('Movie Counter', 'movie_counter_widget_domain'),
            array( 
				'description' => __('Simple Counter for Movies', 'movie_counter_widget_domain')
			)
		);
    }

    //- Block on Front
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title)) echo $args['before_title'] . $title . $args['after_title'];
		echo "Movie Count: " . wp_count_posts( 'movie' )->publish;
        echo $args['after_widget'];
    }

    //- Block on Back
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('Movie Counter', 'movie_counter_widget_domain');
        }
		?>
		<label for="<?php echo $this->get_field_id('title'); ?>"> 
			<?php _e('Title:'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		<?php
    }

    //- Block content
    public function update($new_instance, $old_instance) {
        $instance          = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

} 
// Movie Counter Widget - load 
add_action('widgets_init', 'movie_counter_widget_load');
function movie_counter_widget_load() {
     register_widget('movie_counter_widget');
}

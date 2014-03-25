<?php
/**
 * Tatva Theme Customizer support
 *
 * @package WordPress
 * @subpackage Tatva
 * @since Tatva 1.0
 */

/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @since Tatva 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tatva_customize_register( $wp_customize ) {
	// Add custom description to Colors and Background sections.
	$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'tatva' );
	$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'tatva' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the label to "Site Title Color" because this only affects the site title in this theme.
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'tatva' );

	// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
	$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'tatva' );

        
        /** ===============
	 * Extends CONTROLS to add color scheme
	 */
        $wp_customize->add_section( 'tatva_color_scheme_settings', array(
		'title'       => __( 'Color Scheme', 'tatva' ),
		'priority'    => 30,
		'description' => 'Select your color scheme',
	) );

	$wp_customize->add_setting( 'tatva_color_scheme', array(
		'default'        => 'blue',
	) );

	$wp_customize->add_control( 'tatva_color_scheme', array(
		'label'   => 'Choose your color scheme',
		'section' => 'tatva_color_scheme_settings',
		'default'        => 'red',
		'type'       => 'radio',
		'choices'    => array(
			__( 'Blue', 'locale' ) => 'blue',
			__( 'Red', 'locale' ) => 'red',
			__( 'Green', 'locale' ) => 'green',
			__( 'Gray', 'locale' ) => 'gray',
                        __( 'Purple', 'locale' ) => 'purple',
                        __( 'Orange', 'locale' ) => 'orange',
                        __( 'Brown', 'locale' ) => 'brown',
                        __( 'Pink', 'locale' ) => 'pink',
		),
	) );
        
        
         // Add new section for theme layout and color schemes
    $wp_customize->add_section('tatva_theme_layout_settings', array(
        'title' => __('Layout', 'tatva'),
        'priority' => 30,
    ));

    // Add setting for theme layout
    $wp_customize->add_setting('tatva_theme_layout', array(
        'default' => 'full-width',
    ));

    $wp_customize->add_control('tatva_theme_layout', array(
        'label' => 'Theme Layout',
        'section' => 'tatva_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'full-width' => __('Full Width', 'tatva'),
            'boxed' => __('Boxed', 'tatva'),
        ),
    ));
    
        /** ===============
	 * Extends CONTROLS class to add textarea
	 */
        
	class tatva_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
	<?php
		}
	}	

        // Displays a list of categories in dropdown
        class WP_Customize_Dropdown_Categories_Control extends WP_Customize_Control {
		public $type = 'dropdown-categories';	

			public function render_content() {
				$dropdown = wp_dropdown_categories( 
					array( 
						'name'             => '_customize-dropdown-categories-' . $this->id,
						'echo'             => 0,
						'hide_empty'       => false,
						'show_option_none' => '&mdash; ' . __('Select', 'tatva') . ' &mdash;',
						'hide_if_empty'    => false,
						'selected'         => $this->value(),
					 )
				 );

				$dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown );

				printf( 
					'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					$this->label,
					$dropdown
				 );
			}
        }
        
        // Add new section for displaying Featured Posts on Front Page
        $wp_customize->add_section( 'tatva_front_page_post_options', array(
        'title'       	=> __( 'Front Page Featured Posts', 'tatva' ),
                'description' 	=> __( 'Settings for displaying featured posts on Front Page', 'tatva' ),
                'priority'   	=> 60,
        ) );
        // enable featured posts on front page?
        $wp_customize->add_setting( 'tatva_front_featured_posts_check', array( 'default' => 0 ) );
        $wp_customize->add_control( 'tatva_front_featured_posts_check', array(
                'label'		=> __( 'Show featured posts on Front Page', 'tatva' ),
                'section'	=> 'tatva_front_page_post_options',
                'priority'	=> 10,
                'type'      => 'checkbox',
        ) );
        
        // Front featured posts section headline
        $wp_customize->add_setting( 'tatva_front_featured_posts_title', array( 'default' => __( 'Latest Posts', 'tatva') ) );
        $wp_customize->add_control( 'tatva_front_featured_posts_title', array(
                'label'		=> __( 'Main Title', 'tatva' ),
                'section'	=> 'tatva_front_page_post_options',
                'settings'	=> 'tatva_front_featured_posts_title',
                'priority'	=> 10,
        ) );
        
        // select number of posts for featured posts on front page
        $wp_customize->add_setting( 'tatva_front_featured_posts_count', array( 'default' => 3 ) );		
        $wp_customize->add_control( 'tatva_front_featured_posts_count', array(
            'label' 	=> __( 'Number of posts to display (multiple of 4)', 'tatva' ),
            'section' 	=> 'tatva_front_page_post_options',
                'settings' 	=> 'tatva_front_featured_posts_count',
                'priority'	=> 20,
        ) );
        
        // select category for featured posts 
        $wp_customize->add_setting( 'tatva_front_featured_posts_cat', array( 'default' => 0 ) );
        $wp_customize->add_control( new WP_Customize_Dropdown_Categories_Control( $wp_customize, 'tatva_front_post_category', array( 
                'label'    => __('Post Category', 'tatva'),
                'section'  => 'tatva_front_page_post_options',
                'type'     => 'dropdown-categories',
                'settings' => 'tatva_front_featured_posts_cat',
                'priority' => 20,
         ) ) );
        
        // featured post read more link
        $wp_customize->add_setting( 'tatva_front_featured_link_text', array( 'default' => __( 'Read more', 'tatva' ) ) );	
        $wp_customize->add_control( 'tatva_front_featured_link_text', array(
            'label' 	=> __( 'Posts Read More Link Text', 'tatva' ),
            'section' 	=> 'tatva_front_page_post_options',
                'settings' 	=> 'tatva_front_featured_link_text',
                'priority'	=> 30,
        ) );
        
	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'tatva_edd_options', array(
	    	'title'       	=> __( 'EDD Store Page', 'tatva' ),
			'description' 	=> __( 'All other EDD options are under Dashboard => Downloads.', 'tatva' ),
			'priority'   	=> 60,
		) );
		// store product archive headline
		$wp_customize->add_setting( 'tatva_edd_store_archives_title', array( 'default' => null ) );
		$wp_customize->add_control( 'tatva_edd_store_archives_title', array(
			'label'		=> __( 'Store/Product Archives Main Title', 'tatva' ),
			'section'	=> 'tatva_edd_options',
			'settings'	=> 'tatva_edd_store_archives_title',
			'priority'	=> 10,
		) );
		// store product archive description
		$wp_customize->add_setting( 'tatva_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new tatva_customize_textarea_control( $wp_customize, 'tatva_edd_store_archives_description', array(
			'label'		=> __( 'Store/Product Archives Description', 'tatva' ),
			'section'	=> 'tatva_edd_options',
			'settings'	=> 'tatva_edd_store_archives_description',
			'priority'	=> 20,
		) ) );
		// product read more link
		$wp_customize->add_setting( 'tatva_product_view_details', array( 'default' => __( 'View Details', 'tatva' ) ) );	
		$wp_customize->add_control( 'tatva_product_view_details', array(
		    'label' 	=> __( 'Store Item Details Link Text', 'tatva' ),
		    'section' 	=> 'tatva_edd_options',
			'settings' 	=> 'tatva_product_view_details',
			'priority'	=> 30,
		) );
		// store archive item count
		$wp_customize->add_setting( 'tatva_store_archive_count', array( 'default' => 9 ) );		
		$wp_customize->add_control( 'tatva_store_archive_count', array(
		    'label' 	=> __( 'Store Archive Item Count', 'tatva' ),
		    'section' 	=> 'tatva_edd_options',
			'settings' 	=> 'tatva_store_archive_count',
			'priority'	=> 40,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'tatva_download_comments', array( 'default' => 0 ) );
		$wp_customize->add_control( 'tatva_download_comments', array(
			'label'		=> __( 'Comments on Downloads?', 'tatva' ),
			'section'	=> 'tatva_edd_options',
			'priority'	=> 50,
			'type'      => 'checkbox',
		) );
                
                /* ========================================================= */
                // Add new section for EDD featured products on Front Page
                /* ========================================================= */
                $wp_customize->add_section( 'tatva_edd_front_page_options', array(
	    	'title'       	=> __( 'EDD Front Page', 'tatva' ),
			'description' 	=> __( 'Settings for displaying featured products on Front Page', 'tatva' ),
			'priority'   	=> 60,
		) );
                // enable featured products on front page?
		$wp_customize->add_setting( 'tatva_edd_front_featured_products', array( 'default' => 0 ) );
		$wp_customize->add_control( 'tatva_edd_front_featured_products', array(
			'label'		=> __( 'Show featured products on Front Page', 'tatva' ),
			'section'	=> 'tatva_edd_front_page_options',
			'priority'	=> 10,
			'type'      => 'checkbox',
		) );
                // Front featured products section headline
                $wp_customize->add_setting( 'tatva_edd_front_featured_title', array( 'default' => __( 'Latest Products', 'tatva') ) );
                $wp_customize->add_control( 'tatva_edd_front_featured_title', array(
                        'label'		=> __( 'Main Title', 'tatva' ),
                        'section'	=> 'tatva_edd_front_page_options',
                        'settings'	=> 'tatva_edd_front_featured_title',
                        'priority'	=> 10,
                ) );

                // store front item count
		$wp_customize->add_setting( 'tatva_edd_store_front_count', array( 'default' => 6 ) );		
		$wp_customize->add_control( 'tatva_edd_store_front_count', array(
		    'label' 	=> __( 'Number of products to display', 'tatva' ),
		    'section' 	=> 'tatva_edd_front_page_options',
			'settings' 	=> 'tatva_edd_store_front_count',
			'priority'	=> 20,
		) );
                // sotre link text
                $wp_customize->add_setting( 'tatva_edd_store_link_text', array( 'default' => __( 'Browse All Products', 'tatva' ) ) );	
		$wp_customize->add_control( 'tatva_edd_store_link_text', array(
		    'label' 	=> __( 'Store Link Text', 'tatva' ),
		    'section' 	=> 'tatva_edd_front_page_options',
			'settings' 	=> 'tatva_edd_store_link_text',
			'priority'	=> 30,
		) );
                // sotre link
                $wp_customize->add_setting( 'tatva_edd_store_link_url', array( 'default' => __( '', 'tatva' ) ) );	
		$wp_customize->add_control( 'tatva_edd_store_link_url', array(
		    'label' 	=> __( 'Store Page Link URL', 'tatva' ),
		    'section' 	=> 'tatva_edd_front_page_options',
			'settings' 	=> 'tatva_edd_store_link_url',
			'priority'	=> 40,
		) );
                
                
	}
        
        // Add postMessage for EDD store title and description
        $wp_customize->get_setting( 'tatva_edd_store_archives_title' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'tatva_edd_store_archives_description' )->transport   = 'postMessage';
        
        // Add postMessage for EDD front page settings
        $wp_customize->get_setting( 'tatva_edd_front_featured_title' )->transport       = 'postMessage';
        $wp_customize->get_setting( 'tatva_edd_store_link_text' )->transport            = 'postMessage';
        $wp_customize->get_setting( 'tatva_edd_store_link_url' )->transport             = 'postMessage';
        
        // Add postMessage for featured posts on front page settings
        $wp_customize->get_setting( 'tatva_front_featured_posts_title' )->transport       = 'postMessage';
        $wp_customize->get_setting( 'tatva_front_featured_link_text' )->transport            = 'postMessage';
        
}
add_action( 'customize_register', 'tatva_customize_register' );

/**
 * Sanitize the Featured Content layout value.
 *
 * @since Tatva 1.0
 *
 * @param string $layout Layout type.
 * @return string Filtered layout type (grid|slider).
 */
function tatva_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
		$layout = 'grid';
	}

	return $layout;
}

/**
 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Tatva 1.0
 */
function tatva_customize_preview_js() {
	wp_enqueue_script( 'tatva_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131205', true );
}
add_action( 'customize_preview_init', 'tatva_customize_preview_js' );

/**
 * Add contextual help to the Themes and Post edit screens.
 *
 * @since Tatva 1.0
 *
 * @return void
 */
function tatva_contextual_help() {
	if ( 'admin_head-edit.php' === current_filter() && 'post' !== $GLOBALS['typenow'] ) {
		return;
	}

	get_current_screen()->add_help_tab( array(
		'id'      => 'tatva',
		'title'   => __( 'Tatva', 'tatva' ),
		'content' =>
			'<ul>' .
				'<li>' . sprintf( __( 'The home page features your choice of up to 6 posts prominently displayed in a grid or slider, controlled by the <a href="%1$s">featured</a> tag; you can change the tag and layout in <a href="%2$s">Appearance &rarr; Customize</a>. If no posts match the tag, <a href="%3$s">sticky posts</a> will be displayed instead.', 'tatva' ), admin_url( '/edit.php?tag=featured' ), admin_url( 'customize.php' ), admin_url( '/edit.php?show_sticky=1' ) ) . '</li>' .
				'<li>' . sprintf( __( 'Enhance your site design by using <a href="%s">Featured Images</a> for posts you&rsquo;d like to stand out (also known as post thumbnails). This allows you to associate an image with your post without inserting it. Tatva uses featured images for posts and pages&mdash;above the title&mdash;and in the Featured Content area on the home page.', 'tatva' ), 'http://codex.wordpress.org/Post_Thumbnails#Setting_a_Post_Thumbnail' ) . '</li>' .
				'<li>' . sprintf( __( 'For an in-depth tutorial, and more tips and tricks, visit the <a href="%s">Tatva documentation</a>.', 'tatva' ), 'http://codex.wordpress.org/Twenty_Fourteen' ) . '</li>' .
			'</ul>',
	) );
}
add_action( 'admin_head-themes.php', 'tatva_contextual_help' );
add_action( 'admin_head-edit.php',   'tatva_contextual_help' );

<?php
/*----------------------------------------------------------
                    The Setup
----------------------------------------------------------*/
define( 'CHILD_THEME_NAME', 'Anchor Studios Theme' );
define( 'CHILD_THEME_URL', 'http://anchor.is' );
define( 'AS_THEME_DIR', get_stylesheet_directory() );
define( 'AS_THEME_URL', get_stylesheet_directory_uri() );

// Including all .php files in the library/php/ folder
foreach( glob( AS_THEME_DIR . '/library/php/*.php') as $file_path )
    include_once( $file_path );


/*----------------------------------------------------------
                    The Hooks & Filters
----------------------------------------------------------*/
add_action('genesis_setup','as_theme_setup', 15);
    function as_theme_setup() {
        // Theme Support
        add_theme_support( 'genesis-structural-wraps', array( 'header', 'inner', 'footer-widgets', 'footer' ) );
        add_theme_support( 'genesis-footer-widgets', 3 );   
        
        // Remove Actions
        remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
        remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
        remove_action( 'genesis_after_header', 'genesis_do_nav' );

        // Remove Filters

        // Add Actions
        add_action( 'genesis_meta', 'as_add_viewport_meta_tag' );
        add_action( 'wp_enqueue_scripts', 'as_scripts_and_styles', 999 );
        add_action( 'genesis_header_right', 'genesis_do_nav' );

        // Add Filters
        add_filter( 'stylesheet_uri', 'as_stylesheet_uri', 10, 2 );
        add_filter( 'post_thumbnail_html', 'as_remove_thumbnail_dimensions', 10 );
        add_filter( 'image_send_to_editor', 'as_remove_thumbnail_dimensions', 10 );
    }

/*----------------------------------------------------------
                    The Functions
----------------------------------------------------------*/
    // Place all Functions here that are used in custom hooks or filters
    
    function as_add_viewport_meta_tag() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
    }

    function as_remove_thumbnail_dimensions( $html ) {
        $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
        return $html;
    }

    function as_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
        $stylesheet_uri = $stylesheet_dir_uri . '/library/css/style.css';
        return $stylesheet_uri;
    }

    function as_scripts_and_styles() {    

        if( !is_admin() ) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js', false, '1.8.1');
            wp_enqueue_script('jquery');
        }

        if( is_page_template('single_client_page.php') ) {
            wp_register_script('ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js');
            wp_enqueue_script('ui');
        }

        wp_register_script( 'site-js', AS_THEME_URL . '/library/js/site.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'site-js' );

    }

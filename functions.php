<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );
function hello_elementor_child_scripts_styles() {
    
    wp_enqueue_style(
        'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
            'hello-elementor-theme-style',
            ],
            HELLO_ELEMENTOR_CHILD_VERSION
            );
            
            }
            
add_action('after_setup_theme', 'menuUtilisateur');
function menuUtilisateur() {
    register_nav_menus(array(
        'administrateur' => __('Menu Utilisateur', 'textdomain'),
    ));
}


add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items' );
function my_dynamic_menu_items( $items ) {
    foreach ( $items as $item ) {
        if ( is_user_logged_in() && strpos($item->title, 'Compte') !== false ) {
            $current_user = wp_get_current_user();
            $item->title =  $current_user->display_name;
        }
    }
    return $items;
}

add_action('wp_head', function() {
    ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'corsica-blue': '#000814',
                        'corsica-gold': '#FFC300',
                        'corsica-gold-light': '#FFD60A',
                    },
                    fontFamily: {
                        'montserrat': ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <?php
});
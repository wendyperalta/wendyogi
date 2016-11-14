<?php
// styles of child theme
function uni_child_theme_style() {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.1' );

    wp_register_style( 'bxslider-styles', get_template_directory_uri() . '/css/bxslider.css', '4.2.3' );
    wp_enqueue_style( 'bxslider-styles');

    wp_register_style( 'ball-clip-rotate-styles', get_template_directory_uri() . '/css/ball-clip-rotate.css', '0.1.0' );
    wp_enqueue_style( 'ball-clip-rotate-styles');

    wp_register_style( 'fancybox-styles', get_template_directory_uri() . '/css/fancybox.css', '2.1.5' );
    wp_enqueue_style( 'fancybox-styles');

    wp_register_style( 'jscrollpane-styles', get_template_directory_uri() . '/css/jscrollpane.css', '2.1.5' );
    wp_enqueue_style( 'jscrollpane-styles');

    wp_register_style( 'selectric-styles', get_template_directory_uri() . '/css/selectric.css', '2.1.5' );
    wp_enqueue_style( 'selectric-styles' );

    if( class_exists( 'WooCommerce' ) ) {
        wp_register_style( 'asana-woocommerce-styles', get_template_directory_uri() . '/css/woocommerce-store.css', '1.6.12' );
        wp_enqueue_style( 'asana-woocommerce-styles' );
    }

    if( function_exists( 'ecwid_check_version' ) ) {
        wp_register_style( 'asana-ecwid-styles', get_template_directory_uri() . '/css/ecwid-store.css', '1.6.12' );
        wp_enqueue_style( 'asana-ecwid-styles' );
    }

    wp_register_style( 'unitheme-styles', get_template_directory_uri() . '/style.css', array('bxslider-styles', 'ball-clip-rotate-styles', 'fancybox-styles',
    'jscrollpane-styles', 'selectric-styles'), '1.6.12', 'all' );
    wp_enqueue_style( 'unitheme-styles' );

    if ( !ot_get_option( 'uni_color_schemes' ) ) {
        wp_register_style( 'unitheme-asana-scheme', get_template_directory_uri() . '/css/scheme-default.css', array('unitheme-styles'), '1.6.12', 'screen' );
        wp_enqueue_style( 'unitheme-asana-scheme' );
    } else {
        $sColourScheme = ot_get_option( 'uni_color_schemes' );
        wp_register_style( 'unitheme-asana-scheme', get_template_directory_uri() . '/css/scheme-'.$sColourScheme.'.css', array('unitheme-styles'), '1.6.12', 'screen' );
        wp_enqueue_style( 'unitheme-asana-scheme' );
    }

    wp_register_style( 'unitheme-adaptive', get_template_directory_uri() . '/css/adaptive.css', array('unitheme-styles'), '1.6.12', 'screen' );
    wp_enqueue_style( 'unitheme-adaptive' );

    wp_register_style( 'unitheme-asana-custom-scheme', get_stylesheet_directory_uri() . '/css/scheme-custom.css', array('unitheme-styles'), '1.6.12', 'screen' );
    wp_enqueue_style( 'unitheme-asana-custom-scheme' );

    wp_register_style( 'unitheme-child-styles', get_stylesheet_directory_uri() . '/style.css', array( 'unitheme-styles' ), '1.6.12', 'screen' );
    wp_enqueue_style( 'unitheme-child-styles' );
}
add_action( 'wp_enqueue_scripts', 'uni_child_theme_style' );

// after setup of the child theme
add_action( 'after_setup_theme', 'uni_theme_child_theme_setup' );
function uni_theme_child_theme_setup() {

    // Enable featured image
    add_theme_support( 'post-thumbnails');

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Add html5 suppost for search form and comments list
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    // translation files for the child theme
    load_child_theme_textdomain( 'asana-child', get_stylesheet_directory() . '/languages' );
}

// add the new role in the child theme
add_action('after_switch_theme', 'uni_theme_child_activation_func', 10);
function uni_theme_child_activation_func() {
    add_role( 'instructor', esc_html__('Instructor', 'asana'), array('read' => true) );
	$instructor = get_role('instructor');
	$instructor->add_cap('read');
    $instructor->add_cap('edit_published_posts');
    $instructor->add_cap('upload_files');
    $instructor->add_cap('publish_posts');
    $instructor->add_cap('delete_published_posts');
    $instructor->add_cap('edit_posts');
    $instructor->add_cap('delete_posts');
    update_option('posts_per_page', 9);
    flush_rewrite_rules();
}

// remove the new role on theme deactivation
add_action('switch_theme', 'uni_theme_child_deactivation_func');
function uni_theme_child_deactivation_func() {
    remove_role( 'instructor' );
}

if ( ! function_exists( 'theme_special_nav' ) ) {

}

/*
  Edits the Header images/titles on the pages under 'workwithme' and 'products'
*/
add_action( 'woocommerce_before_main_content', 'uni_asana_child_theme_woo_output_content_wrapper', 10);
function child_remove_parent_function() {
  remove_action( 'woocommerce_before_main_content', 'uni_asana_theme_woo_output_content_wrapper', 10);
}
add_action( 'wp_loaded', 'child_remove_parent_function' );
function uni_asana_child_theme_woo_output_content_wrapper() {
    // if this is single product page
    if ( is_singular('product') ) {
        $iShopAttachId  = ( ot_get_option( 'uni_shop_header_bg' ) ) ? ot_get_option( 'uni_shop_header_bg' ) : '';
        $sTitleColor    = ( ot_get_option( 'uni_shop_header_title_color' ) ) ? ot_get_option( 'uni_shop_header_title_color' ) : '#ffffff';
        if ( !empty($iShopAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iShopAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_site_url().'/wp-content/uploads/2016/08/product_page_header.jpg';
        }
        $sOutput = '<section class="uni-container">
		    <div class="pageHeader" style="background-image: url('.esc_url( $sPageHeaderImage ).');">';
		    if ( ot_get_option( 'uni_shop_header_title' ) ) {
                $sOutput .= '<h1>'.esc_html( ot_get_option( 'uni_shop_header_title' ) ).'</h1>';
            } else {
			    $sOutput .= '<h1>'.esc_html__('', 'asana').'</h1>';
            }
	    $sOutput .= '</div>';
        $sOutput .= '<style>.pageHeader h1 {color:'.$sTitleColor.';}</style>';
		$sOutput .= '<div class="contentWrap">';
    // other pages
    } else {
        $iShopAttachId  = ( ot_get_option( 'uni_shop_header_bg' ) ) ? ot_get_option( 'uni_shop_header_bg' ) : '';
        $sTitleColor    = ( ot_get_option( 'uni_shop_header_title_color' ) ) ? ot_get_option( 'uni_shop_header_title_color' ) : '#ffffff';
        if ( !empty($iShopAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iShopAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_site_url().'/wp-content/uploads/2015/10/workwithme_slider.jpg';
        }
        $sOutput = '<section class="uni-container">
		    <div class="pageHeader" style="background-image: url('.esc_url( $sPageHeaderImage ).');">';
            if ( is_shop() ) {
		        if ( ot_get_option( 'uni_shop_header_title' ) ) {
                    $sOutput .= '<h1>'.esc_html( ot_get_option( 'uni_shop_header_title' ) ).'</h1>';
                } else {
			        $sOutput .= '<h1>'.esc_html__('Services', 'asana').'</h1>';
                }
            } else {
                $sOutput .= '<h1 class="page-title">'.woocommerce_page_title( false ).'</h1>';
            }
	    $sOutput .= '</div>';
        $sOutput .= '<style>.pageHeader h1 {color:'.$sTitleColor.';}</style>';
		$sOutput .= '<div class="contentWrap">';
    }

    echo $sOutput;
}

/* Removes the 'Relatable Products' section from the products page*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Change text strings
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function my_text_strings( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Return To Shop' :
			$translated_text = __( 'Return to Booking', 'woocommerce' );
			break;
	}
	return $translated_text;
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );

/*Changes "Place order" text at checkout*/
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' );

function woo_custom_order_button_text() {
    return __( "Let's Practice", 'woocommerce' );
}

// Change Notes section placeholder in checkout page
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
     $fields['order']['order_comments']['placeholder'] = 'Comments about you or your session, e.g. experience with Yoga, preferred location to meet, etc.';
     unset($fields['billing']['billing_company']);
     return $fields;
}

add_filter( 'wc_password_strength_meter_params', 'mr_strength_meter_custom_strings' );
function mr_strength_meter_custom_strings( $data ) {
    $data_new = array(
		'min_password_strength' => apply_filters( 'woocommerce_min_password_strength', 2 ),
        'i18n_password_error'   => esc_attr__( '<span class="mr-red">Please enter a stronger password.</span>', 'woocommerce' ),
        'i18n_password_hint'    => esc_attr__( 'Your password must be <strong>at least 7 characters</strong> and contain a mix of <strong>UPPER</strong> and <strong>lowercase</strong> letters, <strong>numbers</strong>, and <strong>symbols</strong> (e.g., <strong> ! " ? $ % ^ & </strong>). Keep adding additional characters and/or variation until this prompt disappears—you cannot save changes until it is gone.', 'woocommerce' )
    );

    return array_merge( $data, $data_new );
}

add_filter( 'woocommerce_page_title', 'custom_woocommerce_page_title');
function custom_woocommerce_page_title( $page_title ) {
  if ($page_title == 'Products') {
    return 'Services';
  }
}

//remove 'Order Again' button from checkout
remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

/**
 * Custom text on the receipt page.
 */
function isa_order_received_text( $text, $order ) {
    $new = 'Thank you for choosing to practice with me! I will be in contact with you shortly.';
    return $new;
}
add_filter('woocommerce_thankyou_order_received_text', 'isa_order_received_text', 10, 2 );


/*
// email templates filter
add_filter( 'uni_asana_event_email_filter', 'uni_asana_child_email_templates', 10, 2 );
function uni_asana_child_email_templates( $sTemplateName, $sState ) {
    if ( $sState == 'guest' ) {
        return 'email/event-custom-guest.php';
    } else if ( $sState == 'admin' ) {
        return 'email/event-custom-admin.php';
    }
}

// choose option none
add_filter( 'uni_asana_theme_show_option_none_variation_filter', 'uni_asana_show_option_none_variation_text', 10, 2 );
function uni_asana_show_option_none_variation_text( $sOriginalText, $sVariationName ) {
    return 'Options: ' . $sVariationName;
}

//
add_filter( 'uni_calendar_class_title_filter', 'uni_calendar_class_title_func', 10, 2 );
function uni_calendar_class_title_func( $sClassTitle, $oEvent ) {
    $aEventCustom = get_post_custom($oEvent->ID);
    if (  !empty($aEventCustom['_uni_event_user_id'][0]) ) {
        $oUser = get_user_by('id', $aEventCustom['_uni_event_user_id'][0]);
    }
    return $sClassTitle . ' (' . esc_html( $oUser->display_name ) . ')';
}

// switch the subscription email to 'html'
add_filter( 'uni_asana_theme_mailchimp_variables_filter', 'uni_asana_theme_mailchimp_variables_func', 10, 1 );
function uni_asana_theme_mailchimp_variables_func( $aListOfMCVars ) {
    $aListOfMCVars['email_type'] = 'html';
    return $aListOfMCVars;
}
*/
?>

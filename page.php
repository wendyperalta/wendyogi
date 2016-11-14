<?php get_header();
// this template not only handles a markup for a regular WP page, but also for WC cart and WC checkout pages
if ( function_exists('is_cart') && is_cart() ) {
        $iCartAttachId = ( ot_get_option( 'uni_cart_header_bg' ) ) ? ot_get_option( 'uni_cart_header_bg' ) : '';
        if ( !empty($iCartAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iCartAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_site_url().'/wp-content/uploads/2015/04/contact_header2.jpg';
        }
?>

	<section class="uni-container">
		<div class="pageHeader" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ); ?>);">
            <?php
            $sTitleColor = ( ot_get_option( 'uni_cart_header_title_color' ) ) ? ot_get_option( 'uni_cart_header_title_color' ) : '#ffffff';
		    if ( ot_get_option( 'uni_cart_header_title' ) ) {
                $sOutput = ot_get_option( 'uni_cart_header_title' );
            } else {
			    $sOutput = esc_html__('BOOKING', 'asana');
            }
            echo '<h1 class="page-title">'.esc_html( $sOutput ).'</h1>';
            echo '<style>.pageHeader h1 {color:'.$sTitleColor.';}</style>';
            ?>
		</div>
		<div class="contentWrap">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="pagePanel clear">
				<div class="pageTitle"><?php the_title() ?></div>
			</div>
			<div class="cartPage clear">

                <?php the_content() ?>

			</div>

			<div class="overlay"></div>
		</div>

        <?php endwhile; endif; ?>

	</section>

<?php
} else if ( function_exists('is_checkout') && is_checkout() ) {
        $iCheckoutAttachId = ( ot_get_option( 'uni_checkout_header_bg' ) ) ? ot_get_option( 'uni_checkout_header_bg' ) : '';
        if ( !empty($iCheckoutAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iCheckoutAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_site_url().'/wp-content/uploads/2015/04/aboutme_cropped.jpg';
        }
?>

	<section class="uni-container">
		<div class="pageHeader" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ); ?>);">
            <?php
            $sTitleColor = ( ot_get_option( 'uni_checkout_header_title_color' ) ) ? ot_get_option( 'uni_checkout_header_title_color' ) : '#ffffff';
		    if ( ot_get_option( 'uni_checkout_header_title' ) ) {
                $sOutput = ot_get_option( 'uni_checkout_header_title' );
            } else {
			    $sOutput = esc_html__('CHECKOUT', 'asana');
            }
            echo '<h1>'.esc_html( $sOutput ).'</h1>';
            echo '<style>.pageHeader h1 {color:'.$sTitleColor.';}</style>';
            ?>
		</div>
		<div class="contentWrap">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="pagePanel clear">
				<div class="pageTitle"><?php the_title() ?></div>
			</div>
			<div class="checkoutPage clear">

                <?php the_content() ?>

			</div>

			<div class="overlay"></div>
		</div>

        <?php endwhile; endif; ?>

	</section>

<?php
} else {
?>

	<section class="uni-container">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="wrapper">

			<div id="post-<?php the_ID(); ?>" <?php post_class('singlePostWrap clear') ?>>

                <?php the_title( '<h1 class="singleTitle">', '</h1>' ); ?>

					<?php

                        the_content();

            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'pure' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'pure' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );

                    ?>

			</div>

                <?php
        			if ( comments_open() || get_comments_number() ) {
        				comments_template();
        			}
                ?>

		</div>

        <?php endwhile; endif; ?>
	</section>

<?php
}
get_footer(); ?>

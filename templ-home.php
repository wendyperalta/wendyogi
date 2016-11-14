<?php
/*
*  Template Name: Home page
*/
get_header();
$aUniAllowedHtmlWoA = uni_asana_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_asana_theme_allowed_html_with_a();
?>

	<section class="uni-container">

    <?php if ( ot_get_option('uni_home_rev_slider_enable') == 'on' ) { ?>
        <?php echo do_shortcode('[rev_slider alias="home"]'); ?>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_slider_enable') == 'on' ) { ?>
	<?php
	$aHomeSlidesArgs = array(
	    'post_type' => 'uni_home_slides',
	    'orderby' => 'menu_order',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'order' => 'asc'
	);
	$oHomeSlides = new WP_Query( $aHomeSlidesArgs );
	if ( $oHomeSlides->have_posts() ) :
    $i = 0;
    ?>
		<div class="homeBxSliderWrap">
			<div class="homeBxSlider">
    <?php
	while ( $oHomeSlides->have_posts() ) : $oHomeSlides->the_post();
    $aPostCustom = get_post_custom( $post->ID );
	$sThumbId = get_post_thumbnail_id( $post->ID );
	$aImage = wp_get_attachment_image_src( $sThumbId, 'full' );
	?>
				<div class="slide<?php if ( $i === 0 ) echo ' active'; ?>" data-slide="<?php echo $i; ?>" style="background-image: url(<?php echo ( ( isset($aImage[0]) && !empty($aImage[0]) ) ? esc_url( $aImage[0] ) : get_template_directory_uri().'/images/placeholders/pageheader-singleevent.jpg' ); ?>);">
					<div class="slideDesc">
						<h2><?php the_title() ?></h2>
							<style type="text/css">
								.learnMore_<?php echo get_the_ID() ?> {color:<?php echo ( ( isset($aPostCustom['uni_button_a_colour'][0]) ) ? esc_attr( $aPostCustom['uni_button_a_colour'][0] ) : '#ffffff' ); ?>;background-color:<?php echo ( ( isset($aPostCustom['uni_button_a_bg'][0]) ) ? esc_attr( $aPostCustom['uni_button_a_bg'][0] ) : '#168cb9' ); ?>;}
								.learnMore_<?php echo get_the_ID() ?>:hover {color:<?php echo ( ( isset($aPostCustom['uni_button_a_colour'][0]) ) ? esc_attr( $aPostCustom['uni_button_a_colour'][0] ) : '#ffffff' ); ?>;background-color:<?php echo ( ( isset($aPostCustom['uni_button_a_bg_hover'][0]) ) ? esc_attr( $aPostCustom['uni_button_a_bg_hover'][0] ) : '#168cb2' ); ?>;}
							</style>
                        <?php if ( isset($aPostCustom['uni_slide_uri'][0]) && !empty($aPostCustom['uni_slide_uri'][0]) ) { ?>
						<a href="<?php echo ( ( isset($aPostCustom['uni_slide_uri'][0]) ) ? esc_url( $aPostCustom['uni_slide_uri'][0] ) : '' ); ?>" class="learnMore learnMore_<?php echo get_the_ID() ?>"><?php echo ( ( isset($aPostCustom['uni_slide_label'][0]) ) ? esc_html( $aPostCustom['uni_slide_label'][0] ) : esc_html__('learn more', 'asana') ); ?></a>
                        <?php } ?>
					</div>
				</div>
	<?php
    $i++;
	endwhile;
    ?>
			</div>
		</div>
    <?php
    endif;
	wp_reset_postdata();
    ?>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_about_enable') == 'on' ) { ?>
        <div class="homeGrid homeAboutSection">

            <div class="mainItem clear">
								<?php
									$sHomeAboutTitle = ot_get_option('uni_home_about_title');
	                $sHomeAboutText = ot_get_option('uni_home_about_text');
								?>
								<?php /*
                <div class="mainItemImg">
                <?php
                if ( ot_get_option('uni_home_about_image') ) {
                $aHomeAboutBlockImage = wp_get_attachment_image_src( ot_get_option('uni_home_about_image'), 'unithumb-homepostbig' );
                ?>
                    <img src="<?php echo $aHomeAboutBlockImage[0] ?>" alt="<?php if ( !empty($sHomeAboutTitle) ) echo esc_attr($sHomeAboutTitle); ?>" width="960" height="960">
                <?php
                } else {
                ?>
                    <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostbig.jpg" alt="<?php if ( !empty($sHomeAboutTitle) ) echo esc_attr($sHomeAboutTitle); ?>" width="960" height="960">
                <?php } ?>
                </div>
								*/ ?>
                <div class="mainItemDesc">
                    <h3><?php if ( !empty($sHomeAboutTitle) ) echo wp_kses( $sHomeAboutTitle, $aUniAllowedHtmlWoA ); ?></h3>
                    <p><?php if ( !empty($sHomeAboutText) ) echo wp_kses( $sHomeAboutText, $aUniAllowedHtmlWithA ); ?></p>
                    <?php if ( ot_get_option('uni_home_about_more_link_url') ) { ?>
                    <a href="<?php echo ot_get_option('uni_home_about_more_link_url') ?>" class="viewMore"><?php echo ( ot_get_option('uni_home_about_more_link_text') ) ? esc_html( ot_get_option('uni_home_about_more_link_text') ) : esc_html__('view more', 'asana') ?></a>
                    <?php } ?>
                </div>
								<?php echo do_shortcode ('[su_quote cite="Rolf Gates, Meditations from the Mat"]The real payoff of a yoga practice, I came to see, is not a perfect handstand or a deeper forward bend — it is the newly born self that each day steps off the yoga mat and back into life.[/su_quote]');
								?>
            </div>

        </div>

				<!-- Subscribe to newsletter section -->
				<?php
				/*
		        if ( !empty($aPostCustom['uni_events_page_header_bg'][0]) ) {
		            $iContactAttachId = $aPostCustom['uni_events_page_header_bg'][0];
		        } else if ( ot_get_option( 'uni_events_header_bg' ) && empty($aPostCustom['uni_events_page_header_bg'][0]) ) {
		            $iContactAttachId = ot_get_option( 'uni_events_header_bg' );
		        }
		        if ( !empty($iContactAttachId) ) {
		            $aPageHeaderImage = wp_get_attachment_image_src( $iContactAttachId, 'full' );
		            $sPageHeaderImage = $aPageHeaderImage[0];
		        } else {
		            $sPageHeaderImage = get_template_directory_uri().'/images/placeholders/pageheader-events.jpg';
		        }
						*/
		    ?>

				<!-- <div class="subscribeBox" style="background-image: url(<?php/* echo esc_url( $sPageHeaderImage ); */?> 'meditation.jpg');">
					<i class="iconEmail"></i>
					<h3><?php/* echo ( ot_get_option( 'uni_subscribe_header_title' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_title' ) ) : esc_html__('subscribe to our newsletter', 'asana'); */?></h3>
					<p><?php /*echo ( ot_get_option( 'uni_subscribe_header_subtitle' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_subtitle' ) ) : esc_html__('Subscribe and take all information about our latest events', 'asana'); */?></p>
			        <form action="<?php /*echo admin_url( 'admin-ajax.php' ); */?>" role="form" method="post" class="clear uni_form">
	                    <input type="hidden" name="action" value="uni_asana_theme_mailchimp_subscribe_user" />
						<input type="text" name="uni_input_email" size="20" value="" placeholder="<?php /*esc_html_e('Your email', 'asana' ); */?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
						<input class="subscribeSubmit uni_input_submit" type="button" value="<?php /*esc_html_e('subscribe', 'asana' ); */?>">
					</form>
				</div> -->




    <?php } ?>

    <?php if ( ot_get_option('uni_home_grid_custom_enable') == 'on' ) { ?>
		<div class="homeGrid">

            <?php if ( ot_get_option('uni_home_grid_custom_uri_one') ) { ?>
            <div class="mainItem clear">
                <div class="mainItemImg">
                <?php
                $sHomeItemOneTitle = ot_get_option('uni_home_grid_custom_title_one');
                $sHomeItemOneText = ot_get_option('uni_home_grid_custom_text_one');
                if ( ot_get_option('uni_home_grid_custom_image_one') ) {
                $aHomeItemOneImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_one'), 'unithumb-homepostbig' );
                ?>
                    <img src="<?php echo esc_url( $aHomeItemOneImage[0] ) ?>" alt="<?php if ( !empty($sHomeItemOneTitle) ) echo esc_attr($sHomeItemOneTitle); ?>" width="<?php echo esc_attr( $aHomeItemOneImage[1] ) ?>" height="<?php echo esc_attr( $aHomeItemOneImage[2] ) ?>">
                <?php
                } else {
                ?>
                    <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostbig.jpg" alt="<?php if ( !empty($sHomeItemOneTitle) ) echo esc_attr($sHomeItemOneTitle); ?>" width="684" height="684">
                <?php } ?>
                </div>
                <div class="mainItemDesc">
                    <h3><?php if ( !empty($sHomeItemOneTitle) ) echo wp_kses( $sHomeItemOneTitle, $aUniAllowedHtmlWoA ); ?></h3>
                    <p><?php if ( !empty($sHomeItemOneText) ) echo wp_kses( $sHomeItemOneText, $aUniAllowedHtmlWithA ); ?></p>
                    <a href="<?php echo ot_get_option('uni_home_grid_custom_uri_one') ?>" class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_one_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_one_label') ) : esc_html_e('view more', 'asana') ?></a>
                </div>
            </div>
            <?php } ?>

			<div class="gridItemWrap clear">

                <?php if ( ot_get_option('uni_home_grid_custom_uri_two') ) { ?>
				<a href="<?php echo ot_get_option('uni_home_grid_custom_uri_two') ?>" class="gridItem clear">
					<div class="gridItemImg">
                    <?php
                    $sHomeItemTwoTitle = ot_get_option('uni_home_grid_custom_title_two');
                    $sHomeItemTwoText = ot_get_option('uni_home_grid_custom_text_two');
                    if ( ot_get_option('uni_home_grid_custom_image_two') ) {
                    $aHomeItemTwoImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_two'), 'unithumb-homepostsmall' );
                    ?>
                        <img src="<?php echo $aHomeItemTwoImage[0] ?>" alt="<?php if ( !empty($sHomeItemTwoTitle) ) echo esc_attr($sHomeItemTwoTitle); ?>" width="480" height="480">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php if ( !empty($sHomeItemTwoTitle) ) echo esc_attr($sHomeItemTwoTitle); ?>" width="480" height="480">
                    <?php } ?>
					</div>
					<div class="gridItemDesc">
						<h3><?php if ( !empty($sHomeItemTwoTitle) ) echo wp_kses( $sHomeItemTwoTitle, $aUniAllowedHtmlWoA ); ?></h3>
						<p><?php if ( !empty($sHomeItemTwoText) ) echo wp_kses( $sHomeItemTwoText, $aUniAllowedHtmlWoA ); ?></p>
						<span class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_two_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_two_label') ) : esc_html_e('view more', 'asana') ?>
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
								</svg>
							</i>
						</span>
					</div>
				</a>
                <?php } ?>

                <?php if ( ot_get_option('uni_home_grid_custom_uri_three') ) { ?>
				<a href="<?php echo ot_get_option('uni_home_grid_custom_uri_three') ?>" class="gridItem gridItemWhite clear">
					<div class="gridItemImg">
                    <?php
                    $sHomeItemThreeTitle = ot_get_option('uni_home_grid_custom_title_three');
                    $sHomeItemThreeText = ot_get_option('uni_home_grid_custom_text_three');
                    if ( ot_get_option('uni_home_grid_custom_image_three') ) {
                    $aHomeItemThreeImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_three'), 'unithumb-homepostsmall' );
                    ?>
                        <img src="<?php echo $aHomeItemThreeImage[0] ?>" alt="<?php if ( !empty($sHomeItemThreeTitle) ) echo esc_attr($sHomeItemThreeTitle); ?>" width="480" height="480">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php if ( !empty($sHomeItemThreeTitle) ) echo esc_attr($sHomeItemThreeTitle); ?>" width="480" height="480">
                    <?php } ?>
					</div>
					<div class="gridItemDesc">
						<h3><?php if ( !empty($sHomeItemThreeTitle) ) echo wp_kses( $sHomeItemThreeTitle, $aUniAllowedHtmlWoA ); ?></h3>
						<p><?php if ( !empty($sHomeItemThreeText) ) echo wp_kses( $sHomeItemThreeText, $aUniAllowedHtmlWoA ); ?></p>
						<span class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_three_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_three_label') ) : esc_html_e('view more', 'asana') ?>
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
								<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
								<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
								</svg>
							</i>
						</span>
					</div>
				</a>
                <?php } ?>

				<div class="gridItemWrapLeft">

                    <?php if ( ot_get_option('uni_home_grid_custom_uri_four') ) { ?>
					<a href="<?php echo ot_get_option('uni_home_grid_custom_uri_four') ?>" class="gridItem gridItemWhite clear">
						<div class="gridItemImg">
                        <?php
                        $sHomeItemFourTitle = ot_get_option('uni_home_grid_custom_title_four');
                        $sHomeItemFourText = ot_get_option('uni_home_grid_custom_text_four');
                        if ( ot_get_option('uni_home_grid_custom_image_four') ) {
                        $aHomeItemFourImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_four'), 'unithumb-homepostsmall' );
                        ?>
                            <img src="<?php echo $aHomeItemFourImage[0] ?>" alt="<?php if ( !empty($sHomeItemFourTitle) ) echo esc_attr($sHomeItemFourTitle); ?>" width="480" height="480">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php if ( !empty($sHomeItemFourTitle) ) echo esc_attr($sHomeItemFourTitle); ?>" width="480" height="480">
                        <?php } ?>
						</div>
						<div class="gridItemDesc">
							<h3><?php if ( !empty($sHomeItemFourTitle) ) echo wp_kses( $sHomeItemFourTitle, $aUniAllowedHtmlWoA ); ?></h3>
							<p><?php if ( !empty($sHomeItemFourText) ) echo wp_kses( $sHomeItemFourText, $aUniAllowedHtmlWoA ); ?></p>
							<span class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_four_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_four_label') ) : esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
                    <?php } ?>

                    <?php if ( ot_get_option('uni_home_grid_custom_uri_five') ) { ?>
					<a href="<?php echo ot_get_option('uni_home_grid_custom_uri_five') ?>" class="gridItem clear">
						<div class="gridItemImg">
                        <?php
                        $sHomeItemFiveTitle = ot_get_option('uni_home_grid_custom_title_five');
                        $sHomeItemFiveText = ot_get_option('uni_home_grid_custom_text_five');
                        if ( ot_get_option('uni_home_grid_custom_image_five') ) {
                        $aHomeItemFiveImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_five'), 'unithumb-homepostsmall' );
                        ?>
                            <img src="<?php echo $aHomeItemFiveImage[0] ?>" alt="<?php if ( !empty($sHomeItemFiveTitle) ) echo esc_attr($sHomeItemFiveTitle); ?>" width="480" height="480">
                        <?php
                        } else {
                        ?>
                            <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php if ( !empty($sHomeItemFiveTitle) ) echo esc_attr($sHomeItemFiveTitle); ?>" width="480" height="480">
                        <?php } ?>
						</div>
						<div class="gridItemDesc">
							<h3><?php if ( !empty($sHomeItemFiveTitle) ) echo wp_kses( $sHomeItemFiveTitle, $aUniAllowedHtmlWoA ); ?></h3>
							<p><?php if ( !empty($sHomeItemFiveText) ) echo wp_kses( $sHomeItemFiveText, $aUniAllowedHtmlWoA ); ?></p>
							<span class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_five_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_five_label') ) : esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
                    <?php } ?>

				</div>

                <?php if ( ot_get_option('uni_home_grid_custom_uri_six') ) { ?>
				<div class="gridItemWrapRight">
					<a href="<?php echo ot_get_option('uni_home_grid_custom_uri_six') ?>" class="gridItem2 clear">
                    <?php
                    $sHomeItemSixTitle = ot_get_option('uni_home_grid_custom_title_six');
                    $sHomeItemSixText = ot_get_option('uni_home_grid_custom_text_six');
                    if ( ot_get_option('uni_home_grid_custom_image_six') ) {
                    $aHomeItemSixImage = wp_get_attachment_image_src( ot_get_option('uni_home_grid_custom_image_six'), 'unithumb-homepostbig' );
                    ?>
                        <img src="<?php echo $aHomeItemSixImage[0] ?>" alt="<?php if ( !empty($sHomeItemSixTitle) ) echo esc_attr($sHomeItemSixTitle); ?>" width="960" height="960">
                    <?php
                    } else {
                    ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostbig.jpg" alt="<?php if ( !empty($sHomeItemSixTitle) ) echo esc_attr($sHomeItemSixTitle); ?>" width="960" height="960">
                    <?php } ?>
						<div class="gridItemDesc">
							<h3><?php if ( !empty($sHomeItemSixTitle) ) echo wp_kses( $sHomeItemSixTitle, $aUniAllowedHtmlWoA ); ?></h3>
							<p><?php if ( !empty($sHomeItemSixText) ) echo wp_kses( $sHomeItemSixText, $aUniAllowedHtmlWoA ); ?></p>
							<span class="viewMore"><?php echo ( ot_get_option('uni_home_grid_custom_uri_six_label') ) ? esc_html( ot_get_option('uni_home_grid_custom_uri_six_label') ) : esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
				</div>
                <?php } ?>

			</div>

		</div>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_grid_enable') == 'on' ) { ?>
		<div class="homeGrid">
    <?php
    $aSelectedPosts = array();
    for ( $l = 1; $l <= 6; $l++ ) {
        if ( ot_get_option( 'uni_home_posts_'.$l ) ) $aSelectedPosts[] = ot_get_option( 'uni_home_posts_'.$l );
    }
    $iNumberOfPosts = count($aSelectedPosts);
    if ( $iNumberOfPosts == 6 ) {
        $aFeaturedArgs = array(
            'post_type'	=> 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'posts_per_page' => 6,
            'post__in' => $aSelectedPosts,
            'orderby' => 'post__in',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array(
                        'post-format-aside',
                        'post-format-audio',
                        'post-format-chat',
                        'post-format-gallery',
                        'post-format-image',
                        'post-format-link',
                        'post-format-quote',
                        'post-format-status',
                        'post-format-video'
                    ),
                    'operator' => 'NOT IN'
                )
            )
        );
    } else {
        $aFeaturedArgs = array(
            'post_type'	=> 'post',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'posts_per_page' => 6,
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array(
                        'post-format-aside',
                        'post-format-audio',
                        'post-format-chat',
                        'post-format-gallery',
                        'post-format-image',
                        'post-format-link',
                        'post-format-quote',
                        'post-format-status',
                        'post-format-video'
                    ),
                    'operator' => 'NOT IN'
                )
            )
        );
    }

    $oFeaturedQuery = new WP_Query( $aFeaturedArgs );
    if ( $oFeaturedQuery->have_posts() ) :
    $iPostsFound = count($oFeaturedQuery->posts);
    $i = 1;
    while ( $oFeaturedQuery->have_posts() ) : $oFeaturedQuery->the_post(); ?>
        <?php if ( $i == 1 ) { ?>
			<div id="post-<?php the_ID(); ?>" <?php $classes_one[] = 'mainItem'; $classes_one[] = 'clear'; post_class( $classes_one ); ?>><!-- <?php echo $i ?>  -->
				<div class="mainItemImg">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'unithumb-homepostbig', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                    <?php } else { ?>
					    <img src="<?php echo get_template_directory_uri() ?>/images/placeholders/unithumb-homepostbig.jpg" alt="<?php the_title_attribute() ?>" width="960" height="960">
                    <?php } ?>
				</div>
				<div class="mainItemDesc">
					<h3><?php the_title() ?></h3>
					<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
					<a href="<?php the_permalink() ?>" class="viewMore"><?php esc_html_e('view more', 'asana') ?></a>
				</div>
			</div> <!-- end of <?php echo $i ?>  -->
        <?php } ?>

        <?php if ( $i == 2 && $iPostsFound >= 6 ) { ?>
			<div class="gridItemWrap clear"> <!-- <?php echo $i ?>  -->
        <?php } ?>
            <?php if ( $i == 2 && $iPostsFound >= 6 ) { ?>
				<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php $classes_two[] = 'gridItem'; $classes_two[] = 'clear'; post_class($classes_two); ?>>
					<div class="gridItemImg">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'unithumb-homepostsmall', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                    <?php } else { ?>
					    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php the_title_attribute() ?>" width="480" height="480">
                    <?php } ?>
					</div>
					<div class="gridItemDesc">
						<h3><?php the_title() ?></h3>
						<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
						<span class="viewMore"><?php esc_html_e('view more', 'asana') ?>
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
								</svg>
							</i>
						</span>
					</div>
				</a>
            <?php } ?>
            <?php if ( $i == 3 && $iPostsFound >= 6 ) { ?>
				<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php $classes_three[] = 'gridItem'; $classes_three[] = 'gridItemWhite'; $classes_three[] = 'clear'; post_class($classes_three); ?>>
					<div class="gridItemImg">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'unithumb-homepostsmall', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                    <?php } else { ?>
					    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php the_title_attribute() ?>" width="480" height="480">
                    <?php } ?>
					</div>
					<div class="gridItemDesc">
						<h3><?php the_title() ?></h3>
						<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
						<span class="viewMore"><?php esc_html_e('view more', 'asana') ?>
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
								<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
								<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
								</svg>
							</i>
						</span>
					</div>
				</a>
            <?php } ?>
                <?php if ( $i == 4 && $iPostsFound >= 6 ) { ?>
				<div class="gridItemWrapLeft">
                <?php } ?>
                    <?php if ( $i == 4 && $iPostsFound >= 6 ) { ?>
					<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php $classes_four[] = 'gridItem'; $classes_four[] = 'gridItemWhite'; $classes_four[] = 'clear'; post_class($classes_four); ?>>
						<div class="gridItemImg">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'unithumb-homepostsmall', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                        <?php } else { ?>
					        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php the_title_attribute() ?>" width="480" height="480">
                        <?php } ?>
						</div>
						<div class="gridItemDesc">
							<h3><?php the_title() ?></h3>
							<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
							<span class="viewMore"><?php esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
                    <?php } ?>
                    <?php if ( $i == 5 && $iPostsFound >= 6 ) { ?>
					<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php $classes_five[] = 'gridItem'; $classes_five[] = 'clear'; post_class($classes_five); ?>>
						<div class="gridItemImg">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'unithumb-homepostsmall', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                        <?php } else { ?>
					        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/unithumb-homepostsmall.jpg" alt="<?php the_title_attribute() ?>" width="480" height="480">
                        <?php } ?>
						</div>
						<div class="gridItemDesc">
							<h3><?php the_title() ?></h3>
							<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
							<span class="viewMore"><?php esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
                    <?php } ?>
                <?php if ( $i == 6 && $iPostsFound >= 6 ) { ?>
				</div>
                <?php } ?>
            <?php if ( $i == 6 && $iPostsFound >= 6 ) { ?>
				<div class="gridItemWrapRight">
					<a href="<?php the_permalink() ?>" id="post-<?php the_ID(); ?>" <?php $classes_six[] = 'gridItem2'; $classes_six[] = 'clear'; post_class($classes_six); ?>>
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php the_post_thumbnail( 'unithumb-homepostbig', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                    <?php } else { ?>
					    <img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/unithumb-homepostbig.jpg" alt="<?php the_title_attribute() ?>" width="960" height="960">
                    <?php } ?>
						<div class="gridItemDesc">
							<h3><?php the_title() ?></h3>
							<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(20, '', true); } ?>
							<span class="viewMore"><?php esc_html_e('view more', 'asana') ?>
								<i>
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="9px" height="15px" viewBox="0 0 9 15" enable-background="new 0 0 9 15" xml:space="preserve">
									<path fill="#96e9d5" d="M10-184.5l-0.826 0.757L1.826-177L1-177.758l7.349-6.742L1-191.243L1.826-192l7.349 6.743L10-184.5z M9.174-183.743L9.174-183.743L10-184.5L9.174-183.743z M9.175-185.257L10-184.5v0L9.175-185.257z"/>
									<path fill="#96e9d5" d="M9 7.5L8.174 8.257L0.826 15L0 14.242L7.349 7.5L0 0.757L0.826 0l7.349 6.743L9 7.5z M8.174 8.3 L8.174 8.257L9 7.5L8.174 8.257z M8.175 6.743L9 7.5v0L8.175 6.743z"/>
									</svg>
								</i>
							</span>
						</div>
					</a>
				</div>
            <?php } ?>
        <?php if ( $i == 6 && $iPostsFound >= 6 ) { ?>
			</div> <!-- end of <?php echo $i ?>  -->
        <?php } ?>
	<?php
    $i++;
    endwhile; endif;
	wp_reset_postdata(); ?>
		</div>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_membership_cards_enable') == 'on' ) { ?>
    <div class="membershipCardsBlock">
        <div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_membership_cards_title' ) ) ? esc_html( ot_get_option( 'uni_home_membership_cards_title' ) ) : esc_html__('Membership cards', 'asana'); ?></div>
        <div class="membershipCardsWrap<?php echo ( ot_get_option( 'uni_ordernow_btn_membership_cards_enable' ) && ot_get_option( 'uni_ordernow_btn_membership_cards_enable' ) == 'off' && ot_get_option( 'uni_home_membership_cards_subscriptions_enable' ) == 'off' ) ? ' without-order-now-btn' : ''; ?>">
    <?php
    if ( ot_get_option( 'uni_home_membership_cards_subscriptions_enable' ) == 'on' && class_exists('WC_Subscriptions_Product') ) {

        $aChosenSubscriptions = array();
        if ( ot_get_option( 'uni_home_mc_subscription_prod_left' ) ) $aChosenSubscriptions[] = ot_get_option( 'uni_home_mc_subscription_prod_left' );
        if ( ot_get_option( 'uni_home_mc_subscription_prod_center' ) ) $aChosenSubscriptions[] = ot_get_option( 'uni_home_mc_subscription_prod_center' );
        if ( ot_get_option( 'uni_home_mc_subscription_prod_right' ) ) $aChosenSubscriptions[] = ot_get_option( 'uni_home_mc_subscription_prod_right' );

        if ( !empty($aChosenSubscriptions) ) {
        $aPricesArgs = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'post__in' => $aChosenSubscriptions,
            'orderby' => 'post__in',
            'posts_per_page' => 3,
            'meta_query' => array(
                array(
                    'key' => '_subscription_price',
                    'compare' => 'EXISTS',
                )
            )
        );
        } else {
        $aPricesArgs = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => 3,
            'meta_query' => array(
                array(
                    'key' => '_subscription_price',
                    'compare' => 'EXISTS',
                )
            )
        );
        }

        $oPricesQuery = new WP_Query( $aPricesArgs );
        if ( $oPricesQuery->have_posts() ) :
        while ( $oPricesQuery->have_posts() ) : $oPricesQuery->the_post();
        global $product;
        $aPostCustom = get_post_custom( $post->ID );
        $aArrayOfVariations = maybe_unserialize($aPostCustom['_product_attributes'][0]);
        /*
        if ( !empty($aArrayOfVariations) ) {
            // it is a variable product
        }
        */
        ?>
                <div class="membershipCardItem">
                    <h3><?php the_title() ?></h3>
                    <div class="membershipCard">
                        <span><?php echo get_woocommerce_currency_symbol( '' ) ?> <?php echo WC_Subscriptions_Product::get_price( $product ) ?></span>
                        <em><?php if ( !empty($aPostCustom['_subscription_period_interval'][0]) ) echo esc_html($aPostCustom['_subscription_period_interval'][0]); ?> <?php echo WC_Subscriptions_Product::get_period( $product ) ?></em>
                    </div>
                    <?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(40, '', true); } ?>
                    <a href="<?php the_permalink() ?>" class="membership-card-order"><?php echo esc_html__('Order Now', 'asana') ?></a>
                </div>
    	<?php endwhile; endif;
    	wp_reset_postdata();

    } else {

        $aPricesArgs = array(
            'post_type'	=> 'uni_price',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page' => 3,
        );

        $oPricesQuery = new WP_Query( $aPricesArgs );
        if ( $oPricesQuery->have_posts() ) :
        while ( $oPricesQuery->have_posts() ) : $oPricesQuery->the_post();
        $aPostCustom = get_post_custom( $post->ID );
        ?>
                <div class="membershipCardItem">
                    <h3><?php the_title() ?></h3>
                    <div class="membershipCard">
                        <span><span><?php if ( !empty($aPostCustom['uni_currency'][0]) ) echo esc_html($aPostCustom['uni_currency'][0]) ?></span><?php if ( isset($aPostCustom['uni_price_val'][0]) ) echo esc_html($aPostCustom['uni_price_val'][0]) ?></span>
                        <em><?php if ( !empty($aPostCustom['uni_period'][0]) ) echo esc_html($aPostCustom['uni_period'][0]) ?></em>
                    </div>
                    <?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(40, '', true); } ?>
                    <?php if ( ot_get_option( 'uni_ordernow_btn_membership_cards_enable' ) && ot_get_option( 'uni_ordernow_btn_membership_cards_enable' ) == 'off' ) {
                        // empty
                    } else {
                    if ( isset($aPostCustom['uni_order_button_ext_url_enable'][0]) && $aPostCustom['uni_order_button_ext_url_enable'][0] == 'on' && !empty($aPostCustom['uni_order_button_uri'][0]) ) { ?>
                    <a href="<?php echo $aPostCustom['uni_order_button_uri'][0]; ?>" class="membership-card-order"><?php echo ( !empty($aPostCustom['uni_order_button_text'][0]) ) ? $aPostCustom['uni_order_button_text'][0] : esc_html__('Order Now', 'asana') ?></a>
                    <?php } else { ?>
                    <a href="#membershipCardOrderPopup" class="membershipCardOrder membership-card-order" data-priceid="<?php echo $post->ID; ?>" data-pricetitle="<?php echo esc_attr( get_the_title($post->ID) ) ?>"><?php echo ( !empty($aPostCustom['uni_order_button_text'][0]) ) ? $aPostCustom['uni_order_button_text'][0] : esc_html__('Order Now', 'asana') ?></a>
                    <?php }
                    } ?>
                </div>
    	<?php endwhile; endif;
    	wp_reset_postdata();

    }
    ?>
        </div>
    </div>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_shop_enable') == 'on' ) { ?>
    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
    	<div class="woocommerce">
		<div class="shopItems">
			<div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_shop_title' ) ) ? esc_html( ot_get_option( 'uni_home_shop_title' ) ) : esc_html__('yoga shop', 'asana'); ?></div>
			<ul class="shopItemsWrap">
    <?php
    $sSortType = ot_get_option( 'uni_home_products_type' );
    $iNumberOfProducts =  ( ot_get_option( 'uni_home_products_number' ) ) ? intval(ot_get_option( 'uni_home_products_number' )) : 8;
    switch ( $sSortType ) {
        case 'bestsellers' :
        $args = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'orderby' => 'meta_value_num',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                array(
                    'key' => 'total_sales',
                    'compare' => 'EXISTS',
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'random' :
        $args = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'orderby' => 'rand',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'featured-desc' :
        $args = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'orderby' =>'date',
            'order' => 'DESC',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'featured-random' :
        $args = array(
            'post_type'	=> 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'orderby' =>'rand',
            'posts_per_page' => $iNumberOfProducts,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                    'compare' => 'EXISTS'
                ),
                array(
                    'key' => '_visibility',
                    'value' => array('catalog', 'visible'),
                    'compare' => 'IN'
                )
            )
        );
        $oProducts = new WP_Query( $args );
        break;

        case 'most-rated' :
        add_filter( 'posts_clauses',  'uni_asana_theme_order_by_rating_post_clauses' );
		$args = array( 'posts_per_page' => $iNumberOfProducts, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
		$args['meta_query'] = WC()->query->get_meta_query();
        $oProducts = new WP_Query( $args );
        break;
    }

    if ( $oProducts->have_posts() ) :
    while ( $oProducts->have_posts() ) : $oProducts->the_post();

        wc_get_template_part( 'content', 'product' );

	endwhile; endif;
    if ( $sSortType == 'most-rated' ) { remove_filter( 'posts_clauses', 'uni_order_by_rating_post_clauses' ); }
	wp_reset_postdata(); ?>
			</ul>
			<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="showAllItems"><?php esc_html_e('Shop all', 'asana') ?></a>
		</div>
		</div>
    <?php } ?>
    <?php } ?>

    <?php if ( ot_get_option('uni_home_blog_enable') == 'on' || !ot_get_option('uni_home_blog_enable') ) { ?>
		<div class="blogPosts">
			<div class="blockTitle"><?php echo ( ot_get_option( 'uni_home_blog_title' ) ) ? esc_html( ot_get_option( 'uni_home_blog_title' ) ) : esc_html__('blog', 'asana'); ?></div>
			<div class="blogPostWrap">
    <?php
    $aBlogArgs = array(
        'post_type'	=> 'post',
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1,
        'posts_per_page' => 3,
    );

    $oBlogQuery = new WP_Query( $aBlogArgs );
    if ( $oBlogQuery->have_posts() ) :
    while ( $oBlogQuery->have_posts() ) : $oBlogQuery->the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class('postItem'); ?>>
					<a href="<?php the_permalink() ?>" class="postItemImg">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'unithumb-blog', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                        <?php } else { ?>
						    <img src="http://placehold.it/408x272/5FC7AE/FFFFFF" alt="<?php the_title_attribute() ?>" width="408" height="272">
                        <?php } ?>
					</a>
					<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
					<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(12, '', true); } ?>
				</div>

	<?php endwhile; endif;
	wp_reset_postdata(); ?>
			</div>
		</div>
    <?php } ?>

    <?php
    if ( ot_get_option( 'uni_home_classes_enable' ) == 'on' ) {
        $iClassesPageUrl = ( ot_get_option( 'uni_home_classes_button_uri' ) ) ? ot_get_option( 'uni_home_classes_button_uri' ) : '';
        if ( ot_get_option( 'uni_home_classes_bg' ) ) {
            $iClassesBgAttachId = ot_get_option( 'uni_home_classes_bg' );
            $aClassesBgAttach = wp_get_attachment_image_src( $iClassesBgAttachId, 'full' );
            $sClassesImage = $aClassesBgAttach[0];
        } else {
            $sClassesImage = get_template_directory_uri().'/images/placeholders/subscribe.jpg';
        } ?>
		<div class="classesBox" data-type="parallax" data-speed="10" style="background-image: url(<?php echo esc_url( $sClassesImage ); ?>);">
            <div class="classesBoxDesc">
                <a href="<?php if ( !empty($iClassesPageUrl) ) echo $iClassesPageUrl; ?>" class="classesCategory"><?php echo ( ot_get_option( 'uni_home_classes_small_title' ) ) ? esc_html( ot_get_option( 'uni_home_classes_small_title' ) ) : esc_html__('classes', 'asana'); ?></a>
                <h3><?php echo ( ot_get_option( 'uni_home_classes_title' ) ) ? esc_html( ot_get_option( 'uni_home_classes_title' ) ) : esc_html__('choose your classes and start your training', 'asana'); ?></h3>
                <?php if ( !empty($iClassesPageUrl) ) { ?>
                <a href="<?php echo esc_url( $iClassesPageUrl ); ?>" class="viewClasses"><?php echo ( ot_get_option( 'uni_home_classes_button_title' ) ) ? esc_html( ot_get_option( 'uni_home_classes_button_title' ) ) : esc_html__('view classes', 'asana'); ?></a>
                <?php } ?>
            </div>
		</div>
    <?php } ?>
	</section>

<?php get_footer(); ?>

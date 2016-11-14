	<footer id="footer" class="clear">

				<!-- Subscribe to newsletter section -->
				<?php
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
		    ?>

				<div class="subscribeBox" style="background-image: url('<?php echo get_site_url()?>/wp-content/uploads/2016/08/reverseNamaste_2.jpg');">
					<i class="iconEmail"></i>
					<h3><?php echo ( ot_get_option( 'uni_subscribe_header_title' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_title' ) ) : esc_html__('subscribe to our newsletter', 'asana'); ?></h3>
					<p><?php echo ( ot_get_option( 'uni_subscribe_header_subtitle' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_subtitle' ) ) : esc_html__('Subscribe and take all information about our latest events', 'asana'); ?></p>
			        <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" role="form" method="post" class="clear uni_form">
	                    <input type="hidden" name="action" value="uni_asana_theme_mailchimp_subscribe_user" />
						<input type="text" name="uni_input_email" size="20" value="" placeholder="<?php esc_html_e('Your email', 'asana' ); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
						<input class="subscribeSubmit uni_input_submit" type="button" value="<?php esc_html_e('subscribe', 'asana' ); ?>">
					</form>
				</div>

		<?php/* uni_asana_theme_footer_social_icons_output(); */?>
		<div class="footerSocial clear">
        <a href="http://www.facebook.com/wendyogi" target="_blank">
					<i class="fa fa-facebook"></i>
				</a>
        <a href="http://www.instagram.com/wendyogi" target="_blank">
					<i class="fa fa-instagram"></i>
				</a>
        <!-- <a href="http://www.twitter.com/wendyogi" target="_blank">
					<i class="fa fa-twitter"></i>
				</a> -->
    </div>
		<?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'menu_class' => 'footerMenu clear', 'theme_location' => 'footer', 'depth' => 1, 'fallback_cb'=> 'uni_nav_footer_fallback' ) ); ?>

        <?php/* uni_asana_theme_mailchimp_footer_form_output() */?>

		<div class="copyright">
            <?php if ( ot_get_option( 'uni_footer_text' ) ) { ?>
                <?php echo ot_get_option('uni_footer_text'); ?>
            <?php } else { ?>
				<p><?php echo sprintf( esc_html__('Copyright &copy; %d. Wendyogi All rights reserved', 'asana' ), date('Y') ); ?></p>
            <?php } ?>
		</div>

	</footer>

    <?php wp_footer(); ?>

</body>
</html>

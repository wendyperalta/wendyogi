<?php
/*
*  Template Name: About Page
*/
get_header();
$aUniAllowedHtmlWoA = uni_asana_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_asana_theme_allowed_html_with_a();
?>

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
    <?php
        if ( !empty($aPostCustom['uni_about_page_header_bg'][0]) ) {
            $iContactAttachId = $aPostCustom['uni_about_page_header_bg'][0];
        } else if ( ot_get_option( 'uni_about_header_bg' ) && empty($aPostCustom['uni_about_page_header_bg'][0]) ) {
            $iContactAttachId = ot_get_option( 'uni_about_header_bg' );
        }
        if ( !empty($iContactAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iContactAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_template_directory_uri().'/images/placeholders/pageheader-cart.jpg';
        }
    ?>

	<section class="uni-container">

		<div class="pageHeader" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ); ?>);">
            <?php
            if ( !empty($aPostCustom['uni_about_page_header_title_color'][0]) ) {
                $sTitleColor = $aPostCustom['uni_about_page_header_title_color'][0];
            } else if ( ot_get_option( 'uni_about_header_title_color' ) && empty($aPostCustom['uni_about_page_header_title_color'][0]) ) {
                $sTitleColor = ot_get_option( 'uni_about_header_title_color' );
            } else {
                $sTitleColor = '#ffffff';
            }
            if ( !empty($aPostCustom['uni_about_page_header_title'][0]) ) {
                $sHeaderTitle = $aPostCustom['uni_about_page_header_title'][0];
            } else if ( ot_get_option( 'uni_about_header_title' ) && empty($aPostCustom['uni_about_page_header_title'][0]) ) {
                $sHeaderTitle = ot_get_option( 'uni_about_header_title' );
            } else {
                $sHeaderTitle = __('About Our Studio', 'asana');
            }

            echo '<h1>'.esc_html( $sHeaderTitle ).'</h1>';
            echo '<style>.pageHeader h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
            ?>
		</div>
		<div class="ourStory">
			<div class="wrapper">
				<div class="storyItem clear">
					<div class="storyImg">
						  <img src="<?php echo get_site_url()?>/wp-content/uploads/2016/08/headshot_edited.jpg" alt="<?php the_title_attribute() ?>" width="570" height="871">
					</div>
					<div class="storyDesc">
                        <h3><?php the_title() ?></h3>
						<?php the_content() ?>
					</div>
				</div>
        <?php echo do_shortcode ('[su_quote cite="T.K.V. Desikachar"]Mastery of yoga is really measured by how it influences our day-to-day living, how it enhances our relationships, how it promotes clarity and peace of mind.[/su_quote]');
        ?>
			</div>
		</div>

    <?php if ( !empty($aPostCustom['uni_meet_team_enable'][0]) && $aPostCustom['uni_meet_team_enable'][0] == 'on' ) { ?>
    <?php
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'uni-sortable-users/uni-sortable-users.php' ) ) {
        if ( !empty( $aPostCustom['uni_meet_team_members'][0] ) ) {
            $aUsersArray = maybe_unserialize($aPostCustom['uni_meet_team_members'][0]);
            $oUserQuery = new WP_User_Query( array('role' => 'instructor', 'include' => $aUsersArray, 'meta_key' => 'user_order', 'orderby' => 'meta_value_num', 'order' => 'asc') );
        } else {
            $oUserQuery = new WP_User_Query( array('role' => 'instructor', 'meta_key' => 'user_order', 'orderby' => 'meta_value_num', 'order' => 'asc') );
        }
    } else {
        if ( !empty( $aPostCustom['uni_meet_team_members'][0] ) ) {
            $aUsersArray = maybe_unserialize($aPostCustom['uni_meet_team_members'][0]);
            $oUserQuery = new WP_User_Query( array('role' => 'instructor', 'include' => $aUsersArray) );
        } else {
            $oUserQuery = new WP_User_Query( array('role' => 'instructor') );
        }
    }
    if ( ! empty( $oUserQuery->results ) ) {
    ?>
		<div class="ourTeam">
			<div class="blockTitle"><?php if ( !empty($aPostCustom['uni_meet_team_title'][0]) ) { echo esc_html( $aPostCustom['uni_meet_team_title'][0] ); } else { esc_html_e( 'meet our team', 'asana' ); } ?></div>
			<div class="teamItemWrap clear<?php if ( !empty($aPostCustom['uni_meet_team_center_users_enable'][0]) && $aPostCustom['uni_meet_team_center_users_enable'][0] == 'on' ) echo ' teamItemCenter'; ?>">
    <?php
        foreach ( $oUserQuery->results as $oUser ) {
            $aUserData = ( get_user_meta( $oUser->ID, '_uni_user_data', true ) ) ? get_user_meta( $oUser->ID, '_uni_user_data', true ) : array();
    ?>
				<div class="teamItem" data-userid="user_<?php echo $oUser->ID ?>">
					<?php echo do_shortcode('[uav-display-avatar id="'.$oUser->ID.'" size="342" alt="'.esc_attr($oUser->display_name).'"]') ?>
					<div class="overlay">
						<div class="teamItemNameWrap">
							<h3><?php echo esc_html( $oUser->display_name ); ?></h3>
						</div>
						<p><?php if ( !empty($aUserData['profession']) ) echo esc_attr( $aUserData['profession'] ) ?></p>
					</div>
				</div>

				<div class="teamItemDesc" id="user_<?php echo $oUser->ID ?>">
                    <div class="teamItemDescWrap">
    					<?php echo do_shortcode('[uav-display-avatar id="'.$oUser->ID.'" size="342" alt="'.esc_attr( $oUser->display_name ).'"]') ?>
    					<h3><?php echo esc_html( $oUser->display_name ); ?></h3>
    					<p class="teamItemDescText1"><?php if ( !empty($aUserData['profession']) ) echo esc_attr( $aUserData['profession'] ) ?></p>
    					<p class="teamItemDescText"><?php echo wp_kses( $oUser->description, $aUniAllowedHtmlWithA ) ?></p>
    					<div class="teamItemSocial">
	                        <?php if ( !empty($aUserData['social_link_uri_one']) && !empty($aUserData['social_link_icon_one']) ) { ?>
	    						<a href="<?php echo esc_url( $aUserData['social_link_uri_one'] ) ?>"><i class="fa <?php echo esc_attr($aUserData['social_link_icon_one']) ?>"></i></a>
	                        <?php } ?>
	                        <?php if ( !empty($aUserData['social_link_uri_two']) && !empty($aUserData['social_link_icon_two']) ) { ?>
	    						<a href="<?php echo esc_url( $aUserData['social_link_uri_two'] ) ?>"><i class="fa <?php echo esc_attr($aUserData['social_link_icon_two']) ?>"></i></a>
	                        <?php } ?>
	                        <?php if ( !empty($aUserData['social_link_uri_three']) && !empty($aUserData['social_link_icon_three']) ) { ?>
	    						<a href="<?php echo esc_url( $aUserData['social_link_uri_three'] ) ?>"><i class="fa <?php echo esc_attr($aUserData['social_link_icon_three']) ?>"></i></a>
	                        <?php } ?>
	                        <?php if ( !empty($aUserData['social_link_uri_four']) && !empty($aUserData['social_link_icon_four']) ) { ?>
	    						<a href="<?php echo esc_url( $aUserData['social_link_uri_four'] ) ?>"><i class="fa <?php echo esc_attr($aUserData['social_link_icon_four']) ?>"></i></a>
	                        <?php } ?>
	                        <?php if ( !empty($aUserData['social_link_uri_five']) && !empty($aUserData['social_link_icon_five']) ) { ?>
	    						<a href="<?php echo esc_url( $aUserData['social_link_uri_five'] ) ?>"><i class="fa <?php echo esc_attr($aUserData['social_link_icon_five']) ?>"></i></a>
	                        <?php } ?>
    					</div>
                    </div>
					<span class="closeTeamDesc">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="1.5 -1 16 16" enable-background="new 1.5 -1 16 16" xml:space="preserve">
							<path fill="#C1F4E8" d="M11.185 7l6.315 6.314L15.814 15L9.5 8.685L3.186 15L1.5 13.314L7.815 7L1.5 0.686L3.186-1L9.5 5.3 L15.814-1L17.5 0.686L11.185 7z"/>
						</svg>
					</span>
				</div>
    <?php
        }
    ?>
			</div>
		</div>
    <?php
    }
    ?>
    <?php } ?>

    <?php if ( !empty($aPostCustom['uni_about_values_enable'][0]) && $aPostCustom['uni_about_values_enable'][0] == 'on' ) { ?>
		<div class="ourValues">
			<div class="blockTitle"><?php echo ( $aPostCustom['uni_about_values_title'][0] ) ? esc_html( $aPostCustom['uni_about_values_title'][0] ) : esc_html__('our values', 'asana'); ?></div>
    <?php
    if ( !empty( $aPostCustom['uni_about_values_posts'][0] ) ) {
        $aValuesArray = maybe_unserialize($aPostCustom['uni_about_values_posts'][0]);
        $aValuesArgs = array(
            'post_type'	=> 'uni_value',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'post__in' => $aValuesArray,
        );
    } else {
        $aValuesArgs = array(
            'post_type'	=> 'uni_value',
            'post_status' => 'publish',
            'ignore_sticky_posts'	=> 1,
            'posts_per_page' => -1,
        );
    }

    $oValuesQuery = new WP_Query( $aValuesArgs );
    if ( $oValuesQuery->have_posts() ) :
    $i = 1;
    while ( $oValuesQuery->have_posts() ) : $oValuesQuery->the_post();
        if ( has_post_thumbnail() ) {
            $iImageId = get_post_thumbnail_id();
            $aValueHeaderImage = wp_get_attachment_image_src( $iImageId, 'full' );
            $sValueHeaderImage = $aValueHeaderImage[0];
        } else {
            $sValueHeaderImage = get_template_directory_uri().'/images/placeholders/pageheader-value.jpg';
        }
    ?>
			<div class="parallaxBox" data-type="parallax" data-speed="10" style="background-image:url('<?php echo esc_url( $sValueHeaderImage ); ?>')">
				<h3><?php the_title() ?></h3>
			</div>
			<div class="wrapper">
				<?php the_content() ?>
			</div>
    <?php $i++;
    endwhile; endif;
    wp_reset_postdata(); ?>
		</div>
    <?php } ?>

    <?php if ( !empty($aPostCustom['uni_instagram_enable'][0]) && $aPostCustom['uni_instagram_enable'][0] == 'on' ) { ?>
		<div class="ourInstagram">
			<?php echo do_shortcode('[instagram-feed showheader=true widthunit=273 heightunit=273 imagepadding=0 showfollow=true showbutton=false]'); ?>
		</div>
    <?php } ?>

	</section>

        <?php endwhile; endif; ?>

<?php get_footer(); ?>

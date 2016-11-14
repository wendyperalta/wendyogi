<?php
/*
*  Template Name: Events Page
*/
get_header();
$aUniAllowedHtmlWoA = uni_asana_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_asana_theme_allowed_html_with_a();
$sDateAndTimeFormat = get_option( 'date_format' ).' '.get_option( 'time_format' );
$sDateFormat = get_option( 'date_format' );
?>

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
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

	<section class="uni-container">

		<div class="pageHeader" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ); ?>);">
            <?php
            if ( !empty($aPostCustom['uni_events_page_header_title_color'][0]) ) {
                $sTitleColor = $aPostCustom['uni_events_page_header_title_color'][0];
            } else if ( ot_get_option( 'uni_events_header_title_color' ) && empty($aPostCustom['uni_events_page_header_title_color'][0]) ) {
                $sTitleColor = ot_get_option( 'uni_events_header_title_color' );
            } else {
                $sTitleColor = '#ffffff';
            }
            if ( !empty($aPostCustom['uni_events_page_header_title'][0]) ) {
                $sHeaderTitle = $aPostCustom['uni_events_page_header_title'][0];
            } else if ( ot_get_option( 'uni_events_header_title' ) && empty($aPostCustom['uni_events_page_header_title'][0]) ) {
                $sHeaderTitle = ot_get_option( 'uni_events_header_title' );
            } else {
                $sHeaderTitle = __('follow our events', 'asana');
            }

            echo '<h1>'.esc_html( $sHeaderTitle ).'</h1>';
            echo '<style>.pageHeader h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
            ?>
		</div>

		<div class="contentWrap">
			<div class="pagePanel clear">

				<div class="pageTitle">
                    <?php the_title() ?>
                    <?php
                    if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'newer' ) {
                        echo '<span class="pageTitle-sort-desc">(' . esc_html__('newer to older', 'asana') . ')</span>';
                    } else if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'older' ) {
                        echo '<span class="pageTitle-sort-desc">(' . esc_html__('older to newer', 'asana') . ')</span>';
                    } else {
                        echo '<span class="pageTitle-sort-desc">(' . esc_html__('by date created', 'asana') . ')</span>';
                    }
                    ?>
                </div>

                <?php
                if ( ( !empty($aPostCustom['events_display_list_cats'][0]) && $aPostCustom['events_display_list_cats'][0] == 'on' ) || empty($aPostCustom['events_display_list_cats'][0]) ) {
                    $aEventTerms = get_terms( 'uni_event_cat' );
                    if ( !empty($aEventTerms) && !is_wp_error($aEventTerms) ) {
                ?>
				<div class="categoryList">
					<span><?php esc_html_e('category', 'asana') ?> <i></i></span>
					<ul>
						<li><a href="<?php if ( ot_get_option( 'uni_events_page' ) ) echo get_permalink( ot_get_option( 'uni_events_page' ) ); ?>"><?php esc_html_e('All', 'asana') ?></a></li>
                    <?php foreach ( $aEventTerms as $oTerm ) { ?>
						<li><a href="<?php echo get_term_link($oTerm) ?>"><?php echo esc_html( $oTerm->name ); ?></a></li>
					<?php } ?>
					</ul>
				</div>
                <?php }
                }
                ?>
                <div class="sortingList">
                    <span><?php esc_html_e('sorting', 'asana') ?> <i></i></span>
                    <ul>
                        <li<?php if ( !isset($_GET['events_sort']) ) echo ' class="current"'; ?>>
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php esc_html_e('By date created', 'asana') ?></a>
                        </li>
                        <li<?php if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'newer' ) echo ' class="current"'; ?>>
                            <a href="<?php echo esc_url( add_query_arg( array( 'events_sort' => 'newer' ), get_the_permalink() ) ) ?>"><?php esc_html_e('Newer first', 'asana') ?></a>
                        </li>
                        <li<?php if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'older' ) echo ' class="current"'; ?>>
                            <a href="<?php echo esc_url( add_query_arg( array( 'events_sort' => 'older' ), get_the_permalink() ) ) ?>"><?php esc_html_e('Older first', 'asana') ?></a>
                        </li>
                    </ul>
                </div>
			</div>
			<div class="eventsWrap">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        if ( !empty($aPostCustom['events_categories'][0]) ) {
            $aChosenCats = maybe_unserialize( $aPostCustom['events_categories'][0] );
            if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'newer' ) {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
	                'tax_query' => array(
		                array(
			                'taxonomy' => 'uni_event_cat',
			                'field'    => 'id',
			                'terms'    => $aChosenCats,
		                ),
	                ),
                    'order' => 'DESC',
                    'orderby' => 'meta_value',
                    'meta_key' => 'uni_event_date_start',
                    'meta_type' => 'DATE',
                    'paged' => $paged
                );
            } else if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'older' ) {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
	                'tax_query' => array(
		                array(
			                'taxonomy' => 'uni_event_cat',
			                'field'    => 'id',
			                'terms'    => $aChosenCats,
		                ),
	                ),
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_key' => 'uni_event_date_start',
                    'meta_type' => 'DATE',
                    'paged' => $paged
                );
            } else {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
	                'tax_query' => array(
		                array(
			                'taxonomy' => 'uni_event_cat',
			                'field'    => 'id',
			                'terms'    => $aChosenCats,
		                ),
	                ),
                    'paged' => $paged
                );
            }
        } else {
            if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'newer' ) {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
                    'order' => 'DESC',
                    'orderby' => 'meta_value',
                    'meta_key' => 'uni_event_date_start',
                    'meta_type' => 'DATE',
                    'paged' => $paged
                );
            } else if ( isset($_GET['events_sort']) && $_GET['events_sort'] == 'older' ) {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_key' => 'uni_event_date_start',
                    'meta_type' => 'DATE',
                    'paged' => $paged
                );
            } else {
                $aEventsArgs = array(
                    'post_type' => 'uni_event',
                    'paged' => $paged
                );
            }
        }

        $oEventsQuery = new wp_query( $aEventsArgs );
        if ( $oEventsQuery->have_posts() ) :
        while ( $oEventsQuery->have_posts() ) : $oEventsQuery->the_post();
            $aCustomData = get_post_custom( $post->ID );
        ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('eventItem clear') ?>>
					<a href="<?php echo the_permalink() ?>" class="eventItemImg">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <?php the_post_thumbnail( 'unithumb-eventpost', array( 'alt' => the_title_attribute('echo=0') ) ); ?>
                        <?php } else { ?>
						    <img src="http://placehold.it/502x342/5FC7AE/FFFFFF" alt="<?php the_title_attribute() ?>" width="502" height="342">
                        <?php } ?>
					</a>
					<div class="eventItemDesc">
						<time class="eventItemTime" datetime="<?php if ( !empty($aCustomData['uni_event_date_start'][0]) ) { $iEventTimestamp = strtotime($aCustomData['uni_event_date_start'][0]); echo date('Y-m-d', $iEventTimestamp); } ?>">
                            <?php if ( !empty($aCustomData['uni_event_date_start'][0]) ) { $iEventDatestamp = strtotime($aCustomData['uni_event_date_start'][0].' '.(( isset($aCustomData['uni_event_time_start'][0]) ) ? $aCustomData['uni_event_time_start'][0] : '') ); echo date_i18n($sDateAndTimeFormat, $iEventDatestamp); } else { esc_html_e('- not specified -', 'asana'); } ?>
                            <?php if ( !empty($aCustomData['uni_event_date_end'][0]) ) { $iEventEndDatestamp = strtotime($aCustomData['uni_event_date_end'][0].' '.(( isset($aCustomData['uni_event_time_end'][0]) ) ? $aCustomData['uni_event_time_end'][0] : '') ); echo ' - ' . date_i18n($sDateAndTimeFormat, $iEventEndDatestamp); } ?>
                        </time>
						<h3><a href="<?php echo the_permalink() ?>"><?php echo the_title() ?></a></h3>
						<?php if ( has_excerpt( $post->ID ) ) { the_excerpt(); } else { uni_asana_theme_excerpt(30, '', true); } ?>
						<a href="<?php echo the_permalink() ?>" class="eventLearnMore"><?php esc_html_e('learn more', 'asana') ?>
							<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="38px" height="38px" viewBox="0 0 38 38" enable-background="new 0 0 38 38" xml:space="preserve">
									<path fill="#6BBFAC" d="M16.558 11.5l6.884 6.494l1.059 0.999v0.015L16.558 26.5L15.5 25.486l6.882-6.494L15.5 12.5L16.558 11.5z"/>
								</svg>
							</i>
						</a>
					</div>
				</div>
        <?php
        endwhile;
        else :
        ?>

            <?php get_template_part( 'no-results', 'archive' ); ?>

        <?php
        endif;
        ?>

		    <div class="pagination clear"<?php if ( ot_get_option('uni_ajax_scroll_enable_events') == 'on' ) { echo ' style="display:none;"'; } ?>>
	    <?php
        $big = 999999999;
		echo paginate_links( array(
			'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'       => '?paged=%#%',
			'add_args'     => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $oEventsQuery->max_num_pages,
			'prev_text'    => '<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="&#1057;&#1083;&#1086;&#1081;_1" x="0px" y="0px" width="7px" height="11px" viewBox="0 0 7 11" enable-background="new 0 0 7 11" xml:space="preserve">
									<path fill="#c3c3c3" class="paginationArrowIcon" d="M0.95 4.636L6.049 0L7 0.864L1.899 5.5L7 10.136L6.049 11L0 5.5L0.95 4.636z"/>
								</svg>
							</i>'.esc_html__('previous', 'asana'),
			'next_text'    => esc_html__('next', 'asana').'<i>
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="&#1057;&#1083;&#1086;&#1081;_1" x="0px" y="0px" width="7px" height="11px" viewBox="0 0 7 11" enable-background="new 0 0 7 11" xml:space="preserve">
									<path fill="#c3c3c3" class="paginationArrowIcon" d="M6.05 6.364L0.951 11L0 10.136L5.102 5.5L0 0.864L0.951 0L7 5.5L6.05 6.364z"/>
								</svg>
							</i>',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) );
	    ?>
		    </div>

			</div>

    <?php if ( ot_get_option('uni_mailchimp_events_enable') == 'on' ) { ?>
    <?php
        $iSubscribeAttachId = ( ot_get_option( 'uni_subscribe_header_bg' ) ) ? ot_get_option( 'uni_subscribe_header_bg' ) : '';
        if ( !empty($iSubscribeAttachId) ) {
            $aPageHeaderImage = wp_get_attachment_image_src( $iSubscribeAttachId, 'full' );
            $sPageHeaderImage = $aPageHeaderImage[0];
        } else {
            $sPageHeaderImage = get_template_directory_uri().'/images/placeholders/pageheader-events.jpg';
        }
    ?>
			<div class="subscribeBox" style="background-image: url(<?php echo esc_url( $sPageHeaderImage ); ?>);">
				<i class="iconEmail"></i>
				<h3><?php echo ( ot_get_option( 'uni_subscribe_header_title' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_title' ) ) : esc_html__('subscribe to our newsletter', 'asana'); ?></h3>
				<p><?php echo ( ot_get_option( 'uni_subscribe_header_subtitle' ) ) ? esc_html( ot_get_option( 'uni_subscribe_header_subtitle' ) ) : esc_html__('Subscribe and take all information about our latest events', 'asana'); ?></p>
		        <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" role="form" method="post" class="clear uni_form">
                    <input type="hidden" name="action" value="uni_asana_theme_mailchimp_subscribe_user" />
					<input type="text" name="uni_input_email" size="20" value="" placeholder="<?php esc_html_e('Your email', 'asana' ); ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
					<input class="subscribeSubmit uni_input_submit" type="button" value="<?php esc_html_e('subscribe', 'asana' ); ?>">
				</form>
			</div>
    <?php } ?>

		</div>

	</section>

    <?php
    endwhile; endif;
    wp_reset_postdata();
    ?>

<?php get_footer(); ?>

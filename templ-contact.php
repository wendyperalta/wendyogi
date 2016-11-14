<?php
/*
*  Template Name: Contact Page
*/
get_header();
$aUniAllowedHtmlWoA = uni_asana_theme_allowed_html_wo_a();
$aUniAllowedHtmlWithA = uni_asana_theme_allowed_html_with_a();
?>

    <?php if (have_posts()) : while (have_posts()) : the_post();
		$aPostCustom = get_post_custom( $post->ID );
    ?>
    <?php
        if ( !empty($aPostCustom['uni_contact_page_header_bg'][0]) ) {
            $iContactAttachId = $aPostCustom['uni_contact_page_header_bg'][0];
        } else if ( ot_get_option( 'uni_contact_header_bg' ) && empty($aPostCustom['uni_contact_page_header_bg'][0]) ) {
            $iContactAttachId = ot_get_option( 'uni_contact_header_bg' );
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
            if ( !empty($aPostCustom['uni_contact_page_header_title_color'][0]) ) {
                $sTitleColor = $aPostCustom['uni_contact_page_header_title_color'][0];
            } else if ( ot_get_option( 'uni_contact_header_title_color' ) && empty($aPostCustom['uni_contact_page_header_title_color'][0]) ) {
                $sTitleColor = ot_get_option( 'uni_contact_header_title_color' );
            } else {
                $sTitleColor = '#ffffff';
            }
            if ( !empty($aPostCustom['uni_contact_page_header_title'][0]) ) {
                $sHeaderTitle = $aPostCustom['uni_contact_page_header_title'][0];
            } else if ( ot_get_option( 'uni_contact_header_title' ) && empty($aPostCustom['uni_contact_page_header_title'][0]) ) {
                $sHeaderTitle = ot_get_option( 'uni_contact_header_title' );
            } else {
                $sHeaderTitle = __('You are welcome', 'asana');
            }

            echo '<h1>'.esc_html( $sHeaderTitle ).'</h1>';
            echo '<style>.pageHeader h1 {color:'.esc_attr( $sTitleColor ).';}</style>';
            ?>
		</div>
		<div class="ourContact">
			<div class="wrapper clear">
				<div class="contactGallery">
                <?php
                if ( !empty($aPostCustom['uni_gallery'][0]) ) {
                $aPageGalleryIds = explode(',', $aPostCustom['uni_gallery'][0]);
                ?>
					<ul>
                    <?php foreach ( $aPageGalleryIds as $iAttachId ) { ?>
						<li><?php echo wp_get_attachment_image( $iAttachId, 'unithumb-contactgallery' ); ?></li>
					<?php } ?>
					</ul>
                <?php
                } else {
                ?>
					<ul>
						<li><img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/gallery.jpg" alt=""></li>
						<li><img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/story.jpg" alt=""></li>
					</ul>
                <?php
                }
                ?>
				</div>
				<div class="contactInfo">
					<h3><?php esc_html_e('Contact', 'asana') ?></h3>
            <?php
                if ( !empty($aPostCustom['uni_contact_phone'][0]) ) {
                    $sUniPhone = $aPostCustom['uni_contact_phone'][0];
                } else if ( ot_get_option( 'uni_phone' ) && empty($aPostCustom['uni_contact_phone'][0]) ) {
                    $sUniPhone = ot_get_option( 'uni_phone' );
                } else {
                    $sUniPhone = '';
                }
            ?>
					<p><i class="contactPhone"></i> <?php echo ( !empty($sUniPhone) ) ? wp_kses( $sUniPhone, $aUniAllowedHtmlWithA ) : '+88 (0) 101 0000 000'; ?></p>
            <?php
                if ( !empty($aPostCustom['uni_contact_email'][0]) ) {
                    $sEmail = sanitize_email( $aPostCustom['uni_contact_email'][0] );
                } else if ( ot_get_option( 'uni_email' ) && empty($aPostCustom['uni_contact_email'][0]) ) {
                    $sEmail = sanitize_email( ot_get_option( 'uni_email' ) );
                } else {
                    $sEmail = esc_attr( get_bloginfo('admin_email') );
                }
            ?>
					<p><i class="contactEmail"></i> <a href="mailto:<?php echo antispambot( $sEmail ); ?>"><?php echo antispambot( $sEmail ); ?></a></p>
            <?php
                if ( !empty($aPostCustom['uni_contact_address'][0]) ) {
                    $sUniAddress = $aPostCustom['uni_contact_address'][0];
                } else if ( ot_get_option( 'uni_address' ) && empty($aPostCustom['uni_contact_address'][0]) ) {
                    $sUniAddress = ot_get_option( 'uni_address' );
                } else {
                    $sUniAddress = '';
                }
            ?>
					<p><i class="contactLocation"></i> <?php echo ( !empty($sUniAddress) ) ? wp_kses( $sUniAddress, $aUniAllowedHtmlWithA ) : '42, Wallaby Way, Sydney, Australlia'; ?></p>
				</div>
			</div>
		</div>

    <?php if ( !empty($aPostCustom['uni_map_enable'][0]) && $aPostCustom['uni_map_enable'][0] == 'on' ) { ?>
		<div class="locationMap">
			<!-- Map -->
			<script type="text/javascript">
                        //Standard
				        var asanaDefaultGoogleMap = [];

                        //Shades of Grey
				        var asanaShadesOfGrey = [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

                        // Cartoon
                        var asanaCartoon = [{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" }]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#b1bc39" } ]},{ "featureType": "landscape.man_made", "stylers": [ { "visibility": "on" }, { "color": "#ebad02" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#416d9f" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#ebad02" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#8ca83c" } ]}];

                        // Grey Scale
                        var asanaGrey = [{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "stylers": [ { "visibility": "on" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "poi.medical", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.medical", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "color": "#cccccc" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#cecece" } ]},{ "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#fdfdfd" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#d2d2d2" } ]}];

                        // Black & White
                        var asanaBlackWhite = [{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill",  "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#cecece" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ]}];

                        // Retro
                        var asanaRetro = [{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, { "color": "#eee8ce" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#b8cec9" } ]},{ "featureType": "road", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#000000" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#d3cdab" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#ced09d" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        // Night
                        var asanaNight = [{ "featureType": "landscape", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "stylers": [ { "visibility": "on" }, {  "hue": "#0008ff" }, { "lightness": -75 }, { "saturation": 10 } ]},{ "elementType": "geometry.stroke", "stylers": [ { "color": "#1f1d45" } ]},{ "featureType": "landscape.natural", "stylers": [ { "color": "#1f1d45" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#01001f" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#e7e8ec" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#151348" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#f7fdd9" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#01001f" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#316694" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#1a153d" } ]}];

                        // Night Light
                        var asanaNightLight = [{"elementType": "geometry", "stylers": [ { "visibility": "on" }, { "hue": "#232a57" } ]},{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "hue": "#0033ff" }, { "saturation": 13 }, { "lightness":-77 } ]},{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "color": "#4657ab" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#d2cfe3" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#ffffff" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#0d0a1f" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#ff9910" } ]},{ "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#4657ab" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "color": "#232a57" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#232a57" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        // Papiro
                        var asanaPapiro = [{"elementType": "geometry", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "road.highway", "stylers": [ { "visibility": "off" } ]},{ "featureType": "transit", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi.park", "elementType": "geometry.fill",  "stylers": [ { "color": "#d3d3d3" }, { "visibility": "on" } ]},{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "off" } ]},{ "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#a77637" } ]},{ "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "administrative", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#f2e48c" } ]},{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#a5630f" } ]},{ "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#592c00" } ]},{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ]},{ "featureType": "water", "elementType": "labels", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "geometry.fill", "stylers": [ { "visibility": "off" } ]},{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ]}];

                        var Asana;
                    <?php if ( !empty($aPostCustom['uni_map_styles'][0]) ) { ?>
                        Asana = <?php echo $aPostCustom['uni_map_styles'][0] ?>;
                    <?php } else { ?>
                        Asana = asanaGrey;
                    <?php } ?>

			      function initialize() {

			        // Declare new style
			        var AsanastyledMap = new google.maps.StyledMapType(Asana, {name: "Asana"});
            <?php
                if ( !empty($aPostCustom['uni_contact_coordinates'][0]) ) {
                    $sCoord = $aPostCustom['uni_contact_coordinates'][0];
                } else if ( ot_get_option( 'uni_coordinates' ) && empty($aPostCustom['uni_contact_coordinates'][0]) ) {
                    $sCoord = ot_get_option( 'uni_coordinates' );
                } else {
                    $sCoord = '41.404182,2.199451';
                }
                if ( !empty($aPostCustom['uni_contact_zoom'][0]) ) {
                    $sZoom = $aPostCustom['uni_contact_zoom'][0];
                } else if ( ot_get_option( 'uni_zoom' ) && empty($aPostCustom['uni_contact_zoom'][0]) ) {
                    $sZoom = ot_get_option( 'uni_zoom' );
                } else {
                    $sZoom = '14';
                }
            ?>
			        // Declare Map options
			        var mapOptions = {
			        	center: new google.maps.LatLng(<?php echo esc_attr( $sCoord ); ?>),
	        			zoom: <?php echo esc_attr( $sZoom ); ?>,
			        	scrollwheel: false,
			        	mapTypeControl:false,
		                streetViewControl: false,
		                panControl:false,
		                rotateControl:false,
		                zoomControl:true
			        };

			        // Create map
			        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

			        // Setup skin for the map
			        map.mapTypes.set('Asana_style', AsanastyledMap);
			        map.setMapTypeId('Asana_style');

		            //add marker
                    var marker_icon = {
					    path: 'M19-5C6.866-5-3,4.966-3,17.214c0,2.233,0.332,4.388,0.941,6.419 c2.523,12.103,17.896,30.404,20.013,32.887C18.217,56.827,18.602,57,19,57c0.049,0,0.096,0,0.145-0.007 c0.372-0.04,0.708-0.227,0.935-0.517l0.083-0.104c4.704-5.628,17.608-21.826,19.901-32.761C40.677,21.588,41,19.439,41,17.214 C41,4.966,31.126-5,19-5 M19,26.169c-4.928,0-8.938-4.016-8.938-8.956c0-1.666,0.461-3.236,1.264-4.58 c0.799-1.351,1.947-2.473,3.322-3.237C15.934,8.673,17.425,8.261,19,8.261c1.589,0,3.087,0.419,4.381,1.156 c1.365,0.764,2.508,1.887,3.304,3.237c0.799,1.336,1.255,2.9,1.255,4.559C27.939,22.154,23.929,26.169,19,26.169',
					    fillColor: '<?php echo ( !empty($aPostCustom['uni_marker_colour'][0]) ) ? $aPostCustom['uni_marker_colour'][0] : '#000000'; ?>',
					    fillOpacity: 1,
					    scale: 1,
					    anchor: new google.maps.Point(19,57),
					    strokeWeight: 0
					};

		            var myLatLng = new google.maps.LatLng(<?php echo esc_attr( $sCoord ) ?>);
		            var beachMarker = new google.maps.Marker({
		                position: myLatLng,
		                map: map,
		                icon: marker_icon
		            });

			      }
			      google.maps.event.addDomListener(window, 'load', initialize);
			    </script>

				<div class="location-map">
					<div class="map" id="map-canvas"></div>
				</div>
		</div>
    <?php } ?>

    <?php if ( !empty($aPostCustom['uni_form_enable'][0]) && $aPostCustom['uni_form_enable'][0] == 'on' ) { ?>

            <?php
                if ( !empty($aPostCustom['uni_contact_form_title'][0]) ) {
                    $sContactFormTitle = $aPostCustom['uni_contact_form_title'][0];
                } else {
                    $sContactFormTitle = esc_html__('Say Hello', 'asana');
                }
                if ( !empty($aPostCustom['uni_contact_form_subtitle'][0]) ) {
                    $sContactFormSubTitle = $aPostCustom['uni_contact_form_subtitle'][0];
                } else {
                    $sContactFormSubTitle = esc_html__('We love to meet people and talk about possibilities', 'asana');
                }
            ?>

		<?php if( in_array('contact-form-7/wp-contact-form-7.php', get_option('active_plugins')) && ( ot_get_option( 'uni_contact_form_seven_id' ) || !empty($aPostCustom['uni_contact_page_form_seven_id'][0]) ) ) { ?>
			<div class="contactForm">
				<h3><?php echo wp_kses( $sContactFormTitle, $aUniAllowedHtmlWithA ); ?></h3>
				<p class="contactFormDesc"><?php echo wp_kses( $sContactFormSubTitle, $aUniAllowedHtmlWithA ); ?></p>
            <?php
                if ( !empty($aPostCustom['uni_contact_page_form_seven_id'][0]) ) {
                    $sCf7Id = esc_attr( $aPostCustom['uni_contact_page_form_seven_id'][0] );
                } else if ( ot_get_option( 'uni_contact_form_seven_id' ) && empty($aPostCustom['uni_contact_page_form_seven_id'][0]) ) {
                    $sCf7Id = esc_attr( ot_get_option( 'uni_contact_form_seven_id' ) );
                }
            ?>
                <?php echo do_shortcode('[contact-form-7 id="'.$sCf7Id.'"]'); ?>
			</div>
            <?php } else { ?>
			<div class="contactForm">
				<h3><?php echo wp_kses( $sContactFormTitle, $aUniAllowedHtmlWithA ); ?></h3>
				<p class="contactFormDesc"><?php echo wp_kses( $sContactFormSubTitle, $aUniAllowedHtmlWithA ); ?></p>
		        <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" method="post" class="clear uni_form">
                    <input type="hidden" name="uni_contact_nonce" value="<?php echo wp_create_nonce('uni_nonce') ?>" />
                    <input type="hidden" name="page_id" value="<?php echo get_the_ID() ?>" />
                    <input type="hidden" name="action" value="uni_asana_theme_contact_form" />

                    <div class="form-row form-row-first">
                    	<input class="formInput userName" type="text" name="uni_contact_name" value="" placeholder="<?php esc_html_e('Name', 'asana') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
                    </div>
                    <div class="form-row form-row-last">
						<input class="formInput userEmail" type="text" name="uni_contact_email" value="" placeholder="<?php esc_html_e('E-mail', 'asana') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit" data-parsley-type="email">
					</div>
					<div class="clear"></div>
					<div class="form-row">
						<input class="formInput userSubject" type="text" name="uni_contact_subject" value="" placeholder="<?php esc_html_e('Subject', 'asana') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit">
					</div>
					<div class="form-row">
						<textarea class="formTextarea" name="uni_contact_msg" id="" cols="30" rows="10" placeholder="<?php esc_html_e('Message', 'asana') ?>" data-parsley-required="true" data-parsley-trigger="change focusout submit"></textarea>
					</div>
					<input id="uniSendContactForm" class="submitContactFormBtn uni_input_submit" type="button" value="<?php esc_html_e('Send', 'asana') ?>">
				</form>
			</div>
            <?php } ?>

    <?php } ?>

	</section>

    <?php
    endwhile; endif;
    ?>

<?php get_footer(); ?>

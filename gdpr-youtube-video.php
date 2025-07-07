<?php

add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {

    //wp_dequeue_style( 'et-font' );
    //wp_deregister_style( 'et-font' );

}

/************************************
 * @return void
 * add js to work for GDPR VIDEO
 */
function wb_mm_gdpr_enqueue_script_styles()
{
    wp_register_style('custom-gdpr-style', get_stylesheet_directory_uri() . '/modules/gdpr-youtube-video/css/gdpr-adaptive.css', array
    (), '1.0.0', 'all' );

    wp_register_script( 'custom-player-api', get_stylesheet_directory_uri() . '/modules/gdpr-youtube-video/js/player_api.js',
        array ( 'jquery' ), 1.1, true);
    wp_register_script( 'custom-grpd-custom', get_stylesheet_directory_uri() . '/modules/gdpr-youtube-video/js/gdpr-custom.js',
        array ( 'jquery' ), 1.1, true);


}
add_action('wp_enqueue_scripts', 'wb_mm_gdpr_enqueue_script_styles', 101);




/***********************************
 * local Video GDPR
 ***********************************/
function wb_mm_gdpr_youtube_video($attr, $content = null) {

    extract(shortcode_atts(array(
        'video_id' 	=> '123456',
        'link'      => '/datenschutz/',
        'img_link'  => '/wp-content/themes/betheme-child/img/img_placeholder.jpg',
    ), $attr));

    wp_enqueue_style( 'custom-gdpr-style' );
    wp_enqueue_script( 'custom-player-api' );
    wp_enqueue_script( 'custom-grpd-custom' );

    $returnHtml = '<div class="gdpr-youtube-video-container">';


    $getDe_html = '';
    $getEn_html = '';

    if(ICL_LANGUAGE_CODE == "de"){
        $getDe_html .='<div id="video-'.$video_id.'">
    				
    					<div class="video__holder__container">
					    	<div class="video__item video_item_full_width clearfix" style="background-image: url('
            .$img_link.')">
						        <div class="videoTextOverlayContainer '.ICL_LANGUAGE_CODE.'">
						            <p><strong>'.__('Empfohlener redaktioneller Inhalt', 'betheme').'</strong></p>
						                <p>
						                '.__('Wenn Sie auf „YouTube aktivieren“ klicken, wird der Inhalt von YouTube geladen und Ihre Daten werden an YouTube übermittelt. Der Dienstanbieter befindet sich in den USA. In den USA gibt es kein angemessenes Datenschutzniveau. Wenn Sie keine Datenübermittlung wünschen, klicken Sie bitte nicht auf die Schaltfläche. Weitere Informationen finden Sie in unserem.', 'betheme').'
						                <br><a href="'.$link.'" id="t1" target="_blank">'.__('Datenschutzinformationen', 'betheme').'</a>.</p>
						                <p><a href="#" id="javaImg" data-videoid="'.$video_id.'" class="get_click_video onlyLinkOverlay">'.__('YouTube aktivieren', 'betheme').'</a></p>
								</div>  
							    <div id="playerContainer-'.$video_id.'">
							        <div id="player-'.$video_id.'" width="300" align="left" height="238" style="margin-right:30px;"></div>
							    </div>
					    	</div>
					    </div>
    
                    </div>';
        $returnHtml .= $getDe_html;
    }else{
        $getEn_html .= '<div id="video-'.$video_id.'">
    				
    					<div class="video__holder__container">
					    	<div class="video__item video_item_full_width clearfix" style="background-image: url('
            .$img_link.')">
						        <div class="videoTextOverlayContainer '.ICL_LANGUAGE_CODE.'">
						            <p><strong>'.__('Recommended editorial content', 'betheme').'</strong></p>
						                <p>
						                '.__('“Activate YouTube”, the content will be loaded from YouTube and your data will be transmitted to YouTube. The service provider is located in the USA. There is no adequate level of data protection in the USA. If you do not wish any data to be transferred, please do not click the button. You can find further information in our.  Data protection information.', 'betheme').'
						                <br><a href="'.$link.'" id="t1" target="_blank">'.__('Data protection information', 'betheme').'</a>.</p>
						                <p><a href="#" id="javaImg" data-videoid="'.$video_id.'" class="get_click_video onlyLinkOverlay">'.__('YouTube aktivieren', 'betheme').'</a></p>
								</div>  
							    <div id="playerContainer-'.$video_id.'">
							        <div id="player-'.$video_id.'" width="300" align="left" height="238" style="margin-right:30px;"></div>
							    </div>
					    	</div>
					    </div>
    
                    </div>';
        $returnHtml .= $getEn_html;
    }



    $returnHtml .= '</div>';
    return $returnHtml;

}
add_shortcode('gdpr-youtube-video', 'wb_mm_gdpr_youtube_video');
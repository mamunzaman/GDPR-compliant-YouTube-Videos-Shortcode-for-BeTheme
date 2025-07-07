jQuery(document).ready(function(){
    var player;
    // this is when click a video after cookie consent and play the respective video
    jQuery('.get_click_video').on('click', function(ev) {

        var get_video_id = jQuery(this).data('videoid'); 
        jQuery('#video-'+ get_video_id ).find('.videoTextOverlayContainer').hide();
        if(jQuery("#player-"+get_video_id).is("div"))
        {
            jQuery(this).hide();
            player = new YT.Player('player-'+get_video_id, {
                height: '335',
                width: '596',
                playerVars: { 'controls': 1,'autohide':1},
                videoId: get_video_id,
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });

        }
        else {
            player.autohide=1;
            player.playVideo();
        }
        // when video ends
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        function onPlayerStateChange(event) {
            if(event.data === 0) {
                jQuery("#player-"+get_video_id).remove();
                jQuery("#playerContainer-"+get_video_id).append('<div id ="player-'+get_video_id+'" width="300" align="left" height="238" style="margin-right:30px;"></div>');
                jQuery(".get_click_video").show();
            }
        }

        return false;
    });

});

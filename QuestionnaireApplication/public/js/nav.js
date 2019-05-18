jQuery(document).ready(function() {
    jQuery('.layer-three').toggle();
    
    jQuery('.more-icon').click(function(event) {
        jQuery('.layer-three').toggle();
    });
});
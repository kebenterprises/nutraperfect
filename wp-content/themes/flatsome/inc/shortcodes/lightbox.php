<?php
// [lightbox]
function uxLightboxShortcode($atts, $content=null) {
    $sliderrandomid = rand();
    ob_start();
    extract( shortcode_atts( array(
        'id' => 'enter-id-here',
        'width' => '600px',
        'padding' => '20px',
    ), $atts ) );
    ?> 

<div id="<?php echo $id; ?>" class="mfp-hide my-mfp-zoom-in lightbox-white" style="max-width:<?php echo $width ?>;padding:<?php echo $padding; ?>">
    <?php echo do_shortcode($content); ?>
</div><!-- Lightbox-<?php echo $id; ?> -->

<script>
jQuery(document).ready(function($) {
   $('a[href="#<?php echo $id; ?>"]').addClass('open-popup-link-<?php echo $id; ?>');
    $('.open-popup-link-<?php echo $id; ?>').magnificPopup({
       type:'inline',
       midClick: true,
       mainClass: 'my-mfp-zoom-in product-zoom-lightbox',
       removalDelay: 300,

    });
});
</script>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode("lightbox", "uxLightboxShortcode");
?>

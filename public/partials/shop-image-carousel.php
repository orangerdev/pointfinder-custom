<div class="owl-carousel owl-theme shop-item-images">
<?php
    foreach((array) $images as $i => $_image_id) :
        $image_src = wp_get_attachment_image_src($_image_id);
?>
    <div class="item">
        <img src='<?php echo $image_src[0]; ?>' data-src="<?php echo $image_src[0]; ?>" alt="" />
    </div>
<?php endforeach; ?>
</div>

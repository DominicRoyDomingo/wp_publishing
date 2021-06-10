<?php
require '_data.php';
?>

<?php if ($geolocalization_meta['images'] != null) { ?>
    <div class="geolocalized__content-image">
        <div class="content_image">
            <img src="<?php echo $geolocalization_meta['images'][0]; ?>" alt="IMAGE">
        </div>
    </div>
<?php } ?>
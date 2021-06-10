<?php
require '_data.php';
?>

<?php
$i = 1;
$data = array();
foreach ($geolocalization_meta['providers'] as $provider) {
    $data[] = $provider;
    if ($i++ == 3) break;
}
$geolocalization_meta['providers'] = $data;
?>
<div class="scroll_tothis">
    <div id="providers">
        <?php foreach ($geolocalization_meta['providers'] as $provider) : ?>
            <div class="geolocalized--providers">
                <div class="providers_name">
                    <?php echo $provider['name']; ?>
                </div>
                <div class="geolocalized__info">

                    <?php if ($provider['address'] != null) { ?>
                        <div class="single-line-provider">
                            <span id="farmacia__header--loc-icon" class="fas fa-map-marker-alt" style="font-size:20px"></span>
                            <span> <?php echo $provider['address']; ?> </span>
                        </div>
                    <?php } ?>

                    <?php if ($provider['contact_no'][0] != null) { ?>
                        <div class="single-line-provider">
                            <span id="geolocalized__header--phone-icon" class="fas fa-phone-square-alt" style="font-size:20px"></span>
                            <span> <?php echo $provider['contact_no'][0]; ?></span>
                        </div>
                    <?php } ?>

                    <div class="geolocalized__external-link">

                        <?php if ($provider['url'] != null) { ?>
                            <div class="single-line-provider">
                                <span id="geolocalized__header--enter-icon" class="fas fa-external-link-alt" style="font-size:18px"></span>
                                <span> <a href="<?php echo $provider['url'] ?>" style="text-decoration:none; color:#4054b2;">Vai alla scheda della Farmacia</a></span>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<div id="providers_all" style="display:none">
    <?php foreach ($geolocalization_meta_all['providers'] as $provider_all) { ?>
        <div class="geolocalized--providers">
            <div class="providers_name">
                <?php echo $provider_all['name']; ?>
            </div>
            <div class="geolocalized__info">

                <?php if ($provider_all['address'] != null) { ?>
                    <div class="single-line-provider">
                        <span id="farmacia__header--loc-icon" class="fas fa-map-marker-alt" style="font-size:20px"></span>
                        <span> <?php echo $provider_all['address']; ?> </span>
                    </div>
                <?php } ?>

                <?php if ($provider_all['contact_no'][0] != null) { ?>
                    <div class="single-line-provider">
                        <span id="geolocalized__header--phone-icon" class="fas fa-phone-square-alt" style="font-size:20px"></span>
                        <span> <?php echo $provider_all['contact_no'][0]; ?></span>
                    </div>
                <?php } ?>
                <div class="geolocalized__external-link">

                    <?php if ($provider_all['url'] != null) { ?>
                        <div class="single-line-provider">
                            <span id="geolocalized__header--enter-icon" class="fas fa-external-link-alt" style="font-size:18px"></span>
                            <span> <a href="<?php echo $provider_all['url'] ?>" style="text-decoration:none; color:#4054b2;">Vai alla scheda della Farmacia</a></span>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    <?php } ?>
</div>
<?php $provider_count = count($geolocalization_meta_all['providers']); ?>

<div class="show-more">
    <button type="submit" id="button2" onclick="showMore();SwitchButtons('button2');" class="more--buttons" value="more1">Show More ▼</button>
    <button type="submit" id="button1" onclick="showMore();SwitchButtons('button1');" class="more--buttons" style='display:none;' value="more2">Show Less ▲</button>
</div>
<script type="text/javascript">
$("#button1").click(function() {
    $('html, body').animate({
        scrollTop: $(".scroll_tothis").offset().top
    }, 100);
});
</script>
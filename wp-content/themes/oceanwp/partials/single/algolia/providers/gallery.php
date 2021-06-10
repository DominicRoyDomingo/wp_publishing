<?php
require '_data.php';
?>

<article class="box gallery">
    <div class="gallery__container">
        <?php
        $row_counter = 0;
        $item_counter = 0;

        foreach ($provider_meta['images'] as $images) {
            if ($row_counter == 0) { ?>
                <div class="gallery__container-row box__container">
                <?php
            }
                ?>
                <div class="box__container--3">
                    <a href="<?php c_echo($images); ?>" data-lightbox="provider-gallery">
                        <img src="<?php c_echo($images); ?>" class="gallery__thumbnail" />
                    </a>
                </div>
                <?php
                $item_counter++;

                if ($row_counter == 4 || $item_counter >= count($provider_meta['images'])) {
                    $row_counter = 0;
                ?>
                </div>
        <?php
                } else {
                    $row_counter++;
                }
            } ?>
</article>
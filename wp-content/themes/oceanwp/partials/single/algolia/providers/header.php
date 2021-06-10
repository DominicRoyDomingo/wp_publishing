<?php
require '_data.php';
?>

<article class="box">
    <section class="box__title--header">
        <h1>
            <?php c_echo($provider_meta['name']); ?>
        </h1>
    </section>
    <section class="box__container--header">
        <ul class="box__container--contacts">
            <?php
            if (
                $provider_meta['address']
                || $provider_meta['city']['name']
                || $provider_meta['division']['name']
                || $provider_meta['country']['name']
            ) {
            ?>
                <li class="box__container--location">
                    <i class="fas fa-map-marker-alt fw fa-lg"></i>
                    <?php
                    c_echo($provider_location);
                    ?>
                </li>
            <?php
            }
            ?>
            <?php if (isset($provider_meta['contact_no']) && sizeof($provider_meta['contact_no']) > 0) {
            ?>
                <li class="box__container--contact">
                    <i class="fas fa-phone-square-alt fw fa-lg"></i>
                    <?php
                    $contact_index = 0;

                    foreach ($provider_meta['contact_no'] as $contact_no) {
                        if (!$is_free) {
                    ?>
                            <a class="box__container--contact-item" target="_new" href="tel:<?php c_echo($contact_no); ?>">
                                <?php c_echo($contact_no); ?>
                            </a>
                        <?php
                        } else {
                        ?>
                            <span class="box__container--contact-item">
                                <?php c_echo($contact_no); ?>
                            </span>
                        <?php
                        }
                        ++$contact_index;

                        if ($contact_index == count($provider_meta['contact_no']) - 1) {
                        ?>
                            <span class="box__container--contact-divider">|</span>
                    <?php
                        }
                    }
                    ?>
                </li>
            <?php
            } ?>
            <?php
            if ((!$is_free && $provider_meta['website']) || $is_free) {
            ?>
                <li class="box__container--site">
                    <i class="fas fa-external-link-square-alt fw fa-lg"></i>
                    <?php
                    if (!$is_free) {
                    ?>
                        <a target="_new" href="<?php c_echo($provider_meta['website']); ?>">
                            Sito Web
                        </a>
                    <?php
                    } else {
                        echo "Sito Web";
                    } ?>
                    </a>
                </li>
            <?php
            }
            ?>
            <?php
            if ((!$is_free && $provider_meta['facebook_url']) || $is_free) {
            ?>
                <li class="box__container--facebook">
                    <i class="fab fa-facebook-square fw fa-lg"></i>
                    <?php
                    if (!$is_free) {
                    ?>
                        <a target="_new" href="<?php c_echo($provider_meta['facebook_url']); ?>">
                            Pagina Facebook
                        </a>
                    <?php
                    } else {
                        echo "Pagina Facebook";
                    } ?>
                </li>
            <?php
            }
            ?>
            <?php
            if ((!$is_free && $provider_meta['linkedin']) || $is_free) {
            ?>
                <li class="box__container--linkedin">
                    <i class="fab fa-linkedin fw fa-lg"></i>
                    <?php
                    if (!$is_free) {
                    ?>
                        <a target="_new" href="<?php c_echo($provider_meta['linkedin']); ?>">
                            Pagina LinkedIn
                        </a>
                    <?php
                    } else {
                        echo "Pagina LinkedIn";
                    } ?>
                </li>
            <?php
            }
            ?>
        </ul>
    </section>
</article>
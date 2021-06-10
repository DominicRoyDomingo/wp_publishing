<?php
require '_data.php';
?>

<article class="box">
    <?php
    foreach ($provider_meta['all_services'] as $all_services) {
    ?>
        <h4 class="box__title box__title--accordion">
            <?php
            if ($all_services['type_of_provider'] == "Farmacia")
                echo "I Servizi della ";
            else
                echo "I Servizi del ";
            c_echo($all_services['type_of_provider']); ?>
        </h4>
        <section class="box__container">
            <?php
            foreach ($all_services['provider_services'] as $provider_services) {
            ?>
                <div class="box__container--6 box__container--accordion">
                    <div class="box__container--accordion-title-container">
                        <img src="<?php c_echo($provider_services['category_icons']); ?>" class="box__container--accordion-title-image" draggable="false" />
                        <h6 class="box__container--accordion-title">
                            <?php
                            c_echo($provider_services['category_of_service']);
                            ?>
                        </h6>
                        <i class="fas fa-chevron-down fa-xs box__container--accordion-icon"></i>
                    </div>
                    <div class="box__container--accordion-content">
                        <ul>
                            <?php
                            foreach ($provider_services['services'] as $services) {
                                c_echo("<li>" . $services['name'] . "</li>");
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    <?php
    }
    ?>
</article>
<?php
require '_data.php';
?>

<article class="box">
    <h4 class="box__title box__title--sub">
        Altre Informazioni
    </h4>
    <section class="box__container--header">
        <ul class="box__container--other">
            <?php
            foreach ($provider_meta['other_info'] as $other_info) {
            ?>
                <li class="box__container--other-item">
                    <span class="box__container--other-title"><?php c_echo($other_info['type_of_info']); ?></span>:
                    <?php c_echo($other_info['value']) ?>
                </li>
            <?php
            }
            ?>
        </ul>
    </section>
</article>
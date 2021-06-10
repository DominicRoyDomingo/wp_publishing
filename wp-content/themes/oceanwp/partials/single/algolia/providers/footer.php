<?php
require('_data.php');
?>

<article class="box">
    <section class="box__container--footer">
        <?php if ($is_free) { ?>
            <div class="box__container--footer-content">
                <?php
                $providers_array = [];
                $acceptable_providers = ["Farmacia", "Poliambulatorio"];

                foreach ($provider_meta['all_services'] as $all_services) {
                    if (in_array($all_services['type_of_provider'], $acceptable_providers))
                        array_push($providers_array, $all_services['type_of_provider']);
                }

                if (count($providers_array) == 1) {
                    if ($providers_array[0] == "Farmacia") {
                        echo "Sei il titolare di questa Farmacia e vuoi aiutarci a migliorare le informazioni qui pubblicate?";
                    } else if ($providers_array[0] == "Poliambulatorio") {
                        echo $default_message;
                    }
                } else {
                    echo $default_message;
                }
                ?>
            </div>
            <div class="box__container--footer-content">
                <a target="_new" href="/form-provider">Clicca qui</a>
            </div>
        <?php } else { ?>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0nuljxJEL_GzG3VygvztLsydX3p0BIRY&callback=initMap&libraries=places&v=weekly&language=it&region=IT" async></script>
            <script>
                let marker;
                let map;
                let service;
                let infowindow;

                function initMap() {
                    const venice = new google.maps.LatLng(45.4378743, 12.3195901);
                    map = new google.maps.Map(document.getElementById("box__container--footer-map"), {
                        zoom: 18,
                        center: venice,
                    });
                    const request = {
                        query: document.getElementById("footer_map__location").value,
                        fields: ["name", "geometry"],
                    };
                    service = new google.maps.places.PlacesService(map);
                    service.findPlaceFromQuery(request, (results, status) => {
                        if (status === google.maps.places.PlacesServiceStatus.OK && results) {
                            for (let i = 0; i < results.length; i++) {
                                createMarker(results[i]);
                            }
                            map.setCenter(results[0].geometry.location);
                        }
                    });
                }

                function createMarker(place) {
                    if (!place.geometry || !place.geometry.location) return;
                    const marker = new google.maps.Marker({
                        map,
                        position: place.geometry.location,
                        animation: google.maps.Animation.DROP,
                    });
                    google.maps.event.addListener(marker, "load", function() {
                        infowindow.setContent(
                            "<div><strong>" +
                            place.formatted_address +
                            "</strong></div>"
                        );
                        infowindow.open(map, this);
                    });
                }
            </script>
            <input type="hidden" value="<?php c_echo($provider_location) ?>" id="footer_map__location">
            <div id="box__container--footer-map">
            </div>
        <?php } ?>
    </section>
</article>
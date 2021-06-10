<?php

include get_template_directory() . '/partials/single/algolia/utils/_data.php';

// data
$geolocalization_meta = json_decode($arr_content, true);
$geolocalization_meta_all =
    json_decode($arr_content, true);

// template slug
$geolocalization_slug = $algolia_slug_prefix . 'geolocalizations/';

// subscription
$is_free = $geolocalization_meta['account_status'] == 'free';

if (!$is_free) {
    $container_class = "upgraded-geolocalization";
}

// subscription - free message
$default_message = "Vorresti inserire il tuo studio o la tua struttura in questo elenco?";
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<script type="text/javascript">
function SwitchButtons(buttonId) {
  var hideBtn, showBtn, menuToggle;
  if (buttonId == "button1") {
    menuToggle = "menu2";
    showBtn = "button2";
    hideBtn = "button1";
  } else {
    menuToggle = "menu3";
    showBtn = "button1";
    hideBtn = "button2";
  }

  document.getElementById(hideBtn).style.display = "none"; //step 2 :additional feature hide button
  document.getElementById(showBtn).style.display = ""; //step 3:additional feature show button
}

function showMore() {
  var x = document.getElementById("providers");
  var y = document.getElementById("providers_all");
  y.style.display = "none";
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    y.style.display = "block";
    x.style.display = "none";
  }
}
</script>
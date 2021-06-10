jQuery(document).ready(function ($) {
  $("#new--button").on("click", function () {
    $.post("admin-ajax.php", {
      action: "admin_post_add_new_post",
    });
  });

  $("#reindex--button").on("click", function () {
    $.post("admin-ajax.php", {
      action: "admin_post_reindex_post",
    });
  });
});

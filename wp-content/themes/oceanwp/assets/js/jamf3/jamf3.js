jQuery(document).ready(function ($) {
  // accordion title expand/collapse all
  $(".box__title--accordion").on("click", function () {
    var items = $(this).next();
    var itemContent = items.children().children();
    var itemContentIcon = itemContent.children(
      ".box__container--accordion-icon"
    );

    if ($(this).hasClass("hide")) {
      $(this).removeClass("hide");
      itemContent.removeClass("active");
      itemContentIcon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
    } else {
      $(this).addClass("hide");
      itemContent.addClass("active");
      itemContentIcon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }
  });

  // accordion title roll down/up
  $(".box__container--accordion-title").on("click", function () {
    var title = $(this).parent().parent();
    var titleContent = title.children();
    var titleContentIcon = titleContent.children(
      ".box__container--accordion-icon"
    );

    if (titleContent.hasClass("active")) {
      titleContent.removeClass("active");
      titleContentIcon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
    } else {
      titleContent.addClass("active");
      titleContentIcon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
    }
  });

  // tabs controls
  $(".box__container--tab-button").on("click", function () {
    var target = $(this).attr("data-tab");
    var container = $(this).parent().parent();
    var tabsContents = container.children();

    tabsContents.children().removeClass("active");

    $(this).addClass("active");

    tabsContents.children(".box__container--tab-content").each(function () {
      if ($(this).attr("data-tab-content") == target) {
        $(this).addClass("active");
      }
    });
  });

  // replace missing image
  $(".box__container--accordion-title-image").each(function () {
    var img = $(this);

    img
      .error(function () {
        img.replaceWith(
          "<div class='box__container--accordion-title-image-fix'><span>NO IMG</span></div>"
        );
      })
      .attr("src", img.attr("src"));
  });

  $(".course__sidebar--icon").each(function () {
    var img = $(this);

    img
      .error(function () {
        img.replaceWith("<span class='course__sidebar-fix'>NO IMG</span>");
      })
      .attr("src", img.attr("src"));
  });
});

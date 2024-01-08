"use strict";

(function () {
  if (
    document.getElementsByClassName("superb-pixels-colcade-column").length <=
      0 ||
    document.getElementsByClassName("all-blog-articles").length <= 0 ||
    document.getElementsByClassName("blogposts-list").length <= 0
  ) {
    return;
  }

  var superb_pixels_colcade = new Colcade(
    ".add-blog-to-sidebar .all-blog-articles",
    {
      columns: ".superb-pixels-colcade-column",
      items: ".posts-entry.blogposts-list",
    }
  );
})();

(function (api) {
  // Extends our custom "superb-pixels" section.
  api.sectionConstructor["superb-pixels"] = api.Section.extend({
    // No events for this type of section.
    attachEvents: function () {},

    // Always make the section active.
    isContextuallyActive: function () {
      return true;
    },
  });

  // Extends our custom "superb-pixels" section.
  api.controlConstructor["superb_pixels_control"] = api.Control.extend({
    // No events for this type of section.
    attachEvents: function () {},

    // Always make the section active.
    isContextuallyActive: function () {
      return true;
    },
  });
})(wp.customize);

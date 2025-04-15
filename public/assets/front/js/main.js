/*-----------------------------------------------------------------------------------

    Theme Name: eLearn - Online Education Learning Template
    Description: Online Education Learning Template
    Author: Chitrakoot Web
    Version: 1.0
    
    ---------------------------------- */

!(function (t) {
  "use strict";
  var s = t(window);
  function a() {
    var e, a;
    (e = t(".full-screen")),
      (a = s.height()),
      e.css("min-height", a),
      (e = t("header").height()),
      (a = t(".screen-height")),
      (e = s.height() - e),
      a.css("height", e);
  }
  t("#preloader").fadeOut("normall", function () {
    t(this).remove();
  }),
    s.on("scroll", function () {
      var e = s.scrollTop(),
        a = t(".navbar-brand img"),
        o = t(".navbar-brand.logodefault img");
      e <= 50
        ? (t("header").removeClass("scrollHeader").addClass("fixedHeader"),
          a.attr("src", "/assets/admin/img/logo.png"))
        : (t("header").removeClass("fixedHeader").addClass("scrollHeader"),
          a.attr("src", "/assets/admin/img/logo.png")),
        o.attr("src", "/assets/admin/img/logo.png");
    }),
    s.on("scroll", function () {
      500 < t(this).scrollTop()
        ? t(".scroll-to-top").fadeIn(400)
        : t(".scroll-to-top").fadeOut(400);
    }),
    t(".scroll-to-top").on("click", function (e) {
      e.preventDefault(), t("html, body").animate({ scrollTop: 0 }, 600);
    }),
    t(".parallax,.bg-img").each(function (e) {
      t(this).attr("data-background") &&
        t(this).css(
          "background-image",
          "url(" + t(this).data("background") + ")"
        );
    }),
    t(".story-video").magnificPopup({ delegate: ".video", type: "iframe" }),
    s.resize(function (e) {
      setTimeout(function () {
        a();
      }, 500),
        e.preventDefault();
    }),
    a(),
    t(document).ready(function () {
      t(".testimonial-carousel").owlCarousel({
        loop: !0,
        responsiveClass: !0,
        autoplay: !1,
        smartSpeed: 1500,
        nav: !1,
        dots: !0,
        center: !1,
        margin: 30,
        items: 1,
      }),
        t(".client-carousel").owlCarousel({
          loop: !0,
          responsiveClass: !0,
          autoplay: !0,
          smartSpeed: 1500,
          nav: !1,
          dots: !1,
          center: !1,
          margin: 0,
          responsive: {
            0: { items: 2 },
            480: { items: 3 },
            767: { items: 3 },
            768: { items: 4 },
            992: { items: 5 },
          },
        }),
        t(".related-courses-carousel").owlCarousel({
          loop: !0,
          responsiveClass: !0,
          autoplay: !0,
          smartSpeed: 1500,
          nav: !1,
          dots: !0,
          center: !1,
          margin: 30,
          responsive: {
            0: { items: 1 },
            768: { items: 2 },
            992: { items: 2 },
            1200: { items: 2 },
          },
        }),
        t(".aboutme-carousel").owlCarousel({
          loop: !0,
          responsiveClass: !0,
          autoplay: !0,
          smartSpeed: 1500,
          nav: !1,
          dots: !1,
          center: !1,
          margin: 0,
          responsive: { 0: { items: 1 }, 768: { items: 1 }, 992: { items: 1 } },
        }),
        t(".slider-fade1").owlCarousel({
          items: 1,
          loop: !0,
          dots: !0,
          margin: 0,
          nav: !1,
          navText: [
            "<i class='ti-angle-left'></i>",
            "<i class='ti-angle-right'></i>",
          ],
          autoplay: !0,
          smartSpeed: 1500,
          mouseDrag: !1,
          animateIn: "fadeIn",
          animateOut: "fadeOut",
          responsive: { 992: { nav: !0, dots: !1 } },
        }),
        t(".owl-carousel").owlCarousel({
          items: 1,
          loop: !0,
          dots: !1,
          margin: 0,
          autoplay: !0,
          smartSpeed: 500,
        }),
        t(".slider-fade1").on("changed.owl.carousel", function (e) {
          e = e.item.index - 2;
          t(".h5").removeClass("animated fadeInUp"),
            t(".title").removeClass("animated fadeInUp"),
            t("p").removeClass("animated fadeInUp"),
            t("a").removeClass("animated fadeInUp"),
            t(".owl-item")
              .not(".cloned")
              .eq(e)
              .find(".h5")
              .addClass("animated fadeInUp"),
            t(".owl-item")
              .not(".cloned")
              .eq(e)
              .find(".title")
              .addClass("animated fadeInUp"),
            t(".owl-item")
              .not(".cloned")
              .eq(e)
              .find("p")
              .addClass("animated fadeInUp"),
            t(".owl-item")
              .not(".cloned")
              .eq(e)
              .find("a")
              .addClass("animated fadeInUp");
        }),
        0 !== t(".horizontaltab").length &&
          t(".horizontaltab").easyResponsiveTabs({
            type: "default",
            width: "auto",
            fit: !0,
            tabidentify: "hor_1",
            activate: function (e) {
              var a = t(this),
                o = t("#nested-tabInfo");
              t("span", o).text(a.text()), o.show();
            },
          }),
        t(".countup").counterUp({ delay: 25, time: 2e3 }),
        t(".countdown").countdown({
          date: "01 Apr 2026 00:01:00",
          format: "on",
        }),
        t(".current-year").text(new Date().getFullYear());
    }),
    s.on("load", function () {
      t(".portfolio-gallery").lightGallery(),
        t(".portfolio-link").on("click", (e) => {
          e.stopPropagation();
        });
    });
})(jQuery);

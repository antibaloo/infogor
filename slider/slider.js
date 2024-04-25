$(".slResponsive").slick({
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  centerMode: true,
  centerPadding: "25%",
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1081,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: false,
      }
    },

  ]
});

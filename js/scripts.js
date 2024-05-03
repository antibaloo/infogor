$(document).ready(function () {
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
  $(".slContainer").show();
  // $(".dropdown").hover(function () {
  //   console.log($(this).find(".dropdown-toggle"));
  //   $(this).find(".dropdown-toggle")[0].trigger("click");
  // });
  if (window.matchMedia("(min-width: 768px)").matches) {
    $(".dropdown").hover(
      function () {
        $(this).find(".dropdown-toggle").addClass("open");
        $(this).find(".dropdown-menu").addClass("show");
      },
      function () {
        $(this).find(".dropdown-toggle").removeClass("open");
        $(this).find(".dropdown-menu").removeClass("show");
      }
    );
  }
  if (window.matchMedia("(max-width: 768px)").matches) {
    $(".partners .grid").slick({
      dots: true,
      arrows: false,

      infinite: false,
    });

    $(".kds .kds-cards").slick({
      dots: true,
      arrows: false,
      infinite: false,
    });
    $(".kds.d-block .kds-cards").removeClass("row");
  }

  $(".search").click(function () {
    $(this).addClass("active");
    $(this).addClass("mb-3");
    $(this).parent().addClass("flex-wrap");
  });
});

$(document).ready(function () {
  var select_rub = "";

  $(document).ready(function () {
    if ($("#rub").val()) {
      select_rub = $("#rub").val();
      $("#r" + select_rub).addClass("radio2");
    }

    $(".catalog_list div").hover(
      function () {
        $(this).addClass("hover");
      },
      function () {
        $(this).removeClass("hover");
      }
    );

    $(".catalog_list .radio").on("click", function () {
      $(".txtrubviwer").remove();
      var txtrub = $(this).data("info");
      if (txtrub) {
        $(this).append('<div class="green txtrubviwer">' + txtrub + "</div>");
      }

      if (select_rub) $("#r" + select_rub).removeClass("radio2");
      if (select_rub) $("#s" + select_rub).removeClass("radio2");
      if (select_rub) $("#a" + select_rub).removeClass("radio2");
      $(this).addClass("radio2");
      select_rub = $(this).attr("id").substr(1, 10);
      $("#rub").val(select_rub);

      if (typeof similar === "function") {
        similar();
      }
    });

    $(".catalog_list_search .radio").on("click", function () {
      /*
                $('.txtrubviwer').remove();
                var txtrub = $(this).data('info');
                if(txtrub) {
                	$(this).append('<div class="green txtrubviwer">'+txtrub+'</div>');
                }			
                */

      if (select_rub) $("#r" + select_rub).removeClass("radio2");
      if (select_rub) $("#s" + select_rub).removeClass("radio2");
      if (select_rub) $("#a" + select_rub).removeClass("radio2");

      $(this).addClass("radio2");
      select_rub = $(this).attr("id").substr(1, 10);
      $("#rub").val(select_rub);

      if (typeof similar === "function") {
        similar();
      }
    });

    $(document).on("click", ".catalog_list .close", function () {
      $(this).removeClass("close");
      $(this).addClass("open");
      $("ul:first", $(this).parent()).show("fast");
    });

    $(document).on("click", ".catalog_list .open", function () {
      $(this).removeClass("open");
      $(this).addClass("close");

      $("ul:first", $(this).parent()).removeClass("show");
      $("ul:first", $(this).parent()).show();
      $("ul:first", $(this).parent()).hide("fast");
    });
  });
});

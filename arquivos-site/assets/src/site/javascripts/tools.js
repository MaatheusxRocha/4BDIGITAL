$(document).ready(function () {

    $(".nav-anchor").click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash),
                    targetOffset = target.offset().top;
            target = (target.length) && (target || $('[name=' + this.hash.slice(1) + ']'));
            if (target.length) {
                $('html,body').animate({
                    scrollTop: targetOffset
                }, 1000);
                return false;
            }
        }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $('.back-top').addClass('active');
        } else {
            $('.back-top').removeClass('active');
        }
    });

    $(".top-slider").slick({
        fade: true,
        autoplay: true,
        autoplaySpeed: 8000,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 700
    });

    $(".tel").inputmask("( 99 ) 9999 - 9999", {showMaskOnHover: false, clearIncomplete: true});
    $(".cel").inputmask("( 99 ) 99999 - 9999", {showMaskOnHover: false, clearIncomplete: true});
    $(".phone-input").inputmask("( 99 ) 9999 - 9999[9]", {showMaskOnHover: false, clearIncomplete: true});
    $(".date").inputmask("99 / 99 / 9999", {showMaskOnHover: false, clearIncomplete: true});
    $(".cnpj").inputmask("99 . 999 . 999 / 9999 - 99", {showMaskOnHover: false, clearIncomplete: true});
    $('.money').maskMoney({prefix: 'R$ ', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});

    $(".join-file").change(function () {
        var file = $(this).val().split("/").pop().split("\\").pop();
        var desc = $(this).attr("title");
        $(".file-name").html(desc + ": <em>" + file + "</em>");
    });

    $(function () {
        $(".question p").hide();
        $(".question h3").click(function (event) {
            var $this = $(this);
            $this.next("p").stop().slideToggle();
            $this.toggleClass('active');
        });
    });

    setTimeout(function () {
        $(".alert-dialog").toggleClass("active");
    }, 1000);
    $(".close-dialog").click(function () {
        $(".alert-dialog").toggleClass("active");
    });

    $(".pricing-slider").slick({
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        speed: 700,
        responsive: [
            {
                breakpoint: 1023,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $(".startup-slider").slick({
        fade: true,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        speed: 700
    });

    $(".pricing-toggle_holder").click(function () {
        $(this).children('button').toggleClass('active');
        if ($(this).children('button').hasClass('active')) {
            $(".price-hour").hide();
            $(".price-month").show();
        } else {
            $(".price-month").hide();
            $(".price-hour").show();
        }
    });

    $(".video").each(function () {
        var thisHref = this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/').replace(new RegExp("&", "i"), '?');

        $(this).fancybox({
            "padding": 0,
            "height": 450,
            "type": 'iframe',
            "href": thisHref + "&amp;wmode=opaque&amp;autoplay=1&amp;rel=0"
        });
    });

    $(".menu-toggle").click(function (event) {
        $(".top-menu_responsive").toggleClass('active');
    });
});

// -- backend --

var base_url = 'brascloud/';

function load_cities() {
    $.ajax({
        type: 'get',
        url: '/' + base_url + 'get_cities/' + $('#state_id').val(),
        success: function (data) {
            $('#city_id').html(data);
        }
    });
}

function load_plans_operational(os_id) {
    $.ajax({
        type: 'POST',
        data: {os_id: os_id},
        url: '/' + base_url + 'home/load_plans_slider',
        success: function (data, textStatus, jqXHR) {
            try {
                result = JSON.parse(data);
                if (result.status == 'success') {
                    $('.pricing-slider').slick('unslick');
                    $(".pricing-slider").html(result.html);
                    $(".pricing-slider").slick({
                        autoplay: true,
                        autoplaySpeed: 6000,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        speed: 700,
                        responsive: [
                            {
                                breakpoint: 1023,
                                settings: {
                                    slidesToShow: 1
                                }
                            }
                        ]
                    });
                } else {
                    console.log('Não foi possivel realizar a requisição');
                }
            } catch (e) {
                console.log('Falha, não foi possivel realizar a requisição');
            }

        },
        error: function (result) {
            console.log(result.responseText);
        },
        beforeSend: function (xhr) {

            if ($(".pricing-toggle_holder").children('button').hasClass('active')) {
                $(".pricing-toggle_holder").children('button').toggleClass('active');
            }
        }
    });
}

function load_plans_table_operational(os_id) {
    $.ajax({
        type: 'POST',
        data: {os_id: os_id},
        url: '/' + base_url + 'home/load_plans_table',
        success: function (data, textStatus, jqXHR) {
            try {
                result = JSON.parse(data);
                if (result.status == 'success') {
                    $("#div-pricing-table").html(result.html);
                } else {
                    console.log('Não foi possivel realizar a requisição');
                }
            } catch (e) {
                console.log('Falha, não foi possivel realizar a requisição');
            }

        },
        error: function (result) {
            console.log(result.responseText);
        },
        beforeSend: function (xhr) {
            if ($(".pricing-toggle_holder").children('button').hasClass('active')) {
                $(".pricing-toggle_holder").children('button').toggleClass('active');
            }
        }
    });
}

function show_faq(id) {
    $(".questions").each(function () {
        $(this).hide();
    });
    $("#questions-" + id).show();
}

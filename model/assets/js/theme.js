jQuery(function ($) {
    "use strict";
    create_modal();
    create_slider();
    create_carousel();

    active_hamburger();

    scroll_in_banner();
    scroll_to_section();

    generateSvg();

    event_filters();
    $('.event__filter').click(function () {

        $('.event__filter--active').removeClass('event__filter--active');
        $(this).addClass('event__filter--active');
        event_filters();
    });

    //go_to_next_line('.page-title__title', 1);

    according('p:nth-child(n+3)');
    according('> div', '.accordingFront-content', '.accordingFront', '.accordingFront-button');

    wmpl_change_style_menu();

    function wmpl_change_style_menu() {
        $(window).resize(function () {
            let width = $(this).width();
            let wmpl = $('.wpml-ls-statics-shortcode_actions');

            let el_wmpl = $('.wmpl');

            let el_class = 'wpml-ls-legacy-dropdown';

            if (width > 767) {
                wmpl.removeClass(el_class);
                el_wmpl.removeClass('wmpl--mobile');
            } else {
                wmpl.addClass(el_class);
                el_wmpl.addClass('wmpl--mobile');
            }

        }).resize();
    }

    function go_to_next_line(el, count_char = 0) {

        if ($(el).length) {

            let text = document.querySelector(el).innerHTML;

            if (count_char === 1) {
                text = text.replace(/(\s)([\S])[\s]+/g, '<br> $1$2 ');
            } else {
                //do poprawy abył RegExp był wraz z zmienna count_char
                let re = new RegExp(/(\s)([^<][\S]{1})[\s]/, "g");
                text = text.replace(re, '<br> $1$2 '); //dwuznakowe

            }

            document.querySelector(el).innerHTML = text;

        }

    }

    function scroll_in_banner() {
        let link = document.querySelector('.scroll__body');

        if (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                $([document.documentElement, document.body]).animate({
                    scrollTop: $('.aurelioMenu').offset().top - 50
                }, 750);
            });
        }
    }

    function scroll_to_section() {
        const menu_items = document.querySelectorAll('header .menu__item');

        menu_items.forEach(function (menu_item) {
            let offset = 0;
            let link = menu_item.querySelector('.menu__link');

            if (link) {
                let anchor = link.dataset.anchor;

                offset = parseInt(link.dataset.offset);
                if (!offset) {
                    offset = 0;
                }

                if (document.querySelector(`${anchor}`)) {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();

                        $([document.documentElement, document.body]).animate({
                            scrollTop: $(anchor).offset().top - offset
                        }, 2000);
                    });
                }
            }
        });
    }

    function active_hamburger() {
        const $hamburger = $('.hamburger');
        $hamburger.click(function () {
            $(this).toggleClass('hamburger--active');
            $('.nav-container--mobile .nav__menu').slideToggle("fast");
            if ($(this).hasClass('hamburger--active')) {
                $('.main__overlay').addClass('main__overlay--active');
            } else {
                $('.main__overlay').removeClass('main__overlay--active');
            }
        });


        $(window).click(function (event) {

            if ($hamburger.hasClass('hamburger--active') && !$(event.target).hasClass('hamburger')) {
                let menu = $(event.target).closest('.menu');
                if (!menu.length) {
                    $hamburger.toggleClass('hamburger--active');
                    $('.nav-container--mobile .nav__menu').slideToggle("fast");
                    if ($(this).hasClass('hamburger--active')) {
                        $('.main__overlay').addClass('main__overlay--active');
                    } else {
                        $('.main__overlay').removeClass('main__overlay--active');
                    }
                }
            }
        });
    }

    function according(child_content = 'div', content = '.according-content', parent_content = '.according', button = '.according-button') {
        const according_fields = document.querySelectorAll(`${parent_content}`);

        according_fields.forEach(function (field) {
            const btn = $(field).find(`${button}`);

            $(field).find(btn).click(function (e) {
                e.preventDefault();
                $(this).toggleClass('active');
                if ($(this).hasClass(`active`)) {
                    $(field).find(`${content} ${child_content} `).slideToggle();
                } else {
                    $(field).find(`${content} ${child_content} `).slideToggle();
                }
            });

        })
    }

    function create_modal() {
        const containers = document.querySelectorAll('.modal-container');

        containers.forEach(function (container) {
            $(container).find('.modal').hide();

            $(container).find('.modal__btn').click(function () {
                $(container).find('.modal').fadeIn();
                modal_css('add', 'body');
            });

            $('body').on('click', function (e) {
                let targetClass = e.target.className;
                if (targetClass === 'modal' || targetClass === 'modal__close') {
                    $(this).find('.modal').fadeOut('200');
                    modal_css('remove', 'body');
                }
            });

        });

        function modal_css(type, selector) {
            let element = $(selector);
            let paddingRight = 15;

            switch (type) {
                case 'add':
                    if (!is_mobile()) {
                        element.css({
                            overflow: 'hidden',
                            paddingRight: paddingRight,
                        })
                    } else {
                        element.css({
                            overflow: 'hidden',
                        })
                    }
                    break;
                case 'remove':
                    setTimeout(function () {
                        element.css({
                            overflow: '',
                            paddingRight: '',
                        });
                    }, 300)
                    break;
            }
        }
    }

    function event_filters() {
        const ajax_url = $('[data-ajax]').data('ajax');
        let content = $('.event__body--ajax');

        let event_active = $('.event').find('.event__filter--active');

        let month = event_active.data('month');
        let year = event_active.data('year');

        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                month: month,
                year: year,
                action: 'event_ajax',
            },
            success: function (response) {
                content.hide();
                content.html(response).fadeIn("normal");
                generateSvg();
            }
        });
    }

    function create_slider() {
        const sliders = document.querySelectorAll('.slider');
        sliders.forEach(function (slider) {
            $(slider).slick({
                draggable: true,
                arrows: $(slider).data("arrows"),
                dots: $(slider).data("dots"),
                fade: true,
                speed: 1500,
                infinite: true,
                touchThreshold: 100,
                prevArrow: '<span  class="slick-prev"><i class="fa fa-angle-double-left" style="font-size:36px"></i></span>',
                nextArrow: '<span  class="slick-next"><i class="fa fa-angle-double-right" style="font-size:36px"></i></span>',
                autoplay: true,
                autoplaySpeed: 2000,
            })
        });
    }

    function create_carousel() {
        const carousel = document.querySelectorAll('.carousel');
        carousel.forEach(function (carousel) {
            $(carousel).slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                draggable: true,
                arrows: true,
                speed: 1500,
                infinite: true,
                touchThreshold: 100,
                prevArrow: '<span  class="slick-prev"><i class="fa fa-angle-double-left" style="font-size:36px"></i></span>',
                nextArrow: '<span  class="slick-next"><i class="fa fa-angle-double-right" style="font-size:36px"></i></span>',
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }
                ]
            })
        });
    }

    window.is_mobile = function () {
        let check = false;
        (function (a) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };

    function generateSvg() {
        $('img.svg').ready(function () {
            $('img.svg').each(function () {

                let $img = $(this);
                let imgID = $img.attr('id');
                let imgClass = $img.attr('class');
                let imgURL = $img.attr('src');

                $.get(imgURL, function (data) {
                    let $svg = $(data).find('svg');

                    if (typeof imgID !== 'undefined') {
                        $svg = $svg.attr('id', imgID);
                    }

                    if (typeof imgClass !== 'undefined') {
                        $svg = $svg.attr('class', imgClass + ' replaced-svg');
                    }

                    $svg = $svg.removeAttr('xmlns:a');

                    if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                        $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
                    }

                    $img.replaceWith($svg)
                }, 'xml');
            });
        });

    }

});



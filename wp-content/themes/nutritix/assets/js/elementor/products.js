(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/nutritix-products.default', ($scope) => {
            let $carousel = $('.woocommerce-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings'),
                    rtl = $('body').hasClass('rtl');
                if (data['layout_carousel'] === true) {
                    $('ul.products', $carousel).slick(
                        {
                            rtl: rtl,
                            dots: data.navigation == 'both' || data.navigation == 'dots',
                            arrows: data.navigation == 'both' || data.navigation == 'arrows',
                            infinite: data.loop,
                            speed: 300,
                            slidesToShow: parseInt(data.items),
                            autoplay: data.autoplay,
                            autoplaySpeed: parseInt(data.autoplayTimeout),
                            slidesToScroll: 1,
                            lazyLoad: 'ondemand',
                            responsive: [
                                {
                                    breakpoint: parseInt(data.breakpoint_laptop),
                                    settings: {
                                        slidesToShow: parseInt(data.items_laptop),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_tablet_extra),
                                    settings: {
                                        slidesToShow: parseInt(data.items_tablet_extra),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_tablet),
                                    settings: {
                                        slidesToShow: parseInt(data.items_tablet),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_mobile_extra),
                                    settings: {
                                        slidesToShow: parseInt(data.items_mobile_extra),
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 2,
                                    }
                                },
                                {
                                    breakpoint: 500,
                                    settings: {
                                        slidesToShow: 1,
                                    }
                                }
                            ]
                        }
                    ).on('setPosition', function (event, slick) {
                        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
                    });
                } else if (data['layout_carousel'] === false) {
                    $('ul.products', $carousel).slick(
                        {
                            rtl: rtl,
                            dots: data.navigation == 'both' || data.navigation == 'dots',
                            arrows: data.navigation == 'both' || data.navigation == 'arrows',
                            infinite: data.loop,
                            speed: 300,
                            slidesToShow: parseInt(data.items),
                            autoplay: data.autoplay,
                            autoplaySpeed: parseInt(data.autoplayTimeout),
                            slidesToScroll: 1,
                            lazyLoad: 'ondemand',
                            responsive: [
                                {
                                    breakpoint: parseInt(data.breakpoint_laptop),
                                    settings: {
                                        slidesToShow: parseInt(data.items_laptop),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_tablet_extra),
                                    settings: {
                                        slidesToShow: parseInt(data.items_tablet_extra),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_tablet),
                                    settings: {
                                        slidesToShow: parseInt(data.items_tablet),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_mobile_extra),
                                    settings: {
                                        slidesToShow: parseInt(data.items_mobile_extra),
                                    }
                                },
                                {
                                    breakpoint: parseInt(data.breakpoint_mobile),
                                    settings: {
                                        slidesToShow: parseInt(data.items_mobile),
                                    }
                                }
                            ]
                        }
                    ).on('setPosition', function (event, slick) {
                        slick.$slides.css('height', slick.$slideTrack.height() + 'px');
                    });
                }

            }
        });
    });

})(jQuery);

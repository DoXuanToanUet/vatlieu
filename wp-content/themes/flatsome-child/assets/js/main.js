(function ($) {
    $(document).ready(function () {
        
        //Phần tab đăng nhập đăng kí
        function activeTabLogin(obj) {
            $(".login-tab .common-tab").removeClass("active-tab");
            let id = $(obj).data("tab");
            $(obj).addClass("active-tab");
            $(".content-tab-common").hide();
            // console.log(id);
            $('.'+id).show();
        }
        $('.login-tab .common-tab').click(function (e) {
            // console.log(e.target)
            e.preventDefault();
            activeTabLogin(this);

        })
        activeTabLogin('.login-tab .common-tab:first-child');

        // $('#mega_menu').css("position","relative").addClass('active');
        // $('#mega-menu-title').off();

        // Section Banner
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            loop: true,
            autoplay: {
                delay: 5000,
            },
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            // loopedSlides: 4, 
        });
        var galleryTop = new Swiper('.gallery-top', {
            // spaceBetween: 10,
            loop:true,
            autoplay: {
                delay: 5000,
            },
            navigation: {
              nextEl: '.swiper-button-next',
              prevEl: '.swiper-button-prev',
            },
            thumbs: {
              swiper: galleryThumbs
            }
        });

        // Section tin khuyen mai
        var swiperBlog = new Swiper('.saleNews-swiper', {
            spaceBetween: 20,
            slidesPerView: 4,
            // autoplay: {
            //     delay: 5000,
            // },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // pagination: {
            //     el: '.swiper-pagination',
            //     clickable: true,
            // },
            breakpoints: {
                //max-width> 575px
                575: {
                    slidesPerView: 1.5,
                    spaceBetween: 15,
                    // centeredSlides: true,
                },
                768: {
                    slidesPerView: 2.5,
                    spaceBetween: 15,
                }
            }
        });
        

        var  swiperApp={
            swiperGallery:function ($class){
                // console.log("swiper test");
                new Swiper($class, {
                    spaceBetween: 20,
                    slidesPerView: 4,
                    autoplay: {
                        delay: 5000,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    observeParents: true,
                    observer: true,
                    // pagination: {
                    //     el: '.swiper-pagination',
                    //     clickable: true,
                    // },
                    breakpoints: {
                        //max-width> 575px
                        575: {
                            slidesPerView: 1.5
                        },
                        768: {
                            slidesPerView: 2.5
                        }
                    }
                });
            },
            swiperGalleryCat:function ($class){
                // console.log("swiper test");
                new Swiper($class, {
                    spaceBetween: 20,
                    slidesPerView: 1,
                    autoplay: {
                        delay: 5000,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    // pagination: {
                    //     el: '.swiper-pagination',
                    //     clickable: true,
                    // },
                    breakpoints: {
                        //max-width> 575px
                        575: {
                            slidesPerView: 1.5
                        },
                        768: {
                            slidesPerView: 2.5
                        }
                    }
                });
            }

        }
        // console.log( swiperApp)
        swiperApp.swiperGallery('.devProduct-swiper1');
        swiperApp.swiperGallery('.devProduct-swiper2');
        swiperApp.swiperGallery('.devProduct-swiperfeature');
        swiperApp.swiperGalleryCat('.devProduct-swiperCat');
        // Section sản phẩm
        // var swiperProduct = 
        
        // Trigger nut xem nhanh
        $('.dev-quickView').on('click',function(event) {
            event.preventDefault();
            /* Act on the event */
            $(this).closest('.product').find('.quick-view.quick-view-added').trigger('click');
        });

        $('.single_add_to_cart_button').html(`<span class="lnr lnr-cart"></span> <span>Thêm vào giỏ</span>`);


        // JS cho muc expand noi dung trong Single Product
        heightShortDesc = $('.dev-short-description ').height();
        // console.log(typeof heightT);
        // if( )
        if( heightShortDesc > 150){
            $(".dev-short-description").toggleClass('show');
            $(" .product-short-description  .short-desc-toggle").toggleClass('show');
            $(".product-short-description .short-desc-toggle").click( function(){
                $(this).parent().find('.dev-short-description ').toggleClass('expand');
                if(  $('.product-short-description .expand-text').text() == 'Xem thêm'){
                    $('.product-short-description .expand-text').text("Thu gọn");
                } else{
                    $('.product-short-description .expand-text').text("Xem thêm");
                }
                
            })
        }

        heightShortDescDiv = $('.woocommerce-Tabs-panel .content');
        // console.log(heightShortDescDiv)
        $(heightShortDescDiv).each( function (){
            heightShortDesc1 = $(this).height();
            // console.log("toan");
            console.log(heightShortDesc1);

            if( heightShortDesc1 > 150){
                $(this).toggleClass('show');
                $(this).parent().find(".short-desc-toggle").toggleClass('show');
                $(this).parent().find(".short-desc-toggle").click( function(){
                    $(this).parent().find('.content').toggleClass('expand');
                    if(  $(this).find('.expand-text').text() == 'Xem thêm'){
                        $(this).find('.expand-text').text("Thu gọn");
                    } else{
                        $(this).find('.expand-text').text("Xem thêm");
                    }
                    
                })
            }  
        })
        

        // Custom status css order my account
        getorder=$('.woocommerce-account .woocommerce-orders-table__cell-order-status');
        getorder.each(function(){
            gethtml = $(this).html()
            // console.log()
            // console.log(typeof toan)
            trim = gethtml.replace(/\s/g, '')
            console.log(trim);
            switch (trim) {
                case 'Đangxửlý':
                    $(this).html(`<div class="flex-status"><p class="front-status-processing front-status"><i class="fa fa-circle" style="padding-right:4px"></i>Đang xử lý </p></div>`)
                    break;
                case 'Đãhoànthành':
                    $(this).html(`<div class="flex-status"><p class="front-status-success front-status"><i class="fa fa-circle" style="padding-right:4px"></i>Đã hoàn thành</p></div>`)
                    break;
                case 'Tạmgiữ':
                    $(this).html(`<div class="flex-status"><p class="front-status-on-hold front-status"><i class="fa fa-circle" style="padding-right:4px"></i>Tạm giữ </p></div>`)
                    break;
                case 'Đãhủy':
                    $(this).html(`<div class="flex-status"><p class="front-status-cancel front-status"><i class="fa fa-circle" style="padding-right:4px"></i>Đã hủy</p></div>`)
                    break;
                default:
                    break;
            }
        })
        
        //Tab feature product
        function activeTab(obj) {
            $(".feature-tab .common-tab").removeClass("active-tab");
            let id = $(obj).data("tab");
            $(obj).addClass("active-tab");
            $(".featureTab").hide();
            // console.log(id);
            $("." + id).show();
          }
        $(".feature-tab .common-tab").click(function (e) {
            // console.log(e.target);
            e.preventDefault();
            activeTab(this);
        });
        activeTab(".feature-tab .common-tab:first-child");


        // Custom category mobile menu
        $('.category-mb-link').click(function (e){
            e.preventDefault();
            $('body').toggleClass("no-scroll");
            $('.category-mb').toggleClass('active');
        })

        // // Wow js 
        new WOW().init();


        // $('.menu-mb').click(function (e){
        //     e.preventDefault();
        //     $(this).closest('body').find('.header-main .nav  li a ').trigger('click');
        // })
    })
})(jQuery);
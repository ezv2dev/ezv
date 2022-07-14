  {{-- lazy load list --}}
        {{-- store index function --}}
        <script>
            var itemIds = [];
            function add(items) {
                if (items.length) {
                    items.forEach(id => {
                        if (items.indexOf(id) != -1) {
                            itemIds.push(id);
                        }
                    });
                }
            }
        </script>
        {{-- scroll action --}}
        <script>
            var page = 1;
            const widthBreakpoint = 768;
            function disabledScrollAction() {
                $(window).off('scroll');
            }
            function enabledScrollAction() {
                $(window).scroll(function() {
                    if ($(window).scrollTop() + $(window).height() + 100 >= $(document).height()) {
                        page++;
                        loadMoreData(page);
                    }
                });
            }
        </script>
        {{-- show/hide show more button --}}
        <script>
            function hideLazyShowMoreButton() {
                $('#lazy-show-more').addClass('d-none');
                $('#lazy-show-more').removeClass('d-block');
            }
            function showLazyShowMoreButton() {
                $('#lazy-show-more').removeClass('d-none');
                $('#lazy-show-more').addClass('d-block');
            }
        </script>
        {{-- load more action --}}
        <script>
            async function loadMoreData(page) {
                if($(window).width() < widthBreakpoint){
                    hideLazyShowMoreButton();
                } else {
                    disabledScrollAction();
                }

                // check if link indicator is link list
                // otherwise link filter
                var linkIndicator = location.origin + location.pathname;
                var linkTarget = `{{ route('list') }}`;
                if (linkIndicator == linkTarget) {
                    let load = await $.ajax({
                        url: '?page=' + page,
                        type: 'get',
                        beforeSend: function() {
                            $(".ajax-load").show();
                        },
                        data: {
                            itemIds: itemIds
                        },
                    })
                    .done(function(data) {
                        // append data to element
                        if (data.html == " ") {
                            $('.ajax-load').html("No more records found");
                            return;
                        }
                        $('.ajax-load').hide();
                        $("#villa-data").append(data.html);

                        // rerun slick
                        $('.js-slider-2 .slick-next').not('.slick-initialized').css('display', 'none');
                        $('.js-slider-2 .slick-prev').not('.slick-initialized').css('display', 'none');
                        $('.js-slider-2').not('.slick-initialized').mouseenter(function(e) {
                            $(this).children('.slick-prev').not('.slick-initialized').css('display', 'block');
                            $(this).children('.slick-next').not('.slick-initialized').css('display', 'block');
                        })
                        $('.js-slider-2').not('.slick-initialized').mouseleave(function(e) {
                            $(this).children('.slick-prev').not('.slick-initialized').css('display', 'none');
                            $(this).children('.slick-next').not('.slick-initialized').css('display', 'none');
                        })

                        $(".js-slider-2").not('.slick-initialized').slick({
                            rtl: false,
                            autoplay: false,
                            autoplaySpeed: 5000,
                            speed: 800,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            variableWidth: true,
                            pauseOnHover: false,
                            easing: "linear",
                            arrows: true
                        });
                        // rerun change background

                        // changebackground();
                        if($(window).width() < widthBreakpoint){
                            showLazyShowMoreButton();
                        } else {
                            enabledScrollAction();
                        }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert("Server not responding");
                        if($(window).width() < widthBreakpoint){
                            showLazyShowMoreButton();
                        } else {
                            enabledScrollAction();
                        }
                    });
                } else {
                    let load = await $.ajax({
                        url: location.href+'&page=' + page,
                        type: 'get',
                        beforeSend: function() {
                            $(".ajax-load").show();
                        },
                        data: {
                            itemIds: itemIds
                        },
                    })
                    .done(function(data) {
                        // append data to element
                        if (data.html == " ") {
                            $('.ajax-load').html("No more records found");
                            return;
                        }
                        $('.ajax-load').hide();
                        $("#villa-data").append(data.html);

                        // rerun slick
                        $('.js-slider-2 .slick-next').not('.slick-initialized').css('display', 'none');
                        $('.js-slider-2 .slick-prev').not('.slick-initialized').css('display', 'none');
                        $('.js-slider-2').not('.slick-initialized').mouseenter(function(e) {
                            $(this).children('.slick-prev').not('.slick-initialized').css('display', 'block');
                            $(this).children('.slick-next').not('.slick-initialized').css('display', 'block');
                        })
                        $('.js-slider-2').not('.slick-initialized').mouseleave(function(e) {
                            $(this).children('.slick-prev').not('.slick-initialized').css('display', 'none');
                            $(this).children('.slick-next').not('.slick-initialized').css('display', 'none');
                        })

                        $(".js-slider-2").not('.slick-initialized').slick({
                            rtl: false,
                            autoplay: false,
                            autoplaySpeed: 5000,
                            speed: 800,
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            variableWidth: true,
                            pauseOnHover: false,
                            easing: "linear",
                            arrows: true
                        });
                        // rerun change background

                        // changebackground();
                        if($(window).width() < widthBreakpoint){
                            showLazyShowMoreButton();
                        } else {
                            enabledScrollAction();
                        }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert("Server not responding");
                        if($(window).width() < widthBreakpoint){
                            showLazyShowMoreButton();
                        } else {
                            enabledScrollAction();
                        }
                    });
                }
                removeSkeletonClass()
            }
            function runAction() {
                if($(window).width() < widthBreakpoint){
                    showLazyShowMoreButton();
                    enabledScrollAction();
                    disabledScrollAction();
                } else {
                    hideLazyShowMoreButton();
                    disabledScrollAction();
                    enabledScrollAction();
                }
            }
        </script>
        <script>
            $(window).on('load', () => {
                add(@json($villas->pluck('id_villa')));
            });

            $(window).on('load resize', ()=>{
                runAction();
            });

            runAction();
        </script>
    {{-- end lazy load list --}}

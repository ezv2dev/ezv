<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    @include('layouts.admin.title')

    <meta name="description" content="EZV2 ">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="EZV2">
    <meta property="og:description" content="EZV2 ">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <link rel="stylesheet" href="{{asset('assets/js/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    
    
    <style>
    
        .box {
           width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .overlay {
          z-index: 9;
          margin-top: 500px;
          padding-left:3%;
          padding-right:3%;
        }

        .input1
        {
            width: 400px; 
            height:50px;
        }

        .input2
        {
            width: 190px; 
            height:50px;
        }

        .input3
        {
            width: 189px; 
            height:50px;
        }

        .photosGrid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .photosGrid__Photo {
            width: 33.3%;
            width: calc(33.3% - 2px);
            height: 30vw;
            background-position: center;
            background-size: cover;
            margin-bottom: 3px;
        }

        @media screen and (min-width: 736px) {
            main {
                padding: 20px;
            }

            .photosGrid__Photo {
                width: calc(25% - 16px);
                margin-bottom: 26px;
            }

            
        }

        @media screen and (min-width: 980px) {
            main {
                max-width: 1280px;
                margin: auto;
            }

            .photosGrid__Photo {
                height: 293px;
            }
            
        }

        input {
          background: rgba(255,255,255,0.4);
          border: none;
          position: relative;
          display: block;
          outline: none;
          margin: 0 auto;
          color: #333;
          -webkit-box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
          box-shadow: 0 2px 10px 1px rgba(0,0,0,0.5);
        }
        
        ::-webkit-input-placeholder { color: #000;} 
        :-moz-placeholder { color: #000; }
        ::-moz-placeholder { color: #000; }
        :-ms-input-placeholder { color: #000; }


/*Slider */
.banner {
    position: relative;
    height: 180px;
    padding: 11px 0 16px;
    margin: 0 auto;
    text-align: center;
}

.dg-container {
    position: relative;
    width: 100%;
    height: 350px;
}

.dg-wrapper {
  width: 200px;
  height: 200px;
  margin: 0 auto;
  position: relative;
  transform-style: preserve-3d;
  perspective: 200px;
}

.dg-wrapper a {
    width: 100%;
    height: 250px;
    display: block;
    position: absolute;
    left: 0;
    top: 0;
}

.dg-wrapper a:first-child {
    z-index: 2;
}

.dg-wrapper a img {
  display: block;
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.20);
  border-radius: 25px;
  width: 200px;
  height: 200px;
  background: #fff;
}

.dg-wrapper a.dg-transition {
    transition: all 0.5s ease-in-out;
}

.dg-wrapper a.dg-transition-fast {
    transition: all 0.2s ease-in-out;
}

.dg-container nav {
    display: none;
}

.dg-container nav span:hover {
    opacity: 1;
}

/* .dg-container nav span.dg-next {
    background-position: top right;
    margin-left: 10px;
} */

.dg-container #lightButton2 {
    bottom: 20px;
}

.dg-container .button {
     position: relative;
     z-index: 5;
 }

.dg-container .button li {
    cursor: pointer;
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin-right: 5px;
    background: rgba(255, 255, 255, 0.30);
    border: 1px solid rgba(0, 0, 0, 0.20);
}

.dg-container .button .light {
    background: #01BDFF;
}
    </style>

  </head>
  <body>
    <div id="page-container" class="page-header-fixed page-header-glass main-content-boxed">

      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        <div class="content-header justify-content-center justify-content-lg-between">
          <!-- Left Section -->
          <div class="d-flex align-items-center">
            <!-- Logo -->
            <a class="link-fx fs-lg fw-semibold text-dark" href="">
              <span style="color: white">EZV</span><small class="fw-medium" style="color: white">2</small>
            </a>
            <!-- END Logo -->
          </div>
          <!-- END Left Section -->

          <!-- Right Section -->
          <div class="d-none d-lg-flex align-items-center">
            <!-- Menu -->
            <ul class="nav-main nav-main-horizontal nav-main-hover">
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('villa_list') }}">
                  <i class="nav-main-link-icon fa fa-home" style="font-size: 32px; color:white;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Villa"></i>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="#dm-package">
                  <i class="nav-main-link-icon fa fa-hotel" style="font-size: 32px; color:white;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Hotel"></i>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="#dm-package">
                  <i class="nav-main-link-icon fa fa-utensils" style="font-size: 32px; color:white;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Restaurant"></i>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="#dm-package">
                  <i class="nav-main-link-icon fa fa-walking" style="font-size: 32px; color:white;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Activity"></i>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link btn btn-light" href="{{ route('login') }}">
                  LOGIN
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link btn btn-light" href="{{ route('register') }}">
                  SIGN UP
                </a>
              </li>
            </ul>
            <!-- END Menu -->
          </div>
          
          <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-sidebar-dark">
          <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
              <div class="input-group">
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                  <i class="fa fa-fw fa-times-circle"></i>
                </button>
                <input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
              </div>
            </form>
          </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-sidebar-dark">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->

      <!-- Main Container -->
      <main id="main-container">
        <!-- Hero -->
        <div class="container">
          
          <div id="hero" class="bg-image box" style="background-image : url({{ asset('assets/user/assets/images/banner/02.jpg') }});">
            <div class="content content-top text-center">

<!-- Slider -->
        <div class="banner">
        <section id="dg-container" class="dg-container">
            <div class="dg-wrapper">
                <a href="#">
                    <img src="http://www.goodlightscraps.com/content/good-day/good-day-7.jpg">
                </a>
                <a href="#">
                    <img src="http://aurora.edu.au/wp-content/uploads/2015/05/good-news.jpg">
                </a>
                <a href="#">
                    <img src="https://www.wisetiger.co.uk/blog/wp-content/uploads/2012/08/Good-Web-Design1.jpg">
                </a>
                <a href="#">
                    <img src="http://blog.askiitians.com/wp-content/uploads/2014/05/ww.gif">
                </a>
            </div>
            <ol class="button" id="lightButton">
                <li index="0">
                <li index="1">
                <li index="2">
                <li index="3">
            </ol>
            <!-- <nav>
                <span class="dg-prev">PREV</span>
                <span class="dg-next">NEXT</span>
            </nav> -->
        </section>
    </div>
<!-- End Slider -->

              <div class="pt-4 pt-lg-6">
                  <form action="{{ route('list') }}" method="POST" id="basic-form">
                      @csrf
                      <div class="mb-2">
                          <input class="form-control input1" id="location" type="text" name="location" placeholder="Let's find location..."/>
                      </div>
                      <div id="textfield" style="width: 400px; margin: 0 auto;" >
                          <div class="row mb-2">
                              <div class="col-lg-6">
                              <input class="flatpickr form-control bg-white input2" type="text" style="display: none;" name="check_in" id="check_in" placeholder="Check In"/>
                              </div>
                              <div class="col-lg-6">
                              <input class="flatpickr form-control bg-white input3" type="text" style="display: none;" name="check_out" id="check_out" placeholder="Check Out"/>
                              </div>
                          </div>
                          <div class="row mb-2">
                            <div class="col-lg-6">
                            <input class="form-control input2" type="number" min="0" style="display: none;" name="adult" id="adult" placeholder="Number of adults"/>
                            </div>
                            <div class="col-lg-6">
                            <input class="form-control input3" type="number" min="0" style="display: none;" name="children" id="children" placeholder="Number of children"/>
                            </div>
                        </div>
                      </div>
                      <button type="submit" id="button" class="btn btn-outline-light px-4 py-2 m-1">
                          <i class="fa fa-fw fa-search opacity-50 me-1"></i> Search
                      </button>
                  </form>
              </div>
          </div>
          {{-- GALLERY --}}
          <main>
          <div class="box overlay">
              <div class="js-gallery">
              <section class="photosGrid">
                @foreach($photo as $item)
                  <a href="{{ URL::asset('/foto/gallery/'.strtolower($item->name_villa).'/'.$item->name)}}" class="img-lightbox photosGrid__Photo"
                      style="background-image: url('{{ URL::asset('/foto/gallery/'.strtolower($item->name_villa).'/'.$item->name)}}')">
                  </a>
                @endforeach
                </section>
              </div>
              <!-- END Simple Gallery -->
          </div>
          </main>
          {{-- end gallery --}}
        
        </div>
          
        <!-- END Hero -->

        <!-- Footer -->
        {{-- <footer id="page-footer" class="bg-body-extra-light">
          <div class="content py-5">
            <div class="row fs-sm">
              <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
              </div>
              <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                <a class="fw-semibold" href="https://1.envato.market/r6y" target="_blank">Dashmix 5.1</a> &copy; <span data-toggle="year-copy"></span>
              </div>
            </div>
          </div>
        </footer> --}}
        <!-- END Footer -->
      </main>
      <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
    <script src="{{asset('assets/js/dashmix.app.min.js')}}"></script>

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Page JS Helpers (Magnific Popup Plugin) -->
    <script>Dashmix.helpersOnLoad(['jq-magnific-popup']);</script>
    
    <script>
        $("#location").keyup(function() {
          var id = $(this).val();
          if ((id).length >= 1) {
            $("#adult").fadeIn("slow");
            $("#children").fadeIn("slow");
            $("#check_in").fadeIn("slow");
            $("#check_out").fadeIn("slow");
            $("#button").fadeIn("slow");
          }
          else
            {
                $("#adult").fadeOut("slow");
                $("#children").fadeOut("slow");
                $("#check_in").fadeOut("slow");
                $("#check_out").fadeOut("slow");
                $("#button").fadeOut("slow");
            }
        })
    </script>

    <script>
    $('#check_in').flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function(selectedDates, dateStr, instance) {
            $('#check_out').flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: new Date(dateStr).fp_incr(1),
                onChange: function(selectedDates, dateStr, instance){
                    var start = new Date($('#check_in').val());
                    var end = new Date($('#check_out').val());
                    var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                    var min_stay = $('#min_stay').val();
                    var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                    if(sum_night < min_stay)
                    {
                        alert("minimum stay is " + min_stay + " days");
                    }
                }
            }); 
        }
    });
    </script>
    
    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>

<script>
  $(function () {
        $('#dg-container').carrousel({
            current: 0,
            autoplay: false,
            interval: 3000
        });
    });
!function(e,n,t){function r(e,n){return typeof e===n}function o(){var e,n,t,o,s,i,f;for(var a in y){if(e=[],n=y[a],n.name&&(e.push(n.name.toLowerCase()),n.options&&n.options.aliases&&n.options.aliases.length))for(t=0;t<n.options.aliases.length;t++)e.push(n.options.aliases[t].toLowerCase());for(o=r(n.fn,"function")?n.fn():n.fn,s=0;s<e.length;s++)i=e[s],f=i.split("."),1===f.length?Modernizr[f[0]]=o:(!Modernizr[f[0]]||Modernizr[f[0]]instanceof Boolean||(Modernizr[f[0]]=new Boolean(Modernizr[f[0]])),Modernizr[f[0]][f[1]]=o),C.push((o?"":"no-")+f.join("-"))}}function s(){return"function"!=typeof n.createElement?n.createElement(arguments[0]):_?n.createElementNS.call(n,"http://www.w3.org/2000/svg",arguments[0]):n.createElement.apply(n,arguments)}function i(){var e=n.body;return e||(e=s(_?"svg":"body"),e.fake=!0),e}function f(e,t,r,o){var f,a,u,l,p="modernizr",d=s("div"),c=i();if(parseInt(r,10))for(;r--;)u=s("div"),u.id=o?o[r]:p+(r+1),d.appendChild(u);return f=s("style"),f.type="text/css",f.id="s"+p,(c.fake?c:d).appendChild(f),c.appendChild(d),f.styleSheet?f.styleSheet.cssText=e:f.appendChild(n.createTextNode(e)),d.id=p,c.fake&&(c.style.background="",c.style.overflow="hidden",l=S.style.overflow,S.style.overflow="hidden",S.appendChild(c)),a=t(d,e),c.fake?(c.parentNode.removeChild(c),S.style.overflow=l,S.offsetHeight):d.parentNode.removeChild(d),!!a}function a(e,n){return!!~(""+e).indexOf(n)}function u(e){return e.replace(/([a-z])-([a-z])/g,function(e,n,t){return n+t.toUpperCase()}).replace(/^-/,"")}function l(e){return e.replace(/([A-Z])/g,function(e,n){return"-"+n.toLowerCase()}).replace(/^ms-/,"-ms-")}function p(n,r){var o=n.length;if("CSS"in e&&"supports"in e.CSS){for(;o--;)if(e.CSS.supports(l(n[o]),r))return!0;return!1}if("CSSSupportsRule"in e){for(var s=[];o--;)s.push("("+l(n[o])+":"+r+")");return s=s.join(" or "),f("@supports ("+s+") { #modernizr { position: absolute; } }",function(e){return"absolute"==getComputedStyle(e,null).position})}return t}function d(e,n,o,i){function f(){d&&(delete k.style,delete k.modElem)}if(i=r(i,"undefined")?!1:i,!r(o,"undefined")){var l=p(e,o);if(!r(l,"undefined"))return l}for(var d,c,m,v,h,y=["modernizr","tspan"];!k.style;)d=!0,k.modElem=s(y.shift()),k.style=k.modElem.style;for(m=e.length,c=0;m>c;c++)if(v=e[c],h=k.style[v],a(v,"-")&&(v=u(v)),k.style[v]!==t){if(i||r(o,"undefined"))return f(),"pfx"==n?v:!0;try{k.style[v]=o}catch(g){}if(k.style[v]!=h)return f(),"pfx"==n?v:!0}return f(),!1}function c(e,n){return function(){return e.apply(n,arguments)}}function m(e,n,t){var o;for(var s in e)if(e[s]in n)return t===!1?e[s]:(o=n[e[s]],r(o,"function")?c(o,t||n):o);return!1}function v(e,n,t,o,s){var i=e.charAt(0).toUpperCase()+e.slice(1),f=(e+" "+P.join(i+" ")+i).split(" ");return r(n,"string")||r(n,"undefined")?d(f,n,o,s):(f=(e+" "+T.join(i+" ")+i).split(" "),m(f,n,t))}function h(e,n,r){return v(e,t,t,n,r)}var y=[],g={_version:"3.0.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,n){var t=this;setTimeout(function(){n(t[e])},0)},addTest:function(e,n,t){y.push({name:e,fn:n,options:t})},addAsyncTest:function(e){y.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=g,Modernizr=new Modernizr;var C=[],S=n.documentElement,w="CSS"in e&&"supports"in e.CSS,x="supportsCSS"in e;Modernizr.addTest("supports",w||x);var _="svg"===S.nodeName.toLowerCase(),b=g.testStyles=f,z="Moz O ms Webkit",P=g._config.usePrefixes?z.split(" "):[];g._cssomPrefixes=P;var T=g._config.usePrefixes?z.toLowerCase().split(" "):[];g._domPrefixes=T;var E={elem:s("modernizr")};Modernizr._q.push(function(){delete E.elem});var k={style:E.elem.style};Modernizr._q.unshift(function(){delete k.style}),g.testAllProps=v,g.testAllProps=h,Modernizr.addTest("csstransforms3d",function(){var e=!!h("perspective","1px",!0),n=Modernizr._config.usePrefixes;if(e&&(!n||"webkitPerspective"in S.style)){var t;Modernizr.supports?t="@supports (perspective: 1px)":(t="@media (transform-3d)",n&&(t+=",(-webkit-transform-3d)")),t+="{#modernizr{left:9px;position:absolute;height:5px;margin:0;padding:0;border:0}}",b(t,function(n){e=9===n.offsetLeft&&5===n.offsetHeight})}return e}),Modernizr.addTest("csstransforms",function(){return-1===navigator.userAgent.indexOf("Android 2.")&&h("transform","scale(1)",!0)}),o(),delete g.addTest,delete g.addAsyncTest;for(var A=0;A<Modernizr._q.length;A++)Modernizr._q[A]();e.Modernizr=Modernizr}(window,document);
(function ($) {
    $.carrousel = function (options, element) {
        this.$el = $(element);
        this._init(options);
    };
    $.carrousel.defaults = {
        current: 0,	// index of current item
        autoplay: true,// slideshow on / off
        interval: 3000  // time between transitions
    };
    $.carrousel.prototype = {
        // inisialisasi 
        _init: function (options) {
            this.options = $.extend(true, {}, $.carrousel.defaults, options);

            this.support3d = Modernizr.csstransforms3d;
            this.support2d = Modernizr.csstransforms;

            this.$wrapper = this.$el.find('.dg-wrapper');
            this.$items = this.$wrapper.children();
            this.itemsCount = this.$items.length;
            this.$nav = this.$el.find('nav');
            this.$navPrev = this.$nav.find('.dg-prev');
            this.$navNext = this.$nav.find('.dg-next');
            this.button = $('#lightButton li');
            this.box = $('.banner');
            this.imgWidth = $('.banner .dg-wrapper img').width();

            this.indexB = 0;
            this.CSSX = 0;
            this.CSSXout = 0;

            this.button[0].classList.add('light');

            this.current = this.options.current;
            this.isAnim = false;
            this.$items.css({
                'opacity': 1
            });
            this._updateWidth();
            this._layout();
            // load the events
            this._loadEvents();
            // slideshow
            if (this.options.autoplay) {
                this._startSlideshow();
            }
            var _self = this;
            for (var i = 0, len = this.button.length; i < len; i++) {     // klik titik 
                this.button[i].addEventListener('click', function() {
                    var toIndex = parseInt(this.getAttribute('index'));
                    var toMove = toIndex - _self.indexB;
                    switch (toMove) {
                        case 0:
                            break;
                        case 1:
                            _self._navigate('next', 'dg-transition');
                            break;
                        case -1:
                            _self._navigate('prev', 'dg-transition');
                            break;
                        default:
                            _self._stopSlideshow();
                            var bTime = setInterval(function () {
                                if (!_self.isAnim) {
                                    if (!toMove) {
                                        clearInterval(bTime);
                                        if (_self.options.autoplay) {
                                            _self._startSlideshow();
                                        }
                                    }
                                    else if (toMove > 0) {
                                        _self._navigate('next', 'dg-transition-fast');
                                        toMove--;
                                    }
                                    else if (toMove < 0) {
                                        _self._navigate('prev', 'dg-transition-fast');
                                        toMove++;
                                    }
                                }
                            }, 0);
                            break;
                    }
                });
            }
        },
        // lebar adaptif 
        _updateWidth: function () {
            if (this.support3d) {
                if (document.body.clientWidth < 1000) {
                    this.CSSX = ($(this.box).width()  - 10 - this.imgWidth * 0.7) / 2;
                    this.CSSXout = 0;
                }
                else if (document.body.clientWidth >= 1000) {
                    this.CSSX = ($(this.box).width() * 1.2 + 480 - 10 - this.imgWidth * 0.5) / 2 * 0.5;
                    this.CSSXout = ($(this.box).width() * 1.2 + 480 - 10 - this.imgWidth * 0.5) / 2;
                }
            }
            else if (this.support2d) {
                if (document.body.clientWidth < 1464) {
                    this.CSSX = ($(this.box).width() - 10 - this.imgWidth * 0.9) / 2;
                    this.CSSXout = 0;
                }
                else if (document.body.clientWidth >= 1464) {
                    this.CSSX = (($(this.box).width() - 10 - this.imgWidth * 0.8) / 2) * 0.7;
                    this.CSSXout = ($(this.box).width() - 10 - this.imgWidth * 0.8) / 2;
                }
            }
        },

       // tampilkan titik 
        _showButton: function () {
            var _self = this;
            for (var i = 0, len = _self.button.length; i < len; i++) {
                if (_self.button[i].classList.contains('light')) {
                    _self.button[i].classList.remove('light');
                    break;
                }
            }
            _self.button[_self.indexB].classList.add('light');
        },

        // digunakan untuk mengikat event klik 
        _click: function (element, move) {
            var _self = this;
            element.off('click.gallery');
            element.on('click.gallery', function () {
                if (!this.isAnim) {
                    _self._navigate(move);
                    if (_self.options.autoplay) {
                        _self._startSlideshow();
                    }
                }
            });
        },

      // gaya awal 
        _layout: function () {
            this._setItems();

            this.$leftItm.css(this._getCoordinates('left'));
            this.$rightItm.css(this._getCoordinates('right'));
            this.$currentItm.css(this._getCoordinates('center')).addClass('dg-center');

            this._click(this.$leftItm, 'prev');
            this._click(this.$prevItm, 'prev');

            this.$currentItm.off('click.carrousel');

            this._click(this.$rightItm, 'next');
            this._click(this.$nextItm, 'next');

            this.$nextItm.css(this._getCoordinates('outright'));
            this.$prevItm.css(this._getCoordinates('outleft'));

            this.$currentItm[0].href = this.$currentItm[0].getAttribute('link');
        },

        // perbarui posisi gambar 
        _setItems: function () {

            this.$items.removeClass('dg-center');

            this.$currentItm = this.$items.eq(this.current);
            this.$leftItm = ( this.current === 0 ) ? this.$items.eq(this.itemsCount - 1) : this.$items.eq(this.current - 1);
            this.$rightItm = ( this.current === this.itemsCount - 1 ) ? this.$items.eq(0) : this.$items.eq(this.current + 1);
            this.$nextItm = ( this.$rightItm.index() === this.itemsCount - 1 ) ? this.$items.eq(0) : this.$rightItm.next();
            this.$prevItm = ( this.$leftItm.index() === 0 ) ? this.$items.eq(this.itemsCount - 1) : this.$leftItm.prev();
        },

        _loadEvents: function () {
            var _self = this;
            this.$navPrev.on('click.carrousel', function () {
                _self._navigate('prev');
                return false;
            });

            this.$navNext.on('click.carrousel', function () {
                _self._navigate('next');
                return false;
            });

            this.$wrapper.on('webkitTransitionEnd.carrousel transitionend.carrousel OTransitionEnd.carrousel', function () {
                _self.$currentItm.addClass('dg-center');
                _self.$items.removeClass('dg-transition');
                _self.$items.removeClass('dg-transition-fast');
                _self.isAnim = false;

                // menangani href dari elemen tengah 
                _self.$currentItm[0].href = _self.$currentItm[0].getAttribute('link');
                _self.$leftItm[0].href = '#';
                _self.$rightItm[0].href = '#';

                // menangani event klik dari elemen kiri dan kanan 
                _self._click(_self.$leftItm, 'prev');
                _self._click(_self.$prevItm, 'prev');

                _self.$currentItm.off('click.gallery');

                _self._click(_self.$rightItm, 'next');
                _self._click(_self.$nextItm, 'next');
            });
        },

        // tentukan gaya 
        _getCoordinates: function (position) {
            if (this.support3d) {
                switch (position) {
                    case 'outleft':
                        return {
                             'opacity': 0,
							'visibility': 'hidden'
                        };
                        break;
                    case 'outright':
                        return {
                             'opacity': 0,
							'visibility': 'hidden'
                        };
                        break;
                    case 'left':
                        return {
                            '-webkit-transform': 'translateX(-' + this.CSSX + 'px) translateZ(-300px) rotateY(-25deg)',
                            '-moz-transform': 'translateX(-' + this.CSSX + 'px) translateZ(-300px) rotateY(-25deg)',
                            '-o-transform': 'translateX(-' + this.CSSX + 'px) translateZ(-300px) rotateY(-25deg)',
                            '-ms-transform': 'translateX(-' + this.CSSX + 'px) translateZ(-300px) rotateY(-25deg)',
                            'transform': 'translateX(-' + this.CSSX + 'px) translateZ(-300px) rotateY(-25deg)',
                            'opacity': 1,
                            'visibility': 'visible'
                        };
                        break;
                    case 'right':
                        return {
                            '-webkit-transform': 'translateX(' + this.CSSX + 'px) translateZ(-300px) rotateY(25deg)',
                            '-moz-transform': 'translateX(' + this.CSSX + 'px) translateZ(-300px) rotateY(25deg)',
                            '-o-transform': 'translateX(' + this.CSSX + 'px) translateZ(-300px) rotateY(25deg)',
                            '-ms-transform': 'translateX(' + this.CSSX + 'px) translateZ(-300px) rotateY(25deg)',
                            'transform': 'translateX(' + this.CSSX + 'px) translateZ(-300px) rotateY(25deg)',
                            'opacity': 1,
                            'visibility': 'visible'
                        };
                        break;
                    case 'center':
                        return {
                            '-webkit-transform': 'translateX(0px) translateZ(0px) rotateY(0deg)',
                            '-moz-transform': 'translateX(0px) translateZ(0px) rotateY(0deg)',
                            '-o-transform': 'translateX(0px) translateZ(0px) rotateY(0deg)',
                            '-ms-transform': 'translateX(0px) translateZ(0px) rotateY(0deg)',
                            'transform': 'translateX(0px) translateZ(0px) rotateY(0deg)',
                            'opacity': 1,
                            'visibility': 'visible'
                        };
                        break;
                    case 'hide':
                        return {
                            '-webkit-transform': 'translate(0px) scale(0.7)',
                            'opacity': 1,
                            'visibility': 'visible',
                            'z-index': 1
                        };
                        break;
                }
            }
            else if (this.support2d) {
                switch (position) {
                    case 'outleft':
                        return {
                            '-webkit-transform': 'translate(-' + this.CSSXout + 'px) scale(0.8)',
                            '-moz-transform': 'translate(-' + this.CSSXout + 'px) scale(0.8)',
                            '-o-transform': 'translate(-' + this.CSSXout + 'px) scale(0.8)',
                            '-ms-transform': 'translate(-' + this.CSSXout + 'px) scale(0.8)',
                            'transform': 'translate(-' + this.CSSXout + 'px) scale(0.8)',
                            'opacity': 1,
                            'z-index': 2
                        };
                        break;
                    case 'outright':
                        return {
                            '-webkit-transform': 'translate(' + this.CSSXout + 'px) scale(0.8)',
                            '-moz-transform': 'translate(' + this.CSSXout + 'px) scale(0.8)',
                            '-o-transform': 'translate(' + this.CSSXout + 'px) scale(0.8)',
                            '-ms-transform': 'translate(' + this.CSSXout + 'px) scale(0.8)',
                            'transform': 'translate(' + this.CSSXout + 'px) scale(0.8)',
                            'opacity': 1,
                            'z-index': 2
                        };
                        break;
                    case 'left':
                        return {
                            '-webkit-transform': 'translate(-' + this.CSSX + 'px) scale(0.9)',
                            '-moz-transform': 'translate(-' + this.CSSX + 'px) scale(0.9)',
                            '-o-transform': 'translate(-' + this.CSSX + 'px) scale(0.9)',
                            '-ms-transform': 'translate(-' + this.CSSX + 'px) scale(0.9)',
                            'transform': 'translate(-' + this.CSSX + 'px) scale(0.9)',
                            'opacity': 1,
                            'visibility': 'visible',
                            'z-index': 3
                        };
                        break;
                    case 'right':
                        return {
                            '-webkit-transform': 'translate(' + this.CSSX + 'px) scale(0.9)',
                            '-moz-transform': 'translate(' + this.CSSX + 'px) scale(0.9)',
                            '-o-transform': 'translate(' + this.CSSX + 'px) scale(0.9)',
                            '-ms-transform': 'translate(' + this.CSSX + 'px) scale(0.9)',
                            'transform': 'translate(' + this.CSSX + 'px) scale(0.9)',
                            'opacity': 1,
                            'visibility': 'visible',
                            'z-index': 3
                        };
                        break;
                    case 'center':
                        return {
                            '-webkit-transform': 'translate(0px) scale(1)',
                            '-moz-transform': 'translate(0px) scale(1)',
                            '-o-transform': 'translate(0px) scale(1)',
                            '-ms-transform': 'translate(0px) scale(1)',
                            'transform': 'translate(0px) scale(1)',
                            'opacity': 1,
                            'visibility': 'visible',
                            'z-index': 4
                        };
                    case 'hide':
                        return {
                            '-webkit-transform': 'translate(0px) scale(0.7)',
                            '-moz-transform': 'translate(0px) scale(0.7)',
                            '-o-transform': 'translate(0px) scale(0.7)',
                            '-ms-transform': 'translate(0px) scale(0.7)',
                            'transform': 'translate(0px) scale(0.7)',
                            'opacity': 1,
                            'visibility': 'visible',
                            'z-index': 1
                        }
                        break;
                }
            }
        },

       // alihkan 
        _navigate: function (dir, speedClass) {
            speedClass = speedClass || 'dg-transition';
            if (!this.isAnim) {
                this._updateWidth();

                this.isAnim = true;
                var _self = this;

                switch (dir) {
                    case 'next' :
                        this.indexB++;
                        if (this.indexB === this.itemsCount) {
                            this.indexB = 0;
                        }
                        this._showButton();
                        this.current = this.$rightItm.index();
                        // current item moves left
                        this.$currentItm.addClass(speedClass).css(this._getCoordinates('left'));

                        // right item moves to the center
                        this.$rightItm.addClass(speedClass).css(this._getCoordinates('center'));

                        // left item moves out
                        this.$leftItm.addClass(speedClass).css(this._getCoordinates('outleft'));

                        this.$nextItm.addClass(speedClass).css(this._getCoordinates('right'));

                        if (this.itemsCount > 5) {
                            this.$prevItm.addClass(speedClass).css(this._getCoordinates('hide'));
                            this.$prevItm.off('click.carrousel');
                        }

                        var nextEle = ( this.$nextItm.index() === this.itemsCount - 1 ) ? this.$items.eq(0) : this.$nextItm.next();
                        $(nextEle).addClass(speedClass).css(this._getCoordinates('outright'));
                        $(nextEle).off('click.carrousel');

                        break;

                    case 'prev' :
                        this.indexB--;
                        if (this.indexB === -1) {
                            this.indexB = this.itemsCount - 1;
                        }
                        this._showButton();
                        this.current = this.$leftItm.index();
                        // current item moves right
                        this.$currentItm.addClass(speedClass).css(this._getCoordinates('right'));

                        // left item moves to the center
                        this.$leftItm.addClass(speedClass).css(this._getCoordinates('center'));

                        // right item moves out
                        this.$rightItm.addClass(speedClass).css(this._getCoordinates('outright'));

                        this.$prevItm.addClass(speedClass).css(this._getCoordinates('left'));

                        if (this.itemsCount > 5) {
                            this.$nextItm.addClass(speedClass).css(this._getCoordinates('hide'));
                            this.$nextItm.off('click.carrousel');
                        }

                        var prevEle = ( this.$prevItm.index() === 0 ) ? this.$items.eq(this.itemsCount - 1) : this.$prevItm.prev();
                        $(prevEle).addClass(speedClass).css(this._getCoordinates('outleft'));
                        $(prevEle).off('click.carrousel');

                        break;
                }
                ;
                this._setItems();
            }
        },

       // saklar otomatis 
        _startSlideshow: function () {
            if (this.slideshow) {
                clearInterval(this.slideshow);
            }
            var _self = this;
            this.slideshow = setInterval(function () {
                if ($('.dg-center')[0] && !_self.isAnim) {
                    _self._navigate('next');
                }
            }, this.options.interval);
        },

        _stopSlideshow: function () {
            clearTimeout(this.slideshow);
        }
    };

    $.fn.carrousel = function (options) {
        if (typeof options === 'object') {
            this.each(function () {
                var instance = $.data(this, 'carrousel');
                if (!instance) {
                    $.data(this, 'carrousel', new $.carrousel(options, this));
                }
            });
        }
        else if (typeof options === 'string') {
            this.each(function () {
                var instance = $.data(this, 'carrousel');
                if (instance) {
                    switch (options) {
                        case 'play':
                            instance._startSlideshow();
                            instance.options.autoplay = true;
                            break;
                        case 'stop':
                            instance._stopSlideshow();
                            instance.options.autoplay = false;
                            break;
                        case 'next':
                            instance._navigate('next');
                            break;
                        case 'prev':
                            instance._navigate('prev');
                            break;
                    }
                }
            });
        }
        else if (typeof options === 'number') {
            this.each(function () {
                var instance = $.data(this, 'carrousel');
                instance.button[options].click();
            });
        }
        return this;
    };

})(jQuery);
</script>
 
  </body>
</html>

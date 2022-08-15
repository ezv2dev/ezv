@extends('user.profile.layout-profile')

@section('title', 'User Profile - EZV2')

@section('content_admin')
<style>
/*! CSS Used from: http://127.0.0.1:8000/assets/partner/css/styles.css */
*,*::before,*::after{box-sizing:border-box;}
h6{font-family:"Poppins", sans-serif;}
p,div,span,input{font-family:"Poppins", sans-serif;}
h6{margin-top:0;margin-bottom:0.5rem;}
a{color:#ff7400;text-decoration:none;background-color:transparent;}
a:hover{color:#222222;text-decoration:underline;}
a:not([href]){color:inherit;text-decoration:none;}
a:not([href]):hover{color:inherit;text-decoration:none;}
img{vertical-align:middle;border-style:none;}
svg{overflow:hidden;vertical-align:middle;}
label{display:inline-block;margin-bottom:0.5rem;}
button{border-radius:0;}
button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color;}
input,button{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button,input{overflow:visible;}
button{text-transform:none;}
[role="button"]{cursor:pointer;}
button,[type="button"]{-webkit-appearance:button;}
button::-moz-focus-inner,[type="button"]::-moz-focus-inner{padding:0;border-style:none;}
input[type="checkbox"]{box-sizing:border-box;padding:0;}
h6{margin-bottom:0.5rem;font-weight:500;line-height:1.2;color:#222222;}
h6{font-size:1rem;}

.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:0.5rem 0;margin:0.125rem 0 0;font-size:1rem;color:#687281;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:1px solid #e3e6ec;border-radius:0.35rem;}
.dropdown-menu-right{right:0;left:auto;}
.dropdown-item{display:block;width:100%;padding:0.25rem 1.5rem;clear:both;font-weight:400;color:#222222;text-align:inherit;white-space:nowrap;background-color:transparent;border:0;}
.dropdown-item:hover,.dropdown-item:focus{color:#172130;text-decoration:none;background-color:#eff3f9;}
.dropdown-item:active{color:#fff;text-decoration:none;background-color:#ff7400;}
.dropdown-item:disabled{color:#687281;pointer-events:none;background-color:transparent;}
.dropdown-header{display:block;padding:0.5rem 1.5rem;margin-bottom:0;font-size:0.875rem;color:#687281;white-space:nowrap;}
.navbar-toggler{padding:0.25rem 0.75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:0.35rem;}
.navbar-toggler:hover,.navbar-toggler:focus{text-decoration:none;}
.d-flex{display:flex!important;}
.flex-fill{flex:1 1 auto!important;}
.justify-content-end{justify-content:flex-end!important;}
.align-items-center{align-items:center!important;}
.shadow{box-shadow:0 0.15rem 1.75rem 0 rgba(31, 45, 65, 0.15)!important;}
@media (min-width: 992px){
.mb-lg-0{margin-bottom:0!important;}
}
.text-center{text-align:center!important;}
@media print{
*,*::before,*::after{text-shadow:none!important;box-shadow:none!important;}
a:not(.btn){text-decoration:underline;}
img{page-break-inside:avoid;}
}
.animated--fade-in-up{-webkit-animation-name:fadeInUp;animation-name:fadeInUp;-webkit-animation-duration:300ms;animation-duration:300ms;-webkit-animation-timing-function:margin cubic-bezier(0.18, 1.25, 0.4, 1),          opacity cubic-bezier(0, 1, 0.4, 1);animation-timing-function:margin cubic-bezier(0.18, 1.25, 0.4, 1),          opacity cubic-bezier(0, 1, 0.4, 1);}
.animated--fade-in-up.dropdown-menu{margin-top:0;top:0.125rem!important;}
.dropdown-menu{font-size:0.9rem;border:none;box-shadow:0 0.15rem 1.75rem 0 rgba(31, 45, 65, 0.15);}
.dropdown-menu .dropdown-header{font-size:0.75rem;font-weight:700;display:flex;align-items:center;}
.dropdown-menu .dropdown-item{display:flex;align-items:center;}
.dropdown-menu .dropdown-item .dropdown-item-icon{margin-right:0.5rem;line-height:1;}
.dropdown-menu .dropdown-item .dropdown-item-icon svg{height:0.9em;width:0.9em;}
.dropdown-menu .dropdown-item:active .dropdown-item-icon{color:#fff;}
.feather{height:1rem;width:1rem;vertical-align:top;}
*,*:before,*:after{box-sizing:border-box;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-shadow:1px 1px 1px rgba(0, 0, 0, 0.04);}
.navbar-toggler{position:absolute;right:6%;top:29px;}
/*! CSS Used from: Embedded ; media=all */
@media all{
.fa-solid{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:var(--fa-display,inline-block);font-style:normal;font-variant:normal;line-height:1;text-rendering:auto;}
.fa-bars:before{content:"\f0c9";}
.fa-solid{font-family:"Font Awesome 6 Free";font-weight:900;}
}
/*! CSS Used from: Embedded */
a:hover{color:#ff7400!important;}
/*! CSS Used from: Embedded */
*,::after,::before{box-sizing:border-box;}
h6{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;}
h6{font-size:1rem;}
a{color:#0d6efd;text-decoration:underline;}
a:hover{color:#0a58ca;}
img{vertical-align:middle;}
label{display:inline-block;}
button{border-radius:0;}
button:focus:not(:focus-visible){outline:0;}
button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button{text-transform:none;}
[role=button]{cursor:pointer;}
[type=button],button{-webkit-appearance:button;}
::-moz-focus-inner{padding:0;border-style:none;}

.dropdown-menu{position:absolute;top:100%;z-index:1000;display:none;min-width:10rem;padding:.5rem 0;margin:0;font-size:1rem;color:#212529;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.15);border-radius:.25rem;}
.dropdown-item{display:block;width:100%;padding:.25rem 1rem;clear:both;font-weight:400;color:#212529;text-align:inherit;text-decoration:none;white-space:nowrap;background-color:transparent;border:0;}
.dropdown-item:focus,.dropdown-item:hover{color:#1e2125;background-color:#e9ecef;}
.dropdown-item:active{color:#fff;text-decoration:none;background-color:#0d6efd;}
.dropdown-item:disabled{color:#adb5bd;pointer-events:none;background-color:transparent;}
.dropdown-header{display:block;padding:.5rem 1rem;margin-bottom:0;font-size:.875rem;color:#6c757d;white-space:nowrap;}
.navbar-toggler{padding:.25rem .75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:.25rem;transition:box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.navbar-toggler{transition:none;}
}
.navbar-toggler:hover{text-decoration:none;}
.navbar-toggler:focus{text-decoration:none;outline:0;box-shadow:0 0 0 .25rem;}
.d-flex{display:flex!important;}
.shadow{box-shadow:0 .5rem 1rem rgba(0,0,0,.15)!important;}
.flex-fill{flex:1 1 auto!important;}
.justify-content-end{justify-content:flex-end!important;}
.align-items-center{align-items:center!important;}
.ps-1{padding-left:.25rem!important;}
.text-center{text-align:center!important;}
@media (min-width:992px){
.mb-lg-0{margin-bottom:0!important;}
}
@media all{
.fa-solid{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:var(--fa-display,inline-block);font-style:normal;font-variant:normal;line-height:1;text-rendering:auto;}
.fa-bars:before{content:"\f0c9";}
.fa-solid{font-family:"Font Awesome 6 Free";font-weight:900;}
}
button::-moz-focus-inner{padding:0;border:0;}
*,::after,::before{box-sizing:border-box;}
h6{margin-top:0;margin-bottom:1.375rem;font-weight:600;line-height:1.25;}
h6{font-size:1rem;}
a{color:#ff7400;text-decoration:none;}
a:hover{text-decoration:none;}
img{vertical-align:middle;}
label{display:inline-block;}
button{border-radius:0;}
button:focus:not(:focus-visible){outline:0;}
button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button{text-transform:none;}
[role="button"]{cursor:pointer;}
[type="button"],button{-webkit-appearance:button;}
::-moz-focus-inner{padding:0;border-style:none;}
.dropdown-menu{position:absolute;z-index:1000;display:none;min-width:12rem;padding:.5rem 0;margin:0;font-size:1rem;color:#343a40;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:0 solid #dfe4f1;border-radius:.25rem;}
.dropdown-item{display:block;width:100%;padding:.375rem .75rem;clear:both;font-weight:400;color:#343a40;text-align:inherit;white-space:nowrap;background-color:transparent;border:0;}
.dropdown-item:focus,.dropdown-item:hover{color:#343a40;background-color:#edf0f7;}
.dropdown-item:active{color:#fff;text-decoration:none;background-color:#ff7400;}
.dropdown-item:disabled{color:#adb5bd;pointer-events:none;background-color:transparent;}
.dropdown-header{display:block;padding:.5rem .75rem;margin-bottom:0;font-size:.875rem;color:#6c757d;white-space:nowrap;}
.navbar-toggler{padding:.25rem .75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:.25rem;transition:box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.navbar-toggler{transition:none;}
}
.navbar-toggler:hover{text-decoration:none;}
.navbar-toggler:focus{text-decoration:none;outline:0;box-shadow:0 0 0 .25rem;}
.d-flex{display:flex!important;}
.shadow{box-shadow:0 .5rem 1rem rgba(0,0,0,0.15)!important;}
.flex-fill{flex:1 1 auto!important;}
.justify-content-end{justify-content:flex-end!important;}
.align-items-center{align-items:center!important;}
.ps-1{padding-left:.25rem!important;}
.text-center{text-align:center!important;}
@media (min-width:992px){
.mb-lg-0{margin-bottom:0!important;}
}
a{transition:color .12s ease-out;}
.dropdown-menu{padding-right:.5rem;padding-left:.5rem;box-shadow:0 .25rem 2rem rgba(0,0,0,0.08);}
.dropdown-item{margin-bottom:.25rem;border-radius:.25rem;}
.fa-bars:before{content:"\f0c9";}
h6{font-family:"Poppins",sans-serif;color:#000;}
p,div,span,input{font-family:"Poppins";color:#000;}
*{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins";}
a{color:#ff7400;}
.searchbox{margin:0 auto;padding:.5rem 20px;border-radius:13px;border:2px solid #ff7400;}
::placeholder{font-size:.75rem;}
.searchbox p{margin-top:10px;margin-bottom:10px;color:#b9b9b9;text-align:left;font-size:13px;}
.right-bar{z-index:111;}
.font-black{color:black!important;}
.villa-list-header-logo{display:flex!important;padding:0;}
.list-villa-user{text-align:right!important;display:flex!important;position:relative!important;}
@media only screen and (max-width:1366px){
.list-villa-user{text-align:right!important;display:flex!important;position:relative!important;}
}
@media only screen and (max-width:1290px){
.list-villa-user{text-align:right!important;display:flex!important;position:relative!important;}
}
button{background:0;color:inherit;border:0;padding:0;font:inherit;cursor:pointer;outline:inherit;}
a[type="button"]{-webkit-appearance:none!important;}
@media only screen and (min-width:992px) and (max-width:1290px){
.searchbox{width:60%!important;}
}
@media only screen and (max-width:991px){
.search-box{height:0!important;}
#searchbox{display:none!important;}
#navbar-first-dekstop{padding-top:.7rem!important;padding-bottom:.5rem!important;padding-left:0rem!important;padding-right:0rem!important;}
}
@media only screen and (max-width:300px){
.search-box p{font-size:11px!important;}
}
.navbar-gap{font-size:15px;transition:.3s;}
@media only screen and (max-width:991px){
.top-search{padding:4px 12px!important;font-size:.8rem!important;height:30px!important;border-radius:40px!important;width:45px!important;}
.max-h-50{max-height:0!important;}
}
.navbar-toggler{padding:0 0 0 15px;}
i.fa-solid.fa-bars{font-size:30px;}
.list-villa-user{height:70px;margin-top:5px;justify-content:end;align-items:center;-webkit-justify-content:flex-end;}
.nav-row{margin:0;display:flex;align-items:center;padding-left:102px;padding-right:102px;}
.dropdown-header{padding:.5rem 1.5rem!important;}
.user-dropdown-menu{border:2px solid #ff7400!important;border-radius:12px!important;margin-top:38px!important;}
.dropdown-menu .dropdown-header .dropdown-user-img{height:2.5rem;width:2.5rem;margin-right:1rem;border-radius:100%;}
.dropdown-menu .dropdown-header .dropdown-user-details .dropdown-user-details-name{color:#222;font-weight:500;font-size:.9rem;max-width:10rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.dropdown-menu .dropdown-header .dropdown-user-details .dropdown-user-details-email{color:#687281;font-size:.75rem;max-width:10rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.dropdown-item{display:block!important;width:100%!important;padding:.25rem 1.5rem!important;clear:both!important;font-weight:400!important;color:#222!important;text-align:inherit!important;white-space:nowrap!important;background-color:transparent!important;border:0!important;font-size:.9rem!important;font-family:"Poppins"!important;}
.container-mode{position:relative;width:100%;height:100%;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}
.container-mode input{position:absolute;opacity:0;cursor:pointer;height:0;width:0;}
.checkmark-mode{position:relative;display:block;height:100%;background-color:transparent;}
.checkmark-mode::before{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:18px;height:18px;content:url(http://127.0.0.1:8000/assets/icon/menu/sun.svg);}
.container-mode input:checked ~ .checkmark-mode{background-color:transparent;}
.checkmark-mode:after{content:"";position:absolute;display:none;}
.container-mode input:checked ~ .checkmark-mode::before{content:url(http://127.0.0.1:8000/assets/icon/menu/moon.svg);}
.searchbox-display-block{transform:scale(1)!important;transition:all .2s ease!important;}
.max-h-50{max-height:50px;}
*,*:before,*:after{box-sizing:border-box;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-shadow:1px 1px 1px rgba(0,0,0,0.04);}
.logged-user-menu{display:inline-block;width:80px;background-image:linear-gradient(to right,#fea429,#fd6920);border-radius:20px;padding:5px;}
.logged-user-photo{width:35px;height:35px;border:solid 2px white;border-radius:50%;}
.top-search{position:absolute;top:50%;right:5px;padding:8px;transform:translateY(-50%);background:#ff7400;color:#fff!important;font-size:.8rem;height:38px;border-radius:15%;width:38px;border:solid 1px #ff7400;}
@media only screen and (max-width:425px){
.nav-row{padding-left:.8rem!important;padding-right:.8rem!important;}
}
@media only screen and (min-width:426px) and (max-width:549px){
.nav-row{padding-right:1.5rem!important;padding-left:1.5rem!important;}
}
@media only screen and (min-width:550px) and (max-width:991px){
.nav-row{padding-right:40px;padding-left:40px;}
}
@media only screen and (max-width:991px){
.nav-row{display:block!important;transition:none!important;}
#navbar-collapse-button{display:flex!important;}
#nav-end-dekstop{display:none!important;}
#searchbox{width:100%!important;}
}
@media only screen and (min-width:992px){
#navbar-collapse-button{display:none!important;}
}
@media only screen and (min-width:992px) and (max-width:1119px){
.searchbox-villa p{font-size:10.6px!important;}
}
.right-bar{text-align:right;display:flex;position:relative;}
.dropdown-menu{border-radius:15px!important;min-width:220px;}
.dropdown-menu:hover{background-color:white!important;}
.btn-filter-header{outline:0;background:#ff7400;border-radius:40px;margin-right:5px;padding:0 12px;}
::placeholder{font-size:1rem!important;}
input::-ms-reveal,input::-ms-clear{display:none;}
::placeholder{font-size:1rem!important;}
.text-center{text-align:center;}
/*! CSS Used from: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css */
.fa-solid{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:var(--fa-display,inline-block);font-style:normal;font-variant:normal;line-height:1;text-rendering:auto;}
.fa-bars:before{content:"\f0c9";}
.fa-solid{font-family:"Font Awesome 6 Free";font-weight:900;}
/*! CSS Used keyframes */
@-webkit-keyframes fadeInUp{0%{opacity:0;margin-top:0.75rem;}100%{opacity:1;margin-top:0;}}
@keyframes fadeInUp{0%{opacity:0;margin-top:0.75rem;}100%{opacity:1;margin-top:0;}}
/*! CSS Used fontfaces */
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:"Poppins";font-style:normal;font-weight:normal;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tDMPKzSQ.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tMMPKzSQ.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tCMPI.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucHtA.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucHtA.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F,U+1CD0-1CF6,U+1CF8-1CF9,U+200C-200D,U+20A8,U+20B9,U+25CC,U+A830-A839,U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F,U+0259,U+1E00-1EFF,U+2020,U+20A0-20AB,U+20AD-20CF,U+2113,U+2C60-2C7F,U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+2000-206F,U+2074,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tDMPKzSQ.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tMMPKzSQ.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tCMPI.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucHtA.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucHtA.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:400;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:900;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:400;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:900;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:400;font-display:block;src:url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-regular-400.woff2) format("woff2"),url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:900;font-display:block;src:url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-solid-900.woff2) format("woff2"),url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/webfonts/fa-solid-900.ttf) format("truetype");}
</style>
<style>
/*! CSS Used from: https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css */
*,::after,::before{box-sizing:border-box;}
[tabindex="-1"]:focus:not(:focus-visible){outline:0!important;}
a{color:#0d6efd;text-decoration:underline;}
a:hover{color:#0a58ca;}
a:not([href]):not([class]),a:not([href]):not([class]):hover{color:inherit;text-decoration:none;}
img,svg{vertical-align:middle;}
button{border-radius:0;}
button:focus:not(:focus-visible){outline:0;}
button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button{text-transform:none;}
[type=button],button{-webkit-appearance:button;}
::-moz-focus-inner{padding:0;border-style:none;}
.img-fluid{max-width:100%;height:auto;}
.col-12{flex:0 0 auto;width:100%;}
@media (min-width:992px){
.col-lg-6{flex:0 0 auto;width:50%;}
.col-lg-10{flex:0 0 auto;width:83.3333333333%;}
.col-lg-12{flex:0 0 auto;width:100%;}
}
.d-flex{display:flex!important;}
.h-auto{height:auto!important;}
.justify-content-center{justify-content:center!important;}
.justify-content-between{justify-content:space-between!important;}
.mt-0{margin-top:0!important;}
.mt-1{margin-top:.25rem!important;}
.mb-2{margin-bottom:.5rem!important;}
.mb-3{margin-bottom:1rem!important;}
.ms-0{margin-left:0!important;}
/*! CSS Used from: Embedded ; media=all */
@media all{
.fa{font-family:var(--fa-style-family,"Font Awesome 6 Free");font-weight:var(--fa-style,900);}
.fa,.fa-solid,.fas{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:var(--fa-display,inline-block);font-style:normal;font-variant:normal;line-height:1;text-rendering:auto;}
.fa-2x{font-size:2em;}
.fa-lg{font-size:1.25em;line-height:.05em;vertical-align:-.075em;}
.fa-heart:before{content:"\f004";}
.fa-location-dot:before{content:"\f3c5";}
.fa-play:before{content:"\f04b";}
.fa-solid,.fas{font-family:"Font Awesome 6 Free";font-weight:900;}
}
/*! CSS Used from: http://127.0.0.1:8000/assets/js/plugins/magnific-popup/magnific-popup.css */
button::-moz-focus-inner{padding:0;border:0;}
/*! CSS Used from: http://127.0.0.1:8000/assets/js/plugins/slick-carousel/slick.css */
.slick-slider{position:relative;display:block;box-sizing:border-box;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-touch-callout:none;-khtml-user-select:none;-ms-touch-action:pan-y;touch-action:pan-y;-webkit-tap-highlight-color:transparent;}
.list-slider .slick-list{position:relative;display:block;overflow:hidden;height:auto;margin:0;padding:0;}
.slick-list:focus{outline:none;}
.slick-slider .slick-track,.slick-slider .slick-list{-webkit-transform:translate3d(0, 0, 0);-moz-transform:translate3d(0, 0, 0);-ms-transform:translate3d(0, 0, 0);-o-transform:translate3d(0, 0, 0);transform:translate3d(0, 0, 0);}
.slick-track{position:relative;top:0;left:0;display:block;margin-left:auto;margin-right:auto;}
.slick-track:before,.slick-track:after{display:table;content:'';}
.slick-track:after{clear:both;}
.slick-slide{display:none;float:left;height:100%;min-height:1px;}
.slick-slide img{display:block;}
.slick-initialized .slick-slide{display:block;}
/*! CSS Used from: http://127.0.0.1:8000/assets/js/plugins/slick-carousel/slick-theme.css */
.slick-prev,.slick-next{font-size:0;line-height:0;position:absolute;top:50%;display:block;width:20px;height:20px;padding:0;-webkit-transform:translate(0, -50%);-ms-transform:translate(0, -50%);transform:translate(0, -50%);cursor:pointer;color:transparent;border:none;outline:none;background:transparent;}
.slick-prev:hover,.slick-prev:focus,.slick-next:hover,.slick-next:focus{color:transparent;outline:none;background:transparent;}
.slick-prev:hover:before,.slick-prev:focus:before,.slick-next:hover:before,.slick-next:focus:before{opacity:1;}
.slick-prev:before,.slick-next:before{font-family:'slick';font-size:20px;line-height:1;opacity:.75;color:white;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}
.slick-prev{left:-25px;}
.slick-prev:before{content:'←';}
.slick-next{right:-25px;}
.slick-next:before{content:'→';}
/*! CSS Used from: http://127.0.0.1:8000/assets/css/dashmix.min.css */
*,::after,::before{box-sizing:border-box;}
a{color:#ff7400;text-decoration:none;}
a:hover{text-decoration:none;}
a:not([href]):not([class]),a:not([href]):not([class]):hover{color:inherit;text-decoration:none;}
img,svg{vertical-align:middle;}
button{border-radius:0;}
button:focus:not(:focus-visible){outline:0;}
button,input{margin:0;font-family:inherit;font-size:inherit;line-height:inherit;}
button{text-transform:none;}
[type="button"],button{-webkit-appearance:button;}
::-moz-focus-inner{padding:0;border-style:none;}
.img-fluid{max-width:100%;height:auto;}
.col-12{flex:0 0 auto;width:100%;}
@media (min-width: 992px){
.col-lg-6{flex:0 0 auto;width:50%;}
.col-lg-10{flex:0 0 auto;width:83.33333333%;}
.col-lg-12{flex:0 0 auto;width:100%;}
}
.d-flex{display:flex!important;}
.h-auto{height:auto!important;}
.justify-content-center{justify-content:center!important;}
.justify-content-between{justify-content:space-between!important;}
.mt-0{margin-top:0!important;}
.mt-1{margin-top:0.25rem!important;}
.mb-2{margin-bottom:0.5rem!important;}
.mb-3{margin-bottom:1rem!important;}
.ms-0{margin-left:0!important;}
a{transition:color 0.12s ease-out;}
.content{width:100%;margin:0 auto;padding:0.875rem 0.875rem 1px;overflow-x:visible;}
@media (min-width: 768px){
.content{width:100%;margin:0 auto;padding:1.75rem 1.75rem 1px;overflow-x:visible;}
}
#page-container > #main-container .content{max-width:1920px;}
.fa,.fas{-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;display:inline-block;font-style:normal;font-variant:normal;text-rendering:auto;line-height:1;}
.fa-lg{font-size:1.3333333333em;line-height:0.75em;vertical-align:-0.0667em;}
.fa-2x{font-size:2em;}
.fa-heart:before{content:"\f004";}
.fa-play:before{content:"\f04b";}
.fa,.fas{font-family:"Font Awesome 5 Free";font-weight:900;}
.slick-slider .slick-slide{outline:0;}
.slick-slider .slick-next,.slick-slider .slick-prev{width:2.5rem;height:3.75rem;text-align:center;background-color:rgba(0, 0, 0, 0.03);z-index:2;}
.slick-slider .slick-next:hover,.slick-slider .slick-prev:hover{background-color:rgba(0, 0, 0, 0.15);}
.slick-slider .slick-next::before,.slick-slider .slick-prev::before{font-family:"Font Awesome 5 Free", "Font Awesome 5 Pro";font-weight:600;font-size:28px;line-height:28px;color:#044792;}
.slick-slider .slick-prev{left:0;}
.slick-slider .slick-prev::before{content:"\f104";}
.slick-slider .slick-next{right:0;}
.slick-slider .slick-next::before{content:"\f105";}
.slick-slider.slick-nav-black .slick-next,.slick-slider.slick-nav-black .slick-prev{background-color:rgba(0, 0, 0, 0.25);}
.slick-slider.slick-nav-black .slick-next:hover,.slick-slider.slick-nav-black .slick-prev:hover{background-color:#000;}
.slick-slider.slick-nav-black .slick-next::before,.slick-slider.slick-nav-black .slick-prev::before{color:#fff;}
/*! CSS Used from: http://127.0.0.1:8000/assets/css/list-villa.css */
div,span,input{font-family:"Poppins";color:#000;}
*{margin:0;padding:0;box-sizing:border-box;font-family:"Poppins";}
.like-sign{display:none;position:absolute;top:50%;left:50%;z-index:1;font-size:55px;transform:translate(-50%, -50%);}
video{width:1000px;height:auto;}
a{color:#ff7400;}
.slick-prev::before,.slick-next::before{opacity:0.5;}
@media only screen and (max-width: 480px){
.video-button{margin-top:0;margin-left:0;}
}
@media only screen and (max-width: 360px){
.video-button{margin-top:-69px!important;margin-left:275px!important;}
}
.video-button{position:absolute;color:#fff;font-size:12px!important;padding:8px;}
.video-button:hover{color:#ff7400;}
a:not([href]):not([class]),a:not([href]):not([class]):hover{border:none;}
.content{padding:0.75rem;}
.slick-slider .slick-track,.slick-slider{border-radius:15px;}
.slick-slider{border-radius:0px;}
.slick-list{border-radius:15px;}
.box-shadow-light{box-shadow:1px 1px 15px rgb(0 0 0 / 16%);}
.slick-slider.slick-nav-black .slick-next,.slick-slider.slick-nav-black .slick-prev,.slick-slider.slick-nav-black .slick-next:hover,.slick-slider.slick-nav-black .slick-prev:hover{background-color:transparent;}
.slick-slider .slick-next::before{content:"\f054";}
.slick-slider.slick-nav-black .slick-next::before,.slick-slider.slick-nav-black .slick-prev::before{text-shadow:2px 2px 5px #000;}
.slick-slider .slick-prev::before{content:"\f053";}
::placeholder{font-size:0.75rem;}
.grid-image-container{box-sizing:border-box;}
.grid-desc-container{position:relative;height:350px;display:flex;}
.list-image-container{padding-right:0px;}
.list-image-content{padding:0px;}
.slick-slide{width:570px;}
.grid-image{height:350px;object-fit:cover;width:100%;}
.font-black{color:black!important;}
.orange-hover:hover{color:#ff7400;}
button{background:none;color:inherit;border:none;padding:0;font:inherit;cursor:pointer;outline:inherit;}
.favorite-button-28{height:28px;width:28px;}
.favorite-button{display:block;fill:rgba(0, 0, 0, 0.5);stroke:white;stroke-width:2;overflow:visible;}
.favorite-button-active{display:block;fill:#e31c5f;stroke:white;stroke-width:2;overflow:visible;}
.dots-container{position:absolute;bottom:5px;width:95%;z-index:1;}
.dots-container .circle.activeIndicator{border:solid 5px white;width:8px;height:8px;margin-top:-1px;margin-bottom:5px;}
.dots-container .circle{width:8px;height:8px;margin-left:2px;margin-right:2px;background-color:rgba(255, 255, 255, 0.6);border-radius:50%;}
@media only screen and (max-width: 649px){
.video-button{margin-top:0px!important;margin-left:0px!important;}
}
@media only screen and (min-width: 615px) and (max-width: 648px){
.slick-slide{width:600px;}
}
@media only screen and (min-width: 649px) and (max-width: 991px){
.slick-slide{width:768px;}
}
@media only screen and (max-width: 575px){
.slick-arrow{display:none!important;}
}
@media only screen and (min-width: 576px){
.dots-container{display:none!important;}
}
@media only screen and (min-width: 769px){
.like-sign{font-size:70px;}
}
@media only screen and (min-width: 992px){
.mt-lg-10p{margin-top:10px!important;}
}
a.orange-hover{margin-left:10px;top:-2px;position:relative;}
/*! CSS Used from: http://127.0.0.1:8000/assets/css/list-restaurant.css */
.container-grid{grid-template-columns:repeat( 1, minmax(0, 1fr) );grid-template-rows:repeat(1, auto);gap:15px;display:grid;padding-left:30px;padding-right:30px;margin-top:20px;margin-bottom:40px;transition:all 0.2s ease;}
.desc-container-grid{grid-template-rows:repeat(1, auto)!important;grid-template-columns:1fr minmax(auto, 25%);gap:2px;display:grid;position:relative;}
.grid-one-line{grid-column:1 / -1;}
.h-auto{height:auto!important;}
.aspect-ratio-2{aspect-ratio:3/4!important;}
.grid-overlay-desc{position:absolute;width:100%;height:70px;top:0px;}
.max-lines{display:block;text-overflow:ellipsis;white-space:nowrap;word-wrap:break-word;overflow:hidden;max-height:4.5em;line-height:1.5em;}
@media (max-width: 549px){
.container-grid .list-image-content .aspect-ratio-2{height:350px!important;}
}
@media (min-width: 550px){
.container-grid{grid-template-columns:repeat( 2, minmax(0, 1fr) );grid-template-rows:repeat(1, auto)!important;gap:15px;display:grid;padding-left:40px;padding-right:40px;margin-bottom:45px;}
}
@media (min-width: 950px){
.container-grid{grid-template-columns:repeat( 3, minmax(0, 1fr) );grid-template-rows:repeat(1, auto)!important;gap:15px;display:grid;padding-left:102px;padding-right:102px;margin-bottom:40px;}
}
@media (min-width: 1128px){
.container-grid{grid-template-columns:repeat( 4, minmax(0, 1fr) );grid-template-rows:repeat(1, auto)!important;gap:15px;display:grid;padding-left:102px;padding-right:102px;margin-bottom:50px;}
}
@media (min-width: 1606px){
.container-grid{grid-template-columns:repeat( 5, minmax(0, 1fr) );grid-template-rows:repeat(1, auto)!important;gap:15px;display:grid;padding-left:102px;padding-right:102px;margin-bottom:40px;}
}
.slick-slider.slick-nav-black .slick-next,.slick-slider.slick-nav-black .slick-prev,.slick-slider.slick-nav-black .slick-next:hover,.slick-slider.slick-nav-black .slick-prev:hover{background-color:#fff;}
.slick-slider.slick-nav-black .slick-next{background-color:#fff;height:30px;width:30px;right:6px;border-radius:15px;border:solid 1px #999;opacity:0.8;}
.slick-slider.slick-nav-black .slick-prev{background-color:#fff;height:30px;width:30px;right:6px;border-radius:15px;border:solid 1px #999;opacity:0.8;}
.slick-slider.slick-nav-black .slick-next:hover,.slick-slider.slick-nav-black .slick-prev:hover{opacity:1;}
.slick-slider.slick-nav-black .slick-next::before,.slick-slider.slick-nav-black .slick-prev::before{color:#000;}
.slick-slider .slick-prev{left:6px;}
.slick-slider .slick-next::before,.slick-slider .slick-prev::before{font-size:16px;}
.slick-slider.slick-nav-black .slick-next::before,.slick-slider.slick-nav-black .slick-prev::before{text-shadow:none;}
.absolute-right{left:auto;right:10px;top:10px;position:absolute;z-index:99;}
.video-thumb-container{background-color:#ff7400;height:50px;width:50px;border-radius:50px;z-index:99;display:flex;align-items:center;justify-content:center;}
.video-thumb-content{background-color:black;width:46px;height:46px;border-radius:50px;display:flex;align-items:center;justify-content:center;}
.video-thumb{width:44px;height:44px;border-radius:50%;object-fit:cover;}
@media only screen and (max-width: 425px){
.list-slider .slick-list{margin-right:-2px;}
}
@media only screen and (min-width: 426px) and (max-width: 549px){
.container-grid{padding-right:1.5rem!important;padding-left:1.5rem!important;}
}
@media only screen and (min-width: 320px) and (max-width: 425px){
.container-grid{padding-left:0.8rem!important;padding-right:0.8rem!important;}
}
/*! CSS Used from: http://127.0.0.1:8000/assets/css/header-css.css */
.slick-slider{position:relative;display:block;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-touch-callout:none;-khtml-user-select:none;touch-action:pan-y;-webkit-tap-highlight-color:transparent;}
.slick-list{position:relative;display:block;overflow:hidden;margin:0;padding:0;}
.slick-list:focus{outline:none;}
.slick-slider .slick-track,.slick-slider .slick-list{transform:translate3d(0, 0, 0);}
.slick-track{position:relative;top:0;left:0;display:block;}
.slick-track:before,.slick-track:after{display:table;content:"";}
.slick-track:after{clear:both;}
.slick-slide{display:none;float:left;height:100%;min-height:1px;}
.slick-initialized .slick-slide{display:block;}
*,*:before,*:after{box-sizing:border-box;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;text-shadow:1px 1px 1px rgba(0, 0, 0, 0.04);}
.slick-slider div{transition:none;}
/*! CSS Used from: Embedded */
.limit-text-1{overflow:hidden;text-overflow:ellipsis;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;}
/*! CSS Used from: Embedded */
::placeholder{font-size:1rem!important;}
input::-ms-reveal,input::-ms-clear{display:none;}
/*! CSS Used from: Embedded */
::placeholder{font-size:1rem!important;}
/*! CSS Used from: Embedded */
.text-orange{color:#ff7400;}
/*! CSS Used from: Embedded */
.text-13{font-size:13px;}
.text-14{font-size:14px;}
.text-align-right{text-align:right;}
.fw-400{font-weight:400;}
.fw-500{font-weight:500;}
.text-grey-2{color:#ACACAC;}
.text-orange{color:#ff7400;}
/*! CSS Used fontfaces */
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:400;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 6 Free";font-style:normal;font-weight:900;font-display:block;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.ttf) format("truetype");}
@font-face{font-family:'slick';font-weight:normal;font-style:normal;src:url('http://127.0.0.1:8000/assets/js/plugins/slick-carousel/fonts/slick.eot');src:url('http://127.0.0.1:8000/assets/js/plugins/slick-carousel/fonts/slick.eot#iefix') format('embedded-opentype'), url('http://127.0.0.1:8000/assets/js/plugins/slick-carousel/fonts/slick.woff') format('woff'), url('http://127.0.0.1:8000/assets/js/plugins/slick-carousel/fonts/slick.ttf') format('truetype'), url('http://127.0.0.1:8000/assets/js/plugins/slick-carousel/fonts/slick.svg#slick') format('svg');}
@font-face{font-family:"Font Awesome 5 Free";font-display:block;font-weight:900;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 5 Free";font-display:block;font-weight:400;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 5 Free";font-display:block;font-weight:900;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-solid-900.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 5 Free";font-display:block;font-weight:400;src:url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.woff2) format("woff2"),url(https://ka-f.fontawesome.com/releases/v6.1.2/webfonts/free-fa-regular-400.ttf) format("truetype");}
@font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:400;font-display:block;src:url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.eot);src:url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.eot#iefix)              format("embedded-opentype"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.woff2) format("woff2"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.woff) format("woff"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.ttf) format("truetype"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-regular-400.svg#fontawesome) format("svg");}
@font-face{font-family:"Font Awesome 5 Free";font-style:normal;font-weight:900;font-display:block;src:url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.eot);src:url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.eot#iefix)              format("embedded-opentype"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.woff2) format("woff2"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.woff) format("woff"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.ttf) format("truetype"),          url(http://127.0.0.1:8000/assets/fonts/fontawesome/fa-solid-900.svg#fontawesome) format("svg");}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tDMPKzSQ.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tMMPKzSQ.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiAyp8kv8JHgFVrJJLmE0tCMPI.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmv1pVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm21lVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrJJLucHtA.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmg1hVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmr19VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLmy15VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm111VF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVFteOcEg.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVGdeOcEg.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:italic;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiDyp8kv8JHgFVrJJLm81xVF9eO.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucXtAKPY.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTufntAKPY.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:100;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiGyp8kv8JHgFVrLPTucHtA.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:200;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLFj_Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:300;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:500;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLGT9Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:600;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLEj6Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:700;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLCz7Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:800;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z11lFc-K.woff2) format('woff2');unicode-range:U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1JlFc-K.woff2) format('woff2');unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}
@font-face{font-family:'Poppins';font-style:normal;font-weight:900;font-display:swap;src:url(https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLBT5Z1xlFQ.woff2) format('woff2');unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
</style>
    <div class="container mb-5">
        <div class="row">
            <div class="col-2">
                <div class="row">
                    @if (Auth::user()->foto_profile != null)
                        <img class="img-fluid" src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                    @elseIf (Auth::user()->avatar != null)
                        <img class="img-fluid" src="{{ Auth::user()->avatar }}">
                    @else
                        <img class="img-fluid" src="{{ asset('assets/icon/menu/user_default.svg') }}">
                    @endif
                </div>
                <div class="row">
                    <p class="m-auto">add photo <i class="fas fa-plus"></i></p>
                </div>
                <div class="row">
                    <p class="m-auto">Get verified <i class="fas fa-check-square" style="color: #FF7400"></i></p>
                </div>
            </div>

            <div class="col-5">
                <div class="row">
                    <div class="col-4">
                        <p>
                            <b>Name</b>
                        </p>
                        <p>
                            <b>Lives in</b>
                        </p>

                        <p>
                            <b>Email</b>
                        </p>
                        <p>
                            <b>Phone</b>
                        </p>
                        <p>
                            <b>User ID</b>
                        </p>
                    </div>
                    <div class="col-8">
                        <p>: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </p>
                        <p>: @if (Auth::user()->address == null) - @else {{ Auth::user()->address }} @endif
                        </p>
                        <p>: {{ Auth::user()->email }}
                        </p>
                        <p>: @if (Auth::user()->phone == null) - @else {{ Auth::user()->phone }} @endif
                        </p>
                        <p style="color: #FF7400">: {{ Auth::user()->user_code }}
                        </p>
                    </div>
                </div>
                {{-- <p>
                    <b>Balance</b>
                    IDR {{ number_format($sumArray) }}
                </p> --}}

                <div class="col-6 pt-3" style="margin-left: 0; padding: 0;">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#exampleModal" style="background: #fff; color: #000; border-color: #000;">
                        Edit Profile
                    </button>
                </div>
            </div>

            <div class="col-5">
                <div class="row mb-3">
                <p class="mb-2"><h3><b>About me:</b></h3></p>
                    </div>
                    <div class="row mb-3">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            </div><div class="row">
                <p style="text-decoration: underline;"><b>Reviews(2)</b></p></div>
            </div>
        </div>
        <hr>
        <div id="new-bar-black" class="page-header-fixed d-flex flex-column bg-body-light pt-5p">
        <div class="px-0 row nav-row">
            <div id="navbar-first-dekstop" class="col-lg-2 logo mb-lg-0 villa-list-header-logo d-flex align-items-center">
                <button type="button" class="btn btn-primary btn-sm" style="background: #fff; color: #000; border-color: #000;">
                    List your Property
                </button>
               <div id="navbar-collapse-button" class="flex-fill d-flex justify-content-end">
                  <button type="button" class="btn-filter-header" onclick="moreSubCategory();">
                  <img src="http://127.0.0.1:8000/assets/icon/menu/filter.svg" style="width: 20px; height: auto;">
                  </button>
                  <div id="searchbox-mobile" class="searchbox searchbox-display-block searchbox-villa" onclick="popUp();" style="cursor: pointer; width: 50px; border: none; margin: 0px;">
                     <p>
                        <span class="top-search">
                           <img src="http://127.0.0.1:8000/assets/icon/menu/search.svg" style="width: 20px; height: auto;">
                           <!-- <i class="fa fa-search"></i> -->
                        </span>
                     </p>
                  </div>
                  <button class="navbar-toggler ps-1" type="button" id="expand-mobile-btn">
                  <i class="fa-solid fa-bars list-description font-black"></i>
                  </button>
               </div>
            </div>
            <div class="col-lg-8 search-box" style="height: 50px;">
               <div class="row">
                  <div class="col-12 text-center max-h-50">
                     <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();" style="cursor: pointer; width: 49%;">
                        <p>
                           Add Location
                           | Type of Villa
                           <span class="top-search">
                              <img src="http://127.0.0.1:8000/assets/icon/menu/search.svg" style="width: 20px; height: auto;">
                              <!-- <i class="fa fa-search"></i> -->
                           </span>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
            <div id="nav-end-dekstop" class="col-lg-2 list-villa-user right-bar" style="padding: 0px;">
               <div>
                <div class="row">
                <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 50px; height: 50px;">
                </div>
                <div class="row">
                <p style="text-decoration: underline;">View cart</p>
                </div>
               </div>
            </div>
         </div>
         <div class="row row-cat-container">
            <div id="myBtnContainer" class="menu col-12">
            </div>
         </div>
        </div>

        <div class="container-fluid">
            <h1 class="mt-2">Homes in Seminyak</h1>
            <div class="px-0 col-lg-12 container-grid container__grid translate-text-group mt-0 mt-lg-10p" style="padding-left: 143.5px; padding-right: 143.5px;">
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(24, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant24">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-24">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/24" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="24" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            <div class="circle" data-index="3"></div>
                            <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 13113px; transform: translate3d(-279px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 279px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" alt="EZV_1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 279px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/24" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">MeVui Vietnam Kitchen Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Taste of Vietnam at an affordable price.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            Chinese
                            &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(24, 'restaurant')" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant24">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                                </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-24">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/24" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                                <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="24" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                                <div class="circle activeIndicator" data-index="0"></div>
                                <div class="circle" data-index="1"></div>
                                <div class="circle" data-index="2"></div>
                                <div class="circle" data-index="3"></div>
                                <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                                <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                                <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 13113px; transform: translate3d(-279px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 279px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" alt="EZV_1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 279px;">

                                </div>
                                </div>
                                <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/24" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">MeVui Vietnam Kitchen Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Taste of Vietnam at an affordable price.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                                Chinese
                                &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                            <div class="">
                                <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                                <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                                Legian
                                </a>
                                <span>
                                09:00 AM - 10:00 PM
                                </span>
                            </div>
                            <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(20, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button-active favorite-button-28 unlikeButtonrestaurant20">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-20">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/20" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="20" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 1932px; transform: translate3d(-276px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/20" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 276px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" alt="EZV_1652855521_airsidebali-20220329-0001.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/20" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 276px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/20" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">Airside Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Life is a combination of magic and food ✨  Enjoy our food, beverage, view and atmosphere.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(16, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant16">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-16">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/16" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="16" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            <div class="circle" data-index="3"></div>
                            <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 27876px; transform: translate3d(-276px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/16" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 276px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" alt="EZV_1652841913_gourmetcafedewisri-20220331-0064.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/16" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 276px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/16" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">Gourmet Cafe Dewi Sri</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Healthy Food Option is here
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            Chinese
                            &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>

        <div class="container-fluid">
            <h1 class="mt-2">Homes in Canggu</h1>
            <div class="px-0 col-lg-12 container-grid container__grid translate-text-group mt-0 mt-lg-10p" style="padding-left: 143.5px; padding-right: 143.5px;">
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(24, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant24">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-24">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/24" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="24" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            <div class="circle" data-index="3"></div>
                            <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 13113px; transform: translate3d(-279px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 279px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" alt="EZV_1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 279px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/24" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">MeVui Vietnam Kitchen Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Taste of Vietnam at an affordable price.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            Chinese
                            &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(24, 'restaurant')" style="cursor: pointer;">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant24">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                                </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-24">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/24" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                                <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="24" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                                <div class="circle activeIndicator" data-index="0"></div>
                                <div class="circle" data-index="1"></div>
                                <div class="circle" data-index="2"></div>
                                <div class="circle" data-index="3"></div>
                                <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                                <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                                <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 13113px; transform: translate3d(-279px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 279px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" data-src="http://127.0.0.1:8000/foto/restaurant/872481652858084/1652859096_mevuibali-20220331-0022.webp" alt="EZV_1652859096_mevuibali-20220331-0022.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/24" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 279px;">

                                </div>
                                </div>
                                <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/24" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">MeVui Vietnam Kitchen Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Taste of Vietnam at an affordable price.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                                Chinese
                                &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                            <div class="">
                                <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                                <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                                Legian
                                </a>
                                <span>
                                09:00 AM - 10:00 PM
                                </span>
                            </div>
                            <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(20, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button-active favorite-button-28 unlikeButtonrestaurant20">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-20">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/20" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="20" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 1932px; transform: translate3d(-276px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/20" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 276px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" data-src="http://127.0.0.1:8000/foto/restaurant/924301652854918/1652855521_airsidebali-20220329-0001.webp" alt="EZV_1652855521_airsidebali-20220329-0001.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/20" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 276px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/20" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">Airside Bali</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Life is a combination of magic and food ✨  Enjoy our food, beverage, view and atmosphere.
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                <div class="grid-list-container" data-loaded="true">
                    <div class=" grid-image-container mb-3 grid-desc-container h-auto list-image-container">
                        <div style="position: absolute; z-index: 99; top: 10px; left: 10px;">
                            <a onclick="likeFavorit(16, 'restaurant')" style="cursor: pointer;">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" class="favorite-button favorite-button-28 likeButtonrestaurant16">
                                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z">
                                </path>
                            </svg>
                            </a>
                        </div>
                        <div class="like-sign like-sign-restaurant-16">
                            <i class="fa fa-heart fa-lg" style="color: #e31c5f" aria-hidden="true"></i>
                        </div>
                        <a href="http://127.0.0.1:8000/food/16" class="absolute-right" target="_blank">
                            <div class="video-thumb-container">
                            <div class="video-thumb-content">

                                <img class="video-thumb" src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-loaded="true">
                            </div>
                            </div>
                        </a>
                        <div class="content list-image-content" style="margin: 0; padding: 0; max-width: 1200px !important;">
                            <input type="hidden" value="16" id="id_restaurant" name="id_restaurant">
                            <div class="dots-container d-flex justify-content-center">
                            <div class="circle activeIndicator" data-index="0"></div>
                            <div class="circle" data-index="1"></div>
                            <div class="circle" data-index="2"></div>
                            <div class="circle" data-index="3"></div>
                            <div class="circle" data-index="4"></div>
                            </div>
                            <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true">
                            <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="display: none;">Previous</button>
                            <div class="slick-list draggable box-shadow-light" style="">
                                <div class="slick-track" style="opacity: 1; width: 27876px; transform: translate3d(-276px, 0px, 0px);"><a href="http://127.0.0.1:8000/food/16" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 276px;">
                                    <img class="lozad img-fluid grid-image aspect-ratio-2 h-auto" style="display: block;" src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" data-src="http://127.0.0.1:8000/foto/restaurant/758421652841692/1652841913_gourmetcafedewisri-20220331-0064.webp" alt="EZV_1652841913_gourmetcafedewisri-20220331-0064.webp" data-loaded="true">
                                    </a><a href="http://127.0.0.1:8000/food/16" target="_blank" class="col-lg-6 grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 276px;">

                                </div>
                            </div>
                            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="display: none;">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="desc-container-grid mb-2">
                        <a href="http://127.0.0.1:8000/food/16" target="_blank" class="grid-overlay-desc"></a>
                        <div class="max-lines">
                            <span class="text-14 fw-500 font-black list-description">Gourmet Cafe Dewi Sri</span>
                        </div>
                        <div class="text-align-right">
                            <span class="fw-500 text-align-right text-14 font-black list-description">
                            </span>
                        </div>
                        <div class="grid-one-line text-grey-2 max-lines col-lg-10">
                            <span class="text-14 fw-400 text-grey-2">
                            Healthy Food Option is here
                            </span>
                        </div>
                        <div class="">
                            <div style="min-height: 21px;" class="col-12 text-14 fw-400 limit-text-1 translate-text-group-items list-description font-black">
                            Chinese
                            &nbsp;
                            </div>
                        </div>
                        <div class="text-14 fw-400 text-grey-2 grid-one-line text-orange mt-1 d-flex justify-content-between" style="position: relative;">
                        <div class="">
                            <a class="ms-0 orange-hover" href="#!" onclick="view_maps('24')">
                            <i class="fa-solid fa-location-dot text-13 text-orange"></i>
                            Legian
                            </a>
                            <span>
                            09:00 AM - 10:00 PM
                            </span>
                        </div>
                        <div style="position: absolute; right: 5px; bottom: 5px;">
                            <img src="https://d1nhio0ox7pgb.cloudfront.net/_img/g_collection_png/standard/256x256/shopping_cart.png" style="width: 35px;height: 35px;" class="" alt="">
                        </div>
                        </div>
                    </div>
                </div>
                </div>
        </div>

            <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile_update', Auth::user()->id) }}" method="POST" id="basic-form"
                            class="js-validation" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="first_name">First Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Input First Name" value="{{ Auth::user()->first_name }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="last_name">Last Name</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Input Last Name" value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="address">Address</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Input Address" value="{{ Auth::user()->address }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="email">Email</label>
                                <div class="col-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Input Email" value="{{ Auth::user()->email }}">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <label class="col-4 col-form-label" for="phone">Phone</label>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="phone" name="phone"
                                        placeholder="Input Phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function popUp() {
            document.getElementById("myBtnContainer").classList.add("display-none");
            document.getElementById("searchbox").classList.remove("searchbox-display-block");
            document.getElementById("searchbox").classList.add("searchbox-display-none");
            document.getElementById("change_display_block").classList.remove("display-none");
            document.getElementById("change_display_block").classList.add("display-block");
            document.getElementById("new-bar-black").classList.add("header-popup-list");
            document.getElementById("new-bar-black").classList.add("search-height");
            document.getElementById("search_bar").classList.add("searchbar-list-display-block");
            document.getElementById("search_bar").classList.remove("searchbar-list-display-none");
            $("#overlay").css("display", "block");

            function addClass(elements, className) {
                for (var i = 0; i < elements.length; i++) {
                    var element = elements[i];
                    if (element.classList) {
                        element.classList.add(className);
                    } else {
                        element.className += ' ' + className;
                    }
                }
            }

            function removeClass(elements, className) {
                for (var i = 0; i < elements.length; i++) {
                    var element = elements[i];
                    if (element.classList) {
                        element.classList.remove(className);
                    } else {
                        element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(
                                ' ')
                            .join('|') + '(\\b|$)', 'gi'), ' ');
                    }
                }
            }

            var elss = document.getElementsByClassName("flatpickr-calendar");
            removeClass(elss, 'display-none');
        }
    </script>

    <script>
        window.onscroll = function() {
            whenScroll()
        };

        function whenScroll() {
            function addClass(elements, className) {
                for (var i = 0; i < elements.length; i++) {
                    var element = elements[i];
                    if (element.classList) {
                        element.classList.add(className);
                    } else {
                        element.className += ' ' + className;
                    }
                }
            }

            function removeClass(elements, className) {
                for (var i = 0; i < elements.length; i++) {
                    var element = elements[i];
                    if (element.classList) {
                        element.classList.remove(className);
                    } else {
                        element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ')
                            .join('|') + '(\\b|$)', 'gi'), ' ');
                    }
                }
            }

            var isFocused = document.querySelector("#loc_sugest") == document.activeElement ||
                document.querySelector("#search_sugest") == document.activeElement;

            if (!isFocused || window.innerWidth > 768) {
                document.getElementById("myBtnContainer").classList.remove("display-none");
                document.getElementById("searchbox").classList.add("searchbox-display-block");
                document.getElementById("searchbox").classList.remove("searchbox-display-none");
                document.getElementById("search_bar").classList.remove("active");
                document.getElementById("change_display_block").classList.add("display-none");
                document.getElementById("change_display_block").classList.remove("display-block");
                document.getElementById("new-bar-black").classList.remove("header-popup-list");
                document.getElementById("new-bar-black").classList.remove("search-height");
                document.getElementById("search_bar").classList.remove("searchbar-list-display-block");
                document.getElementById("search_bar").classList.add("searchbar-list-display-none");

                // hide overlay ketika scroll, dan ketika sidebar close di mobile size
                if ($('.expand-navbar-mobile').attr('aria-expanded') == 'false') {
                    $("#overlay").css("display", "none");
                }

                var els = document.getElementsByClassName("flatpickr-calendar");
                addClass(els, 'display-none');
            }
        }
    </script>
@endsection

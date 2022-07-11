Dashmix.helpersOnLoad(["jq-slick"]);
Dashmix.helpersOnLoad(["jq-magnific-popup"]);

//edit photo profile
function edit_collab_profile() {
    $("#modal-edit_collab_profile").modal("show");
}

function edit_location() {
    $("#modal-edit_location").modal("show");
}

function calendar_availability(months) {
    if (!$("#check_in").val()) {
        var check_in_val = "";
    } else {
        var check_in_val = $("#check_in").val();
    }

    if (!$("#check_out").val()) {
        var check_out_val = "";
    } else {
        var check_out_val = $("#check_out").val();
    }
    $("#inline").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        inline: true,
        mode: "range",
        defaultDate: [check_in_val, check_out_val],
        showMonths: months,
        onChange: function (selectedDates, dateStr, instance) {
            // $('#date_things').val(flatpickr.formatDate("Y-m-d"));
            let from = instance.formatDate(selectedDates[0], "Y-m-d");
            let to = instance.formatDate(selectedDates[1], "Y-m-d");
            $("#check_in").val(from);
            $("#check_out").val(to);

            calendar_inline_collab(2);
        },
    });
}

$("#clear_date_inline").click(function () {
    // $("#check_in2").val("");
    $("#check_in").val("");
    $("#check_out").val("");
    calendar_inline_collab(2);
    calendar_availability(2);
});

$("#clear_date_availability").click(function () {
    // $("#check_in2").val("");
    $("#check_in").val("");
    $("#check_out").val("");
    calendar_inline_collab(2);
    calendar_availability(2);
});

function calendar_inline_collab(months) {
    if (!$("#check_in").val()) {
        var check_in_val = "";
    } else {
        var check_in_val = $("#check_in").val();
    }

    if (!$("#check_out").val()) {
        var check_out_val = "";
    } else {
        var check_out_val = $("#check_out").val();
    }
    $("#inline_reserve").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        inline: true,
        mode: "range",
        defaultDate: [check_in_val, check_out_val],
        showMonths: months,
        onChange: function (selectedDates, dateStr, instance) {
            // $('#date_things').val(flatpickr.formatDate("Y-m-d"));
            let from = instance.formatDate(selectedDates[0], "Y-m-d");
            let to = instance.formatDate(selectedDates[1], "Y-m-d");
            $("#check_in").val(from);
            $("#check_out").val(to);
            let content = document.getElementById("popup_check");
            content.style.display = "none";

            calendar_availability(2);
        },
    });
}

calendar_availability(2);
calendar_inline_collab(2);

// $.ajax({
//     //create an ajax request to display.php
//     type: "GET",
//     url: "/villa/date_disabled/" + $("#id_villa").val(),
//     success: function (data) {
//         $("#inline_reserve").flatpickr({
//             enableTime: false,
//             dateFormat: "Y-m-d",
//             minDate: "today",
//             inline: true,
//             mode: "range",
//             showMonths: 2,
//             disable: data,
//             onClose: function (selectedDates, dateStr, instance) {
//                 var start = new Date(
//                     instance.formatDate(selectedDates[0], "Y-m-d")
//                 );
//                 var end = new Date(
//                     instance.formatDate(selectedDates[1], "Y-m-d")
//                 );
//                 var sum_night = (end - start) / 1000 / 60 / 60 / 24;
//                 var min_stay = $("#min_stay").val();
//                 // var total = $('#price').val() * sum_night;
//                 var minimum = new Date($("#check_in").val()).fp_incr(min_stay);
//                 $.ajax({
//                     type: "GET",
//                     url: "/villa/get_total/" + $("#id_villa").val(),
//                     data: {
//                         start: start.toISOString().split("T")[0],
//                         end: end.toISOString().split("T")[0],
//                         _token: "{{ csrf_token() }}",
//                     },
//                     success: function (data) {
//                         var total = data;
//                         if (sum_night < min_stay) {
//                             alert("minimum stay is " + min_stay + " days");
//                         } else {
//                             $("#check_in").val(
//                                 instance.formatDate(selectedDates[0], "Y-m-d")
//                             );
//                             $("#check_out").val(
//                                 instance.formatDate(selectedDates[1], "Y-m-d")
//                             );
//                             $("#sum_night").val(sum_night);
//                             $("#total").text(
//                                 total
//                                     .toString()
//                                     .replace(
//                                         /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
//                                         "."
//                                     )
//                             );
//                             $("#total_all").text(
//                                 total
//                                     .toString()
//                                     .replace(
//                                         /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
//                                         "."
//                                     )
//                             );
//                         }
//                     },
//                 });
//             },
//         });
//     },
// });

$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/villa/date_disabled/" + $("#id_villa").val(),
    success: function (data) {
        $("#inline_reserve_search").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            inline: true,
            mode: "range",
            showMonths: 2,
            disable: data,
            onClose: function (selectedDates, dateStr, instance) {
                var start = new Date(
                    instance.formatDate(selectedDates[0], "Y-m-d")
                );
                var end = new Date(
                    instance.formatDate(selectedDates[1], "Y-m-d")
                );
                var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                var min_stay = $("#min_stay").val();
                // var total = $('#price').val() * sum_night;
                var minimum = new Date($("#check_in").val()).fp_incr(min_stay);
                $.ajax({
                    type: "GET",
                    url: "/villa/get_total/" + $("#id_villa").val(),
                    data: {
                        start: start.toISOString().split("T")[0],
                        end: end.toISOString().split("T")[0],
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        var total = data;
                        if (sum_night < min_stay) {
                            alert("minimum stay is " + min_stay + " days");
                        } else {
                            $("#check_in").val(
                                instance.formatDate(selectedDates[0], "Y-m-d")
                            );
                            $("#check_out").val(
                                instance.formatDate(selectedDates[1], "Y-m-d")
                            );
                            $("#sum_night").val(sum_night);
                            $("#total").text(
                                total
                                    .toString()
                                    .replace(
                                        /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                                        "."
                                    )
                            );
                            $("#total_all").text(
                                total
                                    .toString()
                                    .replace(
                                        /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                                        "."
                                    )
                            );
                        }
                    },
                });
            },
        });
    },
});

$("#start_date,#end_date").flatpickr({
    static: true,
    minDate: "today",
});

// Modal Amenities
function amenities() {
    $("#modal-amenities").modal("show");
}
// Model Reserve
function reserve() {
    $("#modal-reserve").modal("show");
}
// Model Reserve
function reserve2() {
    $("#modal-reserve2").modal("show");
}

function contact_restaurant() {
    $("#modal-contact_restaurant").modal("show");
}

// Modal Share
function share() {
    $("#modal-share").modal("show");
}
// Modal Video
function view_story(id) {
    $.ajax({
        type: "GET",
        url: "/collab/story/" + id,
        dataType: "JSON",
        success: function (data) {
            $('[name="id_story"]').val(data.id_story);
            let villa = document.getElementById("villa").value;
            // let video = document.getElementById('video');
            let public = "/foto/collaborator/";
            let slash = "/";
            let uid = data.collab.uid;
            var lowerCaseName = uid.toLowerCase();
            video.src = public + lowerCaseName + slash + data.name;
            video.load();
            video.play();
            $("#title").html(data.title);
            $("#storymodal").modal("show");
        },
    });
}

$(function () {
    $("#storymodal")
        .modal({
            show: false,
        })
        .on("hidden.bs.modal", function () {
            $(this).find("video")[0].pause();
        });
});

// Sticky Menu
window.onscroll = function () {
    myFunction();
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;
// var about_sticky = document.getElementById("about-sticky");
// var description = document.getElementById("description");
// var descriptiona = description.offsetTop;

function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky");
        document
            .getElementById("add_class_popup")
            .classList.remove("header-popup");
        document
            .getElementById("searchbox")
            .classList.add("searchbox-display-block");
        document
            .getElementById("searchbox")
            .classList.remove("searchbox-display-none");
        document.getElementById("search_bar").classList.remove("active");
        document
            .getElementById("change_display_block")
            .classList.add("display-none");
        document
            .getElementById("change_display_block")
            .classList.remove("display-block");
    } else {
        navbar.classList.remove("sticky");
        document
            .getElementById("add_class_popup")
            .classList.remove("header-popup");
        document
            .getElementById("searchbox")
            .classList.add("searchbox-display-block");
        document
            .getElementById("searchbox")
            .classList.remove("searchbox-display-none");
        document.getElementById("search_bar").classList.remove("active");
        document
            .getElementById("change_display_block")
            .classList.add("display-none");
        document
            .getElementById("change_display_block")
            .classList.remove("display-block");
        document
            .getElementById("search_bar")
            .classList.remove("searchbar-display-block");
        document
            .getElementById("row_popup")
            .classList.remove("row-popup-height");
    }
}

// function active_orange(){
//     if(window.pageYOffset >= descriptiona){
//         console.log("OKE");
//         // about_sticky.classList.add("active");
//     } else{
//         console.log("sip");
//         // about_sticky.classList.remove("active");
//     }
// }

//edit modal
function edit_price() {
    $("#modal-edit_price").modal("show");
}

function edit_bedroom() {
    $("#modal-edit_bedroom").modal("show");
}

function view_bars() {
    $("#modal-bars").modal("show");
}

function edit_description() {
    $("#modal-edit_description").modal("show");
}

function edit_short_description() {
    $("#modal-edit_short_description").modal("show");
}

function edit_guest() {
    $("#modal-edit_guest").modal("show");
}

function edit_amenities() {
    $("#modal-edit_amenities").modal("show");
}

function edit_description() {
    $("#modal-edit_description").modal("show");
}

function edit_collab_language() {
    $("#collab_language_modal").modal("show");
}

function edit_story() {
    $("#modal-edit_story").modal("show");
}

function edit_photo() {
    $("#modal-edit_photo").modal("show");
}

function amenities() {
    $("#modal-amenities").modal("show");
}

function view(id) {
    $.ajax({
        type: "GET",
        url: "/collaborator/video/open/" + id,
        dataType: "JSON",
        success: function (data) {
            // var video = document.getElementById("video1");
            var public = "/foto/collaborator/";
            var slash = "/";
            var uid = data.collab.uid;
            var lowerCaseName = uid.toLowerCase();
            video.src = public + lowerCaseName + slash + data.video;
            video.load();
            video.play();
            $("#title").html(data.title);
            $("#storymodal").modal("show");
        },
    });
}
$(function () {
    $("#videomodal")
        .modal({
            show: false,
        })
        .on("hidden.bs.modal", function () {
            $(this).find("video")[0].pause();
        });
});

// Google Map
function initialize() {
    var latitude = document.getElementById("latitude").value;
    var longitude = document.getElementById("longitude").value;
    const myLatLng = {
        lat: parseFloat(latitude),
        lng: parseFloat(longitude),
    };
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: myLatLng,
        scrollwheel: true,
        draggable: true,
        gestureHandling: "greedy",
        styles: [
            {
                featureType: "poi",
                elementType: "all",
                stylers: [
                    {
                        visibility: "off",
                    },
                ],
            },
            {
                featureType: "road.local",
                elementType: "all",
                stylers: [
                    {
                        visibility: "on",
                    },
                ],
            },
            {
                featureType: "transit.station.airport",
                elementType: "labels.icon",
                stylers: [
                    {
                        visibility: "off",
                    },
                ],
            },
        ],
    });

    new google.maps.Marker({
        position: myLatLng,
        map,
    });
}

google.maps.event.addDomListener(window, "load", initialize);

Dashmix.helpersOnLoad(["jq-slick"]);
Dashmix.helpersOnLoad(["jq-magnific-popup"]);
// Guest Counter
// $("#guest, #children").keyup(function () {
//     count();
// });

// function count() {
//     var x = document.getElementById("adult").value;
//     var y = document.getElementById("child").value;
//     var z = x + y;
//     console.log(z);
// }
// Date Picker
$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/hotel/room/date_disabled/" + $("#id_hotel_room").val(),
    success: function (data) {
        $("#inline").flatpickr({
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
                    url: "/hotel/room/get_total/" + $("#id_hotel_room").val(),
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

$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/hotel/room/date_disabled/" + $("#id_hotel_room").val(),
    success: function (data) {
        $("#inline2").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            inline: true,
            mode: "range",
            showMonths: 1,
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
                    url: "/hotel/room/get_total/" + $("#id_hotel_room").val(),
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

$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/hotel/room/date_disabled/" + $("#id_hotel_room").val(),
    success: function (data) {
        $("#inline_reserve").flatpickr({
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
                    url: "/hotel/room/get_total/" + $("#id_hotel_room").val(),
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

$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/hotel/room/date_disabled/" + $("#id_hotel_room").val(),
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
                    url: "/hotel/room/get_total/" + $("#id_hotel_room").val(),
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

function showMoreGuestSafety() {
    $("#modal-guest_safety").modal("show");
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
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/hotel/room/story/" + id,
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            $('[name="id_story"]').val(data.id_story);
            let hotel = document.getElementById("hotel").value;
            // let video = document.getElementById('video');
            let public = `/foto/hotel/`;
            let slash = "/";
            let hotel_uid = data.hotel.uid;
            var lowerCaseUid = hotel_uid.toLowerCase();
            video.src = public + lowerCaseUid + slash + data.name;
            video.load();
            video.play();
            $("#storymodal-title").html(data.title);
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

        document.getElementById("navbarright").classList.add("active");
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
        document.getElementById("navbarright").classList.remove("active");
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

//edit modal
function edit_price() {
    $("#modal-edit_price").modal("show");
}

function edit_room_size() {
    $("#modal-edit_room_size").modal("show");
}

function edit_hotel_profile() {
    $("#modal-edit_hotel_profile").modal("show");
}

function view_bars() {
    $("#modal-bars").modal("show");
}

function edit_description() {
    $("#modal-edit_description").modal("show");
}

function showMoreDescription() {
    $("#modal-show_description").modal("show");
}

function edit_short_description() {
    $("#modal-edit_short_description").modal("show");
}

function edit_guest() {
    $("#modal-edit_guest").modal("show");
}

function edit_location() {
    $("#modal-edit_location").modal("show");
}

function edit_amenities() {
    $("#modal-edit_amenities").modal("show");
}

function edit_description() {
    $("#modal-edit_description").modal("show");
}

function edit_story() {
    $("#modal-edit_story").modal("show");
}

function edit_photo() {
    $("#modal-edit_photo").modal("show");
}

function editHouseRules() {
    $("#modal-edit-house-rules").modal("show");
}

function editGuestSafety() {
    $("#modal-edit-guest-safety").modal("show");
}

function amenities() {
    $("#modal-amenities").modal("show");
}

function view(id) {
    $.ajax({
        type: "GET",
        url: "/hotel/room/video/open/" + id,
        dataType: "JSON",
        success: function (data) {
            var video = document.getElementById("video1");
            var public = "/foto/hotel/";
            var slash = "/";
            // var uid = data.villa.uid;
            var hotel_uid = data.hotel.uid;
            var lowerCaseUid = hotel_uid.toLowerCase();
            video.src = public + lowerCaseUid + slash + data.video;
            video.load();
            video.play();
            $("#title").html(data.hotel.name);
            $("#videomodal").modal("show");
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
// function initialize() {
//     var latitude = document.getElementById("latitude").value;
//     var longitude = document.getElementById("longitude").value;
//     const myLatLng = {
//         lat: parseFloat(latitude),
//         lng: parseFloat(longitude),
//     };
//     const map = new google.maps.Map(document.getElementById("map"), {
//         zoom: 15,
//         center: myLatLng,
//         draggable: true,
//         // gestureHandling: "greedy",
//         styles: [
//             {
//                 featureType: "poi",
//                 elementType: "all",
//                 stylers: [
//                     {
//                         visibility: "off",
//                     },
//                 ],
//             },
//             {
//                 featureType: "road.local",
//                 elementType: "all",
//                 stylers: [
//                     {
//                         visibility: "on",
//                     },
//                 ],
//             },
//             {
//                 featureType: "transit.station.airport",
//                 elementType: "labels.icon",
//                 stylers: [
//                     {
//                         visibility: "off",
//                     },
//                 ],
//             },
//         ],
//     });

//     new google.maps.Marker({
//         position: myLatLng,
//         map,
//         icon: {
//             url: "http://maps.google.com/mapfiles/kml/paddle/orange-circle.png",
//             scaledSize: new google.maps.Size(40, 40),
//         },
//     });
// }

// google.maps.event.addDomListener(window, "load", initialize);

// // function to showing loading
// function showingLoading() {
//     $("#loading-content").show();
// }

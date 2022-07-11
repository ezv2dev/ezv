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

function checkTemporaryDate() {
    //jika ada temporary CheckIn tersimpan?
    if (
        localStorage.getItem("tempCheckIn") &&
        localStorage.getItem("tempCheckOut")
    ) {
        var valueCheckIn = localStorage.getItem("tempCheckIn");
        var valueCheckOut = localStorage.getItem("tempCheckOut");

        $("#check_in").val(valueCheckIn);
        $("#check_in3").val(valueCheckIn);

        $("#check_out").val(valueCheckOut);
        $("#check_out3").val(valueCheckOut);

        localStorage.removeItem("tempCheckIn");
        localStorage.removeItem("tempCheckOut");

        const start = new Date(valueCheckIn);
        const end = new Date(valueCheckOut);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        $.ajax({
            type: "GET",
            url: "/villa/get_total/" + $("#id_villa").val(),
            data: {
                start: valueCheckIn,
                end: valueCheckOut,
                _token: "{{ csrf_token() }}",
            },
            success: function (data) {
                var total = data;

                // console.log(total);

                $("#sum_night").val(diffDays);
                // sum night in modal reserve
                $("#sum_night3").val(diffDays);
                $("#total").text(
                    total["total"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );

                $("#tax").text(
                    total["tax"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );
                $("#total_all").text(
                    total["total_all"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );

                // total in reserve modal
                $("#total3").text(
                    total["total"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );
                $("#tax3").text(
                    total["tax"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );
                $("#total_all3").text(
                    total["total_all"]
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                );

                calendar_reserve();
                calendar_reserve2();
            },
        });
    } else {
        var valueCheckIn = "";
        var valueCheckOut = "";
    }
}

function calendar_availability() {
    $.ajax({
        //create an ajax request to display.php
        type: "GET",
        url: "/villa/date_disabled/" + $("#id_villa").val(),
        success: function (data) {
            if (!$("#check_in3").val()) {
                var check_in_val = $("#check_in").val();
            } else {
                var check_in_val = $("#check_in3").val();
            }

            if (!$("#check_out3").val()) {
                var check_out_val = $("#check_out").val();
            } else {
                var check_out_val = $("#check_out3").val();
            }
            $("#inline").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                inline: true,
                mode: "range",
                showMonths: 2,
                defaultDate: [check_in_val, check_out_val],
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
                    var minimum = new Date($("#check_in").val()).fp_incr(
                        min_stay
                    );
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
                                $('#adult2').attr({
                                    "max" : total["max_total_guest"],
                                 });
                                $("#normal_price").text(total["normal_price"]);
                                $("#check_in").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                // calendar in reserve modal
                                $("#check_in3").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out3").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                $("#sum_night").val(sum_night);
                                // sum night in modal reserve
                                $("#sum_night3").val(sum_night);

                                $("#discount").text(total["discount"]);
                                $("#cleaning_fee").text(total["cleaning_fee"]);

                                $("#total").text(total["total"]);
                                $("#tax").text(total["tax"]);
                                $("#total_all").text(total["total_all"]);

                                // total in reserve modal
                                $("#total3").text(total["total"]);
                                $("#tax3").text(total["tax"]);
                                $("#total_all3").text(total["total_all"]);

                                calendar_reserve();
                                calendar_reserve2();
                            }
                        },
                    });
                },
            });
        },
    });
}

$("#clear1").click(function () {
    $("#check_in").val("");
    $("#check_in3").val("");
    $("#check_out").val("");
    $("#check_out3").val("");
    calendar_reserve();
    calendar_reserve2();
    calendar_availability();
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
});

$("#clear_date").click(function () {
    $("#check_in").val("");
    $("#check_in3").val("");
    $("#check_out").val("");
    $("#check_out3").val("");
    calendar_reserve();
    calendar_reserve2();
    calendar_availability();
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
});

$("#clear_date2").click(function () {
    $("#check_in").val("");
    $("#check_in3").val("");
    $("#check_out").val("");
    $("#check_out3").val("");
    calendar_reserve();
    calendar_reserve2();
    calendar_availability();
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
});

$.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "/villa/date_disabled/" + $("#id_villa").val(),
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
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                            );
                            $("#total_all").text(
                                total
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                            );
                        }
                    },
                });
            },
        });
    },
});

function calendar_reserve() {
    $.ajax({
        //create an ajax request to display.php
        type: "GET",
        url: "/villa/date_disabled/" + $("#id_villa").val(),
        success: function (data) {
            if (!$("#check_in3").val()) {
                var check_in_val = $("#check_in").val();
            } else {
                var check_in_val = $("#check_in3").val();
            }

            if (!$("#check_out3").val()) {
                var check_out_val = $("#check_out").val();
            } else {
                var check_out_val = $("#check_out3").val();
            }

            $("#inline_reserve").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                inline: true,
                mode: "range",
                showMonths: 2,
                defaultDate: [check_in_val, check_out_val],
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
                    var minimum = new Date($("#check_in").val()).fp_incr(
                        min_stay
                    );
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
                                $('#adult2').attr({
                                    "max" : total["max_total_guest"],
                                 });
                                $("#normal_price").text(total["normal_price"]);
                                $("#check_in").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                // calendar in reserve modal
                                $("#check_in3").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out3").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                $("#sum_night").val(sum_night);
                                $("#total").text(total["total"]);
                                $("#discount").text(total["discount"]);
                                $("#cleaning_fee").text(total["cleaning_fee"]);
                                $("#tax").text(total["tax"]);
                                $("#total_all").text(total["total_all"]);
                                $("#total3").text(total["total"]);
                                $("#tax3").text(total["tax"]);
                                $("#total_all3").text(total["total_all"]);

                                $("#popup_check").css("display", "none");
                                calendar_availability();
                                calendar_reserve2();
                            }
                        },
                    });
                },
            });
        },
    });
}

function calendar_reserve2() {
    $.ajax({
        //create an ajax request to display.php
        type: "GET",
        url: "/villa/date_disabled/" + $("#id_villa").val(),
        success: function (data) {
            if (!$("#check_in3").val()) {
                var check_in_val = $("#check_in").val();
            } else {
                var check_in_val = $("#check_in3").val();
            }

            if (!$("#check_out3").val()) {
                var check_out_val = $("#check_out").val();
            } else {
                var check_out_val = $("#check_out3").val();
            }
            $("#inline_reserve2").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                minDate: "today",
                inline: true,
                mode: "range",
                showMonths: 2,
                defaultDate: [check_in_val, check_out_val],
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
                    var minimum = new Date($("#check_in").val()).fp_incr(
                        min_stay
                    );
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
                                $('#adult2').attr({
                                    "max" : total["max_total_guest"],
                                 });
                                $("#normal_price").text(total["normal_price"]);
                                $("#check_in3").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out3").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                // calendar in reserve right bar
                                $("#check_in").val(
                                    instance.formatDate(
                                        selectedDates[0],
                                        "Y-m-d"
                                    )
                                );
                                $("#check_out").val(
                                    instance.formatDate(
                                        selectedDates[1],
                                        "Y-m-d"
                                    )
                                );

                                $("#sum_night3").val(sum_night);

                                $("#total3").text( total["total"]);
                                $("#tax3").text( total["tax"]);
                                $("#total_all3").text( total["total_all"]);
                                $("#discount").text(total["discount"]);
                                $("#cleaning_fee").text(total["cleaning_fee"]);
                                // total in reserve right bar
                                $("#total").text( total["total"]);
                                $("#tax").text( total["tax"]);
                                $("#total_all").text( total["total_all"]);

                                $("#popup_check2").css("display", "none");
                                calendar_availability();
                                calendar_reserve();
                            }
                        },
                    });
                },
            });
        },
    });
}

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
                            // $("#total").text(total.toString().replace(
                            //     /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                            //     "."));
                            // $("#total_all").text(total.toString().replace(
                            //     /\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g,
                            //     "."));
                            $("#total").text(
                                total
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                            );
                            $("#total_all").text(
                                total
                                    .toString()
                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
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
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/story/" + id,
        dataType: "JSON",
        success: function (data) {
            $('[name="id_story"]').val(data.id_story);
            let villa = document.getElementById("villa").value;
            // let video = document.getElementById('video');
            let public = `/foto/gallery/`;
            let slash = "/";
            let uid = data.villa.uid;
            var lowerCaseUid = uid.toLowerCase();
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
    if ((document.getElementById("popup_check").style.display = "block")) {
        document.getElementById("popup_check").style.display = "none";
    }
    if ((document.getElementById("popup_guest").style.display = "block")) {
        document.getElementById("popup_guest").style.display = "none";
    }
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

function whenScrollCalendar() {
    document.getElementById("popup_check").style.display = "none";
    document.getElementById("popup_guest").style.display = "none";
}

//edit modal
function edit_price() {
    $("#modal-edit_price").modal("show");
}

function edit_bedroom() {
    $("#modal-edit_bedroom").modal("show");
}

function edit_villa_profile() {
    $("#modal-edit_villa_profile").modal("show");
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

function showMoreGuestSafety() {
    $("#modal-guest_safety").modal("show");
}

function editRestaurantRules() {
    $("#modal-edit-restaurant-rules").modal("show");
}

function editRestaurantGuestSafety() {
    $("#modal-edit-restaurant-guest-safety").modal("show");
}

function showMoreRestaurantGuestSafety() {
    $("#modal-restaurant_guest_safety").modal("show");
}

function editActivityRules() {
    $("#modal-edit-activity-rules").modal("show");
}

function editActivityGuestSafety() {
    $("#modal-edit-activity-guest-safety").modal("show");
}

function showMoreActivityGuestSafety() {
    $("#modal-activity_guest_safety").modal("show");
}

function amenities() {
    $("#modal-amenities").modal("show");
}

function view(id) {
    $.ajax({
        type: "GET",
        url: "/villa/video/open/" + id,
        dataType: "JSON",
        success: function (data) {
            var video = document.getElementById("video1");
            var public = "/foto/gallery/";
            var slash = "/";
            var uid = data.villa.uid;
            var lowerCaseUid = uid.toLowerCase();
            video.src = public + lowerCaseUid + slash + data.video;
            video.load();
            video.play();
            $("#title").html(data.villa.name);
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

// function to showing loading
function showingLoading() {
    $("#loading-content").show();
}

checkTemporaryDate();

//call calendar
calendar_availability();
calendar_reserve();
calendar_reserve2();

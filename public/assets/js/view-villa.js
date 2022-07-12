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

function getCookie2(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function checkCheckInOutDate() {
    let checkIn = getCookie2("sCheck_in");
    let checkOut = getCookie2("sCheck_out");
    let adult = getCookie2("sAdult");
    let child = getCookie2("sChild");
    let id_villa = $("#id_villa").val();

    if (checkIn == null && checkOut == null) {
    } else {
        $.ajax({
            type: "GET",
            url: "/villa/calendar/check",
            data: {
                start: checkIn,
                end: checkOut,
                id: id_villa,
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                // console.log(response.status);
                console.log(response.data.length);
                if (response.data.length > 0) {
                } else {
                    runningCookiesDate(checkIn, checkOut, adult, child);
                }
            },
        });
    }
}

function runningCookiesDate(checkIn, checkOut, adult, child) {
    $("#check_in").val(checkIn);
    $("#check_in2").val(checkIn);
    $("#check_in3").val(checkIn);
    $("#check_in_date").val($("#check_in3").val());

    $("#check_out").val(checkOut);
    $("#check_out2").val(checkOut);
    $("#check_out3").val(checkOut);
    $("#check_out_date").val($("#check_out3").val());

    $("#adult").val(adult);
    $("#adult2").val(adult);
    $("#adult3").val(adult);
    $("#adult_va").val(adult);

    $("#child").val(child);
    $("#child2").val(child);
    $("#child3").val(child);
    $("#child_va").val(child);

    let total_guest = parseInt(adult) + parseInt(child);
    $("#total_guest").val(total_guest);
    $("#total_guest2").val(total_guest);
    $("#total_guest3").val(total_guest);

    const start = new Date(checkIn);
    const end = new Date(checkOut);
    const diffTime = Math.abs(end - start);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    $.ajax({
        type: "GET",
        url: "/villa/get_total/" + $("#id_villa").val(),
        data: {
            start: checkIn,
            end: checkOut,
            _token: "{{ csrf_token() }}",
        },
        success: function (data) {
            var total = data;

            // console.log(total);

            $("#adult2").attr({
                max: total["max_total_guest"],
            });
            $("#normal_price").text(total["normal_price"]);

            $("#sum_night").val(diffDays);
            // sum night in modal reserve
            $("#sum_night3").val(diffDays);

            if (!total["discount"]) {
                $("#discount_div").removeAttr("style");
                $("#discount_div").css("display", "none");
            } else {
                $("#discount").text(total["discount"]);
                $("#discount_div").css("display", "block");
            }

            $("#total").text(total["total"]);
            $("#tax").text(total["tax"]);
            $("#total_all").text(total["total_all"]);
            // $("#price_total").val(total["price"]);
            // $("#price_total2").val(total["price"]);

            // total in reserve modal
            $("#total3").text(total["total"]);
            $("#tax3").text(total["tax"]);
            $("#total_all3").text(total["total_all"]);

            if (!total["total_all"] || total["total_all"] == 0) {
                $("#total_all2_div").css({ display: "none" });
                $("#details_button").css({ display: "none" });
                $("#details_mobile_button").css({ display: "none" });
                $("#details_mobile_reserve_button").css({ display: "inline" });
            } else {
                $("#total_all2").text(total["total_all"]);
                $("#total_all2_div").css({
                    display: "flex",
                    "margin-top": "10px",
                    "padding-top": "10px",
                });
                $("#details_button").css({
                    display: "block",
                    "margin-top": "10px",
                    "padding-top": "0px",
                });
                $("#details_mobile_button").css({ display: "inline" });
                $("#details_mobile_reserve_button").css({ display: "none" });
            }

            $("#counting_part").css("display", "block");

            if (!total["cleaning_fee"]) {
                $("#cleaning_div").removeAttr("style");
                $("#cleaning_div").css("display", "none");
            } else {
                $("#cleaning_fee").text(total["cleaning_fee"]);
                $("#cleaning_div").css("display", "block");
            }

            calendar_reserve(2);
            calendar_reserve2(2);
        },
    });
}

checkCheckInOutDate();

$(document).ready(function () {
    if ($(window).width() <= 991) {
        calendar_availability(1);
        calendar_reserve2(1)
    } else {
        calendar_availability(2);
        calendar_reserve2(2)
    }
});

$(window).on("resize", function () {
    if ($(this).width() <= 991) {
        calendar_availability(1);
        calendar_reserve2(1)
    } else {
        calendar_availability(2);
        calendar_reserve2(2)
    }
});

function calendar_availability(months) {
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
                showMonths: months,
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
                                $("#adult2").attr({
                                    max: total["max_total_guest"],
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

                                $("#check_in_date").val($("#check_in3").val());
                                $("#check_out_date").val($("#check_out3").val());

                                // sum night in modal reserve
                                $("#sum_night3").val(sum_night);
                                $("#sum_night").val($('#sum_night3').val());
                                $("#sum_night2").val($('#sum_night3').val());

                                if (!total["discount"]) {
                                    $("#discount_div").removeAttr("style");
                                    $("#discount_div").css("display", "none");
                                } else {
                                    $("#discount").text(total["discount"]);
                                    $("#discount_div").css("display", "block");
                                }

                                $("#total").text(total["total"]);
                                $("#tax").text(total["tax"]);
                                $("#total_all").text(total["total_all"]);

                                // total in reserve modal
                                $("#total3").text(total["total"]);
                                $("#tax3").text(total["tax"]);
                                $("#total_all3").text(total["total_all"]);

                                if (
                                    !total["total_all"] ||
                                    total["total_all"] == 0
                                ) {
                                    $("#total_all2_div").css({
                                        display: "none",
                                    });
                                    $("#details_button").css({
                                        display: "none",
                                    });
                                    $("#details_mobile_button").css({ display: "none" });
                                    $("#details_mobile_reserve_button").css({ display: "inline" });
                                } else {
                                    $("#total_all2").text(total["total_all"]);
                                    $("#total_all2_div").css({
                                        display: "flex",
                                        "margin-top": "10px",
                                        "padding-top": "10px",
                                    });
                                    $("#details_button").css({
                                        display: "block",
                                        "margin-top": "10px",
                                        "padding-top": "0px",
                                    });
                                    $("#details_mobile_button").css({ display: "inline" });
                                    $("#details_mobile_reserve_button").css({ display: "none" });
                                }

                                // $("#price_total").val(total["price"]);
                                // $("#price_total2").val(total["price"]);

                                $("#counting_part").css("display", "block");

                                if (!total["cleaning_fee"]) {
                                    $("#cleaning_div").removeAttr("style");
                                    $("#cleaning_div").css("display", "none");
                                } else {
                                    $("#cleaning_fee").text(
                                        total["cleaning_fee"]
                                    );
                                    $("#cleaning_div").css("display", "block");
                                }

                                calendar_reserve(2);
                                calendar_reserve2(2);
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
    if ($(window).width() <= 991) {
        calendar_availability(1);
        calendar_reserve2(1)
    } else {
        calendar_availability(2);
        calendar_reserve2(2)
    }
    calendar_reserve(2);
    $("#counting_part").css("display", "none");
    $("#details_button").css("display", "none");
    $("#details_mobile_button").css({ display: "none" });
    $("#details_mobile_reserve_button").css({ display: "inline" });
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
    $("#total_all2_div").css({ display: "none" });
});

$("#clear_date").click(function () {
    $("#check_in").val("");
    $("#check_in3").val("");
    $("#check_out").val("");
    $("#check_out3").val("");
    if ($(window).width() <= 991) {
        calendar_availability(1);
        calendar_reserve2(1)
    } else {
        calendar_availability(2);
        calendar_reserve2(2)
    }
    calendar_reserve(2);
    $("#counting_part").css("display", "none");
    $("#details_button").css("display", "none");
    $("#details_mobile_button").css({ display: "none" });
    $("#details_mobile_reserve_button").css({ display: "inline" });
    $("#popup_check").css("display", "none");
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
    $("#total_all2_div").css({ display: "none" });
});

$("#clear_date2").click(function () {
    $("#check_in").val("");
    $("#check_in3").val("");
    $("#check_out").val("");
    $("#check_out3").val("");
    if ($(window).width() <= 991) {
        calendar_availability(1);
        calendar_reserve2(1)
    } else {
        calendar_availability(2);
        calendar_reserve2(2)
    }
    calendar_reserve(2);
    $("#counting_part").css("display", "none");
    $("#popup_check2").css("display", "none");
    $("#details_button").css("display", "none");
    $("#details_mobile_button").css({ display: "none" });
    $("#details_mobile_reserve_button").css({ display: "inline" });
    // $("#modal-details-reserve").removeClass("show");
    // $(".modal-backdrop").removeClass("show");
    $("#modal-details-reserve").modal("hide");
    $("#sum_night").val("0");
    $("#total3").text("0");
    $("#tax3").text("0");
    $("#total_all3").text("0");
    $("#total").text("0");
    $("#tax").text("0");
    $("#total_all").text("0");
    $("#total_all2_div").css({ display: "none" });
});

$("#clear_date_header").click(function () {
    $("#check_in4").val("");
    $("#check_out4").val("");
    calendar_header(2);
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

function calendar_reserve(months) {
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
                showMonths: months,
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
                                $("#adult2").attr({
                                    max: total["max_total_guest"],
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

                                $("#check_in_date").val($("#check_in3").val());
                                $("#check_out_date").val($("#check_out3").val());

                                $("#sum_night3").val(sum_night);
                                $("#sum_night").val($('#sum_night3').val());
                                $("#sum_night2").val($('#sum_night3').val());
                                $("#total").text(total["total"]);

                                if (
                                    !total["total_all"] ||
                                    total["total_all"] == 0
                                ) {
                                    $("#total_all2_div").css({
                                        display: "none",
                                    });
                                    $("#details_button").css({
                                        display: "none",
                                    });
                                    $("#details_mobile_button").css({ display: "none" });
                                    $("#details_mobile_reserve_button").css({ display: "inline" });
                                } else {
                                    $("#total_all2").text(total["total_all"]);
                                    $("#total_all2_div").css({
                                        display: "flex",
                                        "margin-top": "10px",
                                        "padding-top": "10px",
                                    });
                                    $("#details_button").css({
                                        display: "block",
                                        "margin-top": "10px",
                                        "padding-top": "0px",
                                    });
                                    $("#details_mobile_button").css({ display: "inline" });
                                    $("#details_mobile_reserve_button").css({ display: "none" });
                                }

                                $("#tax").text(total["tax"]);
                                $("#total_all").text(total["total_all"]);
                                $("#total3").text(total["total"]);
                                $("#tax3").text(total["tax"]);
                                $("#total_all3").text(total["total_all"]);

                                if (
                                    !total["total_all"] ||
                                    total["total_all"] == 0
                                ) {
                                    $("#total_all2_div").css({
                                        display: "none",
                                    });
                                } else {
                                    $("#total_all2").text(total["total_all"]);
                                    $("#total_all2_div").css({
                                        display: "flex",
                                        "margin-top": "10px",
                                        "padding-top": "10px",
                                    });
                                }

                                // $("#price_total").val(total["price"]);
                                // $("#price_total2").val(total["price"]);

                                $("#popup_check").css("display", "none");

                                $("#counting_part").css("display", "block");

                                if (!total["discount"]) {
                                    $("#discount_div").removeAttr("style");
                                    $("#discount_div").css("display", "none");
                                } else {
                                    $("#discount").text(total["discount"]);
                                    $("#discount_div").css("display", "block");
                                }

                                if (!total["cleaning_fee"]) {
                                    $("#cleaning_div").removeAttr("style");
                                    $("#cleaning_div").css("display", "none");
                                } else {
                                    $("#cleaning_fee").text(
                                        total["cleaning_fee"]
                                    );
                                    $("#cleaning_div").css("display", "block");
                                }
                                if ($(window).width() <= 991) {
                                    calendar_availability(1);
                                    calendar_reserve2(1)
                                } else {
                                    calendar_availability(2);
                                    calendar_reserve2(2)
                                }
                            }
                        },
                    });
                },
            });
        },
    });
}

function calendar_reserve2(months) {
    months = $(window).width() <= 991 ? 1 : 2
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
                showMonths: months,
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
                                $("#adult2").attr({
                                    max: total["max_total_guest"],
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

                                $("#check_in_date").val($("#check_in3").val());
                                $("#check_out_date").val($("#check_out3").val());

                                $("#sum_night3").val(sum_night);
                                $("#sum_night").val($('#sum_night3').val());
                                $("#sum_night2").val($('#sum_night3').val());

                                $("#total3").text(total["total"]);
                                $("#tax3").text(total["tax"]);
                                $("#total_all3").text(total["total_all"]);

                                // $("#price_total").val(total["price"]);
                                // $("#price_total2").val(total["price"]);
                                if (
                                    !total["total_all"] ||
                                    total["total_all"] == 0
                                ) {
                                    $("#total_all2_div").css({
                                        display: "none",
                                    });
                                    $("#details_button").css({
                                        display: "none",
                                    });
                                    $("#details_mobile_button").css({ display: "none" });
                                    $("#details_mobile_reserve_button").css({ display: "inline" });
                                } else {
                                    $("#total_all2").text(total["total_all"]);
                                    $("#total_all2_div").css({
                                        display: "flex",
                                        "margin-top": "10px",
                                        "padding-top": "10px",
                                    });
                                    $("#details_button").css({
                                        display: "block",
                                        "margin-top": "10px",
                                        "padding-top": "0px",
                                    });
                                    $("#details_mobile_button").css({ display: "inline" });
                                    $("#details_mobile_reserve_button").css({ display: "none" });
                                }

                                if (!total["discount"]) {
                                    $("#discount_div").removeAttr("style");
                                    $("#discount_div").css("display", "none");
                                } else {
                                    $("#discount").text(total["discount"]);
                                    $("#discount_div").css("display", "block");
                                }

                                // total in reserve right bar
                                $("#total").text(total["total"]);
                                $("#tax").text(total["tax"]);
                                $("#total_all").text(total["total_all"]);

                                $("#popup_check2").css("display", "none");

                                $("#counting_part").css("display", "block");

                                if (!total["cleaning_fee"]) {
                                    $("#cleaning_div").removeAttr("style");
                                    $("#cleaning_div").css("display", "none");
                                } else {
                                    $("#cleaning_fee").text(
                                        total["cleaning_fee"]
                                    );
                                    $("#cleaning_div").css("display", "block");
                                }
                                calendar_availability(months);
                                calendar_reserve(2);
                            }
                        },
                    });
                },
            });
        },
    });
}

function calendar_header(months) {
    if (!$("#check_in4").val()) {
        var check_in_val = "";
    } else {
        var check_in_val = $("#check_in4").val();
    }

    if (!$("#check_out4").val()) {
        var check_out_val = "";
    } else {
        var check_out_val = $("#check_out4").val();
    }
    $("#inline_reserve_search").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today",
        inline: true,
        mode: "range",
        showMonths: months,
        // disable: data,
        defaultDate: [check_in_val, check_out_val],
        onChange: function (selectedDates, dateStr, instance) {
            $("#check_in4").val(instance.formatDate(selectedDates[0], "Y-m-d"));
            $("#check_out4").val(
                instance.formatDate(selectedDates[1], "Y-m-d")
            );
            let content = document.getElementById("popup_check_search");
            content.style.display = "none";
        },
    });
}

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

function editCancelationPolicy() {
    $("#modal-cancelation-policy").modal("show");
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

//call calendar
calendar_header(2);
calendar_availability(2);
calendar_reserve(2);
calendar_reserve2(2);

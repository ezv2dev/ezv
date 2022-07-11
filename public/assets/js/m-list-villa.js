Dashmix.helpersOnLoad(['jq-slick']);

// Button
// document.getElementById("villa-button").onclick = function () {
//     document.getElementById("villa-form").submit();
// }

// document.getElementById("hotel-button").onclick = function () {
//     document.getElementById("hotel-form").submit();
// }

// document.getElementById("restaurant-button").onclick = function () {
//     document.getElementById("restaurant-form").submit();
// }

// document.getElementById("activity-button").onclick = function () {
//     document.getElementById("activity-form").submit();
// }

// Flat Picker

$('#check_in').flatpickr({
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: "today",
    onChange: function (selectedDates, dateStr, instance) {
        $('#check_out').flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: new Date(dateStr).fp_incr(1),
            onChange: function (selectedDates, dateStr, instance) {
                var start = new Date($('#check_in').val());
                var end = new Date($('#check_out').val());
                var sum_night = (end - start) / 1000 / 60 / 60 / 24;
                var min_stay = $('#min_stay').val();
                var minimum = new Date($('#check_in').val()).fp_incr(min_stay);
                if (sum_night < min_stay) {
                    alert("minimum stay is " + min_stay + " days");
                }
            }
        });
    }
});


Dashmix.helpersOnLoad(['jq-magnific-popup']);
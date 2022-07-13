$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

let id_restaurant = $("#id_restaurant").val();

//ganti short description restaurant

let short_desc_backup = $("#short-description-form-input").val();

function saveShortDescription() {
    let short_desc = $("#short-description-form-input").val();

    let btn = document.getElementById("btnSaveShortDesc");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        url: "/restaurant/update/short-description",
        data: {
            id: id_restaurant,
            short_desc: short_desc,
        },
        success: function (response) {
            // console.log(response.data.short_description);
            let short_desc_input = document.getElementById(
                "short-description-form-input"
            );

            $("#short_description_contents").html(
                response.data.short_description
            );

            short_desc_input.value = response.data.short_description;

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            btn.textContent = "Done";
            btn.classList.remove("disabled");

            editShortDescriptionCancel();
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            iziToast.error({
                title: "Error",
                message: jqXHR.responseJSON.message,
                position: "topRight",
            });

            btn.textContent = "Done";
            btn.classList.remove("disabled");

            editShortDescriptionCancel();

            let short_desc_input = document.getElementById(
                "short-description-form-input"
            );

            short_desc_input.value = short_desc_backup;
        },
    });
}

function saveDescription() {
    let desc = $("#description-form-input").val();

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/update/description",
        data: {
            id_restaurant: id_restaurant,
            description: desc,
        },
        success: function (response) {
            console.log(response);
            console.log(response.data.description.length);

            let desc_input = document.getElementById("description-form-input");

            $("#description-content").html(
                response.data.description.substring(0, 600)
            );

            desc_input.value = response.data.description;

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            if (response.data.description.length > 600) {
                $("#buttonShowMoreDescription").html("");
                $("#buttonShowMoreDescription").append(
                    '<a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);" onclick="showMoreDescription();"><span style="text-decoration: underline; color: #ff7400;">Show more</span> <span style="color: #ff7400;">></span></a>'
                );
                $("#modalDescriptionContent").html(response.data.description);
            } else {
                $("#buttonShowMoreDescription").html("");
                $("#btnShowMoreDescription").remove();
            }

            editDescriptionCancel();
        },
    });
}

//ganti nama restaurant
let name_resto_backup = $("#name-form-input").val();

function saveNameRestaurant() {
    let name_resto = $("#name-form-input").val();

    let btn = document.getElementById("btnSaveRestaurant");
    btn.textContent = "Saving Name...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        url: "/restaurant/update/name",
        data: {
            id: id_restaurant,
            name: name_resto,
        },
        success: function (response) {
            // console.log(response.data.name);
            let name_input = document.getElementById("name-form-input");

            $("#name-content2").html(response.data.name);

            name_input.value = response.data.name;

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            btn.textContent = "Done";
            btn.classList.remove("disabled");

            editNameCancel();
        },
        error: function (jqXHR, exception) {
            iziToast.error({
                title: "Error",
                message: jqXHR.responseJSON.message,
                position: "topRight",
            });

            btn.textContent = "Done";
            btn.classList.remove("disabled");

            editNameCancel();

            let name_input = document.getElementById("name-form-input");
            name_input.value = name_resto_backup;
        },
    });
}

//Ganti Foto Profile
let imageProfileRestaurant;
let readerImageRestaurant;

$("#imageRestaurant").on("change", function (ev) {
    imageProfileRestaurant = this.files[0];

    readerImageRestaurant = new FileReader();
});

$("#updateImageForm").submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("image", imageProfileRestaurant);

    // console.log(imageProfileRestaurant);

    var btn = document.getElementById("btnupdateImageForm");
    btn.textContent = "Saving Image...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        url: "/restaurant/update/image",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        enctype: "multipart/form-data",
        dataType: "json",
        success: function (response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            readerImageRestaurant.addEventListener("load", function () {
                $("#imageProfileRestaurant").attr(
                    "src",
                    readerImageRestaurant.result
                );
            });

            readerImageRestaurant.readAsDataURL(imageProfileRestaurant);

            $("#modal-edit_restaurant_profile").modal("hide");

            $("#profileDropzone").attr("src", "");

            btn.textContent = "Save Image";
            btn.classList.remove("disabled");
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);

            iziToast.error({
                title: "Error",
                message: jqXHR.responseJSON.message.image[0],
                position: "topRight",
            });

            btn.textContent = "Save Image";
            btn.classList.remove("disabled");

            $("#modal-edit_restaurant_profile").modal("hide");
        },
    });
});

function saveCategoryRestaurant() {
    let cuisine = [];
    let dietaryfood = [];
    let dishes = [];
    let goodfor = [];
    let meal = [];

    $("input[name='cuisine[]']:checked").each(function () {
        cuisine.push(parseInt($(this).val()));
    });

    $("input[name='dietaryfood[]']:checked").each(function () {
        dietaryfood.push(parseInt($(this).val()));
    });

    $("input[name='dishes[]']:checked").each(function () {
        dishes.push(parseInt($(this).val()));
    });

    $("input[name='goodfor[]']:checked").each(function () {
        goodfor.push(parseInt($(this).val()));
    });

    $("input[name='meal[]']:checked").each(function () {
        meal.push(parseInt($(this).val()));
    });

    let btn = document.getElementById("btnsaveCategoryRestaurant");
    btn.textContent = "Saving Tag...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/store/tag",
        data: {
            id: id_restaurant,
            cuisine: cuisine,
            dietaryfood: dietaryfood,
            dishes: dishes,
            goodfor: goodfor,
            meal: meal,
        },
        success: function (response) {
            console.log(response);
            // console.log(response.data.tags.length);

            $("#modal-add_tag").modal("hide");

            btn.textContent = "Save";
            btn.classList.remove("disabled");

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content = "";

            if (response.data.tags.length > 6) {
                for (let i = 0; i < 7; i++) {
                    content =
                        content +
                        '<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">' +
                        response.data.tags[i].name +
                        "</span>";
                }
                content =
                    content +
                    '<button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button" onclick="view_tag()">More</button>';
            } else {
                for (let i = 0; i < response.data.tags.length; i++) {
                    content =
                        content +
                        '<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">' +
                        response.data.tags[i].name +
                        "</span>";
                }
            }

            if (response.data.tags.length == 0) {
                content = "there is no tag yet";
            }

            content =
                content +
                '&nbsp;<a type="button" onclick="add_tag()" style="font-size: 10pt; font-weight: 600; color: #ff7400;">Edit Tags</a>';

            $("#tagsContent").html(content);

            //modal
            if (response.data.tags.length > 6) {
                let contentCuisine,
                    contentDietaryFood,
                    contentDishes,
                    contentGoodFor,
                    contentMeal;

                for (let h = 0; h < response.data.cuisine.length; h++) {
                    if (h == 0) {
                        contentCuisine =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.cuisine[h].name +
                            "</span></div>";
                    } else {
                        contentCuisine =
                            contentCuisine +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.cuisine[h].name +
                            "</span></div>";
                    }
                }

                for (let j = 0; j < response.data.dietaryfood.length; j++) {
                    if (j == 0) {
                        contentDietaryFood =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.dietaryfood[j].name +
                            "</span></div>";
                    } else {
                        contentDietaryFood =
                            contentDietaryFood +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.dietaryfood[j].name +
                            "</span></div>";
                    }
                }

                for (let k = 0; k < response.data.dishes.length; k++) {
                    if (k == 0) {
                        contentDishes =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.dishes[k].name +
                            "</span></div>";
                    } else {
                        contentDishes =
                            contentDishes +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.dishes[k].name +
                            "</span></div>";
                    }
                }

                for (let l = 0; l < response.data.goodfor.length; l++) {
                    if (l == 0) {
                        contentGoodFor =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.goodfor[l].name +
                            "</span></div>";
                    } else {
                        contentGoodFor =
                            contentGoodFor +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.goodfor[l].name +
                            "</span></div>";
                    }
                }

                for (let m = 0; m < response.data.meal.length; m++) {
                    if (m == 0) {
                        contentMeal =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.meal[m].name +
                            "</span></div>";
                    } else {
                        contentMeal =
                            contentMeal +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data.meal[m].name +
                            "</span></div>";
                    }
                }

                $("#cuisineModalContent").html("");
                $("#cuisineModalContent").append(contentCuisine);

                $("#dietaryFoodModalContent").html("");
                $("#dietaryFoodModalContent").append(contentDietaryFood);

                $("#dishesModalContent").html("");
                $("#dishesModalContent").append(contentDishes);

                $("#goodForModalContent").html("");
                $("#goodForModalContent").append(contentGoodFor);

                $("#mealModalContent").html("");
                $("#mealModalContent").append(contentMeal);
            }
        },
    });
}

function saveTimeRestaurant() {
    let open_time = $("#open-time-input").val();
    let closed_time = $("#close-time-input").val();
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/update/time",
        data: {
            id_restaurant: id_restaurant,
            open_time: open_time,
            closed_time: closed_time,
        },
        success: function (response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let newOpenTime = tConvert(response.data.open_time);
            let newClosedTime = tConvert(response.data.closed_time);

            $("#timeRestaurantContent").html(
                newOpenTime + " - " + newClosedTime
            );

            $("#open-time-input").val(response.data.open_time);
            $("#closed-time-input").val(response.data.closed_time);

            editTimeFormCancel();
        },
    });
}

//convert AM PM Time
function tConvert(time) {
    // Check correct time format and split into components
    time = time
        .toString()
        .match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

    if (time.length > 1) {
        // If time format correct
        time = time.slice(1); // Remove full string match value
        time[5] = +time[0] < 12 ? " AM" : " PM"; // Set AM/PM
        time[0] = +time[0] % 12 || 12; // Adjust hours
    }
    return time.join(""); // return adjusted time or original string
}

function saveRestaurantPrice() {
    let select_restaurant_type = document.getElementById(
        "restaurant-type-input"
    );
    let type_restaurant =
        select_restaurant_type.options[select_restaurant_type.selectedIndex]
            .value;

    let select_restaurant_price = document.getElementById(
        "restaurant-price-input"
    );
    let price_restaurant =
        select_restaurant_price.options[select_restaurant_price.selectedIndex]
            .value;

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/update/type",
        data: {
            id_restaurant: id_restaurant,
            id_type: type_restaurant,
            id_price: price_restaurant,
        },
        success: function (response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            var restaurantTypeInput = $("#restaurant-type-input");
            var restaurantPriceInput = $("#restaurant-price-input");
            $(restaurantTypeInput).val(response.data.id_type);
            $(restaurantPriceInput).val(response.data.id_price);

            let contentPrice;

            contentPrice =
                '<span data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                response.data.type +
                '">' +
                response.data.type +
                "</span>";

            contentPrice = contentPrice + "<span> - </span>";

            if (response.data.id_price == 1) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$</span>';
            } else if (response.data.id_price == 2) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$$</span>';
            } else if (response.data.id_price == 5) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$$$</span>';
            } else {
                contentPrice = contentPrice + "<span>No Price Rate Yet</span>";
            }

            // contentPrice =
            //     contentPrice +
            //     '<a type="button" onclick="editTypeForm()" style="margin-left: 5px; font-size: 10pt; font-weight: 600; color: #ff7400;">Edit</a>';

            $("#type_price_content").html("");
            $("#type_price_content_mobile").html("");
            $("#type_price_content").append(contentPrice);
            $("#type_price_content_mobile").append(contentPrice);
            editTypeFormCancel();
        },
    });
}

function saveRestaurantPriceMobile() {
    let select_restaurant_type = document.getElementById(
        "restaurant-type-input-mobile"
    );
    let type_restaurant =
        select_restaurant_type.options[select_restaurant_type.selectedIndex]
            .value;

    let select_restaurant_price = document.getElementById(
        "restaurant-price-input-mobile"
    );
    let price_restaurant =
        select_restaurant_price.options[select_restaurant_price.selectedIndex]
            .value;

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/update/type",
        data: {
            id_restaurant: id_restaurant,
            id_type: type_restaurant,
            id_price: price_restaurant,
        },
        success: function (response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            var restaurantTypeInput = $("#restaurant-type-input-mobile");
            var restaurantPriceInput = $("#restaurant-price-input-mobile");
            $(restaurantTypeInput).val(response.data.id_type);
            $(restaurantPriceInput).val(response.data.id_price);

            let contentPrice;

            contentPrice =
                '<span data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                response.data.type +
                '">' +
                response.data.type +
                "</span>";

            contentPrice = contentPrice + "<span> - </span>";

            if (response.data.id_price == 1) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$</span>';
            } else if (response.data.id_price == 2) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$$</span>';
            } else if (response.data.id_price == 5) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$$$</span>';
            } else {
                contentPrice = contentPrice + "<span>No Price Rate Yet</span>";
            }

            // contentPrice =
            //     contentPrice +
            //     '<a type="button" onclick="editTypeFormMobile()" style="margin-left: 5px; font-size: 10pt; font-weight: 600; color: #ff7400;">Edit</a>';

            $("#type_price_content_mobile").html("");
            $("#type_price_content").html("");
            $("#type_price_content_mobile").append(contentPrice);
            $("#type_price_content").append(contentPrice);

            editTypeFormMobileCancel();
        },
    });
}

function saveFacilities() {
    let facilities = [];

    $("input[name='facilities[]']:checked").each(function () {
        facilities.push(parseInt($(this).val()));
    });

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/restaurant/facilities/store",
        data: {
            id_restaurant: id_restaurant,
            facilities: facilities,
        },
        success: function (response) {
            console.log(response);

            $("#modal-add_facilities").modal("hide");

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content;

            if (response.data.length > 5) {
                for (let i = 0; i < 6; i++) {
                    if (i == 0) {
                        content =
                            '<div class="list-amenities"> <div class="text-align-center" data-maxlength="6"> <i class="f-40 fa fa-' +
                            response.data[i].icon +
                            '"></i> <div class="mb-0 max-line"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            ' </span> </div> </div> <div class="mb-0 list-more"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            " </span> </div> </div>";
                    } else {
                        content =
                            content +
                            '<div class="list-amenities"> <div class="text-align-center" data-maxlength="6"> <i class="f-40 fa fa-' +
                            response.data[i].icon +
                            '"></i> <div class="mb-0 max-line"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            ' </span> </div> </div> <div class="mb-0 list-more"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            " </span> </div> </div>";
                    }
                }
                content =
                    content +
                    '<div class="list-amenities"> <button class="amenities-button" type="button" onclick="view_amenities()"> <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i> <div style="font-size: 15px;">More</div> </button> </div>';
            } else {
                for (let i = 0; i < response.data.length; i++) {
                    if (i == 0) {
                        content =
                            '<div class="list-amenities"> <div class="text-align-center" data-maxlength="6"> <i class="f-40 fa fa-' +
                            response.data[i].icon +
                            '"></i> <div class="mb-0 max-line"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            ' </span> </div> </div> <div class="mb-0 list-more"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            " </span> </div> </div>";
                    } else {
                        content =
                            content +
                            '<div class="list-amenities"> <div class="text-align-center" data-maxlength="6"> <i class="f-40 fa fa-' +
                            response.data[i].icon +
                            '"></i> <div class="mb-0 max-line"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            ' </span> </div> </div> <div class="mb-0 list-more"> <span class="translate-text-group-items"> ' +
                            response.data[i].name +
                            " </span> </div> </div>";
                    }
                }
            }

            $("#contentFacilities").html(content);

            //modal
            if (response.data.length > 5) {
                let contentFacilities;

                for (let h = 0; h < response.data.length; h++) {
                    if (h == 0) {
                        contentFacilities =
                            '<div class="col-6 mb-3"> <span class="translate-text-group-items">' +
                            response.data[h].name +
                            "</span> </div>";
                    } else {
                        contentFacilities =
                            contentFacilities +
                            '<div class="col-6 mb-3"> <span class="translate-text-group-items">' +
                            response.data[h].name +
                            "</span> </div>";
                    }
                }

                $("#contentModalFacilities").html(contentFacilities);
            }
        },
    });
}

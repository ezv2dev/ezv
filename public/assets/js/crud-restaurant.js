$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

let id_restaurant = $("#id_restaurant").val();

//ganti short description restaurant
$(document).on("keyup", "textarea#short-description-form-input", function () {
    $("#short-description-form-input").css("border", "");
    $("#err-shrt-desc").hide();
});
let short_desc_backup = $("#short-description-form-input").val();

function saveShortDescription() {
    let error = 0;
    if (!$("textarea#short-description-form-input").val()) {
        $("#short-description-form-input").css("border", "solid #e04f1a 1px");
        $("#err-shrt-desc").show();
        error = 1;
    } else {
        $("#short-description-form-input").css("border", "");
        $("#err-shrt-desc").hide();
    }
    if (error == 1) {
        return false;
    } else {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                short_desc_backup = response.data.short_description;

                editShortDescriptionCancel();
            },
            error: function (jqXHR, exception) {
                // console.log(jqXHR);
                // console.log(exception);
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message.short_desc[0],
                    position: "topRight",
                });

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editShortDescriptionCancel();

                let short_desc_input = document.getElementById(
                    "short-description-form-input"
                );

                short_desc_input.value = short_desc_backup;
            },
        });
    }
}
$(document).on("keyup", "textarea#description-form-input", function () {
    $("#description-form-input").css("border", "");
    $("#err-desc").hide();
});
function saveDescription() {
    let error = 0;
    if (!$("textarea#description-form-input").val()) {
        $("#description-form-input").css("border", "solid #e04f1a 1px");
        $("#err-desc").show();
        error = 1;
    } else {
        $("#description-form-input").css("border", "");
        $("#err-desc").hide();
    }
    if (error == 1) {
        return false;
    } else {
        let desc = $("#description-form-input").val();

        let btn = document.getElementById("btnSaveDescription");
        btn.textContent = "Saving Description...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            url: "/restaurant/update/description",
            data: {
                id_restaurant: id_restaurant,
                description: desc,
            },
            success: function (response) {
                console.log(response);
                console.log(response.data.description.length);

                let desc_input = document.getElementById(
                    "description-form-input"
                );

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
                    $("#modalDescriptionContent").html(
                        response.data.description
                    );
                } else {
                    $("#buttonShowMoreDescription").html("");
                    $("#btnShowMoreDescription").remove();
                }

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editDescriptionCancel();
            },
        });
    }
}

//ganti nama restaurant
$(document).on("keyup", "textarea#name-form-input", function () {
    $("#name-form-input").css("border", "");
    $("#err-name").hide();
});
let name_resto_backup = $("#name-form-input").val();

function saveNameRestaurant() {
    let error = 0;
    if (!$("textarea#name-form-input").val()) {
        $("#name-form-input").css("border", "solid #e04f1a 1px");
        $("#err-name").show();
        error = 1;
    } else {
        $("#name-form-input").css("border", "");
        $("#err-name").hide();
    }
    if (error == 1) {
        return false;
    } else {
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

                $("#nameRestoInContact").html(response.data.name);

                name_input.value = response.data.name;

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                name_resto_backup = response.data.name;

                editNameCancel();
            },
            error: function (jqXHR, exception) {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message.name[0],
                    position: "topRight",
                });

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editNameCancel();

                let name_input = document.getElementById("name-form-input");
                name_input.value = name_resto_backup;
            },
        });
    }
}

//Ganti Foto Profile
let imageProfileRestaurant;
let readerImageRestaurant;

$("#imageRestaurant").on("change", function (ev) {
    if (document.getElementById("imageRestaurant").files.length != 0) {
        $(".image-box").css("border", "");
        $("#err-img").hide();
    }
    imageProfileRestaurant = this.files[0];

    readerImageRestaurant = new FileReader();
});

$("#updateImageForm").submit(function (e) {
    let error = 0;
    if (document.getElementById("imageRestaurant").files.length == 0) {
        $(".image-box").css("border", "solid #e04f1a 1px");
        $("#err-img").show();
        error = 1;
    } else {
        $(".image-box").css("border", "");
        $("#err-img").hide();
    }
    if (error == 1) {
        e.preventDefault();
    } else {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
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

                $("#profileDropzone").attr("src", "");

                $("#modal-edit_restaurant_profile").modal("hide");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
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
            Accept: "application/json",
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

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
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

    var btn = document.getElementById("btnSaveTimeResto");
    var btn2 = document.getElementById("btnCancelTimeResto");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");
    btn2.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
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

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");
            btn2.classList.remove("disabled");
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

    let btn = document.getElementById("btnSaveRestoTime");
    let btn2 = document.getElementById("btnCancelRestoTime");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");
    btn2.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
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

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");
            btn2.classList.remove("disabled");
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
            Accept: "application/json",
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

    btn = document.getElementById("btnSaveFacilities");
    btn.textContent = "Saving Facilities...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
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

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");

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

//update informasi contact
let phoneResto = $("#phoneResto").val();
let emailResto = $("#emailResto").val();

$("#phoneResto").keyup(function (e) {
    $("#phoneResto").removeClass("is-invalid");
    $("#err-phone").hide();
});
$("#emailResto").keyup(function (e) {
    $("#emailResto").removeClass("is-invalid");
    $("#err-email").hide();
});
$("#updateContactForm").submit(function (e) {
    let error = 0;
    let regexMail = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;
    if (!$("#phoneResto").val()) {
        $("#phoneResto").addClass("is-invalid");
        $("#err-phone").show();
        error = 1;
    } else {
            $("#phoneResto").removeClass("is-invalid");
            $("#err-phone").hide();
    }
    if (!$("#emailResto").val()) {
        $("#emailResto").addClass("is-invalid");
        $("#err-email").show();
        error = 1;
    } else {
        if (!regexMail.test($("#emailResto").val())) {
            $("#emailResto").addClass("is-invalid");
            $("#err-email").show();
            error = 1;
        } else {
            $("#emailResto").removeClass("is-invalid");
            $("#err-email").hide();
        }
    }

    if (error == 1) {
        return false;
    } else {
        e.preventDefault();

        var formData = new FormData(this);

        var btn = document.getElementById("btnSaveContactResto");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/restaurant/update/contact",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                console.log(response);

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                $("#modal-edit_contact").modal("hide");

                //change email in icon
                $("#btnEmailResto").attr("href", "mailto:" + response.data.email);

                //update di modal contact resto
                $("#restoPhoneInContact").html(response.data.phone);
                $("#restoEmailInContact").html(response.data.email);

                emailResto = response.data.email;
                phoneResto = response.data.phone;

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                $("#phoneResto").removeClass("is-invalid");
                $("#emailResto").removeClass("is-invalid");
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
                // console.log(exception);

                if (jqXHR.responseJSON.message.phone) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message.phone[0],
                        position: "topRight",
                    });
                    $("#phoneResto").addClass("is-invalid");
                }

                if (jqXHR.responseJSON.message.email) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message.email[0],
                        position: "topRight",
                    });
                    $("#emailResto").addClass("is-invalid");
                }

                $("#emailResto").val(emailResto);
                $("#phoneResto").val(phoneResto);

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
});

//add save story
let storyRestaurant;
var storyVideoForm = $(".story-upload").children(".story-video-form");
var storyVideoInput = $(".story-upload").children(".story-video-input");
var storyVideoPreview = $(".story-upload").children(".story-video-preview");

$(storyVideoInput)
    .children("input")
    .on("change", function (value) {
        storyRestaurant = this.files[0];
    });

$("#storeStoryForm").submit(function (e) {
    e.preventDefault();

    //validasi
    if (
        storyRestaurant.type.includes("video/mp4") ||
        storyRestaurant.type.includes("video/mov")
    ) {
        var formData = new FormData(this);

        var btn = document.getElementById("btnSaveStory");
        btn.textContent = "Saving Story...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            url: "/restaurant/story/store",
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

                let path = "/foto/restaurant/";
                let slash = "/";
                let uid = response.uid;
                var lowerCaseUid = uid.toLowerCase();
                let content;

                for (let i = 0; i < response.data.length; i++) {
                    if (i == 0) {
                        content =
                            '<div class="card4 col-lg-3" id="story' +
                            response.data[i].id_story +
                            '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story_restaurant(' +
                            response.data[i].id_story +
                            ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                            path +
                            lowerCaseUid +
                            slash +
                            response.data[i].name +
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-restaurant="' +
                            id_restaurant +
                            '" data-story="' +
                            response.data[i].id_story +
                            '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
                    } else {
                        content =
                            content +
                            '<div class="card4 col-lg-3" id="story' +
                            response.data[i].id_story +
                            '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story_restaurant(' +
                            response.data[i].id_story +
                            ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                            path +
                            lowerCaseUid +
                            slash +
                            response.data[i].name +
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-restaurant="' +
                            id_restaurant +
                            '" data-story="' +
                            response.data[i].id_story +
                            '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
                    }
                }

                // console.log(content);

                $(storyVideoInput).children("input").val("");
                $(storyVideoPreview).hide();
                $(storyVideoForm).show();

                $("#storyContent").html("");
                $("#storyContent").append(content);
                $("#title").val("");

                $("#modal-edit_story").modal("hide");

                if (response.data.length > 4) {
                    sliderRestaurant();
                }

                // $("#profileDropzone").attr("src", "");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
                // console.log(exception);

                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message.file[0],
                    position: "topRight",
                });

                $("#modal-edit_story").modal("hide");

                // $("#profileDropzone").attr("src", "");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    } else {
        $(storyVideoInput).children("input").val("");
        $(storyVideoPreview).hide();
        $(storyVideoForm).show();
        $("#title").val("");

        iziToast.error({
            title: "Error",
            message: "The file must be a file of type: <b>mp4 / mov</b>",
            position: "topRight",
        });
    }
    // console.log(readerStoryRestaurant);
});

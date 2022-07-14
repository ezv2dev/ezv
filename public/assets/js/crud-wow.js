$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

let id_activity = $("#id_activity").val();

//ganti short description restaurant
function saveShortDescription() {
    let short_desc = $("#short-description-form-input").val();

    let btn = document.getElementById("btnSaveShortDesc");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/short-description",
        data: {
            id_activity: id_activity,
            short_description: short_desc,
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

            editShortDescriptionCancel();
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");

            editShortDescriptionCancel();

            let short_desc_input = document.getElementById(
                "short-description-form-input"
            );

            short_desc_input.value = short_desc;
        },
    });
}

function saveDescription() {
    let desc = $("#description-form-input").val();

    let btn = document.getElementById("btnSaveDescription");
    btn.textContent = "Saving Description...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/description",
        data: {
            id_activity: id_activity,
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

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");

            editDescriptionCancel();
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            editDescriptionCancel();

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");
        },
    });
}

//ganti nama restaurant
function saveNameActivity() {
    let name = $("#name-form-input").val();

    let btn = document.getElementById("btnSaveName");
    btn.textContent = "Saving Name...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/name",
        data: {
            id_activity: id_activity,
            name: name,
        },
        success: function (response) {
            console.log(response.data.name);
            let name_input = document.getElementById("name-form-input");

            $("#name-content2").html(response.data.name);
            $("#name-content2-mobile").html(response.data.name);

            name_input.value = response.data.name;

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");

            editNameCancel();
        },
        error: function (jqXHR, exception) {
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");

            editNameCancel();

            let name_input = document.getElementById("name-form-input");
            name_input.value = name;
        },
    });
}

//Ganti Foto Profile
let imageProfileActivity;
let readerImageActivity;

$("#imageActivity").on("change", function (ev) {
    if(document.getElementById("imageActivity").files.length != 0){
        $('.image-box').css("border", "");
        $('#err-img').hide();
    }
    imageProfileActivity = this.files[0];

    readerImageActivity = new FileReader();
});

$("#updateImageForm").submit(function (e) {
    let error = 0;
    if(document.getElementById("imageActivity").files.length == 0){
        $('.image-box').css("border", "solid #e04f1a 1px");
        $('#err-img').show();
        error = 1;
    } else {
        $('.image-box').css("border", "");
        $('#err-img').hide();
    }
    if(error == 1) {
        e.preventDefault();
    } else {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("image", imageProfileActivity);

        var btn = document.getElementById("btnupdateImageForm");
        btn.textContent = "Saving Image...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/things-to-do/update/image",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            dataType: "json",
            success: function (response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                readerImageActivity.addEventListener("load", function () {
                    $(".imageProfileActivity").attr(
                        "src",
                        readerImageActivity.result
                    );
                });

                readerImageActivity.readAsDataURL(imageProfileActivity);

                $("#modal-edit_activity_profile").modal("hide");

                $("#profileDropzone").attr("src", "");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
            error: function (jqXHR, exception) {
                // console.log(jqXHR.responseJSON);
                // console.log(exception);
                if(jqXHR.responseJSON.errors) {
                    for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                        iziToast.error({
                            title: "Error",
                            message: jqXHR.responseJSON.errors[i],
                            position: "topRight",
                        });
                    }
                } else {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message,
                        position: "topRight",
                    });
                }

                $("#modal-edit_activity_profile").modal("hide");

                $("#profileDropzone").attr("src", "");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
});

function saveSubcategoryActivity() {
    let subcategory = [];

    $("input[name='subcategory[]']:checked").each(function () {
        subcategory.push(parseInt($(this).val()));
    });

    let btn = document.getElementById("btnsaveCategory");
    btn.textContent = "Saving Tag...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/subcategory/store",
        data: {
            id_activity: id_activity,
            subcategory: subcategory,
        },
        success: function (response) {
            console.log(response);
            // console.log(response.data.tags.length);

            $("#modal-add_subcategory").modal("hide");

            btn.textContent = "Save";
            btn.classList.remove("disabled");

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content = "";

            if (response.data.length > 6) {
                for (let i = 0; i < 7; i++) {
                    content =
                        content +
                        '<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">' +
                        response.data[i].name +
                        "</span>";
                }
                content =
                    content +
                    '<button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button" onclick="view_tag()">More</button>';
            } else {
                for (let i = 0; i < response.data.length; i++) {
                    content =
                        content +
                        '<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">' +
                        response.data[i].name +
                        "</span>";
                }
            }
            content =
                content +
                '&nbsp;<a type="button" onclick="editSubcategory()" style="font-size: 10pt; font-weight: 600; color: #ff7400;">Edit Tags</a>';

            $("#tagsContent").html(content);

            //modal
            if (response.data.length > 6) {
                let contentSubcategory;

                for (let h = 0; h < response.data.length; h++) {
                    if (h == 0) {
                        contentSubcategory =
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data[h].name +
                            "</span></div>";
                    } else {
                        contentSubcategory =
                            contentSubcategory +
                            '<div class="col-md-6"><span class="translate-text-group-items">' +
                            response.data[h].name +
                            "</span></div>";
                    }
                }

                $("#subcategoryModalContent").html("");
                $("#subcategoryModalContent").append(contentSubcategory);
            }

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            $("#modal-add_subcategory").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
    });
}

function saveTimeActivity() {
    console.log('hit saveTimeActivity');

    let open_time = $("#open-time-input").val();
    let closed_time = $("#close-time-input").val();
    console.log(open_time, closed_time);

    var btn = $(".btnSaveTime");
    $(btn).html("Saving...");
    $(btn).attr("disabled", true);

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/time",
        data: {
            id_activity: id_activity,
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

            $(".timeActivityContent").html(
                newOpenTime + " - " + newClosedTime
            );

            $("#open-time-input").val(response.data.open_time);
            $("#close-time-input").val(response.data.closed_time);

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Done");
            $(btn).attr("disabled", false);
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Done");
            $(btn).attr("disabled", false);
        },
    });
}

function saveTimeActivityMobile() {
    console.log('hit saveTimeActivityMobile');

    let open_time = $("#open-time-input-mobile").val();
    let closed_time = $("#close-time-input-mobile").val();
    console.log(open_time, closed_time);

    var btn = $(".btnSaveTime");
    $(btn).html("Saving...");
    $(btn).attr("disabled", true);

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/time",
        data: {
            id_activity: id_activity,
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

            $(".timeActivityContent").html(
                newOpenTime + " - " + newClosedTime
            );

            $("#open-time-input-mobile").val(response.data.open_time);
            $("#close-time-input-mobile").val(response.data.closed_time);

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Done");
            $(btn).attr("disabled", false);
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Done");
            $(btn).attr("disabled", false);
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
        url: "/things-to-do/update/type",
        data: {
            id_activity: id_activity,
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
            } else if (response.data.id_price == 3) {
                contentPrice =
                    contentPrice +
                    '<span style="color: #FF7400" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="' +
                    response.data.price +
                    '">$$$</span>';
            } else {
                contentPrice = contentPrice + "<span>No Price Rate Yet</span>";
            }

            contentPrice =
                contentPrice +
                '<a type="button" onclick="editTypeForm()" style="margin-left: 5px; font-size: 10pt; font-weight: 600; color: #ff7400;">Edit</a>';

            $("#type_price_content").html("");
            $("#type_price_content").append(contentPrice);

            editTypeFormCancel();
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
        },
        url: "/things-to-do/facilities/store",
        data: {
            id_activity: id_activity,
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
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            $("#modal-add_facilities").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
    });
}

function saveContactActivity() {
    let phone = $('#modal-edit_contact').find("input[name='phone']").val();
    let email = $('#modal-edit_contact').find("input[name='email']").val();

    var btn = document.getElementById("btnSaveContact");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/contact",
        data: {
            id_activity: id_activity,
            phone: phone,
            email: email,
        },
        success: function (response) {
            console.log(response);
            $('#modal-edit_contact').find("input[name='phone']").val(response.data.phone);
            $('#modal-edit_contact').find("input[name='email']").val(response.data.email);

            $('#modal-contact_activity').find(".modal-content-phone").text(response.data.phone);
            $('#modal-contact_activity').find(".modal-content-email").text(response.data.email);

            let mailTo = '';
            if(response.data.email){
                mailTo = `mailto:${response.data.email}`;
                $('.mailto-email-activity').removeAttr('href');
                $('.mailto-email-activity').attr('href', mailTo);
            } else {
                $('.mailto-email-activity').removeAttr('href');
            }

            $('#modal-edit_contact').modal('hide');

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if(jqXHR.responseJSON.errors) {
                for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.errors[i],
                        position: "topRight",
                    });
                }
            } else {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });
            }

            $('#modal-edit_contact').modal('hide');

            btn.innerHTML = "<i class='fa fa-check'></i> Done";
            btn.classList.remove("disabled");
        },
    });
}

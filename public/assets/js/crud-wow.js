$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

let id_activity = $("#id_activity").val();

function editShortDescriptionForm() {
    var formattedText = asciiToString(
        document.getElementById("short-description-form-input").value
    );
    document.getElementById("short-description-form-input").value =
        formattedText;
    var form = document.getElementById("short-description-form");
    var content = document.getElementById("short-description-content");
    var formInput = document.getElementById("short-description-form-input");
    form.classList.add("d-block");
    content.classList.add("d-none");

    if (formInput.value == "Make your short description here") {
        formInput.value = "";
    }
}

function editShortDescriptionCancel() {
    var form = document.getElementById("short-description-form");
    var formInput = document.getElementById("short-description-form-input");
    var content = document.getElementById("short-description-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
    // formInput.value = '{{ $activity->short_description }}';

    if (formInput.value == "Make your short description here") {
        formInput.value = "";
    }
}

function editDescriptionForm() {
    var formattedText = asciiToString(
        document.getElementById("description-form-input").value
    );
    document.getElementById("description-form-input").value = formattedText;
    var form = document.getElementById("description-form");
    var content = document.getElementById("description-content");
    var btn = document.getElementById("btnShowMoreDescription");
    form.classList.add("d-block");
    content.classList.add("d-none");
    if (btn != null) {
        btn.classList.add("d-none");
    }
}

function editDescriptionCancel() {
    var form = document.getElementById("description-form");
    var formInput = document.getElementById("description-form-input");
    var content = document.getElementById("description-content");
    var btn = document.getElementById("btnShowMoreDescription");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
    if (btn != null) {
        btn.classList.remove("d-none");
    }
    // formInput.value = '{{ $activity->description }}';
}

//ganti short description activity
$(document).on("keyup", "textarea#short-description-form-input", function () {
    $("#short-description-form-input").css("border", "");
    $("#err-shrt-desc").hide();
});

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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                editShortDescriptionCancel();
            },
            error: function (jqXHR, exception) {
                // console.log(jqXHR);
                // console.log(exception);
                if (jqXHR.responseJSON.errors) {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                editShortDescriptionCancel();

                let short_desc_input = document.getElementById(
                    "short-description-form-input"
                );

                short_desc_input.value = short_desc;
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
            },
            url: "/things-to-do/update/description",
            data: {
                id_activity: id_activity,
                description: desc,
            },
            success: function (response) {
                console.log(response);
                console.log(response.data.description.length);

                let desc_input = document.getElementById(
                    "description-form-input"
                );

                if (
                    /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(
                        navigator.userAgent.toLowerCase()
                    )
                ) {
                    $("#description-content").html(
                        response.data.description.substring(0, 400) + "..."
                    );
                } else {
                    $("#description-content").html(
                        response.data.description.substring(0, 600) + "..."
                    );
                }

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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                editDescriptionCancel();
            },
            error: function (jqXHR, exception) {
                // console.log(jqXHR);
                // console.log(exception);
                if (jqXHR.responseJSON.errors) {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
}

//ganti nama wow
$(document).on("keyup", "textarea#name-form-input", function () {
    $("#name-form-input").css("border", "");
    $("#err-name").hide();
});

let nameBackup = $("#name-form-input").val();

function saveNameActivity() {
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
                name: $("#name-form-input").val(),
            },
            success: function (response) {
                console.log(response.data.name);
                let name_input = document.getElementById("name-form-input");

                $("#name-content2").html(response.data.name);
                $("#name-content2-mobile").html(response.data.name);

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                editNameCancel();

                nameBackup = response.data.name;
                name_input.value = response.data.name;
            },
            error: function (jqXHR, exception) {
                if (jqXHR.responseJSON.errors) {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                editNameCancel();

                let name_input = document.getElementById("name-form-input");
                name_input.value = name;
            },
        });
    }
}

//Ganti Foto Profile
let imageProfileActivity;
let readerImageActivity;

$("#imageActivity").on("change", function (ev) {
    if (document.getElementById("imageActivity").files.length != 0) {
        $(".image-box").css("border", "");
        $("#err-img").hide();
    }
    imageProfileActivity = this.files[0];

    readerImageActivity = new FileReader();
});

$("#updateImageForm").submit(function (e) {
    let error = 0;
    if (document.getElementById("imageActivity").files.length == 0) {
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
                if (jqXHR.responseJSON.errors) {
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
                    '<button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button" onclick="view_subcategory()">More</button>';
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
            if (jqXHR.responseJSON.errors) {
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
    console.log("hit saveTimeActivity");

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

            $(".timeActivityContent").html(newOpenTime + " - " + newClosedTime);

            $("#open-time-input").val(response.data.open_time);
            $("#close-time-input").val(response.data.closed_time);

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Save");
            $(btn).attr("disabled", false);
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if (jqXHR.responseJSON.errors) {
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

            $(btn).html("<i class='fa fa-check'></i> Save");
            $(btn).attr("disabled", false);
        },
    });
}

function saveTimeActivityMobile() {
    console.log("hit saveTimeActivityMobile");

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

            $(".timeActivityContent").html(newOpenTime + " - " + newClosedTime);

            $("#open-time-input-mobile").val(response.data.open_time);
            $("#close-time-input-mobile").val(response.data.closed_time);

            editTimeFormCancel();
            editTimeFormMobileCancel();

            $(btn).html("<i class='fa fa-check'></i> Save");
            $(btn).attr("disabled", false);
        },
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            if (jqXHR.responseJSON.errors) {
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

            $(btn).html("<i class='fa fa-check'></i> Save");
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

let priceImageActivity;
// $("#modal-add_price").find("input[name='image']").on("change", function (ev) {
//     priceImageActivity = this.files[0];
// });
$("#modal-add_price")
    .find("input[name='image']")
    .eq(0)
    .on("change", function (ev) {
        priceImageActivity = this.files[0];
        console.log("hit data");
    });

// $("#addPriceForm").submit(function(e) {
//     e.preventDefault();
//     let btn = document.getElementById("btnSavePrice");
//     btn.textContent = "Saving Price...";
//     btn.classList.add("disabled");

//     var formData = new FormData(this);

//     $.ajax({
//         type: "POST",
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//         url: "/things-to-do/price/store",
//         data: formData,
//         cache: false,
//         processData: false,
//         contentType: false,
//         enctype: "multipart/form-data",
//         dataType: "json",
//         success: function(response) {
//             console.log(response);

//             iziToast.success({
//                 title: "Success",
//                 message: response.message,
//                 position: "topRight",
//             });

//             const path = "/foto/activity/";
//             const uid = response.uid.uid;
//             const slash = "/";
//             const lowerCaseUid = uid.toLowerCase();

//             let content = "";

//             content += '<div class="col-12 col-md-4 text-center tab-body">';
//             content += '<div class="content list-image-content">';
//             content +=
//                 '<div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"';
//             content += 'data-dots="false" data-arrows="true">';

//             if (response.data.foto) {
//                 content +=
//                     '<a href="/wow/price/' +
//                     response.data.id_price +
//                     '/details"';
//                 content += 'target="_blank" class="grid-image-container">';
//                 content += '<img class="brd-radius img-fluid grid-image lozad"';
//                 content += 'style="height: 200px; display: block;"';
//                 content +=
//                     'src="' +
//                     path +
//                     lowerCaseUid +
//                     slash +
//                     response.data.foto +
//                     '" alt="">';
//                 content += "</a>";
//             } else {
//                 content +=
//                     '<a href="/wow/price/' +
//                     response.data.id_price +
//                     '/details"';
//                 content += 'target="_blank" class="grid-image-container">';
//                 content += '<img class="brd-radius img-fluid grid-image lozad"';
//                 content += 'style="height: 200px; display: block;"';
//                 content += 'src="/foto/default/no-image.jpeg" alt="">';
//                 content += "</a>";
//             }

//             content += "</div> </div> </div>";
//             content +=
//                 '<div class="col-12 col-md-4 text-justify tab-body" style="cursor: pointer;"';
//             content +=
//                 'onclick="window.location=/wow/price/' +
//                 response.data.id_price +
//                 '/details">';
//             content += "<h4>";
//             content += "<p>";
//             content +=
//                 '<a href="/wow/price/' + response.data.id_price + '/details">';
//             content +=
//                 '<span class="translate-text-group-items">' +
//                 response.data.name +
//                 "</span> </a> </p> </h4>";

//             content += '<p class="desc-hotel">';
//             content += limit(response.data.description, 200);
//             content += "</p> </div>";

//             content +=
//                 '<div class="col-12 col-md-4 text-center tab-body" style="cursor: pointer;"';
//             content +=
//                 'onclick="window.location=/wow/price/' +
//                 response.data.id_price +
//                 '/details">';
//             content += "IDR " + response.data.price;
//             content += "<br>";
//             content +=
//                 '<a href="/wow/price/' + response.data.id_price + '/details"';
//             content +=
//                 'target="_blank" style="display: inline-block; width: 50%;"';
//             content +=
//                 'class="btn btn-outline-dark table-room-button">Select</a>';
//             content += "</div>";

//             let lengthContent = $("#price-content").find(
//                 ".list-image-content"
//             ).length;

//             if (lengthContent == 0) {
//                 $("#price-content").html("");
//             }

//             $("#price-content").append(content);

//             $("#modal-add_price").find("input[name='id_activity']").val("");
//             $("#modal-add_price").find("input[name='name']").val("");
//             $("#modal-add_price").find("input[name='price']").val("");
//             $("#modal-add_price").find("input[name='start_date']").val("");
//             $("#modal-add_price").find("input[name='end_date']").val("");
//             $("#modal-add_price").find("input[name='description']").val("");
//             $("#modal-add_price").find("input[name='image']").val("");
//             $("#modal-add_price").find("img").attr("src", "");

//             btn.innerHTML = "<i class='fa fa-check'></i> Save";
//             btn.classList.remove("disabled");

//             $("#modal-add_price").modal("hide");
//         },
//         error: function(jqXHR, exception) {
//             if (jqXHR.responseJSON.errors) {
//                 for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
//                     iziToast.error({
//                         title: "Error",
//                         message: jqXHR.responseJSON.errors[i],
//                         position: "topRight",
//                     });
//                 }
//             } else {
//                 iziToast.error({
//                     title: "Error",
//                     message: jqXHR.responseJSON.message,
//                     position: "topRight",
//                 });
//             }

//             btn.innerHTML = "<i class='fa fa-check'></i> Save";
//             btn.classList.remove("disabled");
//         },
//     });
// });

$("#name").keyup(function (e) {
    $("#name").removeClass("is-invalid");
    $("#err-xname").hide();
});
$("#xprice").keyup(function (e) {
    $("#xprice").removeClass("is-invalid");
    $("#err-price").hide();
});
$("#xdescription").keyup(function (e) {
    $("#xdescription").removeClass("is-invalid");
    $("#err-descprc").hide();
});
$("#startDate").change(function (e) {
    $("#startDate").removeClass("is-invalid");
    $("#err-sdateprc").hide();
});
$("#endDate").change(function (e) {
    $("#endDate").removeClass("is-invalid");
    $("#err-edateprc").hide();
});
$("#imgPrice").change(function (e) {
    $("#file-upload1").children(".image-box").css("border-color", "");
    $("#err-imgprc").hide();
});

$("#addPriceForm").submit(function (e) {
    let error = 0;
    if (!$("#name").val()) {
        $("#name").addClass("is-invalid");
        $("#err-xname").show();
        error = 1;
    } else {
        $("#name").removeClass("is-invalid");
        $("#err-xname").hide();
    }
    if (!$("#xprice").val()) {
        $("#xprice").addClass("is-invalid");
        $("#err-price").show();
        error = 1;
    } else {
        $("#xprice").removeClass("is-invalid");
        $("#err-price").hide();
    }
    if (!$("#startDate").val()) {
        $("#startDate").addClass("is-invalid");
        $("#err-sdateprc").show();
        error = 1;
    } else {
        $("#startDate").removeClass("is-invalid");
        $("#err-sdateprc").hide();
    }
    if (!$("#endDate").val()) {
        $("#endDate").addClass("is-invalid");
        $("#err-edateprc").show();
        error = 1;
    } else {
        $("#endDate").removeClass("is-invalid");
        $("#err-edateprc").hide();
    }
    if (!$("#xdescription").val()) {
        $("#xdescription").addClass("is-invalid");
        $("#err-descprc").show();
        error = 1;
    } else {
        $("#xdescription").removeClass("is-invalid");
        $("#err-descprc").hide();
    }
    if (document.getElementById("imgPrice").files.length == 0) {
        $("#file-upload1")
            .children(".image-box")
            .css("border-color", "#e04f1a");
        $("#err-imgprc").show();
        error = 1;
    } else {
        $("#file-upload1").children(".image-box").css("border-color", "");
        $("#err-imgprc").hide();
    }
    if (error == 1) {
        e.preventDefault();
    } else {
        e.preventDefault();
        let btn = document.getElementById("btnSavePrice");
        btn.textContent = "Saving Price...";
        btn.classList.add("disabled");

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/things-to-do/price/store",
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

                const path = "/foto/activity/";
                const uid = response.uid.uid;
                const slash = "/";
                const lowerCaseUid = uid.toLowerCase();

                var start_date = new Date(response.data.start_date);
                var end_date = new Date(response.data.end_date);

                let content = "";

                content += `<div class="col-12 row p-3 mb-4 ms-0 me-0" style="box-shadow: 1px 1px 15px rgb(0 0 0 / 17%); background-color: white; border-radius: 15px;">
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 p-0">
                                    <div class="content list-image-content">
                                        <input type="hidden" value="" id="id_price" name="id_price">
                                        <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white"
                                            data-dots="false" data-arrows="true">`;
                content += `<a href="/wow/price/${response.data.id_price}/details" target="_blank" class="grid-image-container">
                                <img class="brd-radius img-fluid grid-image lozad" style="height: 200px; display: block;"`;
                content +=
                    'src="' +
                    path +
                    lowerCaseUid +
                    slash +
                    response.data.foto +
                    '" alt="">';
                content += "</a>";

                content += "</div> </div> </div>";

                content += `<div class="col-12 col-md-5 col-lg-5 col-xl-5 px-3">
                            <div class="col-12">
                                <h4 class="mb-0">
                                    <p class="mb-0">
                                    <a href="">
                                        <span
                                            clas="translate-text-group-items">${response.data.name}</span>
                                    </a>
                                    </p>
                                </h4>
                            </div>
                            <div class="col-12">
                                <p class="desc-hotel mb-0">`;

                content += `${limit(response.data.description, 200)}
                            </p>
                                </div>
                                <div class="col-12">
                                    <p><b>${start_date.toDateString()}</b> -
                                        <b>${end_date.toDateString()}</b>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-3 col-lg-3 col-xl-3 d-flex align-items-center">
                                <div class="col-12 text-center">
                                    <p class="mb-2">`;

                content += "IDR " + response.data.price.toLocaleString();

                content += `</p>
                                <a onclick="open_detail_price()" target="_blank"
                                    style="display: inline-block; width: 50%;"
                                    class="btn btn-primary table-room-button">Select</a>
                            </div>
                        </div>
                    </div>
                `;

                let lengthContent = $("#price-content").find(
                    ".list-image-content"
                ).length;

                if (lengthContent == 0) {
                    $("#price-content").html("");
                }

                $("#price-content").append(content);

                $("#modal-add_price").find("input[name='id_activity']").val("");
                $("#modal-add_price").find("input[name='name']").val("");
                $("#modal-add_price").find("input[name='price']").val("");
                $("#modal-add_price").find("input[name='start_date']").val("");
                $("#modal-add_price").find("input[name='end_date']").val("");
                $("#modal-add_price").find("input[name='description']").val("");
                $("#modal-add_price").find("input[name='image']").val("");
                $("#modal-add_price").find("img").attr("src", "");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");

                $("#modal-add_price").modal("hide");
            },
            error: function (jqXHR, exception) {
                if (jqXHR.responseJSON.errors) {
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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
});

function limit(string = "", limit = 0) {
    return string.substring(0, limit);
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
            $("#default-amen-null").hide();

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content;

            if (response.data.length == 0) {
                content = "";
                $("#row-amenities").append(
                    `<p id="default-amen-null">There is no facilities</p>`
                );
            }

            if (response.data.length > 6) {
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
                    '<div class="list-amenities"> <button class="amenities-button" type="button" onclick="view_amenities()"> <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i> <div style="font-size: 15px;" class="translate-text-group-items">More</div> </button> </div>';
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
            if (response.data.length > 6) {
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
            if (jqXHR.responseJSON.errors) {
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
$("#emailWow").keyup(function (e) {
    $("#emailWow").removeClass("is-invalid");
    $("#err-email").hide();
});
$("#phoneWow").keyup(function (e) {
    $("#phoneWow").removeClass("is-invalid");
    $("#err-phone").hide();
});

function saveContactActivity() {
    let error = 0;
    let regexMail = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;
    if (!$("#phoneWow").val()) {
        $("#phoneWow").addClass("is-invalid");
        $("#err-phone").show();
        error = 1;
    } else {
        $("#phoneWow").removeClass("is-invalid");
        $("#err-phone").hide();
    }
    if (!$("#emailWow").val()) {
        $("#emailWow").addClass("is-invalid");
        $("#err-email").show();
        error = 1;
    } else {
        if (!regexMail.test($("#emailWow").val())) {
            $("#emailWow").addClass("is-invalid");
            $("#err-email").show();
            error = 1;
        } else {
            $("#emailWow").removeClass("is-invalid");
            $("#err-email").hide();
        }
    }

    if (error == 1) {
        return false;
    } else {
        let phone = $("#modal-edit_contact").find("input[name='phone']").val();
        let email = $("#modal-edit_contact").find("input[name='email']").val();

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
                $("#modal-edit_contact")
                    .find("input[name='phone']")
                    .val(response.data.phone);
                $("#modal-edit_contact")
                    .find("input[name='email']")
                    .val(response.data.email);

                $("#modal-contact_activity")
                    .find(".modal-content-phone")
                    .text(response.data.phone);
                $("#modal-contact_activity")
                    .find(".modal-content-email")
                    .text(response.data.email);

                //change email in icon
                if (response.data.email == null) {
                    $("#contentEmailActivity").html(
                        '<a type="button" href="javascript:void(0);"> <i class="fa-solid fa-envelope text-secondary"></i> </a>'
                    );
                } else {
                    $("#contentEmailActivity").html(
                        '<a id="btnEmailActivity" target="_blank" type="button" href="mailto:' +
                            response.data.email +
                            '"> <i class="fa-solid fa-envelope"></i> </a>'
                    );
                }

                $("#modal-edit_contact").modal("hide");

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
                if (jqXHR.responseJSON.errors) {
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

                $("#modal-edit_contact").modal("hide");

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
        });
    }
}

//add save story
let storyActivity;
var storyVideoForm = $(".story-upload").children(".story-video-form");
var storyVideoInput = $(".story-upload").children(".story-video-input");
var storyVideoPreview = $(".story-upload").children(".story-video-preview");

$(storyVideoInput)
    .children("input")
    .on("change", function (value) {
        storyActivity = this.files[0];
        if (document.getElementById("storyVideo").files.length != 0) {
            $(".story-video-form").css("border", "");
            $("#err-stry-vid").hide();
        }
    });
$(document).on("keyup", "#title", function () {
    $("#title").css("border", "");
    $("#err-stry-ttl").hide();
});
$("#storeStoryForm").submit(function (e) {
    let error = 0;
    if (document.getElementById("storyVideo").files.length == 0) {
        $(".story-video-form").css("border", "solid #e04f1a 1px");
        $("#err-stry-vid").show();
        error = 1;
    } else {
        $(".story-video-form").css("border", "");
        $("#err-stry-vid").hide();
    }
    if (!$("#title").val()) {
        $("#title").css("border", "solid #e04f1a 1px");
        $("#err-stry-ttl").show();
        error = 1;
    } else {
        $("#title").css("border", "");
        $("#err-stry-ttl").hide();
    }
    if (error == 1) {
        e.preventDefault();
    } else {
        e.preventDefault();

        //validasi
        if (
            storyActivity.type.includes("video/mp4") ||
            storyActivity.type.includes("video/mov")
        ) {
            var formData = new FormData(this);

            var btn = document.getElementById("btnSaveStory");
            var btnRemove = document.querySelector(".story-video-preview .button-reset");
            var btnChooseAnother = document.querySelector(".story-video-preview .button-choose-other");
            btn.textContent = "Saving Story...";
            btn.classList.add("disabled");
            btnRemove.disabled = true;
            btnChooseAnother.disabled = true;

            $.ajax({
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Accept: "application/json",
                },
                url: "/things-to-do/story/store",
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

                    let path = "/foto/activity/";
                    let slash = "/";
                    let uid = response.uid;
                    var lowerCaseUid = uid.toLowerCase();
                    let content;

                    for (let i = 0; i < response.data.length; i++) {
                        if (i == 0) {
                            content =
                                '<div class="card4 col-lg-3" id="story' +
                                response.data[i].id_story +
                                '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story_activity(' +
                                response.data[i].id_story +
                                ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                                path +
                                lowerCaseUid +
                                slash +
                                response.data[i].name +
                                '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-activity="' +
                                id_activity +
                                '" data-story="' +
                                response.data[i].id_story +
                                '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> <span class="title-story">' +
                                response.data[i].title +
                                "</span> </div> </div> </div>";
                        } else {
                            content =
                                content +
                                '<div class="card4 col-lg-3" id="story' +
                                response.data[i].id_story +
                                '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story_activity(' +
                                response.data[i].id_story +
                                ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                                path +
                                lowerCaseUid +
                                slash +
                                response.data[i].name +
                                '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-activity="' +
                                id_activity +
                                '" data-story="' +
                                response.data[i].id_story +
                                '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> <span class="title-story">' +
                                response.data[i].title +
                                "</span> </div> </div> </div>";
                        }
                    }

                    if (response.video.length > 0) {
                        for (let v = 0; v < response.video.length; v++) {
                            content +=
                                '<div class="card4 col-lg-3 radius-5" id="displayStoryVideo' +
                                response.video[v].id_video +
                                '"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_video_activity(' +
                                response.video[v].id_video +
                                ')"> <div class="story-video-player"><i class="fa fa-play"></i> </div> <video href="javascript:void(0)" class="story-video-grid" loading="lazy" style="object-fit: cover;" src="' +
                                path +
                                lowerCaseUid +
                                slash +
                                response.video[v].name +
                                '#t=1.0"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                                id_activity +
                                '" data-video="' +
                                response.video[v].id_video +
                                '" onclick="delete_photo_video(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
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

                    let sumStory = response.data.length + response.video.length;

                    if (sumStory > 4) {
                        sliderRestaurant();
                    }

                    // $("#profileDropzone").attr("src", "");

                    btn.innerHTML = "<i class='fa fa-check'></i> Save";
                    btn.classList.remove("disabled");
                    btnRemove.disabled = true;
                    btnChooseAnother.disabled = true;
                },
                error: function (jqXHR, exception) {
                    // console.log(jqXHR);
                    // console.log(exception);

                    if (jqXHR.responseJSON.errors) {
                        for (
                            let i = 0;
                            i < jqXHR.responseJSON.errors.length;
                            i++
                        ) {
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

                    $("#modal-edit_story").modal("hide");

                    // $("#profileDropzone").attr("src", "");

                    btn.innerHTML = "<i class='fa fa-check'></i> Save";
                    btn.classList.remove("disabled");
                    btnRemove.disabled = true;
                    btnChooseAnother.disabled = true;
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
        // console.log(readerStoryActivity);
    }
});

function saveLocation() {
    console.log("hit saveLocation");
    let form = $("#editLocationForm");

    const formData = {
        id_activity: parseInt(form.find(`input[name='id_activity']`).val()),
        id_location: parseInt(
            form
                .find(`select[name=id_location] option`)
                .filter(":selected")
                .val()
        ),
        longitude: form.find(`input[name='longitude']`).val(),
        latitude: form.find(`input[name='latitude']`).val(),
    };

    console.log(formData);

    let btn = form.find("#btnSaveLocation");
    btn.text("Saving...");
    btn.addClass("disabled");

    // save data
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/things-to-do/update/location",
        data: formData,
        // response data
        success: function (response) {
            let latitudeOld = parseFloat(response.data.latitude);
            let longitudeOld = parseFloat(response.data.longitude);
            // variabel global edit marker
            markerEditLocation = null;
            // pin marker to map on edit map
            initEditLocationActivity(latitudeOld, longitudeOld);
            // refresh detail map
            view_maps(parseInt(form.find(`input[name='id_activity']`).val()));
            // alert success
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
            // enabled button
            btn.html(`<i class='fa fa-check'></i> Save`);
            btn.removeClass("disabled");
            // close modal
            $("#modal-edit_location").modal("hide");
        },
        // response error
        error: function (jqXHR, exception) {
            // console.log(jqXHR);
            // console.log(exception);
            // alert error
            if (jqXHR.responseJSON.errors) {
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
            // enabled button
            btn.html(`<i class='fa fa-check'></i> Save`);
            btn.removeClass("disabled");
            // close modal
            $("#modal-edit_location").modal("hide");
        },
    });
}

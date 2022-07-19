//Change name
$(document).on("keyup", "textarea#name-form-input", function () {
    $("#name-form-input").css("border", "");
    $("#err-name").hide();
});

function editNameHotel(id_hotel) {
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
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/update/name",
            data: {
                id_hotel: id_hotel,
                name: $("#name-form-input").val(),
            },
            success: function (response) {
                $("#name-content").html(response.data);
                $("#name-content-mobile").html(response.data);
                $("#hotelTitle").html(response.data + " - EZV2");

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

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editNameCancel();
            },
        });
    }
}

//Change short desc
$(document).on("keyup", "textarea#short-description-form-input", function () {
    $("#short-description-form-input").css("border", "");
    $("#err-shrt-desc").hide();
});

function editShortDesc(id_hotel) {
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
        let btn = document.getElementById("btnSaveShortDesc");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/update/short-description",
            data: {
                id_hotel: id_hotel,
                short_description: $("#short-description-form-input").val(),
            },
            success: function (response) {
                $("#short-description-content").html(response.data);
                $("#short-description-form-input").val(response.data);
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

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editShortDescriptionCancel();

                $("#short-description-form-input").val(response.data);
            },
        });
    }
}

//change profile pic
$("#imageHotel").on("change", function (ev) {
    if (document.getElementById("imageHotel").files.length != 0) {
        $(".image-box").css("border", "");
        $("#err-img").hide();
    }

    imageProfileHotel = this.files[0];

    readerImageHotel = new FileReader();
});
$("#updateImageForm").submit(function (e) {
    let error = 0;
    if (document.getElementById("imageHotel").files.length == 0) {
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
        let btn = document.getElementById("btnupdateImageForm");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");

        var formData = new FormData(this);
        formData.append("image", imageProfileHotel);

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/update/image",
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

                readerImageHotel.addEventListener("load", function () {
                    $("#imageProfileHotel").attr(
                        "src",
                        readerImageHotel.result
                    );
                });

                readerImageHotel.readAsDataURL(imageProfileHotel);
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                $("#modal-edit_hotel_profile").modal("hide");
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

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                $("#modal-edit_hotel_profile").modal("hide");
            },
        });
    }
});


//Change long desc
$(document).on("keyup", "textarea#description-form-input", function () {
    $("#description-form-input").css("border", "");
    $("#err-desc").hide();
});
function editDescriptionHotel(id_hotel) {
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
        let btn = document.getElementById("btnSaveDesc");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/update/description",
            data: {
                id_hotel: id_hotel,
                description: $("#description-form-input").val(),
            },
            success: function (response) {
                $("#description-content").html(response.data.substring(0, 600));

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                if (response.data.length > 600) {
                    $("#btnShowMoreDescription").html("");
                    $("#btnShowMoreDescription").append(
                        '<a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);" onclick="showMoreDescription();"><span style="text-decoration: underline; color: #ff7400;">Show more</span> <span style="color: #ff7400;">></span></a>'
                    );
                    $("#modalDescriptionHotel").html(response.data);
                } else {
                    $("#btnShowMoreDescription").html("");
                    $("#btnShowMoreDescription").remove();
                }
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                editDescriptionCancel();
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

                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                editDescriptionCancel();

                $("#description-form-input").val(response.data);
            },
        });
    }
}

//Save Story
let storyHotel;
var storyVideoForm = $(".story-upload").children(".story-video-form");
var storyVideoInput = $(".story-upload").children(".story-video-input");
var storyVideoPreview = $(".story-upload").children(".story-video-preview");

$("#storyVideo").on("change", function (value) {
    storyHotel = this.files[0];
});

$("#updateStoryForm").submit(function (e) {
    e.preventDefault();
    let id_hotel = $('#id_hotel').val();

    if(storyHotel.type.includes("video/mp4") || storyHotel.type.includes("video/mov")) {
        var formData = new FormData(this);
        console.log(formData);

        var btn = document.getElementById("btnSaveStory");
        btn.textContent = "Saving Story...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
                Accept: "application/json",
            },
            url: "/hotel/update/story",
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

                let path = "/foto/gallery/";
                let slash = "/";
                let uid = response.uid;
                var lowerCaseUid = uid.toLowerCase();
                let content;

                for (let i = 0; i < response.data.length; i++) {
                    if (i == 0) {
                        content =
                            '<div class="card4 col-lg-3" id="displayStory' +
                            response.data[i].id_story +
                            '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story(' +
                            response.data[i].id_story +
                            ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                            path +
                            lowerCaseUid +
                            slash +
                            response.data[i].name +
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-hotel="' +
                            id_hotel +
                            '" data-story="' +
                            response.data[i].id_story +
                            '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
                    } else {
                        content =
                            content +
                            '<div class="card4 col-lg-3" id="displayStory' +
                            response.data[i].id_story +
                            '" style="border-radius: 5px;"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view_story(' +
                            response.data[i].id_story +
                            ');"> <div class="story-video-player"> <i class="fa fa-play" aria-hidden="true"></i> </div> <video href="javascript:void(0)" class="story-video-grid" style="object-fit: cover;" src="' +
                            path +
                            lowerCaseUid +
                            slash +
                            response.data[i].name +
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-hotel="' +
                            id_hotel +
                            '" data-story="' +
                            response.data[i].id_story +
                            '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
                    }
                }

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

                btn.innerHTML = "<i class='fa fa-check'></i> Save";
                btn.classList.remove("disabled");
            },
            error: function (jqXHR, exception) {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.message,
                    position: "topRight",
                });

                $("#modal-edit_story").modal("hide");

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
});

$(".check-cat").change(function() {
    $('#check_cat').each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length > 0) {
            $('.checkmark2').css("border", "");
            $('#err-slc-cat').hide();
        }
    });
});
function editCategoryH(id_hotel) {
    let error = 0;

    $('#check_cat').each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length == 0) {
            $('.checkmark2').css("border", "solid #e04f1a 1px");
            $('#err-slc-cat').show();
            error = 1;
        } else {

        }
    });
    if (error == 1) {
        return false;
    } else {
        var hotelCategory = [];
        $("input[name='hotelCategory[]']:checked").each(function () {
            hotelCategory.push(parseInt($(this).val()));
        });

        let btn = document.getElementById("btnSaveCategoryH");
        btn.textContent = "Saving Category...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/update/category",
            data: {
                id_hotel: id_hotel,
                hotelCategory: hotelCategory,
            },
            success: function (response) {
                $("#ModalCategoryHotel").modal("hide");

                btn.innerHTML = '<i class="fa fa-check"></i> Save';
                btn.classList.remove("disabled");

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                var length = response.data.length;

                let content;

                for (let j = 0; j < length; j++) {
                    if (j == 0) {
                        content = `<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400;">${response.data[j]["hotel_category"]["name"]} </span>`;
                    } else if (j < 3) {
                        content =
                            content +
                            `<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400;">${response.data[j]["hotel_category"]["name"]} </span>`;
                    } else if (j > 2) {
                    } else {
                    }
                }

                $("#displayCategory").html(content);

                if (length > 3) {
                    $("#moreCategory").removeClass("d-none");
                    $("#moreCategory").addClass("d-block");
                    $("#moreCategory").html(`
                            <button class="btn btn-outline-dark btn-sm rounded hotel-tag-button"
                            onclick="view_subcategory()">More</button>
                        `);
                } else {
                    $("#moreCategory").removeClass("d-block");
                    $("#moreCategory").addClass("d-none");
                }

                $("#moreSubCategory").html(`
                        <div class='col-md-6'>${response.data[0]["hotel_category"]["name"]}</div>
                    `);
                for (let i = 1; i < length; i++) {
                    $("#moreSubCategory").append(`
                            <div class='col-md-6'>${response.data[i]["hotel_category"]["name"]}</div>
                        `);
                }
            },
        });
    }
}

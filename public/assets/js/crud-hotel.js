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
            $('.checklist-cat').css("border", "");
            $('#err-slc-cat').hide();
        }
    });
});
function editCategoryH(id_hotel) {
    let error = 0;

    $('#check_cat').each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length == 0) {
            $('.checklist-cat').css("border", "solid #e04f1a 1px");
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

function addComa(x) {
    return x.replace(/\B(?=(\d{3})+(?!\d))/g,",");
}
$("#name_room").keyup(function () {
    $('#name_room').removeClass('is-invalid');
    $('#err-rname').hide();
});
$("#room_size").keyup(function () {
    $('#room_size').removeClass('is-invalid');
    $('#err-rsize').hide();
});
$("#number_of_room").keyup(function () {
    $('#number_of_room').removeClass('is-invalid');
    $('#err-numrom').hide();
});
$("#capacity").keyup(function () {
    $('#capacity').removeClass('is-invalid');
    $('#err-cap').hide();
});
$("#frm-price").keyup(function () {
    $('#frm-price').removeClass('is-invalid');
    $('#err-prc').hide();
});
$("#add-room-hotel").submit(function (e) {
    let error = 0;
    if(!$('#name_room').val()) {
        $('#name_room').addClass('is-invalid');
        $('#err-rname').show();
        error = 1;
    }
    if(!$('#room_size').val()) {
        $('#room_size').addClass('is-invalid');
        $('#err-rsize').show();
        error = 1;
    }
    if(!$('#number_of_room').val()) {
        $('#number_of_room').addClass('is-invalid');
        $('#err-numrom').show();
        error = 1;
    }
    if(!$('#capacity').val()) {
        $('#capacity').addClass('is-invalid');
        $('#err-cap').show();
        error = 1;
    }
    if(!$('#frm-price').val()) {
        $('#frm-price').addClass('is-invalid');
        $('#err-prc').show();
        error = 1;
    }
    if(error == 1) {
        e.preventDefault();
    } else {
        e.preventDefault();
        var btn = document.getElementById("btnaddroomForm");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/hotel/add-room",
            data: {
                id_hotel: $('#id_hotel').val(),
                id_hotel_type: $('#id_hotel_type').val(),
                name_room: $('#name_room').val(),
                id_bed: $('#id_bed').val(),
                room_size: $('#room_size').val(),
                number_of_room: $('#number_of_room').val(),
                capacity: $('#capacity').val(),
                status: $('#status').val(),
                price: $('#frm-price').val(),
            },
            success: function (response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                let rooms;

                rooms = '<div class="col-12 col-md-4 text-center tab-body"> <div class="content list-image-content"> <input type="hidden" value="" id="id_hotel" name="id_hotel"> <div class="js-slider list-slider slick-nav-black slick-dotted-inner slick-dotted-white js-slider-enabled slick-initialized slick-slider" data-dots="false" data-arrows="true"> <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 296px; transform: translate3d(0px, 0px, 0px);"><a href="'+ response.data +'" target="_blank" class="grid-image-container slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 296px;"> <img class="brd-radius img-fluid grid-image" style="height: 200px; display: block;" src="https://images.unsplash.com/photo-1609611606051-f22b47a16689?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80" alt=""> </a></div></div></div></div></div><div class="col-12 col-md-4 text-justify tab-body" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');"><h4><p><a href="' +
                response.data + '" target="_blank">' + $('#name_room').val() + '</a></p></h4><p class="desc-hotel"><span class="translate-text-single"></span></p><div class="d-flex" style="font-size: 14px;"><svg class="bk-icon -streamline-room_size" height="24px" width="24px" viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false"><path d="M3.75 23.25V7.5a.75.75 0 0 0-1.5 0v15.75a.75.75 0 0 0 1.5 0zM.22 21.53l2.25 2.25a.75.75 0 0 0 1.06 0l2.25-2.25a.75.75 0 1 0-1.06-1.06l-2.25 2.25h1.06l-2.25-2.25a.75.75 0 0 0-1.06 1.06zM5.78 9.22L3.53 6.97a.75.75 0 0 0-1.06 0L.22 9.22a.75.75 0 1 0 1.06 1.06l2.25-2.25H2.47l2.25 2.25a.75.75 0 1 0 1.06-1.06zM7.5 3.75h15.75a.75.75 0 0 0 0-1.5H7.5a.75.75 0 0 0 0 1.5zM9.22.22L6.97 2.47a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06L8.03 2.47v1.06l2.25-2.25A.75.75 0 1 0 9.22.22zm12.31 5.56l2.25-2.25a.75.75 0 0 0 0-1.06L21.53.22a.75.75 0 1 0-1.06 1.06l2.25 2.25V2.47l-2.25 2.25a.75.75 0 0 0 1.06 1.06zM10.5 13.05v7.2a2.25 2.25 0 0 0 2.25 2.25h6A2.25 2.25 0 0 0 21 20.25v-7.2a.75.75 0 0 0-1.5 0v7.2a.75.75 0 0 1-.75.75h-6a.75.75 0 0 1-.75-.75v-7.2a.75.75 0 0 0-1.5 0zm13.252 2.143l-6.497-5.85a2.25 2.25 0 0 0-3.01 0l-6.497 5.85a.75.75 0 0 0 1.004 1.114l6.497-5.85a.75.75 0 0 1 1.002 0l6.497 5.85a.75.75 0 0 0 1.004-1.114z"></path></svg><p style="margin-left: 10px; margin-top: 5px; font-size: 12px;" class="mb-0">' +
                $('#room_size').val() + ' m<sup>2</sup></p></div></div><div class="col-6 col-md-2 text-center tab-body type-room" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');">';
                for(let i = 0; i < $('#capacity').val(); i++) {
                    rooms += '<i class="fas fa-user" aria-hidden="true"></i>';
                }
                rooms += $('#id_bed').val() == 1 ? '<p style="margin-bottom: 10px; font-size: 13px;">Single</p><svg xmlns="http://www.w3.org/2000/svg" width="40px" height="30px" viewBox="0 0 40 28" style="fill: #222222;"><g id="Group_2" data-name="Group 2" transform="translate(-66 524)"><path id="bed_FILL1_wght400_GRAD0_opsz48" d="M4,38V25.25a5.612,5.612,0,0,1,.5-2.35A4.368,4.368,0,0,1,6,21.1V15.3A5.209,5.209,0,0,1,11.3,10h9a4.336,4.336,0,0,1,2.05.5A5.348,5.348,0,0,1,24,11.85a5.454,5.454,0,0,1,1.625-1.35A4.19,4.19,0,0,1,27.65,10h9a5.211,5.211,0,0,1,3.8,1.525A5.085,5.085,0,0,1,42,15.3v5.8a4.368,4.368,0,0,1,1.5,1.8,5.612,5.612,0,0,1,.5,2.35V38H41V34H7v4ZM25.5,20.25H39V15.3a2.192,2.192,0,0,0-.675-1.65A2.32,2.32,0,0,0,36.65,13H27.5a1.775,1.775,0,0,0-1.425.7,2.45,2.45,0,0,0-.575,1.6ZM9,20.25H22.5V15.3a2.45,2.45,0,0,0-.575-1.6A1.775,1.775,0,0,0,20.5,13H11.3A2.3,2.3,0,0,0,9,15.3Z" transform="translate(62 -534)"></path></g></svg></div>' : '<p style="margin-bottom: 10px; font-size: 13px;"> Twin </p><svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 82 28.001" style="fill: #222222;"> <g id="Group_4" data-name="Group 4" transform="translate(-61 525)"> <path id="Subtraction_1" data-name="Subtraction 1" d="M3,28H0V15.25A5.631,5.631,0,0,1,.5,12.9,4.389,4.389,0,0,1,2,11.1V5.3A5.21,5.21,0,0,1,7.3,0H32.65a5.234,5.234,0,0,1,3.8,1.525A5.109,5.109,0,0,1,38,5.3v5.8a4.391,4.391,0,0,1,1.5,1.8,5.644,5.644,0,0,1,.5,2.35V28H37V24H3v4ZM7,3A2,2,0,0,0,5,5v6H35V5a2,2,0,0,0-2-2H7Z" transform="translate(61 -525)"></path> <path id="Subtraction_2" data-name="Subtraction 2" d="M3,28H0V15.25A5.631,5.631,0,0,1,.5,12.9,4.389,4.389,0,0,1,2,11.1V5.3A5.21,5.21,0,0,1,7.3,0H32.65a5.234,5.234,0,0,1,3.8,1.525A5.109,5.109,0,0,1,38,5.3v5.8a4.391,4.391,0,0,1,1.5,1.8,5.644,5.644,0,0,1,.5,2.35V28H37V24H3v4ZM7,3A2,2,0,0,0,5,5v6H35V5a2,2,0,0,0-2-2H7Z" transform="translate(103 -525)"></path> </g> </svg></div>';
                rooms += '<div class="col-6 col-md-2 text-center tab-body price-room" style="cursor: pointer;" onclick="window.open(\'' +
                response.data + '\', \'_blank\');">IDR ' + addComa($('#frm-price').val()) + '<br><a class="btn btn-outline-dark table-room-button" target="_blank">Select Room</a></div>';
                $('.room-content').last().append(rooms);
                $('#modal-add_room').modal("hide");

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
                $('#modal-add_room').modal("hide");
            },
        });
    }
});

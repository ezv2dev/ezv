//Change language
$(".check-lang").change(function() {
    $('#check_lang').each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length > 0) {
            $('.check-lang').css("border", "");
            $('#err-slc-lang').hide();
            $('#err-slc-lang').text('');
        }
    });
});

// function replace ascii to string in every input
function asciiToString(str) {
    var newStr = str;
    var arrAsciiIndex = [...str.matchAll(/[&#0-9;]/g)];
    if (arrAsciiIndex.length >= 3) {
        for (var i = 0; i < arrAsciiIndex.length; i++) {
            if (str[arrAsciiIndex[i].index] === "&" && i != arrAsciiIndex.length - 1) {
                if (arrAsciiIndex[i + 1] != undefined) {
                    if (str[arrAsciiIndex[i + 1].index] === "#") {
                        if (arrAsciiIndex[i + 2] != undefined) {
                            if (!isNaN(parseInt(str[arrAsciiIndex[i + 2].index]))) {
                                var lastIndex = i + 3;
                                var number = str[arrAsciiIndex[i + 2].index];
                                while(lastIndex < arrAsciiIndex.length) {
                                    if (!isNaN(parseInt(str[arrAsciiIndex[lastIndex].index]))) {
                                        number += str[arrAsciiIndex[lastIndex].index];
                                        lastIndex++;
                                    } else {
                                        break;
                                    }
                                }
                                var escapeChar = String.fromCharCode(parseInt(number));
                                var pattern = str[arrAsciiIndex[i].index] + str[arrAsciiIndex[i + 1].index]
                                            + number + ";"
                                newStr = newStr.replace(pattern, escapeChar);
                            }
                        }
                    }
                }
            }
        }
    }
    return newStr;
}

function editNameForm() {
    var formattedText = asciiToString(document.getElementById("name-form-input").value);
    document.getElementById("name-form-input").value = formattedText;
    var form = document.getElementById("name-form");
    var content = document.getElementById("name-content");
    form.classList.add("d-block");
    content.classList.add("d-none");
}

function editNameCancel() {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
    // formInput.value = '{{ $user->first_name }} {{ $user->last_name }}';
}

//Change name
$(document).on("keyup", "textarea#name-form-input", function() {
    $("#name-form-input").css("border", "");
    $("#err-name").hide();
});

let id_collab = $("#id_collab").val();

function editNameCollab(id_collab) {
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
            url: "/colaborator/update/name",
            data: {
                id: id_collab,
                name: $("#name-form-input").val(),
            },
            success: function(response) {
                $("#name-content").html(response.data);
                $("#name-content-mobile").html(response.data);
                $("#collabTitle").html(response.data + " - EZV2");

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                editNameCancel();
            },
            error: function(jqXHR, exception) {
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

//Change profile pic
let imageProfileCollab;
let readerImageCollab;

$("#imageCollab").on("change", function(ev) {
    if (document.getElementById("imageCollab").files.length != 0) {
        $('.image-box').css("border", "");
        $('#err-img').hide();
    }
    imageProfileCollab = this.files[0];

    readerImageCollab = new FileReader();
});

$("#updateImageForm").submit(function(e) {
    let error = 0;
    if (document.getElementById("imageCollab").files.length == 0) {
        $('.image-box').css("border", "solid #e04f1a 1px");
        $('#err-img').show();
        error = 1;
    } else {
        $('.image-box').css("border", "");
        $('#err-img').hide();
    }
    if (error == 1) {
        e.preventDefault();
    } else {

        e.preventDefault();
        let btn = document.getElementById("btnupdateImageForm");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");

        var formData = new FormData(this);
        formData.append("image", imageProfileCollab);

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/collaborator/update/image",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            dataType: "json",
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                readerImageCollab.addEventListener("load", function() {
                    $("#imageProfileCollab").attr(
                        "src",
                        readerImageCollab.result
                    );
                });

                readerImageCollab.readAsDataURL(imageProfileCollab);
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                $("#modal-edit_collab_profile").modal("hide");
            },
            error: function(jqXHR, exception) {
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
                $("#modal-edit_collab_profile").modal("hide");
            },
        });
    }
});

//Change description
$(document).on("keyup", "textarea#description-form-input", function() {
    $('#description-form-input').css("border", "");
    $('#err-desc').hide();
});

function editDescriptionForm() {
    var formattedText = asciiToString(document.getElementById("description-form-input").value);
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
}

//add save story
let storyCollab;
var storyVideoForm = $(".story-upload").children(".story-video-form");
var storyVideoInput = $(".story-upload").children(".story-video-input");
var storyVideoPreview = $(".story-upload").children(".story-video-preview");

$("#storyVideo").on("change", function (value) {
    storyCollab = this.files[0];
    if (document.getElementById("storyVideo").files.length != 0) {
        $(".story-video-form").css("border", "");
        $("#err-stry-vid").hide();
    }
});
$(document).on("keyup", "#title", function () {
    $("#title").css("border", "");
    $("#err-stry-ttl").hide();
});
$("#updateStoryForm").submit(function (e) {
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
            storyCollab.type.includes("video/mp4") ||
            storyCollab.type.includes("video/mov")
        ) {
            //let validate = validateStory();

            //if (validate > 0) {
            //} else {
            var formData = new FormData(this);
            console.log(formData);

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
                url: "/collab/update/story",
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

                    let path = "/foto/collaborator/";
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
                                '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                                id_collab +
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
                                '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                                id_collab +
                                '" data-story="' +
                                response.data[i].id_story +
                                '" onclick="delete_story(this)"> <i class="fa fa-trash" style="color:red; margin-left: 25px;" data-bs-toggle="popover" data-bs-animation="true" data-bs-placement="bottom" title="Delete"></i> </a> </a> </div> </div> </div>';
                        }
                    }

                    if (response.video.length > 0) {
                        for (let v = 0; v < response.video.length; v++) {
                            content +=
                                '<div class="card4 col-lg-3 radius-5" id="displayStoryVideo' +
                                response.video[v].id_video +
                                '"> <div class="img-wrap"> <div class="video-position"> <a type="button" onclick="view(' +
                                response.video[v].id_video +
                                ')"> <div class="story-video-player"><i class="fa fa-play"></i> </div> <video href="javascript:void(0)" class="story-video-grid" loading="lazy" style="object-fit: cover;" src="' +
                                path +
                                lowerCaseUid +
                                slash +
                                response.video[v].name +
                                '#t=1.0"> </video> <a class="delete-story" href="javascript:void(0);" data-id="' +
                                id_collab +
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
                    console.log(jqXHR);
                    // console.log(exception);

                    iziToast.error({
                        title: "Error",
                        message: jqXHR.responseJSON.message,
                        position: "topRight",
                    });

                    $("#modal-edit_story").modal("hide");

                    // $("#profileDropzone").attr("src", "");

                    btn.innerHTML = "<i class='fa fa-check'></i> Save";
                    btn.classList.remove("disabled");
                    btnRemove.disabled = true;
                    btnChooseAnother.disabled = true;
                },
            });
            //}
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
    }
});

function saveDescription(id_collab) {
    let error = 0;
    if (!$('textarea#description-form-input').val()) {
        $('#description-form-input').css("border", "solid #e04f1a 1px");
        $('#err-desc').show();
        error = 1;
    } else {
        $('#description-form-input').css("border", "");
        $('#err-desc').hide();
    }
    if (error == 1) {
        return false;
    } else {
        let btn = document.getElementById("btnSaveDescription");
        btn.textContent = "Saving Description...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/collab/update/description",
            data: {
                id_collab: id_collab,
                collab_description: $('#description-form-input').val()
            },
            success: function(response) {
                if(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) {
                    $("#description-content").html(response.data.substring(0, 400) + '...');
                } else {
                    $("#description-content").html(response.data.substring(0, 600) + '...');
                }

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                if(/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase())) {
                    if (response.data.length > 400) {
                        $("#btnShowMoreDescription").html("");
                        $("#btnShowMoreDescription").append(
                            '<a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);" onclick="showMoreDescription();"><span style="text-decoration: underline; color: #ff7400;">Show more</span> <span style="color: #ff7400;">></span></a>'
                        );
                        //$("#modalDescriptionVilla").html(response.data);
                    } else {
                        $("#btnShowMoreDescription").html("");
                        $("#btnShowMoreDescription").remove();
                    }
                } else {
                    if (response.data.length > 600) {
                        $("#btnShowMoreDescription").html("");
                        $("#btnShowMoreDescription").append(
                            '<a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);" onclick="showMoreDescription();"><span style="text-decoration: underline; color: #ff7400;">Show more</span> <span style="color: #ff7400;">></span></a>'
                        );
                        //$("#modalDescriptionVilla").html(response.data);
                    } else {
                        $("#btnShowMoreDescription").html("");
                        $("#btnShowMoreDescription").remove();
                    }
                }
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                editDescriptionCancel();
            },
            error: function(jqXHR, exception) {
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

                $('#description-form-input').val(jqXHR.responseJSON.data);
            },
        });
    }
}

function saveLocation() {
    console.log('hit saveLocation');
    let form = $('#editLocationForm');

    const formData = {
        id_collab: parseInt(form.find(`input[name='id_collab']`).val()),
        id_location: parseInt(form.find(`select[name=id_location] option`).filter(':selected').val()),
        longitude: form.find(`input[name='longitude']`).val(),
        latitude: form.find(`input[name='latitude']`).val()
    };

    console.log(formData);

    let btn = form.find('#btnSaveLocation');
    btn.text("Saving...");
    btn.addClass("disabled");

    // save data
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/colaborator/update/location",
        data: formData,
        // response data
        success: function (response) {
            console.log(response);
            let latitudeOld = parseFloat(response.data.latitude);
            let longitudeOld = parseFloat(response.data.longitude);
            // variabel global edit marker
            markerEditLocation = null;
            // pin marker to map on edit map
            initEditLocationCollab(latitudeOld, longitudeOld);
            // refresh detail map
            initialize(latitudeOld,longitudeOld);
            // alert success
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
            // updated new location name
            $('#saveLocationContent').text(response.data.location.name);
            // enabled button
            btn.html(`<i class='fa fa-check'></i> Done`);
            btn.removeClass("disabled");
            // close modal
            $('#modal-edit_location').modal('hide');
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
            btn.html(`<i class='fa fa-check'></i> Done`);
            btn.removeClass("disabled");
            // close modal
            $('#modal-edit_location').modal('hide');
        },
    });
}

function saveSocialMedia() {
    console.log('hit saveSocialMedia');
    const form = $('#saveSocialMediaForm');

    let btn = form.find('#btnSaveSocialMedia');
    btn.text("Saving...");
    btn.addClass("disabled");

    const formData = {
        id_collab: form.find(`input[name='id_collab']`).val(),
        instagram_link: form.find(`input[name='instagram_link']`).val(),
        instagram_follower: form.find(`input[name='instagram_follower']`).val(),
        facebook_link: form.find(`input[name='facebook_link']`).val(),
        facebook_follower: form.find(`input[name='facebook_follower']`).val(),
        twitter_link: form.find(`input[name='twitter_link']`).val(),
        twitter_follower: form.find(`input[name='twitter_follower']`).val(),
        tiktok_link: form.find(`input[name='tiktok_link']`).val(),
        tiktok_follower: form.find(`input[name='tiktok_follower']`).val(),
    };

    console.log(formData);

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/colaborator/update/social-media",
        data: formData,
        success: function (response) {
            console.log(response);
            // notification
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
            // append new content
            let instagramContent = ``;
            if(response.data.instagram_link){
                instagramContent = `
                    <a href="${response.data.instagram_link}" id="instagramID">
                        <i class="fab fa-instagram" target="_blank"></i>
                    </a>
                `;
            }
            let facebookContent = ``;
            if(response.data.facebook_link){
                facebookContent = `
                    <a href="${response.data.facebook_link}" id="facebookID">
                        <i class="fab fa-facebook-f" target="_blank"></i>
                    </a>
                `;
            }
            let twitterContent = ``;
            if(response.data.twitter_link){
                twitterContent = `
                    <a href="${response.data.twitter_link}" id="twitterID">
                        <i class="fab fa-twitter" target="_blank"></i>
                    </a>
                `;
            }
            let tiktokContent = ``;
            if(response.data.tiktok_link){
                tiktokContent = `
                    <a href="${response.data.tiktok_link}" id="tiktokID">
                        <i class="fab fa-tiktok" target="_blank"></i>
                    </a>
                `;
            }
            let content = `
                <div class="social-links">
                    ${instagramContent}
                    ${facebookContent}
                    ${twitterContent}
                    ${tiktokContent}
                </div>
            `;
            const isExist = response.data.instagram_link
                || response.data.facebook_link
                || response.data.twitter_link
                || response.data.tiktok_link;

            $('#saveSocialMediaContent').html('');
            if(isExist){
                $('#saveSocialMediaContent').html(content);
            }
            // enabled button
            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
            // close modal
            $("#modalSocialMedia").modal("hide");
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

            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");

            $("#modalSocialMedia").modal("hide");
        },
    });
}

function saveGender() {
    console.log('hit saveGender');

    const form = $('#saveGenderForm');
    console.log(form.find("input[name='gender[]']:checked").val());

    const formData = {
        id_collab: form.find(`input[name='id_collab']`).val(),
        gender: form.find("input[name='gender[]']:checked").val(),
    };

    let btn = form.find('#btnSaveGender');
    btn.text("Saving...");
    btn.addClass("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/colaborator/update/gender",
        data: formData,
        success: function (response) {
            console.log(response);
            // notification
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            // append updated gender
            $('#saveGenderContent').text(response.data.gender);

            // enabled button
            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
            // close modal
            $('#modal-add_gender').modal('hide');
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

            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");

            $('#modal-add_gender').modal('hide');
        },
    });
}

function saveLanguage() {
    console.log('hit saveLanguage');
    const form = $('#saveLanguageForm');
    const languageInputs = form.find(`input[name='language[]']:checked`);
    let languageIds = [];
    for (let i = 0; i < languageInputs.length; i++) {
        const languageInput = languageInputs.eq(i);
        languageIds.push(languageInput.val());
    }
    const formData = {
        id_collab: form.find(`input[name='id_collab']`).val(),
        language: languageIds
    };

    let btn = form.find('#btnSaveLanguage');
    btn.text("Saving...");
    btn.addClass("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/collab/update/language",
        data: formData,
        success: function (response) {
            console.log(response);

            // notification
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            // append updated langugae content
            let languageContent = '';
            if (response.data) {
                for (let i = 0; i < response.data.length; i++) {
                    const language = response.data[i].language;
                    languageContent += `
                        <img src="http://localhost:8000/assets/flags/${language.flag}"
                            style="width: 27px; border:0.1px solid grey;">&nbsp;
                    `;
                }
            }
            $('#saveLanguageContent').html(languageContent);

            // enabled button
            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
            // close modal
            $('#collab_language_modal').modal('hide');
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

            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");

            $('#collab_language_modal').modal('hide');
        },
    });
}

function saveTags() {
    console.log('hit saveTag');

    const form = $('#saveTagsForm');
    const categoryInputs = form.find(`input[name='category[]']:checked`);
    let categoryIds = [];
    for (let i = 0; i < categoryInputs.length; i++) {
        const categoryInput = categoryInputs.eq(i);
        categoryIds.push(categoryInput.val());
    }
    const formData = {
        id_collab: form.find(`input[name='id_collab']`).val(),
        category: categoryIds
    };

    let btn = form.find('#btnSaveTags');
    btn.text("Saving...");
    btn.addClass("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/colaborator/store/category",
        data: formData,
        success: function (response) {
            console.log(response);

            // notification
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            // append updated tag content
            let tagsContent = '';
            // append updated tag content modal
            let tagsContentModal = '';
            if (response.data) {
                if(response.data.length > 7){
                    for (let i = 0; i < 7; i++) {
                        const name = response.data[i].name;
                        tagsContent += `
                            <span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">
                                ${name}
                            </span>
                        `;
                    }
                    tagsContent += `
                        <button class="btn btn-outline-dark btn-sm rounded restaurant-tag-button" onclick="view_tag()">
                            More
                        </button>
                    `;
                } else {
                    for (let i = 0; i < response.data.length; i++) {
                        const name = response.data[i].name;
                        tagsContent += `
                            <span class="badge rounded-pill fw-normal" style="background-color: #FF7400;">
                                ${name}
                            </span>
                        `;
                    }
                }

                for (let i = 0; i < response.data.length; i++) {
                    const name = response.data[i].name;
                    tagsContentModal += `
                        <div class='col-md-6'>
                            <span class="translate-text-group-items">${name}</span>
                        </div>
                    `;
                }
            }
            $('#saveTagsContent').html(tagsContent);
            $('#saveTagsContentModal').html(tagsContentModal);

            // enabled button
            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
            // close modal
            $('#modal-add_tag').modal('hide');
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

            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");

            $('#modal-add_tag').modal('hide');
        },
    });
}

function saveReview() {
    console.log('hit saveReview');

    const form = $('#saveReviewForm');
    const formData = {
        id_collab: form.find(`input[name='id_collab']`).val(),
        experience: form.find(`input[name='experience']:checked`).val(),
        comment: form.find(`input[name='comment']`).val()
    };
    console.log(formData);

    let btn = form.find('#btnSaveReview');
    btn.text("Saving...");
    btn.addClass("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/collaborator/review/store",
        data: formData,
        success: function (response) {
            console.log(response);
            // notification
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            // append updated data

            // enabled button
            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
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

            btn.html("<i class='fa fa-check'></i> Save");
            btn.removeClass("disabled");
        },
    });
}

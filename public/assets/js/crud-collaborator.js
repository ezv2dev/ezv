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
    var form = document.getElementById("description-form");
    var content = document.getElementById("description-content");
    var btn = document.getElementById("btnShowMoreDescription");
    form.classList.add("d-block");
    content.classList.add("d-none");
    btn.classList.add("d-none");
}

function editDescriptionCancel() {
    var form = document.getElementById("description-form");
    var formInput = document.getElementById("description-form-input");
    var content = document.getElementById("description-content");
    var btn = document.getElementById("btnShowMoreDescription");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
    btn.classList.remove("d-none");
}

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
                    //$("#modalDescriptionVilla").html(response.data);
                } else {
                    $("#btnShowMoreDescription").html("");
                    $("#btnShowMoreDescription").remove();
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

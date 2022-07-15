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
            url: "/colaborator/update/name",
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

//Change profile pic
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

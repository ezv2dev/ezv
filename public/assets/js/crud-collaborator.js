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

function editLangCollab(id_collab) {
    let error = 0;

    $('#check_lang').each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length == 0) {
            $('.check-lang').css("border", "solid #e04f1a 1px");
            $('#err-slc-lang').show();
            error = 1;
        }
    });
    if (error == 1) {
        return false;
    } else {
        let btn = document.getElementById("btnSaveLang");
        btn.textContent = "Saving...";
        btn.classList.add("disabled");
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/collab/update/language",
            data: {
                id: id_collab,
                name: $("#name-form-input").val(),
            },
            success: function (response) {
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

                readerImageVilla.addEventListener("load", function() {
                    $("#imageProfileCollab").attr(
                        "src",
                        readerImageVilla.result
                    );
                });

                readerImageVilla.readAsDataURL(imageProfileCollab);
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

function updateGender(id_collab) {
    var genderArray = [];
    $("input[name='gender[]']:checked").each(function() {
        genderArray.push($(this).val());
    });

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/colaborator/update/gender",
        data: {
            id: id_collab,
            gender: genderArray,
        },
        success: function(response) {
            $("#genderID").html(response.data);
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
            $('#modal-add_gender').modal('hide');
        }
    });
}

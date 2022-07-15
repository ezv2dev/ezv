//Ganti Foto Profile
let imageProfileCollab;
let readerImageCollab;

$("#imageCollab").on("change", function (ev) {
    if(document.getElementById("imageCollab").files.length != 0){
        $('.image-box').css("border", "");
        $('#err-img').hide();
    }
    imageProfileCollab = this.files[0];

    readerImageCollab = new FileReader();
});

$("#updateImageForm").submit(function (e) {
    let error = 0;
    if(document.getElementById("imageCollab").files.length == 0){
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
        formData.append("image", imageProfileCollab);

        var btn = document.getElementById("btnupdateImageForm");
        btn.textContent = "Saving Image...";
        btn.classList.add("disabled");
        // $.ajax({
        //     type: "POST",
        //     headers: {
        //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //     },
        //     url: "/collaborator/update/image",
        //     data: formData,
        //     cache: false,
        //     processData: false,
        //     contentType: false,
        //     enctype: "multipart/form-data",
        //     dataType: "json",
        //     success: function (response) {
        //         iziToast.success({
        //             title: "Success",
        //             message: response.message,
        //             position: "topRight",
        //         });

        //         readerImageCollab.addEventListener("load", function () {
        //             $(".imageProfileCollab").attr(
        //                 "src",
        //                 readerImageCollab.result
        //             );
        //         });

        //         readerImageCollab.readAsDataURL(imageProfileCollab);

        //         $("#modal-edit_activity_profile").modal("hide");

        //         $("#profileDropzone").attr("src", "");

        //         btn.innerHTML = "<i class='fa fa-check'></i> Save";
        //         btn.classList.remove("disabled");
        //     },
        //     error: function (jqXHR, exception) {
        //         // console.log(jqXHR.responseJSON);
        //         // console.log(exception);
        //         if(jqXHR.responseJSON.errors) {
        //             for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
        //                 iziToast.error({
        //                     title: "Error",
        //                     message: jqXHR.responseJSON.errors[i],
        //                     position: "topRight",
        //                 });
        //             }
        //         } else {
        //             iziToast.error({
        //                 title: "Error",
        //                 message: jqXHR.responseJSON.message,
        //                 position: "topRight",
        //             });
        //         }

        //         $("#modal-edit_activity_profile").modal("hide");

        //         $("#profileDropzone").attr("src", "");

        //         btn.innerHTML = "<i class='fa fa-check'></i> Save";
        //         btn.classList.remove("disabled");
        //     },
        // });
    }
});
$(document).on("keyup", "textarea#description-form-input", function () {
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
function saveDescription() {
    let error = 0;
    if(!$('textarea#description-form-input').val()) {
        $('#description-form-input').css("border", "solid #e04f1a 1px");
        $('#err-desc').show();
        error = 1;
    } else {
        $('#description-form-input').css("border", "");
        $('#err-desc').hide();
    }
    if(error == 1) {
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

                editDescriptionCancel();

                $('#description-form-input').val(jqXHR.responseJSON.data);
            },
        });
    }
}

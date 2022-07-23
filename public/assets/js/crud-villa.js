$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// let id_villa = $("#id_villa").val();

let nameVillaBackup = $("#name-form-input").val();

function editNameVilla() {
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
            url: "/villa/update/name",
            data: {
                id_villa: id_villa,
                villa_name: $("#name-form-input").val(),
            },
            success: function(response) {
                $("#name-content2").html(response.data);
                $("#name-content-mobile").html(response.data);
                $("#villaTitle").html(response.data + " - EZV2");

                var formInput = document.getElementById("name-form-input");
                formInput.value = response.data;
                nameVillaBackup = response.data;

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

function editNameForm() {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.add("d-block");
    content.classList.add("d-none");

    if (formInput.value == "Home Name Here") {
        formInput.value = "";
    }
}

function editNameCancel() {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");

    formInput.value = nameVillaBackup;

    if (formInput.value == "Home Name Here") {
        formInput.value = "";
    }
}

let shortDescBackup = $("#short-description-form-input").val();

function editShortDesc() {
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
            url: "/villa/update/short-description",
            data: {
                id_villa: id_villa,
                short_desc: $("#short-description-form-input").val(),
            },
            success: function(response) {
                $("#short-description-content2").html(response.data);
                $("#short-description-form-input").val(response.data);
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                shortDescBackup = response.data;

                editShortDescriptionCancel();
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

                editShortDescriptionCancel();

                $("#short-description-form-input").val(shortDescBackup);
            },
        });
    }
}

function editShortDescriptionForm() {
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

    formInput.value = shortDescBackup;

    if (formInput.value == "Make your short description here") {
        formInput.value = "";
    }
}

function editBedroomVilla(id_villa) {
    var bedroom = $("input[name='bedroom']:checked").val();
    var beds = $("input[name='beds']:checked").val();
    var bathroom = $("input[name='bathroom']:checked").val();
    var adult = $("input[name='adult']:checked").val();
    var children = $("input[name='children']:checked").val();

    var bedroom1 = $("input[name='bedroom1']").val();
    var beds1 = $("input[name='beds1']").val();
    var bathroom1 = $("input[name='bathroom1']").val();
    var adult1 = $("input[name='adult1']").val();
    var children1 = $("input[name='children1']").val();
    var size = $("input[name='size']").val();

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/villa/update/bedroom",
        data: {
            id_villa: id_villa,
            bedroom: bedroom,
            beds: beds,
            bathroom: bathroom,
            adult: adult,
            children: children,
            bedroom1: bedroom1,
            beds1: beds1,
            bathroom1: bathroom1,
            adult1: adult1,
            children1: children1,
            size: size,
        },
        success: function(response) {
            if (response.data.bedroom1 == null) {
                $("#bedroomID").html(response.data.bedroom);
            } else {
                $("#bedroomID").html(response.data.bedroom1);
            }
            if (response.data.beds1 == null) {
                $("#bedsID").html(response.data.beds);
            } else {
                $("#bedsID").html(response.data.beds1);
            }
            if (response.data.bathroom1 == null) {
                $("#bathroomID").html(response.data.bathroom);
            } else {
                $("#bathroomID").html(response.data.bathroom1);
            }
            if (response.data.adult1 == null) {
                $("#adultID").html(response.data.adult);
            } else {
                $("#adultID").html(response.data.adult1);
            }
            if (response.data.children1 == null) {
                $("#childrenID").html(response.data.children);
            } else {
                $("#childrenID").html(response.data.children1);
            }
            $("#sizeID").html(response.data.size);

            $("#modal-edit_bedroom").modal("hide");
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
        },
    });

    saveBedroomDetail(id_villa);
}

async function saveBedroomDetail(id_villa) {
    console.log("hit saveBedroomDetail");
    console.log($(".bedroomDetailFormContent").length);
    let formData = [];
    for (let i = 0; i < $(".bedroomDetailFormContent").length; i++) {
        const content = $(".bedroomDetailFormContent").eq(i);

        let bedroomRawContent = content.find("input[name='bedroom[]']:checked");
        let bathroomRawContent = content.find(
            "input[name='bathroom[]']:checked"
        );
        let bedroomIds = [];
        let bathroomIds = [];
        for (let index = 0; index < bedroomRawContent.length; index++) {
            bedroomIds.push(bedroomRawContent.eq(index).val());
        }
        for (let index = 0; index < bathroomRawContent.length; index++) {
            bathroomIds.push(bathroomRawContent.eq(index).val());
        }

        let bedRawContent = content.find(".bedroomDetailFormContentBed");
        let bed = [];
        for (let index = 0; index < bedRawContent.length; index++) {
            bed.push({
                id_bed: bedRawContent
                    .eq(index)
                    .find(`input[name='id_bed']`)
                    .val(),
                qty: bedRawContent.eq(index).find(`input[name='qty']`).val(),
            });
        }

        formData.push({
            bathroom_ids: bathroomIds,
            bedroom_ids: bedroomIds,
            bed: bed,
        });
    }
    await $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/villa/update/bedroom/detail",
        data: {
            id_villa: id_villa,
            data: formData,
        },
        cache: false,
        enctype: "multipart/form-data",
        dataType: "json",
        success: function(response) {
            if (response.room_count) {
                $("#bedroomID").html(response.room_count);
            }
            if (response.bed_count) {
                $("#bedsID").html(response.bed_count);
            }

            // add latest content to modal amenities
            let content = ``;
            for (let index = 0; index < response.data.length; index++) {
                const data = response.data[index];
                content += contentBedroomDetail(index, data);
            }
            $("#bedroom-detail-content").html(content);

            // iziToast.success({
            //     title: "Success",
            //     message: response.message,
            //     position: "topRight",
            // });

            // disabled/enabled button select/button add bedroom
            // if(response.length > 0){
            //     $('#btnSelectBedroomNumber').addClass('d-none');
            //     $('#btnAddBedroom').removeClass('d-none');
            // } else {
            //     $('#btnSelectBedroomNumber').removeClass('d-none');
            //     $('#btnAddBedroom').addClass('d-none');
            // }
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
        },
    });
}

function contentBedroomDetail(count, data) {
    let bedroomAmenities = ``;
    if (data.villa_bedroom_detail_bedroom_amenities) {
        for (
            let index = 0; index < data.villa_bedroom_detail_bedroom_amenities.length; index++
        ) {
            const item = data.villa_bedroom_detail_bedroom_amenities[index];
            bedroomAmenities += `
                <div class="col-md-12">
                    <span class="translate-text-group-items">
                        ${item.name}
                    </span>
                </div>
            `;
        }
    }
    let bathroomAmenities = ``;
    if (data.villa_bedroom_detail_bathroom_amenities) {
        for (
            let index = 0; index < data.villa_bedroom_detail_bathroom_amenities.length; index++
        ) {
            const item = data.villa_bedroom_detail_bathroom_amenities[index];
            bathroomAmenities += `
                <div class="col-md-12">
                    <span class="translate-text-group-items">
                        ${item.name}
                    </span>
                </div>
            `;
        }
    }
    let bed = ``;
    if (data.villa_bedroom_detail_bed) {
        for (
            let index = 0; index < data.villa_bedroom_detail_bed.length; index++
        ) {
            const item = data.villa_bedroom_detail_bed[index];
            bed += `
                <div class="col-md-12">
                    <span class="translate-text-group-items">
                        ${item.bed.name}
                    </span>
                    <span>
                        x${item.qty}
                    </span>
                </div>
            `;
        }
    }
    let content = `
        <div class="row-modal-amenities translate-text-group row-border-bottom padding-top-bottom-18px">
            <div class="col-md-12">
                <h5 class="mb-3">Bedroom ${count + 1}</h5>
            </div>
            <div class="col-md-12 row">
                <div class="col-md-6">
                    ${bedroomAmenities}
                    ${bed}
                </div>
                <div class="col-md-6">
                    ${bathroomAmenities}
                </div>
            </div>
        </div>
    `;

    return content;
}
$(".check-cat").change(function() {
    $("#check_cat").each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length > 0) {
            $(".checklst-cat").css("border", "");
            $("#err-slc-cat").hide();
        }
    });
});

function editCategoryV(id_villa) {
    let error = 0;

    $("#check_cat").each(function() {
        if ($(this).find('input[type="checkbox"]:checked').length == 0) {
            $(".checklst-cat").css("border", "solid #e04f1a 1px");
            $("#err-slc-cat").show();
            error = 1;
        } else {}
    });
    if (error == 1) {
        return false;
    } else {
        var villaCategory = [];
        $("input[name='villaCategory[]']:checked").each(function() {
            villaCategory.push(parseInt($(this).val()));
        });

        let btn = document.getElementById("btnSaveCategoryV");
        btn.textContent = "Saving Category...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/villa/update/category",
            data: {
                id_villa: id_villa,
                villaCategory: villaCategory,
            },
            success: function(response) {
                $("#ModalCategoryVilla").modal("hide");

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
                        content = `<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">${response.data[j]["villa_category"]["name"]} </span>`;
                    } else if (j < 3) {
                        content =
                            content +
                            `<span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400; margin-right: 3px;">${response.data[j]["villa_category"]["name"]} </span>`;
                    } else if (j > 2) {} else {}
                }

                $("#displayCategory").html(content);

                if (length > 3) {
                    $("#moreCategory").removeClass("d-none");
                    $("#moreCategory").addClass("d-block");
                    $("#moreCategory").html(`
                            <button class="btn btn-outline-dark btn-sm rounded villa-tag-button"
                            onclick="view_subcategory()">More</button>
                        `);
                } else {
                    $("#moreCategory").removeClass("d-block");
                    $("#moreCategory").addClass("d-none");
                }

                $("#moreSubCategory").html(`
                        <div class='col-md-6'>${response.data[0]["villa_category"]["name"]}</div>
                    `);
                for (let i = 1; i < length; i++) {
                    $("#moreSubCategory").append(`
                            <div class='col-md-6'>${response.data[i]["villa_category"]["name"]}</div>
                        `);
                }
            },
        });
    }
}

function editVillaTag(id_villa) {
    var villaFilter = [];
    $("input[name='villaFilter[]']:checked").each(function() {
        villaFilter.push(parseInt($(this).val()));
    });

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/villa/update/tags",
        data: {
            id_villa: id_villa,
            villaFilter: villaFilter,
        },
        success: function(response) {
            var length = response.data.length;

            $("#ModalTagsVilla").modal("hide");
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $("#displayTags").html(`
                <span class="badge rounded-pill fw-normal translate-text-group-items"
            style="background-color: #FF7400;">${response.data[0].name}</span>
            `);

            for (let i = 1; i < 5; i++) {
                $("#displayTags").append(`
                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                style="background-color: #FF7400;">${response.data[i].name}</span>
                `);
            }

            if (length > 5) {
                $("#moreTags").removeClass("d-none");
                $("#moreTags").addClass("d-block");
                $("#moreTags").html(`
                    <button class="btn btn-outline-dark btn-sm rounded villa-tag-button ml-1"
                    onclick="view_tags_villa()">More</button>
                `);
            } else {
                $("#moreTags").addClass("d-none");
            }

            $("#viewTags").html(`
                <div class='col-md-6'>${response.data[0].name}</div>
            `);
            for (let i = 1; i < length; i++) {
                $("#viewTags").append(`
                    <div class='col-md-6'>${response.data[i].name}</div>
                `);
            }
        },
    });
}

let desc_backup = $("#description-form-input").val();

function editDescriptionVilla(id_villa) {
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
            url: "/villa/update/description",
            data: {
                id_villa: id_villa,
                villa_description: $("#description-form-input").val(),
            },
            success: function(response) {
                $("#description-content").html(response.data.substring(0, 600));

                console.log(response.data.length);

                $("#description-form-input").val(response.data);

                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });

                if (response.data.length > 600) {
                    $("#buttonShowMoreDescription").html("");
                    $("#buttonShowMoreDescription").append(
                        '<a id="btnShowMoreDescription" style="font-weight: 600;" href="javascript:void(0);" onclick="showMoreDescription();"><span style="text-decoration: underline; color: #ff7400;">Show more</span> <span style="color: #ff7400;">></span></a>'
                    );
                    $("#modalDescriptionVilla").html(response.data);
                } else {
                    $("#buttonShowMoreDescription").html("");
                    $("#btnShowMoreDescription").remove();
                }
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");

                desc_backup = response.data;

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
            },
        });
    }
}

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

    formInput.value = desc_backup;

    content.classList.remove("d-none");
    btn.classList.remove("d-none");
}

// ! Change Profile Villa
$("#imageVilla").on("change", function(ev) {
    if (document.getElementById("imageVilla").files.length != 0) {
        $(".image-box").css("border", "");
        $("#err-img").hide();
    }

    imageProfileVilla = this.files[0];

    readerImageVilla = new FileReader();
});

$("#updateImageForm").submit(function(e) {
    let error = 0;
    if (document.getElementById("imageVilla").files.length == 0) {
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
        formData.append("image", imageProfileVilla);

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/villa/update/image",
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
                    $("#imageProfileVilla").attr(
                        "src",
                        readerImageVilla.result
                    );
                });

                readerImageVilla.readAsDataURL(imageProfileVilla);
                btn.innerHTML = "<i class='fa fa-check'></i> Done";
                btn.classList.remove("disabled");
                $("#modal-edit_villa_profile").modal("hide");
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
                $("#modal-edit_villa_profile").modal("hide");
            },
        });
    }
});
// ! End Change Profile Villa

// ! Edit Amenities
function editAmenitiesVilla(id_villa) {
    let amenities = [];
    let bathroom = [];
    let bedroom = [];
    let kitchen = [];
    let safety = [];
    let service = [];

    $("input[name='amenities[]']:checked").each(function() {
        amenities.push(parseInt($(this).val()));
    });
    $("input[name='bathroom[]']:checked").each(function() {
        bathroom.push(parseInt($(this).val()));
    });
    $("input[name='kitchen[]']:checked").each(function() {
        kitchen.push(parseInt($(this).val()));
    });
    $("input[name='safety[]']:checked").each(function() {
        safety.push(parseInt($(this).val()));
    });
    $("input[name='service[]']:checked").each(function() {
        service.push(parseInt($(this).val()));
    });

    btn = document.getElementById("btnSaveAmenities");
    btn.textContent = "Saving Amenities...";
    btn.classList.add("disabled");

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "/villa/update/amenities",
        data: {
            id_villa: id_villa,
            amenities: amenities,
            bathroom: bathroom,
            kitchen: kitchen,
            safety: safety,
            service: service,
        },
        success: function(response) {
            var lengthAmenities = response.getAmenities.length;
            var lengthBathroom = response.getBathroom.length;
            var lengthKitchen = response.getKitchen.length;
            var lengthSafety = response.getSafety.length;
            var lengthService = response.getService.length;

            $("#modal-edit_amenities").modal("hide");
            $("#default-amen-null").hide();

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $("#listAmenities").html("");

            if (lengthAmenities == 0) {
                $("#row-amenities").append(
                    `<p id="default-amen-null">There is no amenities</p>`
                );
            }

            if (lengthAmenities > 5) {
                for (i = 0; i < lengthAmenities; i++) {
                    if (i === 6) {
                        break;
                    }
                    $("#listAmenities").append(`
                    <div class="list-amenities">
                        <div class="text-align-center">
                            <i class="f-40 fa fa-${response.getAmenities[i].amenities.icon}"></i>
                            <div class="mb-0 max-line">
                                <span
                                    class="translate-text-group-items">${response.getAmenities[i].amenities.name}</span>
                            </div>
                        </div>
                        <div class="mb-0 list-more">
                            <span
                                class="translate-text-group-items">${response.getAmenities[i].amenities.name}</span>
                        </div>
                    </div>
                    `);
                }
            } else {
                var count;
                var total_last;
                var total;
                var stop;
                for (i = 0; i < lengthAmenities; i++) {
                    // if (i === 2) { break; }
                    $("#listAmenities").append(`
                    <div class="list-amenities">
                        <div class="text-align-center">
                            <i class="f-40 fa fa-${response.getAmenities[i].amenities.icon}"></i>
                            <div class="mb-0 max-line">
                                <span
                                    class="translate-text-group-items">${response.getAmenities[i].amenities.name}</span>
                            </div>
                        </div>
                        <div class="mb-0 list-more">
                            <span
                                class="translate-text-group-items">${response.getAmenities[i].amenities.name}</span>
                        </div>
                    </div>
                    `);
                }

                count = 6 - lengthAmenities;
                if (count > 0) {
                    total_last = 6 - lengthAmenities;
                    total = lengthAmenities + lengthKitchen;

                    if(total <= 6)
                    {
                        stop = lengthKitchen;
                    }else{
                        stop = total_last;
                    }

                    for (k = 0; k < lengthKitchen; k++) {
                        if (k === stop) { break; }
                        $("#listAmenities").append(`
                            <div class="list-amenities">
                                <div class="text-align-center">
                                    <i class="f-40 fa fa-${response.getKitchen[k].kitchen.icon}"></i>
                                    <div class="mb-0 max-line">
                                        <span
                                            class="translate-text-group-items">${response.getKitchen[k].kitchen.name}</span>
                                    </div>
                                </div>
                                <div class="mb-0 list-more">
                                    <span
                                        class="translate-text-group-items">${response.getKitchen[k].kitchen.name}</span>
                                </div>
                            </div>
                        `);
                    }
                }

                count = count - lengthKitchen;
                if (count > 0) {

                    total_last = 6 - total;
                    total = total + lengthSafety;

                    if(total <= 6)
                    {
                        stop = lengthSafety;
                    }else{
                        stop = total_last;
                    }
                    for (k = 0; k < lengthSafety; k++) {
                        if (k === stop) { break; }
                        $("#listAmenities").append(`
                            <div class="list-amenities">
                                <div class="text-align-center">
                                    <i class="f-40 fa fa-${response.getSafety[k].safety.icon}"></i>
                                    <div class="mb-0 max-line">
                                        <span
                                            class="translate-text-group-items">${response.getSafety[k].safety.name}</span>
                                    </div>
                                </div>
                                <div class="mb-0 list-more">
                                    <span
                                        class="translate-text-group-items">${response.getSafety[k].safety.name}</span>
                                </div>
                            </div>
                        `);
                    }
                }



                count = count - lengthSafety;
                if (count > 0) {

                    total_last = 6 - total;
                    total = total + lengthService;

                    if(total <= 6)
                    {
                        stop = lengthService;
                    }else{
                        stop = total_last;
                    }

                    for (l = 0; l < lengthService; l++) {
                        if (l === stop) { break; }
                        $("#listAmenities").append(`
                            <div class="list-amenities">
                                <div class="text-align-center">
                                    <i class="f-40 fa fa-${response.getService[l].service.icon}"></i>
                                    <div class="mb-0 max-line">
                                        <span
                                            class="translate-text-group-items">${response.getService[l].service.name}</span>
                                    </div>
                                </div>
                                <div class="mb-0 list-more">
                                    <span
                                        class="translate-text-group-items">${response.getService[l].service.name}</span>
                                </div>
                            </div>
                        `);
                    }
                }



                count = count - lengthService;
                if (count > 0) {

                    total_last = 6 - total;
                    total = total + lengthBathroom;

                    if(total <= 6)
                    {
                        stop = lengthBathroom;
                    }else{
                        stop = total_last;
                    }

                    for (j = 0; j < lengthBathroom; j++) {
                        if (j === stop) { break; }
                        $("#listAmenities").append(`
                        <div class="list-amenities">
                            <div class="text-align-center">
                                <i class="f-40 fa fa-${response.getBathroom[j].bathroom.icon}"></i>
                                <div class="mb-0 max-line">
                                    <span
                                        class="translate-text-group-items">${response.getBathroom[j].bathroom.name}</span>
                                </div>
                            </div>
                            <div class="mb-0 list-more">
                                <span
                                    class="translate-text-group-items">${response.getBathroom[j].bathroom.name}</span>
                            </div>
                        </div>
                        `);
                    }
                }

                count = count - lengthBathroom;
            }

            if (total > 5) {
                $("#listAmenities").append(`
                    <div class="list-amenities">
                        <button class="amenities-button" type="button" onclick="view_amenities()">
                            <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                            <div style="font-size: 15px;" class="translate-text-group-items">
                                More</div>
                        </button>
                    </div>
                `);
            }

            $("#moreAmenities").html(`
                <div class="col-md-6 mb-2">
                    <span class='translate-text-group-items'>
                        ${response.getAmenities[0].amenities.name}
                    </span>
                </div>
            `);

            for (i = 1; i < lengthAmenities; i++) {
                $("#moreAmenities").append(`
                    <div class="col-md-6 mb-2">
                        <span class='translate-text-group-items'>
                            ${response.getAmenities[i].amenities.name}
                        </span>
                    </div>
                `);
            }

            // $("#moreBedroomz").html(`
            //     <div class="col-md-6">
            //         <span class='translate-text-group-items'>
            //             ${response.getBedroom[0].bedroom.name}
            //         </span>
            //     </div>
            // `);

            // for (k = 1; k < lengthBedroom; k++) {
            //     $("#moreBedroomz").append(`
            //         <div class="col-md-6">
            //             <span class='translate-text-group-items'>
            //                 ${response.getBedroom[k].bedroom.name}
            //             </span>
            //         </div>
            //     `);
            // }

            // console.log(response.getBedroom[0].bedroom.name);
            // console.log(response.getBathroom[0].bathroom.name);

            $("#moreKitchen").html(`
                <div class="col-md-6">
                    <span class='translate-text-group-items'>
                        ${response.getKitchen[0].kitchen.name}
                    </span>
                </div>
            `);

            for (l = 1; l < lengthKitchen; l++) {
                $("#moreKitchen").append(`
                    <div class="col-md-6">
                        <span class='translate-text-group-items'>
                            ${response.getKitchen[l].kitchen.name}
                        </span>
                    </div>
                `);
            }

            $("#moreSafety").html(`
                <div class="col-md-6">
                    <span class='translate-text-group-items'>
                        ${response.getSafety[0].safety.name}
                    </span>
                </div>
            `);

            for (m = 1; m < lengthSafety; m++) {
                $("#moreSafety").append(`
                    <div class="col-md-6">
                        <span class='translate-text-group-items'>
                            ${response.getSafety[m].safety.name}
                        </span>
                    </div>
                `);
            }

            $("#moreService").html(`
                <div class="col-md-6">
                    <span class='translate-text-group-items'>
                        ${response.getService[0].service.name}
                    </span>
                </div>
            `);

            for (n = 1; n < lengthService; n++) {
                $("#moreService").append(`
                    <div class="col-md-6">
                        <span class='translate-text-group-items'>
                            ${response.getService[n].service.name}
                        </span>
                    </div>
                `);
            }

            $("#moreBathroomz").html(`
                <div class="col-md-6">
                    <span class="translate-text-group-items">
                        ${response.getBathroom[0].bathroom.name}
                    </span>
                </div>
            `);

            for (j = 1; j < lengthBathroom; j++) {
                $("#moreBathroomz").append(`
                    <div class="col-md-6">
                        <span class='translate-text-group-items'>
                            ${response.getBathroom[j].bathroom.name}
                        </span>
                    </div>
                `);
            }
        },
        error: function(jqXHR, exception) {
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

            $("#modal-edit_amenities").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
    });
}
// ! End Edit Amenities

//add save story
let storyVilla;
var storyVideoForm = $(".story-upload").children(".story-video-form");
var storyVideoInput = $(".story-upload").children(".story-video-input");
var storyVideoPreview = $(".story-upload").children(".story-video-preview");

$("#storyVideo").on("change", function(value) {
    storyVilla = this.files[0];
});

$("#updateStoryForm").submit(function(e) {
    e.preventDefault();

    //validasi
    if (
        storyVilla.type.includes("video/mp4") ||
        storyVilla.type.includes("video/mov")
    ) {
        //let validate = validateStory();

        //if (validate > 0) {
        //} else {
        var formData = new FormData(this);
        console.log(formData);

        var btn = document.getElementById("btnSaveStory");
        btn.textContent = "Saving Story...";
        btn.classList.add("disabled");

        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
            },
            url: "/villa/update/story",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            dataType: "json",
            success: function(response) {
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
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-villa="' +
                            id_villa +
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
                            '#t=0.1"> </video> <a class="delete-story" href="javascript:void(0);" data-villa="' +
                            id_villa +
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
            error: function(jqXHR, exception) {
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
});

//save house rules
$("#houseRuleForm").submit(function(e) {
    e.preventDefault();

    let btn = document.getElementById("btnSaveHouseRules");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");

    let formData = new FormData(this);

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        url: "/houserules/post",
        dataType: "json",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content = "";

            if (response.data.children == "yes") {
                content += '<i class="fas fa-child"></i> Childrens are allowed';
                content += "<br>";
            }
            if (response.data.children == "no") {
                content += '<i class="fas fa-ban"></i> No children';
                content += "<br>";
            }

            if (response.data.infants == "yes") {
                content += '<i class="fas fa-child"></i> Infants are allowed';
                content += "<br>";
            }
            if (response.data.infants == "no") {
                content += '<i class="fas fa-ban"></i> No infants';
                content += "<br>";
            }

            if (response.data.pets == "yes") {
                content += '<i class="fas fa-paw"></i> Pets are allowed';
                content += "<br>";
            }
            if (response.data.pets == "no") {
                content += '<i class="fas fa-ban"></i> No pets';
                content += "<br>";
            }

            if (response.data.smoking == "yes") {
                content += '<i class="fas fa-smoking"></i> Smoking is allowed';
                content += "<br>";
            }
            if (response.data.smoking == "no") {
                content += '<i class="fas fa-ban"></i> No smoking';
                content += "<br>";
            }

            if (response.data.events == "yes") {
                content += '<i class="fas fa-calendar"></i> Events are allowed';
                content += "<br>";
            }
            if (response.data.events == "no") {
                content += '<i class="fas fa-ban"></i> No events';
                content += "<br>";
            }

            $("#houseRuleContent").html(content);

            $("#modal-edit-house-rules").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
        error: function(jqXHR, exception) {
            console.log(jqXHR);
            // console.log(exception);

            for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.errors[i],
                    position: "topRight",
                });
            }

            // $("#modal-edit-house-rules").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
    });
});

$("#guestSafetyForm").submit(function(e) {
    e.preventDefault();

    let btn = document.getElementById("btnSaveGuestSafety");
    btn.textContent = "Saving...";
    btn.classList.add("disabled");

    let formData = new FormData(this);

    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            Accept: "application/json",
        },
        url: "/guessafety/post",
        dataType: "json",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            let content = "";
            let contentModal = "";

            for (let i = 0; i < 4; i++) {
                content +=
                    '<i class="fas fa-' +
                    response.data[i].icon +
                    '"></i> <span class="translate-text-single">' +
                    response.data[i].guest_safety +
                    "</span><br>";
            }

            $("#btnShowMoreGuestSafety").html("");

            content +=
                '<p style="margin-bottom: 0px !important"> <a href="javascript:void(0)" onclick="showMoreGuestSafety()">Show more <i class="fas fa-chevron-right"></i> </a> </p>';

            $("#guestSafetyContent").html(content);

            for (let j = 0; j < response.data.length; j++) {
                contentModal +=
                    '<p> <i class="fas fa-' +
                    response.data[j].icon +
                    '"></i> <span class="translate-text-group-items">' +
                    response.data[j].guest_safety +
                    '</span> </p> <p style="font-size: 12px; margin-top: -20px;"> <span class="translate-text-group-items">' +
                    response.data[j].description +
                    "</span> </p>";
            }

            $("#guestSafetyContentModal").html(contentModal);

            $("#modal-edit-guest-safety").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
        error: function(jqXHR, exception) {
            console.log(jqXHR);
            // console.log(exception);

            for (let i = 0; i < jqXHR.responseJSON.errors.length; i++) {
                iziToast.error({
                    title: "Error",
                    message: jqXHR.responseJSON.errors[i],
                    position: "topRight",
                });
            }

            // $("#modal-edit-house-rules").modal("hide");

            btn.innerHTML = "<i class='fa fa-check'></i> Save";
            btn.classList.remove("disabled");
        },
    });
});

// ! GradeVilla
$("#gradeVilla").change(function() {
    var grade = $(this).val();
    $.ajax({
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: `/villa/grade/${id_villa}`,
        data: {
            grade: grade,
        },
        success: function(response) {
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
        },
    });
});

function gradeAA() {
    $("#gradeVillaAA").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/villa/grade/${id_villa}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });
}

function gradeA() {
    $("#gradeVillaA").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/villa/grade/${id_villa}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });
}

function gradeB() {
    $("#gradeVillaB").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/villa/grade/${id_villa}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });
}

function gradeC() {
    $("#gradeVillaC").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/villa/grade/${id_villa}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });
}

function gradeD() {
    $("#gradeVillaD").change(function() {
        var grade = $(this).val();
        $.ajax({
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: `/villa/grade/${id_villa}`,
            data: {
                grade: grade,
            },
            success: function(response) {
                iziToast.success({
                    title: "Success",
                    message: response.message,
                    position: "topRight",
                });
            },
        });
    });
}
// ! End GradeVilla

function saveLocation() {
    console.log('hit saveLocation');
    let form = $('#editLocationForm');

    const formData = {
        id_villa: parseInt(form.find(`input[name='id_villa']`).val()),
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
        url: "/villa/update/location",
        data: formData,
        // response data
        success: function (response) {
            let latitudeOld = parseFloat(response.data.latitude);
            let longitudeOld = parseFloat(response.data.longitude);
            // variabel global edit marker
            markerEditLocation = null;
            // pin marker to map on edit map
            initEditLocationVilla(latitudeOld, longitudeOld);
            // refresh detail map
            view_maps(parseInt(form.find(`input[name='id_villa']`).val()));
            // alert success
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });
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

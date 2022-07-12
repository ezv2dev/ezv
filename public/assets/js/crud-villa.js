function editNameVilla(id_villa) {
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/villa/update/name",
        data: {
            id_villa: id_villa,
            villa_name: $('#name-form-input').val()
        },
        success: function(response) {
            $("#name-content2").html(response.data);
            $("#name-content-mobile").html(response.data);
            $("#villaTitle").html(response.data + ' - EZV2');

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            editNameCancel();
        },
    });
}

function editNameForm(id_villa) {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.add("d-block");
    content.classList.add("d-none");

    $.ajax({
        type: "GET",
        url: "/villa/get/name/" + `${id_villa}`,
        success: function(response) {
            $("#name-form-input").val(response.data);

            if (formInput.value == 'Home Name Here') {
                formInput.value = '';
            }
        },
    });
}

function editNameCancel() {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");

    if (formInput.value == 'Home Name Here') {
        formInput.value = '';
    }
}

function editShortDesc(id_villa) {
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/villa/update/short-description",
        data: {
            id_villa: id_villa,
            short_desc: $('#short-description-form-input').val()
        },
        success: function(response) {
            $("#short-description-content2").html(response.data);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            editShortDescriptionCancel();
        },
    });
}

function editShortDescriptionForm(id_villa) {
    var form = document.getElementById("short-description-form");
    var content = document.getElementById("short-description-content");
    var formInput = document.getElementById("short-description-form-input");
    form.classList.add("d-block");
    content.classList.add("d-none");
    $.ajax({
        type: "GET",
        url: "/villa/get/short-description/" + `${id_villa}`,
        success: function(response) {
            $("#short-description-form-input").val(response.data);

            if (formInput.value == 'Make your short description here') {
                formInput.value = '';
            }
        },
    });
}

function editShortDescriptionCancel() {
    var form = document.getElementById("short-description-form");
    var formInput = document.getElementById("short-description-form-input");
    var content = document.getElementById("short-description-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");

    if (formInput.value == 'Make your short description here') {
        formInput.value = '';
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
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
}

function editCategoryV(id_villa) {
    var villaCategory = [];
    $("input[name='villaCategory[]']:checked").each(function() {
        villaCategory.push(parseInt($(this).val()));
    });

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/villa/update/category",
        data: {
            id_villa: id_villa,
            villaCategory: villaCategory
        },
        success: function(response) {
            $("#ModalCategoryVilla").modal('hide');
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $.ajax({
                type: "GET",
                url: "/villa/get/category/" + `${id_villa}`,
                success: function(response) {
                    var length = response.data.length;

                    $("#displayCategory").html(`
                        <span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400;">
                            ${response.data[0]['villa_category']['name']}
                        </span>
                        <span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400;">
                            ${response.data[1]['villa_category']['name']}
                        </span>
                        <span class="badge rounded-pill fw-normal translate-text-group-items" style="background-color: #FF7400;">
                            ${response.data[2]['villa_category']['name']}
                        </span>`);

                    if (length > 3) {
                        $("#moreCategory").removeClass("d-none");
                        $("#moreCategory").addClass("d-block");
                        $("#moreCategory").html(`
                            <button class="btn btn-outline-dark btn-sm rounded villa-tag-button"
                            onclick="view_subcategory()">More</button>
                        `);
                    } else {
                        $("#moreCategory").addClass("d-none");
                    }

                    $("#moreSubCategory").html(`
                        <div class='col-md-6'>${response.data[0]['villa_category']['name']}</div>
                    `)
                    for (let i = 1; i < length; i++) {
                        $("#moreSubCategory").append(`
                            <div class='col-md-6'>${response.data[i]['villa_category']['name']}</div>
                        `)
                    }
                },
            });
        },
    });

}

function editVillaTag(id_villa) {
    var villaFilter = [];
    $("input[name='villaFilter[]']:checked").each(function() {
        villaFilter.push(parseInt($(this).val()));
    });

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/villa/update/tags",
        data: {
            id_villa: id_villa,
            villaFilter: villaFilter
        },
        success: function(response) {
            var length = response.data.length;

            $("#ModalTagsVilla").modal('hide');
            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $("#displayTags").html(`
                <span class="badge rounded-pill fw-normal translate-text-group-items"
            style="background-color: #FF7400;">${response.data[0].name}</span>
            `)

            for (let i = 1; i < 5; i++) {
                $("#displayTags").append(`
                    <span class="badge rounded-pill fw-normal translate-text-group-items"
                style="background-color: #FF7400;">${response.data[i].name}</span>
                `)
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
            `)
            for (let i = 1; i < length; i++) {
                $("#viewTags").append(`
                    <div class='col-md-6'>${response.data[i].name}</div>
                `)
            }
        },

    });
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
    content.classList.remove("d-none");
    btn.classList.remove("d-none");
}

function editDescriptionVilla(id_villa) {
    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/villa/update/description",
        data: {
            id_villa: id_villa,
            villa_description: $('#description-form-input').val()
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
                $("#modalDescriptionVilla").html(response.data);
            } else {
                $("#btnShowMoreDescription").html("");
                $("#btnShowMoreDescription").remove();
            }

            editDescriptionCancel();
        },
    });
}

// ! Change Profile Villa
$("#imageVilla").on("change", function(ev) {
    imageProfileVilla = this.files[0];

    readerImageVilla = new FileReader();
});

$("#updateImageForm").submit(function(e) {
    e.preventDefault();

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

            $("#modal-edit_villa_profile").modal("hide");
        },
    });
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
    $("input[name='bedroom[]']:checked").each(function() {
        bedroom.push(parseInt($(this).val()));
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
            bedroom: bedroom,
            kitchen: kitchen,
            safety: safety,
            service: service,
        },
        success: function(response) {
            var lengthAmenities = response.getAmenities.length;
            var lengthBathroom = response.getBathroom.length;
            var lengthBedroom = response.getBedroom.length;
            var lengthKitchen = response.getKitchen.length;
            var lengthSafety = response.getSafety.length;
            var lengthService = response.getService.length;

            $("#modal-edit_amenities").modal("hide");

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topRight",
            });

            $("#listAmenities").html(`
                <div class="list-amenities">
                    <div class="text-align-center">
                        <i class="f-40 fa fa-${response.getAmenities[0].amenities.icon}"></i>
                        <div class="mb-0 max-line">
                            <span
                                class="translate-text-group-items">${response.getAmenities[0].amenities.name}</span>
                        </div>
                    </div>
                    <div class="mb-0 list-more">
                        <span
                            class="translate-text-group-items">${response.getAmenities[0].amenities.name}</span>
                    </div>
                </div>
            `);

            for (i = 1; i < 3; i++) {
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
            `)
            };

            $("#listAmenities").append(`
                <div class="list-amenities">
                    <div class="text-align-center">
                        <i class="f-40 fa fa-${response.getBathroom[0].bathroom.icon}"></i>
                        <div class="mb-0 max-line">
                            <span
                                class="translate-text-group-items">${response.getBathroom[0].bathroom.name}</span>
                        </div>
                    </div>
                    <div class="mb-0 list-more">
                        <span
                            class="translate-text-group-items">${response.getBathroom[0].bathroom.name}</span>
                    </div>
                </div>
            `);

            $("#listAmenities").append(`
                <div class="list-amenities">
                    <div class="text-align-center">
                        <i class="f-40 fa fa-${response.getBedroom[0].bedroom.icon}"></i>
                        <div class="mb-0 max-line">
                            <span
                                class="translate-text-group-items">${response.getBedroom[0].bedroom.name}</span>
                        </div>
                    </div>
                    <div class="mb-0 list-more">
                        <span
                            class="translate-text-group-items">${response.getBedroom[0].bedroom.name}</span>
                    </div>
                </div>
            `);

            $("#listAmenities").append(`
                <div class="list-amenities">
                    <div class="text-align-center">
                        <i class="f-40 fa fa-${response.getKitchen[0].kitchen.icon}"></i>
                        <div class="mb-0 max-line">
                            <span
                                class="translate-text-group-items">${response.getKitchen[0].kitchen.name}</span>
                        </div>
                    </div>
                    <div class="mb-0 list-more">
                        <span
                            class="translate-text-group-items">${response.getKitchen[0].kitchen.name}</span>
                    </div>
                </div>
            `);

            $("#listAmenities").append(`
                <div class="list-amenities">
                    <button class="amenities-button" type="button" onclick="view_amenities()">
                        <i class="fa-solid fa-ellipsis text-orange" style="font-size: 40px;"></i>
                        <div style="font-size: 15px;" class="translate-text-group-items">
                            More</div>
                    </button>
                </div>
            `);

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

            $("#moreBedroomz").html(`
                <div class="col-md-6">
                    <span class='translate-text-group-items'>
                        ${response.getBedroom[0].bedroom.name}
                    </span>
                </div>
            `);

            for (k = 1; k < lengthBedroom; k++) {
                $("#moreBedroomz").append(`
                    <div class="col-md-6">
                        <span class='translate-text-group-items'>
                            ${response.getBedroom[k].bedroom.name}
                        </span>
                    </div>
                `);
            }

            console.log(response.getBedroom[0].bedroom.name);
            console.log(response.getBathroom[0].bathroom.name);

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
        },
    });
}
// ! End Edit Amenities
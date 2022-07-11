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
                position: "topCenter",
            });

            editNameCancel();
        },
    });
}

function editNameForm(id_villa) {
    var form = document.getElementById("name-form");
    var content = document.getElementById("name-content");
    form.classList.add("d-block");
    content.classList.add("d-none");

    $.ajax({
        type: "GET",
        url: "/villa/get/name/" + `${id_villa}`,
        success: function(response) {
            $("#name-form-input").val(response.data);
        },
    });
}

function editNameCancel() {
    var form = document.getElementById("name-form");
    var formInput = document.getElementById("name-form-input");
    var content = document.getElementById("name-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
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
                position: "topCenter",
            });

            editShortDescriptionCancel();
        },
    });
}

function editShortDescriptionForm(id_villa) {
    var form = document.getElementById("short-description-form");
    var content = document.getElementById("short-description-content");
    form.classList.add("d-block");
    content.classList.add("d-none");
    $.ajax({
        type: "GET",
        url: "/villa/get/short-description/" + `${id_villa}`,
        success: function(response) {
            $("#short-description-form-input").val(response.data);
        },
    });
}

function editShortDescriptionCancel() {
    var form = document.getElementById("short-description-form");
    var formInput = document.getElementById("short-description-form-input");
    var content = document.getElementById("short-description-content");
    form.classList.remove("d-block");
    content.classList.remove("d-none");
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
            // console.log(response.data);

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
                position: "topCenter",
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
                position: "topCenter",
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
                position: "topCenter",
            });

            console.log(response.data[0].name);

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
            $("#description-content").html(response.data);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "topCenter",
            });

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

    console.log(imageProfileVilla);

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
            console.log(response);

            iziToast.success({
                title: "Success",
                message: response.message,
                position: "bottomCenter",
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
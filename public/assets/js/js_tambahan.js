function reload_table(){
    tabel_data.ajax.reload(null,false);
}

function load_tabel_first(){
    $.extend($.fn.dataTable.ext.classes,{
        sWrapper:"dataTables_wrapper dt-bootstrap5",
        sFilterInput:"form-control",
        sLengthSelect:"form-select"
    }),
    $.extend(!0,$.fn.dataTable.defaults,{
        language:{
            lengthMenu:"_MENU_",
            search:"_INPUT_",
            searchPlaceholder:"Search..",
            info:"Page _PAGE_ of <strong>_PAGES_</strong>",
            paginate:{
                first:'<i class="fa fa-angle-double-left"></i>',
                previous:'<i class="fa fa-angle-left"></i>',
                next:'<i class="fa fa-angle-right"></i>',
                last:'<i class="fa fa-angle-double-right"></i>'
            }
        }
    }),
    $.extend(!0,$.fn.DataTable.Buttons.defaults,{
        dom:{
            button:{
                className:"btn btn-sm btn-primary"
            }
        }
    }),
    jQuery("#table").DataTable({
        pagingType:"full_numbers",
        pageLength:5,
        lengthMenu:[[5,10,20],[5,10,20]],
        autoWidth:!1
    })
};


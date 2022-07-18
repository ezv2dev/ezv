<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .modal-header-editprice {
        border-bottom: none !important;
        padding: 2rem 3rem 2rem 2rem;
        background-color: white;
    }

    .modal-body-editprice {
        padding: 0rem 2rem 2rem 2rem !important;
        height: 490px !important;
        overflow-y: auto !important;
    }

    .modal-content-editprice {
        width: 90% !important;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: #ff7400 !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
    }

    .modal-price-title {
        width: 50% !important;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }

</style>

<!-- Extra large modal -->
<div class="modal fade" id="modal-edit_price" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content modal-content-editprice" style="border-radius:15px;">
            <div class="modal-header-editprice">
                <div class="row">
                    <div class="col-11">
                        <ul class="nav filter-language-option-container nav-tabs sideTab column"
                            style="display: flex; flex-wrap: nowrap; padding-bottom: 0px !important;">
                            <li class="active modal-price-title"><a class="tab1 filter-language-option-text"
                                    href="#editprice" data-toggle="tab" style="font-size: 15pt;
                                font-weight: 600;">{{ __('user_page.Edit Price') }}</a></li>
                            <li class="modal-price-title"><a class="filter-language-option-text" href="#availablity"
                                    data-toggle="tab" style="font-size: 15pt;
                                font-weight: 600;">{{ __('user_page.Rooms Availability') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-body modal-body-editprice">
                <div class="tabbable column-wrapper">
                    <!-- Only required for left/right tabs -->


                    <div class="tab-content tab-content-language column rigth" id="tabs">
                        <div class="tab-pane active" id="editprice">
                            <form action="{{ route('room_update_price') }}" method="POST" id="edit-price"
                                class="js-validation" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_hotel_room" id="id_hotel_room" value="{{ $hotelRoom->id_hotel_room }}">

                                <div class="row mb-12">
                                    <label class="col-sm-4 col-form-label" for="price"><strong>{{ __('user_page.Regular Price') }} <span
                                                title="Required"
                                                style="font-size: 12pt; color: #EB5353;">*</span></strong></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="room-price" name="price"
                                            placeholder="{{ __('user_page.Price') }}" value="{{ $hotelRoom->price }}">
                                        <small id="err-prc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_price') }}</small>
                                    </div>
                                </div>

                                <div class="row"
                                    style="margin-bottom: 15px; background: #DAE5D0; padding: 10px; margin-left: -32px;margin-right: -32px;margin-top: 15px;">
                                    <div class="col-12">
                                        <span style="color: #383838; margin-left: 8px;">
                                            <strong>
                                                {{ __('user_page.Add Special Price') }}
                                            </strong>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div id="calendar"></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.Start date') }}</label>
                                        <input type="text" class="form-control" id="start" name="start"
                                            placeholder="{{ __('user_page.Start date') }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.End date') }}</label>
                                        <input type="text" class="form-control" id="end" name="end"
                                            placeholder="{{ __('user_page.End date') }}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>{{ __('user_page.Price') }}</label>
                                        <input type="number" class="form-control" id="special_price"
                                            name="special_price" placeholder="{{ __('user_page.Price') }}">
                                        <small id="err-spcl-prc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_special_price') }}</small>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>{{ __('user_page.Discount') }}</label>
                                        <input type="number" class="form-control" id="disc" name="disc"
                                            placeholder="{{ __('user_page.Discount') }}">
                                        <small id="err-disc" style="display: none;"
                                            class="invalid-feedback">{{ __('auth.empty_discount') }}</small>
                                    </div>
                                </div>
                                <!-- Submit -->
                                <div class="row items-push">
                                    <div class="col-lg-7">
                                        <button type="submit" class="btn btn-sm btn-primary" id="submitPrice">
                                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                                        </button>
                                    </div>
                                </div>
                                <!-- END Submit -->
                                <br>
                            </form>
                        </div>

                        <div class="tab-pane" id="availablity">
                            <div class="row">
                                <div class="col-12">
                                    <div id="calendar2"></div>
                                </div>
                            </div>
                            <form action="{{ route('room_not_available') }}" method="POST" id="basic-form"
                                class="js-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.Start date') }}</label>
                                        <input type="text" class="form-control" id="startNotAvailable" name="start"
                                            placeholder="{{ __('user_page.Start date') }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">{{ __('user_page.End date') }}</label>
                                        <input type="text" class="form-control" id="endNotAvailable" name="end"
                                            placeholder="{{ __('user_page.End date') }}" readonly>
                                    </div>
                                    <input type="hidden" name="id_hotel_room" id="id_hotel_room"
                                        value="{{ $hotelRoom->id_hotel_room }}">
                                </div>
                                <!-- Submit -->
                                <div class="row items-push">
                                    <div class="col-lg-7">
                                        <button type="submit" class="btn btn-sm btn-danger" name="action"
                                            value="not_available">
                                            <i class="fa fa-check"></i> {{ __('user_page.Not Available') }}
                                        </button>
                                    </div>
                                    {{-- <div class="col-lg-7" style="margin-top: 10px;">
                                        <button type="submit" class="btn btn-sm btn-success" name="action" value="available">
                                            <i class="fa fa-check"></i> Available
                                        </button>
                                    </div> --}}
                                </div>
                                <!-- END Submit -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('villa_update_price') }}" method="POST" id="basic-form" class="js-validation" enctype="multipart/form-data" >
                    @csrf
                    <input type="hidden" name="id_villa" id="id_villa" value="{{ $villa[0]->id_villa }}">

                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="price"><strong>Regular Price</strong></label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price.." value="{{ $villa[0]->price }}">
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 15px; background: #ff7400; padding: 10px; margin-top: 15px;">
                        <div class="col-12">
                            <span style="color: #fff;"><strong>Add Special Price</strong></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div id="calendar"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label for="">Start date</label>
                            <input type="text" class="form-control" id="start" name="start" placeholder="End date.." readonly>
                        </div>
                        <div class="col-lg-6">
                            <label for="">End date</label>
                            <input type="text" class="form-control" id="end" name="end" placeholder="End date.." readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <label>Price</label>
                            <input type="number" class="form-control" id="special_price" name="special_price" placeholder="Price..">
                        </div>
                        <div class="col-lg-6">
                            <label>Discount</label>
                            <input type="number" class="form-control" id="disc" name="disc" placeholder="Discount..">
                        </div>
                    </div>
                    <!-- Submit -->
                    <div class="row items-push">
                        <div class="col-lg-7">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-check"></i> Save
                            </button>
                        </div>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div> --}}
    </div>
</div>

<style>
    .fc-widget-header span {
        color: black !important;
    }

    .fc-day-number {
        color: rgb(85, 73, 73) !important;
        float: none !important;
    }

    .fc-view-container {
        border: 2px solid #d8d4d4;
        box-shadow: 0px 3px 15px -8px rgb(100, 100, 100);
    }

    .fc-title {
        color: #fff;
    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>
    $(function() {
        $("#room-price").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#room-price').removeClass('is-invalid');
            $('#err-prc').hide();
        });
        $("#special_price").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#special_price').removeClass('is-invalid');
            $('#err-spcl-prc').hide();
        });
        $("#disc").keyup(function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            $('#disc').removeClass('is-invalid');
            $('#err-disc').hide();
        });
        $("#edit-price").submit(function(e) {
            let error = 0;
            if (!parseInt($('#room-price').val())) {
                $('#room-price').addClass('is-invalid');
                $('#err-prc').show();
                error = 1;
            }
            if ($('#start').val() && $('#end').val()) {
                if (!$('#special_price').val()) {
                    $('#special_price').addClass('is-invalid');
                    $('#err-spcl-prc').show();
                    error = 1;
                }
                if (!$('#disc').val()) {
                    $('#disc').addClass('is-invalid');
                    $('#err-disc').show();
                    error = 1;
                }
            }
            if (error == 1) {
                e.preventDefault();
            } else {
                let btn = document.getElementById("submitPrice");
                btn.textContent = "Saving...";
                btn.classList.add("disabled");
            }
        });
    });
</script>

<script>
    id_hotel_room_fullcalendar = $('#id_hotel_room').val();
    // console.log(id_villa_fullcalendar);

    let calendar = $('#calendar').fullCalendar({
        defaultView: 'month',
        displayEventTime: true,
        editable: false,
        events: `/hotel/room/special-price/calendar/` + id_hotel_room_fullcalendar,

        //disable past day
        validRange: {
            start: new Date(),
        },

        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        selectable: true,
        selectHelper: true,

        //selection date start until end
        select: function(start, end) {
            var start = moment(start).format('YYYY-MM-DD');
            var end = moment(end).subtract(1, "days").format('YYYY-MM-DD');
            $('#start').val(start);
            $('#end').val(end);
            // $('#addSpecialModal').modal('show');
        },
    });

    let calendar2 = $('#calendar2').fullCalendar({
        defaultView: 'month',
        displayEventTime: true,
        editable: false,
        events: `/hotel/room/calendar/not_available/` + id_hotel_room_fullcalendar,

        //disable past day
        validRange: {
            start: new Date(),
        },

        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        selectable: true,
        selectHelper: true,

        //selection date start until end
        select: function(start, end) {
            var start = moment(start).format('YYYY-MM-DD');
            var end = moment(end).subtract(1, "days").format('YYYY-MM-DD');
            $('#startNotAvailable').val(start);
            $('#endNotAvailable').val(end);
            // $('#addSpecialModal').modal('show');
        },
    });
</script>

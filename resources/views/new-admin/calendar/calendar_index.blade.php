@extends('new-admin.layouts.admin_layout')


@section('title', 'Calendar - EZV2')

<style>
    .fc-widget-header span{
        color: black !important;
    }

    .fc-day-number {
        color: rgb(85, 73, 73) !important;
    }

    .fc-view-container {
        border: 2px solid #d8d4d4;
        box-shadow: 0px 3px 15px -8px rgb(100,100,100);
    }

    .container-calendar{
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    @media (min-width: 768px) {
        .container-calendar{
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
    }
</style>

@section('content_admin')
    <!-- Hero -->
    <div class="container">
        <div class="bg-body-light">
            <div class="content content-full">
            </div>
        </div>
    </div>
    <!-- END Hero -->
    {{-- CONTENT --}}
    <div class="container-calendar container d-flex" style="margin-top: 30px;padding-bottom: 50px;">

        <div class="col-calendar2 col-lg-12">
            <div id='calendar' class="calendar"></div>
        </div>

    </div>
    {{-- END CONTENT --}}

    <!-- Modal Add Special Price -->
    <div class="modal fade" id="addSpecialModal" tabindex="-1" role="dialog" aria-labelledby="eventModal"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #3A3845;">
                    <h6 class="modal-title" id="exampleModalCenterTitle" style="color: #fff;"><b>Add Special Price</b></h6>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">×</span></button>
                </div>
                <div class="modal-body" style="font-size: 11pt; color: #000;">
                    <form action="{{ route('calendar_store') }}" method="POST" id="calendar_store">
                        @csrf
                        <div class="row" style="display: flex;">
                            <div class="col-6">
                                {{-- <div class="form-group">
                                    <label for="">Villa name</label>
                                    <select style="width: 100%; padding:10px;" class="form-select" name="id_villa" id="id_villa"
                                    onchange="villachange(this.value);" required>
                                        <option value=""></option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item->id_villa }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="form-group">
                                    <label for="">Villa name</label>
                                    <input type="text" class="form-control" id="name_villa" disabled>
                                    <input type="hidden" name="id_villa" id="id_villa">
                                </div>

                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Regular price</label>
                                    <input type="text" class="form-control" id="regular_price" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Start date</label>
                            <input type="date" class="form-control" id="start" name="start" placeholder="Start date">
                            <small id="err-sdate" style="display: none;" class="invalid-feedback">The start date field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">End date</label>
                            <input type="date" class="form-control" id="end" name="end" placeholder="End date">
                            <small id="err-edate" style="display: none;" class="invalid-feedback">The end date field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Special Price</label>
                            <input type="number" class="form-control" name="price" min="0" id="special_price" placeholder="Price"  inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+">
                            <small id="err-sprice" style="display: none;" class="invalid-feedback">The special price field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="number" class="form-control" name="disc" id="discount" placeholder="Discount" value="0">
                        </div>
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-floppy-disk mr-2"></i>Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Add Special Price -->

    <!-- Modal Edit Special Price -->
    <div class="modal fade" id="editSpecialModal" tabindex="-1" role="dialog" aria-labelledby="eventModal"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #3A3845;">
                    <h6 class="modal-title" id="exampleModalCenterTitle" style="color: #fff;"><b>Edit Special Price</b></h6>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">×</span></button>
                </div>
                <div class="modal-body" style="font-size: 11pt; color: #000;">
                    <form action="{{ route('calendar_update') }}" method="POST" id="calendar_update">
                        @csrf
                        <div class="form-group">
                            <label for="">Villa name</label>
                            <input type="text" class="form-control" id="villa_name" disabled>
                            <input type="hidden" name="id_detail" id="id_detail">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Regular Price</label>
                            <input type="text" class="form-control" id="regular_price" placeholder="0" disabled>
                        </div> --}}
                        <div class="form-group">
                            <label for="">Start date</label>
                            <input type="date" class="form-control" id="edit-start" name="start" placeholder="Start date" date-format="Y-m-d">
                            <small id="err-usdate" style="display: none;" class="invalid-feedback">The end date field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">End date</label>
                            <input type="date" class="form-control" id="edit-end" name="end" placeholder="End date" date-format="Y-m-d">
                            <small id="err-uedate" style="display: none;" class="invalid-feedback">The end date field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Special Price</label>
                            <input type="number" class="form-control" id="special-price" name="price" placeholder="Price">
                            <small id="err-usprice" style="display: none;" class="invalid-feedback">The special price field is required</small>
                        </div>
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="number" class="form-control" id="disc" name="disc" placeholder="Discount" value="0">
                        </div>
                        <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-floppy-disk mr-2"></i>Update</button>
                        <a href="javascript:void(0);" onclick="deleteEvent();" class="btn btn-outline-danger"><i class="fa-solid fa-trash mr-2"></i>Delete</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edit Special Price -->

    @include('new-admin.layouts.footer')

@endsection

@section('scripts')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" integrity="sha256-5veQuRbWaECuYxwap/IOE/DAwNxgm4ikX7nrgsqYp88=" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js" integrity="sha256-sR+oJaZ3c0FHR6+kKaX1zeXReUGbzuNI8QTKpGHE0sg=" crossorigin="anonymous"></script>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" /> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.2/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.2/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script> --}}

<script>

    // validasi agar tidak menginputkan selain angka ke input price
    $('input[name="price"]').on('keypress', function(evt) {
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    });

    // validasi agar tidak menginputkan angka 0 sebelum angka lainnya ke input price
    // $('input[name="price"]').on('keyup', function(evt) {
    //     let splitVal = $(this).val().split('')
    //     if(splitVal.length > 1){
    //         for(let i = 0; i < splitVal.length; i++){
    //             if(typeof splitVal[i] === 'string' || splitVal[i] instanceof String){
    //                 if(splitVal[i] != '0'){
    //                     break;
    //                 }
    //             }

    //             splitVal = splitVal.slice(i+1)
    //             let value = '';
    //             splitVal.forEach(char => {
    //                 value = value + char
    //             })

    //             $(this).val(value)
    //         }
    //     }
    // })

    // validasi agar tidak menginputkan selain angka ke input discount
    $('input[name="disc"]').on('keypress', function(evt){
        if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
        {
            evt.preventDefault();
        }
    })

    //delete event
    function deleteEvent()
    {
        var id = document.getElementById('id_detail').value;
        // console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, deleted it',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type: "GET",
                    url: "/dashboard/calendar/delete/" + id,
                    dataType: "JSON",
                    success: function(data){
                        Swal.fire('Deleted', data.message ,'success');
                        location.reload();
                    },
                });
            }
            else {
                Swal.fire('Cancel','Canceled Deleted Data','error')
            }
        });
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var datas = @json($data);
        console.log(datas);

        let calendarEl = document.getElementById("calendar");
        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'resourceTimelineMonth',
            schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives', //free trial premium features
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth',
            },
            resourceAreaHeaderContent: 'Homes List',
            // resources: [
            //     { id: 'a', title: 'Room A' },
            //     { id: 'b', title: 'Room B' },
            //     { id: 'c', title: 'Room C' },
            // ],
            resources : datas,
            // events : '{{ route('calendar.all') }}',

            // disable past day
            validRange: {
                start: new Date(),
            },

            selectable: true,

            //one day click
            dateClick: function (info) {
                var start = moment(info.start).format("YYYY-MM-DD");
                // $('#id_villa').val(data.id);
                // $('#name_villa').val(data.name);
                // $('#regular_price').val(data.price);
                $('#start').val(info.start);
                $('#addSpecialModal').modal('show');
            },

            //selection date start until end
            select: function (info) {
                // if(start.isBefore(moment())) {
                //     $('#calendar').fullCalendar('unselect');
                //     alert('Min date is Today !');
                //     return false;
                // }
                var start = moment(info.start).format("YYYY-MM-DD");
                var end = moment(info.end).subtract(1, "days").format('YYYY-MM-DD');
                // $('#id_villa').val(data.id_villa);
                // $('#name_villa').val(data.name);
                // $('#regular_price').val(data.price);
                $('#start').val(start);
                $('#end').val(end);
                $('#addSpecialModal').modal('show');
            },
        });

        calendar.render();
    });



</script>

<script>
    $(function() {
        $('#start').change(function (e) {
            $('#start').removeClass('is-invalid');
            $('#err-sdate').hide();
        });
        $('#end').change(function (e) {
            $('#end').removeClass('is-invalid');
            $('#err-edate').hide();
        });
        $('#special_price').keyup(function (e) {
            $('#special_price').removeClass('is-invalid');
            $('#err-sprice').hide();
        });
        $('#calendar_store').submit(function (e) {
            let error = 0;
            if(!$('#start').val()) {
                $('#start').addClass('is-invalid');
                $('#err-sdate').show();
                error = 1;
            } else {
                $('#start').removeClass('is-invalid');
                $('#err-sdate').hide();
            }
            if(!$('#end').val()) {
                $('#err-edate').show();
                $('#end').addClass('is-invalid');
                error = 1;
            } else {
                $('#end').removeClass('is-invalid');
                $('#err-edate').hide();
            }
            if(!$('#special_price').val()) {
                $('#err-sprice').show();
                $('#special_price').addClass('is-invalid');
                error = 1;
            } else {
                $('#special_price').removeClass('is-invalid');
                $('#err-sprice').hide();
            }

            if(error) {
                e.preventDefault();
            }
        });

        $('#edit-start').change(function (e) {
            $('#edit-start').removeClass('is-invalid');
            $('#err-usdate').hide();
        });
        $('#edit-end').change(function (e) {
            $('#edit-end').removeClass('is-invalid');
            $('#err-uedate').hide();
        });
        $('#special-price').keyup(function (e) {
            $('#special-price').removeClass('is-invalid');
            $('#err-usprice').hide();
        });
        $('#calendar_update').submit(function (e) {
            let error = 0;
            if(!$('#edit-start').val()) {
                $('#edit-start').addClass('is-invalid');
                $('#err-usdate').show();
                error = 1;
            } else {
                $('#edit-start').removeClass('is-invalid');
                $('#err-usdate').hide();
            }
            if(!$('#edit-end').val()) {
                $('#err-uedate').show();
                $('#edit-end').addClass('is-invalid');
                error = 1;
            } else {
                $('#edit-end').removeClass('is-invalid');
                $('#err-uedate').hide();
            }
            if(!$('#special-price').val()) {
                $('#err-usprice').show();
                $('#special-price').addClass('is-invalid');
                error = 1;
            } else {
                $('#special-price').removeClass('is-invalid');
                $('#err-usprice').hide();
            }

            if(error) {
                e.preventDefault();
            }
        });
    })
</script>
@endsection

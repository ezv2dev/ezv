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

        <div class="col-calendar1 col-lg-4">
            <div class="filter-calendar">
                <div class="card" style="box-shadow: 0px 3px 15px -8px rgb(100,100,100);">
                    <div class="card-header" style="background: #ff7400;">
                        <span style="font-weight: 600; color: #FAF5E4;">Filter Calendar</span>
                    </div>
                    <div class="card-body">
                        <div class="card-block" style="padding: 20px;">
                            <label style="font-weight: 500;">Select villa :</label>
                            <select class="form-control" name="select_villa" id="select_villa"
                            onchange="changeVillaName(this.value);">
                                <option value="" disabled selected>Choose villa...</option>
                                @foreach ($data as $item)
                                    {{-- <option value="{{$item->id_villa}}">{{ $item->name }}</option> --}}
                                    {{-- <option data-id="{{$item->id_villa}}" data-price="{{$item->price}}">{{ $item->name }}</option> --}}
                                    <option data-price="{{ $item->price }}" value="{{ $item->id_villa }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-calendar2 col-lg-8">
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
                    <form action="{{ route('calendar_store') }}" method="POST">
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
                        </div>
                        <div class="form-group">
                            <label for="">End date</label>
                            <input type="date" class="form-control" id="end" name="end" placeholder="End date">
                        </div>
                        <div class="form-group">
                            <label for="">Special Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="text" class="form-control" name="disc" placeholder="Discount" value="0">
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
                    <form action="{{ route('calendar_update') }}" method="POST">
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
                        </div>
                        <div class="form-group">
                            <label for="">End date</label>
                            <input type="date" class="form-control" id="edit-end" name="end" placeholder="End date" date-format="Y-m-d">
                        </div>
                        <div class="form-group">
                            <label for="">Special Price</label>
                            <input type="text" class="form-control" id="special_price" name="price" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="">Discount</label>
                            <input type="text" class="form-control" id="disc" name="disc" placeholder="Discount" value="0">
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />

<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

<script>

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
    });

    //Filter
    function changeVillaName(id)
    {
        // console.log('hit change villa');
        var datas = @json($data);
        var id = $('#select_villa').val();
        var data = `data not found`;
        for (let index = 0; index < datas.length; index++) {
            if(datas[index].id_villa == id) {
                data = datas[index];
                break;
            }
        }

        $('#id_villa').val(data.id_villa);
        $('#name_villa').val(data.name);
        $('#regular_price').val(data.price);

        $.ajax({
            type: "GET",
            url: "/dashboard/calendar/villa/" + id,
            dataType: "JSON",
            success: function(events){

                //fullcalendar
                let calendar = $('#calendar').fullCalendar({
                    defaultView: 'month',
                    displayEventTime: true,
                    editable: false,
                    // events : '{{ route('calendar.all') }}',

                    // disable past day
                    validRange: {
                        start: new Date(),
                    },

                    // eventRender: function (event, element, view) {
                    //     if (event.allDay === 'true') {
                    //         event.allDay = true;
                    //     } else {
                    //         event.allDay = false;
                    //     }
                    // },

                    selectable: true,
                    selectHelper: true,

                    //one day click
                    dayClick: function (date, view) {
                        var start = $.fullCalendar.formatDate(date, "Y-MM-DD");
                        // $('#id_villa').val(data.id);
                        // $('#name_villa').val(data.name);
                        // $('#regular_price').val(data.price);
                        $('#start').val(date);
                        $('#addSpecialModal').modal('show');
                    },

                    //selection date start until end
                    select: function (start, end) {
                        // if(start.isBefore(moment())) {
                        //     $('#calendar').fullCalendar('unselect');
                        //     alert('Min date is Today !');
                        //     return false;
                        // }
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = moment(end).subtract(1, "days").format('YYYY-MM-DD');
                        // $('#id_villa').val(data.id_villa);
                        // $('#name_villa').val(data.name);
                        // $('#regular_price').val(data.price);
                        $('#start').val(start);
                        $('#end').val(end);
                        $('#addSpecialModal').modal('show');
                    },

                    //special price click in date and update
                    eventClick: function (event) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = moment(event.end).subtract(1, "days").format('YYYY-MM-DD');
                        // console.log(event.id_detail);
                        $('#id_detail').val(event.id_detail);
                        $('#edit-start').val(start);
                        $('#edit-end').val(end);
                        $('#special_price').val(event.title);
                        $('#villa_name').val(event.name);
                        $('#disc').val(event.disc);
                        $('#editSpecialModal').modal('show');
                    }
                });

                $('#calendar').fullCalendar('removeEvents');
                $('#calendar').fullCalendar('addEventSource', events);
                $('#calendar').fullCalendar('rerenderEvents');
            },
        });

    }

    // let calendar2 = $('#calendar2').fullCalendar({
    //     defaultView: 'month',
    //     editable: true,
    //     selectable: true,
    //     selectHelper: true,
    //     validRange: {
    //         start: new Date(),
    //     },
    // });

</script>

@endsection

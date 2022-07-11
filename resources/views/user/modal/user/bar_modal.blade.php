<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-bars" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile_update', Auth::user()->id)}}" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <br>
                    <div class="row mb-12" style="margin-top: -10px;">
                        <h5 class="col-12" style="cursor: pointer;">Settings</h5>
                    </div>
                    <div class="row mb-12">
                        <h5 class="col-12" style="cursor: pointer;">Privacy Policy</h5>
                    </div>
                    <div class="row mb-12">
                        <h5 class="col-12" style="cursor: pointer;">Terms & Condition</h5>
                    </div>
                    <div class="row mb-12">
                        <h5 class="col-12" style="cursor: pointer;">License</h5>
                    </div>
                    <div class="row mb-12">
                        <h5 class="col-12" style="cursor: pointer;">Security</h5>
                    </div>
                    <div class="row" style="margin-bottom: -20px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" >
                        <h5 class="col-12" style="cursor: pointer;"> Sign Out
                        <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                        </h5>
                    </div>
                    {{-- <!-- Submit -->
                    <div class="modal-footer" style="margin-bottom: -30px;">
                        <button type="submit"
                            style="width:200px; margin-right: 100px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                            class="btn btn-primary btn-lg btn-block">
                            Save
                        </button>
                    </div> --}}
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

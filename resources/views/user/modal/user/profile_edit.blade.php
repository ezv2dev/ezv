<!-- Fade In Default Modal -->
<div class="modal fade" id="modal-edit_profile" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile_update', Auth::user()->id) }}" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <br>
                    <div class="row mb-12" style="margin-top: -10px;">
                        <label class="col-sm-4 col-form-label" for="first_name">First Name</label>
                        <div class="col-sm-8" style="margin-bottom: 10px;">
                            <input type="text" style="font-size: 14px;" class="form-control" id="first_name"
                                name="first_name" placeholder="Input First Name"
                                value="{{ Auth::user()->first_name }}">
                        </div>
                    </div>
                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="last_name">Last Name</label>
                        <div class="col-sm-8" style="margin-bottom: 10px;">
                            <input style="font-size: 14px;" type="text" class="form-control" id="last_name"
                                name="last_name" placeholder="Input Last Name" value="{{ Auth::user()->last_name }}">
                        </div>
                    </div>
                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="address">Address</label>
                        <div class="col-sm-8" style="margin-bottom: 10px;">
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Input Address" value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="email">Email</label>
                        <div class="col-sm-8" style="margin-bottom: 10px;">
                            <input style="font-size: 14px;" type="email" class="form-control" id="email" name="email"
                                placeholder="Input Email" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="row mb-12">
                        <label class="col-sm-4 col-form-label" for="phone">Phone</label>
                        <div class="col-sm-8" style="margin-bottom: 10px;">
                            <input style="font-size: 14px;" type="number" class="form-control" id="phone" name="phone"
                                placeholder="Input Phone" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <br>
                    <!-- Submit -->
                    <div class="modal-footer" style="margin-bottom: -30px;">
                        <button type="submit"
                            style="width:200px; margin-right: 100px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                            class="btn btn-primary btn-lg btn-block">
                            Save
                        </button>
                    </div>
                    <!-- END Submit -->
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

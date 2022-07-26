@extends('layouts.password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 pt-5">
            <div class="card pb-5 mb-5 shadow-lg">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body mt-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="frmRst" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email-reset" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                <small id="err-eml-lgn" style="display: none;" class="invalid-feedback"></small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <small id="err-bcknd" class="invalid-feedback">{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;
        $(document).on("focusout", "#email-reset", function () {
            if(!$(this).val()) {
                $('#fvicn-eml').css("top", "35%");
                $('#email-reset').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#fvicn-eml').css("top", "35%");
                    $('#email-reset').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                }
            }
        });
        $(document).on("keyup", "#email-reset", function () {
            $('#fvicn-eml').css("top", "50%");
            $('#email-reset').removeClass('is-invalid');
            $('#err-bcknd').hide();
            $('#err-eml-lgn').hide();
            $('#err-eml-lgn').text('');
        });
        $("#frmRst").submit(function(e) {
            let error = 0;
            if(!$('#email-reset').val()) {
                $('#email-reset').addClass('is-invalid');
                $('#err-bcknd').hide();
                $('#err-eml-lgn').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-lgn').show();
                error = 1;
            } else {
                if (!regex.test($('#email-reset').val())) {
                    $('#email-reset').addClass('is-invalid');
                    $('#err-bcknd').hide();
                    $('#err-eml-lgn').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-lgn').show();
                    error = 1;
                }
            }
            if(error == 1) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection

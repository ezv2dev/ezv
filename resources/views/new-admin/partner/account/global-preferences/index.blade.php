@extends('new-admin.layouts.admin_layout')

@section('title', 'Global Preferences - Account Setting - EZV2')

<style>
    @media only screen and (max-width: 767px) {
        .ml-max-md-20p {
            margin-left: 20px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-2 ml-max-md-20p" style="margin-left: 30px;">
                    <div class="block-content">
                        @if (session('success'))
                        <div class="col-8 justify-content-center ml-n3">
                            <div class="alert alert-success alert-dismissible" role="alert" style="width: 90%;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}"
                                        style="color: #ff7400 !important">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Global preferences</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px; padding-right: 1.5rem;">
                        Global preferences
                    </h1>
                </div>

                <div id="content" class="col-12">
                    <div class="col-12 mt-5 d-flex ml-max-md-0p" style="margin-left: 10px;" id="divLegalName">
                        <div class="col-md-7" id="legal-name">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Preferred language</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);" onclick="showLanguageForm()">Edit</a>
                                @if (Auth::user()->id_language != null)
                                <p class="text-muted">{{ Auth::user()->language->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 d-flex ml-max-md-0p" style="margin-left: 10px;" id="divGender">
                        <div class="col-md-7" id="gender">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Preferred currency</span>
                                <a onclick="showCurrencyForm()" class="float-right text-dark"
                                    style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);">Edit</a>
                                @if (Auth::user()->id_currency != null)
                                <p class="text-muted">{{ Auth::user()->currency->name }} ({{ Auth::user()->currency->code }})</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4 d-flex ml-max-md-0p" style="margin-left: 10px;" id="divBirthday">
                        <div class="col-md-7" id="date-of-birth">
                            <div class="legal-name" style="border-bottom: 1px solid #DFDFDE; padding-bottom:20px;">
                                <span class="lead">Time zone</span>
                                <a onclick="showTimezoneForm()" class="float-right text-dark"
                                    style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);">Edit</a>
                                @if (Auth::user()->id_timezone != null)
                                <p class="text-muted">({{ Auth::user()->timezone->diff_from_gtm }}) {{ Auth::user()->timezone->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Language -->
                <div id="languageForm" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 d-flex ml-max-md-0p" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Preferred language</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);" onclick="showLanguage()">Cancel</a>
                                <p class="text-muted">This updates what you read on EZV, and how we communicate with
                                    you.</p>
                            </div>
                            <form action="{{ route('global-language') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <select style="width: 100%; padding:10px;" class="form-select" name="language">
                                        {{-- <option value="1" selected>English</option> --}}
                                        @foreach($languages as $item)
                                        <option value="{{ $item->id_host_language }}" {{ $item->id_host_language == Auth::user()->id_language ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Language -->

                <!-- Form Currency -->
                <div id="currencyForm" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 d-flex ml-max-md-0p" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Preferred currency</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);" onclick="showCurrency()">Cancel</a>
                            </div>
                            <form action="{{ route('global-currency') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <select style="width: 100%; padding:10px;" class="form-select" name="currency">
                                        @foreach($currency as $item)
                                        <option value="{{ $item->id_currency }}" {{ $item->id_currency == Auth::user()->id_currency ? 'selected' : '' }}>{{ $item->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Currency -->

                <!-- Form Timezone -->
                <div id="timezoneForm" class="col-12" style="display: none;">
                    <div class="col-12 mt-5 d-flex ml-max-md-0p" style="margin-left: 10px;">
                        <div class="col-md-7">
                            <div class="legal-name" style="padding-bottom:20px;">
                                <span class="lead">Preferred timezone</span>
                                <a class="float-right text-dark" style="text-decoration: underline; font-size: 11pt;"
                                    href="javascript:void(0);" onclick="showTimezone()">Cancel</a>
                            </div>
                            <form action="{{ route('global-timezone') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <select style="width: 100%; padding:10px;" class="form-select" name="timezone">
                                        @foreach($timezones as $item)
                                        <option value="{{ $item->id_timezone }}" {{ $item->id_timezone == Auth::user()->id_timezone ? 'selected' : '' }}>({{ $item->diff_from_gtm }})
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-dark">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Form Timezone -->

            </div>
        </div>
    </div>
</div>

@include('new-admin.layouts.footer')

@endsection

@section('scripts')

<script>
    function showLanguageForm() {
        document.getElementById("languageForm").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    function showLanguage() {
        document.getElementById("languageForm").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    function showCurrencyForm() {
        document.getElementById("currencyForm").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    function showCurrency() {
        document.getElementById("currencyForm").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

    function showTimezoneForm() {
        document.getElementById("timezoneForm").style.display = "block";
        document.getElementById("content").style.display = "none";
    }

    function showTimezone() {
        document.getElementById("timezoneForm").style.display = "none";
        document.getElementById("content").style.display = "block";
    }

</script>

@endsection

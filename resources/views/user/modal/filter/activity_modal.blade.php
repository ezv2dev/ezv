<!-- Fade In Default Modal -->

<style>
    .switch {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 25px;
        border-radius: 20px;
        background: #dfd9ea;
        transition: background 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        vertical-align: middle;
        cursor: pointer;
    }

    .example::-webkit-scrollbar {
    display: none;
    }

    .switch::before {
        content: '';
        position: absolute;
        top: 1px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: #fafafa;
        border-radius: 50%;
        transition: left 0.28s cubic-bezier(0.4, 0, 0.2, 1), background 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(128, 128, 128, 0.1);
    }

    input:checked+.switch {
        background: #ff7400;
    }

    input:checked+.switch::before {
        left: 27px;
        background: #fff;
        font-family: "Font Awesome 5 Free";
        font-weight: 600;
        font-size: 15px;
        content: "\f00c";
        text-align: center;
    }

    input:checked+.switch:active::before {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.28), 0 0 0 20px rgba(0, 150, 136, 0.2);
    }

    .font-16 {
        font-size: 16px;
    }

    .font-14 {
        font-size: 14px;
    }

    p {
        font-family: 'Montreal Light', sans-serif !important;
        margin-top: -20px;
    }

    .orange {
        color: #FF7400;
    }

</style>

@php
$amenities2 = App\Models\Amenities::all();
@endphp

@php
$host_language2 = App\Models\HostLanguage::all();
$accessibility_features2 = App\Models\VillaAccessibilityFeatures::all();
$accessibility_features_detail2 = App\Models\VillaAccessibilitiyFeaturesDetail::all();
@endphp

<div class="modal fade" id="modal-filters" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
        <div class="modal-content" style="background: #fff;">
            <div class="modal-header filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="filter-modal-body" style=" height: 450px; overflow-y: auto;">
                <form action="{{ route('filters') }}" method="GET" id="basic-form" class="js-validation col-12" enctype="multipart/form-data"
                    style="display: table">
                    <div class="filter-modal-row">
                        <div class="filter-restaurant">
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Location</h5>
                        <select name="location" id="location">
                            <option>Where are you going?</option>
                            <option value="jimbaran">Jimbaran</option>
                            <option value="seminyak">Seminyak</option>
                            <option value="ubud">Ubud</option>
                            <option value="canggu">Canggu</option>
                        </select>
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Type of activity</h5>
                        <input type="text" name="typeoffood" placeholder="Search">
                    </div>
                    <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Category</h5>
                        <div class="row checkbox-filter">
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="medical" />
                                <span>Medical</span>
                            </label>
                            </div>
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="outdoor" />
                                <span>Outdoor</span>
                            </label>
                            </div>
                        </div>
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Time of Day</h5>
                        <div class="row checkbox-filter">
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="morning" />
                                <span>Morning</span>
                            </label>
                            <label class="checkbox">
                                <input type="checkbox" id="evening" />
                                <span>Evening</span>
                            </label>
                            </div>
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="afternoon" />
                                <span>Afternoon</span>
                            </label>
                            </div>
                        </div>
                        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Facilities</h5>
                        <div class="row checkbox-filter">
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="parking" />
                                <span>Parking</span>
                            </label>
                            </div>
                            <div class="col-6 checkbox">
                            <label class="checkbox">
                                <input type="checkbox" id="wifi" />
                                <span>Wifi</span>
                            </label>
                            </div>
                        </div>
                    </div>
                <!-- Submit -->
                <div class="modal-filter-footer">
                    <button type="submit"
                        style="width:150px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
                        class="btn btn-primary btn-lg btn-block">
                        Save
                    </button>
                </div>
                <!-- END Submit -->
            </form>
        </div>
    </div>
</div>

<script>
    function bedroom_increment_modal() {
        document.getElementById('bedroom_number2').stepUp();
    }

    function bedroom_decrement_modal() {
        document.getElementById('bedroom_number2').stepDown();
    }

    function bathroom_increment_modal() {
        document.getElementById('bathroom_number2').stepUp();
    }

    function bathroom_decrement_modal() {
        document.getElementById('bathroom_number2').stepDown();
    }

    function bed_increment_modal() {
        document.getElementById('bed_number2').stepUp();
    }

    function bed_decrement_modal() {
        document.getElementById('bed_number2').stepDown();
    }

    function showmoreaccessibility() {
        document.getElementById("modal-accessibility-all").classList.remove("display-none");
        document.getElementById("modal-accessibility-all").classList.add("display-block");
        document.getElementById("show-more-accessibility").classList.add("display-none");
    }

    function closemoreaccessibility() {
        document.getElementById("modal-accessibility-all").classList.remove("display-block");
        document.getElementById("modal-accessibility-all").classList.add("display-none");
        document.getElementById("show-more-accessibility").classList.remove("display-none");
    }

    function showmoreamenities() {
        document.getElementById("modal-amenities-all").classList.remove("display-none");
        document.getElementById("modal-amenities-all").classList.add("display-block");
        document.getElementById("show-more-amenities").classList.add("display-none");
    }

    function closemoreamenities() {
        document.getElementById("modal-amenities-all").classList.remove("display-block");
        document.getElementById("modal-amenities-all").classList.add("display-none");
        document.getElementById("show-more-amenities").classList.remove("display-none");
    }

    function showmorelanguage() {
        document.getElementById("modal-language-all").classList.remove("display-none");
        document.getElementById("modal-language-all").classList.add("display-block");
        document.getElementById("show-more-language").classList.add("display-none");
    }

    function closemorelanguage() {
        document.getElementById("modal-language-all").classList.remove("display-block");
        document.getElementById("modal-language-all").classList.add("display-none");
        document.getElementById("show-more-language").classList.remove("display-none");
    }


</script>
<!-- END Fade In Default Modal -->

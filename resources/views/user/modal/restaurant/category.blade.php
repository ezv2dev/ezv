<!-- Fade In Default Modal -->

<style>
    .column.left {
        width: 25%;
        float: left;
    }

    #categoryModal {
        padding: 0px !important;
    }

    .modal-header-category {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
        display: flex;
    }

    .modal-body-category {
        padding: 1rem;
        height: 500px !important;
        display: flex;
        align-items: center;
        overflow-y: auto !important;
    }

    .modal-content-category {
        background-color: white;
        height: 100% !important;
    }

    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .modal-category-title {
        font-family: "Poppins" !important;
        color: #3A3845;
        font-size: 32px;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .filter-language-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: grey;
        cursor: pointer;
    }

    .filter-language-option-text:active {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-text:hover {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: #ff7400 !important;
        cursor: pointer;
    }

    .filter-language-option-container {
        padding-bottom: 10px;
    }

    .filter-language-option-text:focus {
        border: none !important;
    }

    .column.right {
        width: 75%;
        float: left;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: black !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }

    /* Start of filter modal*/
    .btn-close-modal {
        background: none !important;
        border: none;
    }

    .filter-modal {
        justify-content: flex-end;
    }

    .modal-filter-footer-language {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        border-top: none;
        height: 20px;
    }

    .login-container {
        width: 70%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    .register-container {
        width: 80%;
        /* justify-content: center; */
        margin: 0px auto;
    }

    /* End of filter modal*/

    .form-control {
        font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    ::placeholder {
        font-size: 1rem !important;
    }

    .text-small {
        font-size: 12px;
        margin-bottom: -10px;
    }

    .text-small a {
        font-size: 12px;
        color: #ff7400;
        cursor: pointer;
    }

    .right {
        text-align: right;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .modal-category-title p {
        font-size: 14px;
        margin-bottom: 10px;
        margin-top: -10px;
        font-weight: 400;
    }

    .nav-tabs li {
        margin-right: 10px;
    }

    .login-register-label {
        margin: 0px;
        font-weight: 500;
    }

    .switcher-text2 {
        margin: 0px !important;
        width: unset !important;
    }


    .grid-img-container {
        /* justify-content: center;
        align-items: center;
        display: flex;
        margin: 4px; */
        cursor: pointer;
    }

    .grid-img-container:hover>.grid-text {
        color: #ff7400;
    }

    .grid-img {
        width: 100%;
        aspect-ratio: 1/1;
        height: 100%;
        border-radius: 12px;
        object-fit: cover;
        filter: brightness(70%);
    }

    .grid-img:hover {
        filter: brightness(85%);
    }

    .grid-text {
        position: absolute;
        z-index: 99;
        color: white;
    }

    .category-grid {
        grid-template-columns: repeat(6, minmax(0, 1fr));
        grid-template-rows: repeat(1, auto) !important;
        gap: 10px;
        display: grid;
    }

    @media only screen and (max-width: 545px) { 
        .category-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }   
    }
    @media only screen and (min-width: 546px) and (max-width: 768px) { 
        .category-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }   
    }
    @media only screen and (min-width: 769pxpx) and (max-width: 991px) { 
        .category-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }   
    }
</style>

<div id="categoryModal" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-horizontal-centered">
        <div class="modal-content modal-content-category" style="border-radius:15px;">
            <div class="modal-header">
                <div class="col-11">
                    <h4 class="mb-0">
                        <span class="translate-text-single">Choose Category</span>
                    </h4>
                </div>
                <div class="col-1 right">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            <div class="modal-body modal-body-category d-flex align-content-start flex-wrap" style="overflow-y:scroll;">
                <div class="category-grid translate-text-group">
                    @foreach ($categories as $item)
                        <div class="grid-img-container" onclick="foodFilter({{ $item->id_cuisine }}, null)">
                            <img @if ($fCuisine == $item->id_cuisine) style="border: 5px solid #ff7400;" @endif
                                class="grid-img lozad" style="width: 100%; heigth: 100%;"
                                data-src="https://source.unsplash.com/random/?{{ $item->name }}" src="{{ LazyLoad::show() }}">
                            <span class="grid-text translate-text-group-items">
                                {{ $item->name }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer border-0">
            </div>
        </div>
    </div>
</div>
</div>
</div>

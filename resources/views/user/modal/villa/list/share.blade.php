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

    .orange {
        color: #FF7400;
    }

</style>

@php
$villas = $villa->shuffle()->sortBy('grade');
$list = [];
foreach ($villas as $item) {
    array_push($list, $item->id_villa);
}
@endphp

@foreach ($villas as $data)
    <div class="modal fade" id="modal-share-{{ $data->id_villa }}" tabindex="-1" role="dialog"
        aria-labelledby="modal-default-fadein" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document" style="overflow-y: initial !important">
            <div class="modal-content" style="background: #fff;">
                <div class="modal-header filter-modal">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="filter-modal-body" style=" height: 400px; overflow-y: auto;">
                    <div class="row d-flex justify-content-center">
                        @if ($data->image)
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/foto/gallery/' . $data->uid . '/' . $data->image) }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                        @else
                            <img src="{{ LazyLoad::show() }}"
                                data-src="{{ URL::asset('/template/villa/template_profile.jpg') }}"
                                style="height: 48px; width: 48px;" class="rounded-circle shadow lozad">
                        @endif
                        <p class="d-flex align-items-center mb-0">{{ $data->name }}</p>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6 p-3 br-10" style="border: 1px solid #ff7400">
                            <a type="button" class="d-flex p-0" onclick="copy_link()">
                                <div id="myCopy" class="pr-5"><i class="fas fa-copy"></i> <span
                                        class="fw-normal">{{ Translate::translate('Copy Link') }}</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 p-3 br-10" style="border: 1px solid #ff7400">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('villa', $data->id_villa) }}&display=popup"
                                target="_blank" class="d-flex p-0">
                                <div class="pr-5"><i class="fab fa-facebook"></i> <span
                                        class="fw-normal">Facebook</span></div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6 p-3 br-10" style="border: 1px solid #ff7400">
                            <a href="https://api.whatsapp.com/send?text={{ route('villa', $data->id_villa) }}"
                                target="_blank" class="d-flex p-0">
                                <div class="pr-5"><i class="fab fa-whatsapp"></i> <span
                                        class="fw-normal">WhatsApp</span></div>
                            </a>
                        </div>
                        <div class="col-6 p-3 br-10" style="border: 1px solid #ff7400">
                            <a href="https://telegram.me/share/url?url={{ route('villa', $data->id_villa) }}&text={{ route('villa', $data->id_villa) }}"
                                target="_blank" class="d-flex p-0">
                                <div class="pr-5"><i class="fab fa-telegram"></i> <span
                                        class="fw-normal">Telegram</span></div>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 p-3 br-10" style="border: 1px solid #ff7400">
                            <a href="mailto:?subject=I wanted you to see this site&amp;body={{ route('villa', $data->id_villa) }}"
                                target="_blank" class="d-flex p-0">
                                <div class="pr-5"><i class="fas fa-envelope"></i> <span
                                        class="fw-normal">Email</span></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

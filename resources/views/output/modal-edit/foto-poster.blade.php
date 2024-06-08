@foreach ($output as $item)
    <div class="modal fade" id="modalEditFoto/Poster{{ $item->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')
                            pOSTER

                            <div class="action d-flex flex-wrap justify-content-end">
                                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);"
                                    data-bs-dismiss="modal">
                                    {{ __('Simpan') }}
                                </button>
                                <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1"
                                    style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);"
                                    data-bs-dismiss="modal">
                                    {{ __('Batal') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('status-laporan-key.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="name">{{ __('Nama') }}</label>
                                    <input type="text" @error('name') class="form-control is-invalid" @enderror
                                        name="name" id="name" placeholder="{{ __('Nama') }}"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end col -->
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

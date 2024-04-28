<div class="modal fade" id="modalTambahStatusLaporan" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('status-laporan.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="input-style-1">
                                    <label for="status_laporan_key_id">{{ __('Key') }}</label>
                                    <select class="form-control @error('status_laporan_key_id') is-invalid @enderror"
                                        name="status_laporan_key_id" id="status_laporan_key_id">
                                        @foreach ($status_laporan_key as $item)
                                            <option value="{{ $item->id }}"
                                                @if (old('status_laporan_key_id') == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_laporan_key_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
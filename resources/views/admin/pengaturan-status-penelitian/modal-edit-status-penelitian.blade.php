@foreach ($status_penelitian as $item)
    <div class="modal fade" id="modalEditStatusPenelitian{{ $item->id }}" tabindex="-1"
        aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="{{ route('status-penelitian.update', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label
                                            for="statusPenelitianKeyIdEdit{{ $item->id }}">{{ __('Status Penelitian') }}</label>
                                        <select
                                            class="form-control @error('status_penelitian_key_id') is-invalid @enderror"
                                            name="status_penelitian_key_id"
                                            id="statusPenelitianKeyIdEdit{{ $item->id }}">
                                            @foreach ($status_penelitian_key as $status)
                                                <option value="{{ $status->id }}"
                                                    @if (old('status_penelitian_key_id', $item->statusPenelitianKey->id) == $status->id) selected @endif>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status_penelitian_key_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1 mt-3">
                                        <label
                                            for="nameStatusPenelitianEdit{{ $item->id }}">{{ __('Name') }}</label>
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="nameStatusPenelitianEdit{{ $item->id }}"
                                            placeholder="{{ __('Name') }}" value="{{ $item->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="warna{{ $item->id }}">{{ __('Warna Badge') }}</label>
                                        <select class="form-control @error('warna') is-invalid @enderror" name="warna"
                                            id="warna{{ $item->id }}">
                                            <option value="" disabled selected>Pilih Warna</option>
                                            <option value="primary" @if (old('warna', $item->warna) == 'primary') selected @endif>
                                                Biru</option>
                                            <option value="secondary" @if (old('warna', $item->warna) == 'secondary') selected @endif>
                                                Abu</option>
                                            <option value="success" @if (old('warna', $item->warna) == 'success') selected @endif>
                                                Hijau</option>
                                            <option value="danger" @if (old('warna', $item->warna) == 'danger') selected @endif>
                                                Merah</option>
                                            <option value="warning" @if (old('warna', $item->warna) == 'warning') selected @endif>
                                                Kuning</option>
                                            <option value="info" @if (old('warna', $item->warna) == 'info') selected @endif>
                                                Biru Muda</option>
                                            <option value="dark" @if (old('warna', $item->warna) == 'dark') selected @endif>
                                                Hitam</option>
                                        </select>
                                        @error('warna')
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
@endforeach

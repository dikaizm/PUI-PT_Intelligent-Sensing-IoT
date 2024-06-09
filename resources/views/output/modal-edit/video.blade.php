<div class="modal fade" id="modalEditVideo{{ $detail->id }}" tabindex="-1"
    aria-labelledby="ModalEditVideoLabel{{ $detail->id }}" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('output-detail.update-video', ['id' => $detail->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="input-style-1">
                            <label for="jenis_output_id">{{ __('Jenis') }}</label>
                            <select id="jenis_output_id" name="jenis_output_id" class="form-control" disabled>
                                <option value="">--Pilih Jenis Output--</option>
                                @foreach ($jenis_output as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('jenis_output_id', $detail->jenis_output_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->jenisOutputKey->name }} {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-style-1">
                            <label for="judul_output">{{ __('Judul Video') }}</label>
                            <input @error('judul_output') class="form-control is-invalid" @enderror type="text"
                                name="judul_output" id="judul_output" placeholder="{{ __('Judul Video') }}"
                                value="{{ old('judul_output', $detail->judul) }}">
                            @error('judul_output')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="tautan">{{ __('Link Jurnal') }} <span
                                    style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
                            <input @error('tautan') class="form-control is-invalid" @enderror type="text"
                                name="tautan" id="tautan" placeholder="{{ __('gunakan http:// atau https://') }}"
                                value="{{ old('tautan', $detail->tautan) }}">
                            @error('tautan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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

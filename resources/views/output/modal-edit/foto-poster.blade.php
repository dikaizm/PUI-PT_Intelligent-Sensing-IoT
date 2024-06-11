<div class="modal fade" id="modalEditFoto/Poster{{ $detail->id }}" tabindex="-1"
    aria-labelledby="modalEditFoto/PosterLabel{{ $detail->id }}" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('output-detail.update-foto-poster', ['id' => $detail->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="input-style-1">
                            <label for="judul_penelitian">{{ __('Judul Penelitian') }}</label>
                            <input type="hidden" name="uuid" value="{{ isset($penelitian) ? $penelitian->uuid : '' }}">
                            <input @error('judul_penelitian') class="form-control is-invalid" @enderror type="text" name="judul_penelitian"
                                id="judul_penelitian" placeholder="{{ __('Judul Penelitian') }}"
                                value="{{ old('judul_penelitian', $penelitian->judul ?? '') }}"
                                @if (isset($penelitian->judul)) readonly @endif>
                            @error('judul_penelitian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="judul_output">{{ __('Judul Publikasi') }}</label>
                            <input @error('judul_output') class="form-control is-invalid" @enderror type="text"
                                name="judul_output" id="judul_output" placeholder="{{ __('Judul Publikasi') }}"
                                value="{{ old('judul_output', $detail->judul) }}">
                            @error('judul_output')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
                            <label for="file">{{ __('File Foto') }}</label>
                            <input type="file" name="file" accept=".jpeg, .png, .jpg"
                                class="form-control @error('file') is-invalid @enderror"
                                placeholder="{{ __('File Foto') }}" value="{{ old('file') }}">
                            @error('file')
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

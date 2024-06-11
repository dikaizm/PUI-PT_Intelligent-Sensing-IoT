<div class="modal fade" id="modalEditPublikasi{{ $detail->id }}" tabindex="-1"
    aria-labelledby="modalEditPublikasiLabel{{ $detail->id }}" aria-hidden="true">
    <div class="modal-dialog"
        style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
        <div class="modal-content card-style">
            <div class="modal-header px-0 border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-0">
                <div class="content mb-30">
                    <form action="{{ route('output-detail.update-publikasi', ['id' => $detail->id]) }}" method="POST">
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
                            <label for="tipe">{{ __('Tipe') }}</label>
                            <select id="tipe" name="tipe" class="form-control">
                                <option value="">--Pilih Tipe--</option>
                                @foreach ($tipe as $item)
                                    <option value="{{ $item }}"
                                        {{ old('tipe', $detail->tipe) == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('tipe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

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

                        {{-- <div class="input-style-1">
                            <label>{{ __('Author') }}</label>
                            <select name="user_id[]" class="form-control select2 @error('user_id[]') is-invalid @enderror" multiple="multiple" style="width: 100%; height: 58px;" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ (in_array($user->id, old('user_id', $detail->users->pluck('id')->toArray())) ? 'selected' : '') }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id[]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="mt-2">
                                <a type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaEksternal" style="font-size:20px; color: red !important;">
                                    {{ __('Tambah Anggota Eksternal') }}
                                </a>
                            </div>
                        </div>

                        <div class="input-style-1">
                            <label for="is_corresponding">{{ __('Corresponding') }}</label>
                            <select name="is_corresponding" id="is_corresponding" class="form-control select2" style="width: 100%; height: 58px;" required>
                                <option value="">Pilih Corresponding</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('is_corresponding', $detail->is_corresponding) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('is_corresponding')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}

                        <div class="input-style-1">
                            <label for="status_output_id">{{ __('Status Output') }}</label>
                            <select class="form-control @error('status_output_id') is-invalid @enderror"
                                name="status_output_id" id="status_output_id" style="max-width: 100%; margin: 0 auto;">
                                <option value="">Pilih Status</option>
                                @foreach ($status_output as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('status_output_id', $detail->status_output_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_output_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-style-1">
                            <label for="published_at">{{ __('Tanggal Publish') }} <span
                                    style="color:gray;">{{ __('*Diisi jika memilih status Published') }}</span></label>
                            <input type="date" id="dateInput" name="published_at"
                                value="{{ old('published_at', $detail->published_at) }}" required>
                            @error('published_at')
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
                                style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </form>

                    <!-- ========== modal tambah anggota eksternal =========== -->

                    <!-- ========== modal end =========== -->

                </div>
            </div>
        </div>
    </div>
</div>

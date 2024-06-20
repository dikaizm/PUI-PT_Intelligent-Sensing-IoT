<form action="{{ route('output-detail.store-publikasi') }}" method="POST">
    @csrf
    @method('POST')
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
        <label for="tipe">{{ __('Tipe') }}</label>
        <select id="tipe" name="tipe" class="form-control">
            <option value="">--Pilih Tipe--</option>
            @foreach ($tipe as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
        @error('tipe')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="jenis_output_id">{{ __('Jenis') }}</label>
        <select id="jenis_output_id" name="jenis_output_id" class="form-control">
            <option value="">--Pilih Jenis Output--</option>
            @foreach ($jenis_output as $item)
                @php
                    $jenisOutputKey = $item->jenisOutputKey->name;
                    $outputName = $item->name;
                @endphp
                @if (in_array($jenisOutputKey, ['Publikasi']))
                    <option value="{{ $item->id }}">{{ $jenisOutputKey }} {{ $outputName }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="input-style-1">
        <label for="judul_output">{{ __('Judul Publikasi') }}</label>
        <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
            id="judul_output" placeholder="{{ __('Judul Publikasi') }}" value="{{ old('judul_output') }}">
        @error('judul_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label>{{ __('Author') }}</label>
        <div id="input-anggota"></div>

        {{-- <select name="user_id[]" class="form-control select2 @error('user_id[]') is-invalid @enderror"
            multiple="multiple" style="width: 100%; height: 58px;" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @if (isset($penelitian) && $penelitian && in_array($user->id, $penelitian->users->pluck('id')->toArray())) selected @endif>
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
            <a type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaEksternal"
                style="font-size:20px; color: red !important;">
                {{ __('Tambah Anggota Eksternal') }}
            </a>
        </div> --}}
    </div>
    <div class="input-style-1">
        <label for="is_corresponding">{{ __('Corresponding') }}</label>
        <select name="is_corresponding" id="is_corresponding" class="form-control select2"
            style="width: 100%; height: 58px;" required data-selected="{{ old('is_corresponding') }}">
        </select>
        @error('is_corresponding')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="status_output_id">{{ __('Status Output') }}</label>
        <select class="form-control @error('status_output_id') is-invalid @enderror" name="status_output_id"
            id="status_output_id" style="max-width: 100%; margin: 0 auto;">
            <option value="">Pilih Status</option>
            @foreach ($status_output as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
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
        <input type="date" id="dateInput" name="published_at">
        @error('published_at')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="tautan">{{ __('Link Jurnal') }} <span
                style="color:gray;">{{ __('*Apabila sudah publish') }}</span> </label>
        <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
            placeholder="{{ __('gunakan http:// atau https://') }}" value="{{ old('tautan') }}">
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
@include('penelitian.modal-tambah-anggota-eksternal')
<!-- ========== modal end =========== -->


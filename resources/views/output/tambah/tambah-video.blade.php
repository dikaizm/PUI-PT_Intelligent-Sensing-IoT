<form action="{{ route('output-detail.store-video') }}" method="POST">
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
        <label for="jenis_output_id">{{ __('Jenis') }}</label>
        <select id="jenis_output_id" name="jenis_output_id" class="form-control">
            <option value="">--Pilih Video*--</option>
            @foreach ($jenis_output as $item)
                @php
                    $jenisOutputKey = $item->jenisOutputKey->name;
                    $outputName = $item->name;
                @endphp
                @if (in_array($jenisOutputKey, ['Video']))
                    <option value="{{ $item->id }}">{{ $jenisOutputKey }} {{ $outputName }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="input-style-1">
        <label for="judul_output">{{ __('Judul Output') }}</label>
        <input type="hidden" name="uuid" value="{{ isset($penelitian) ? $penelitian->uuid : '' }}">
        <input @error('judul_output') class="form-control is-invalid" @enderror type="text" name="judul_output"
            id="judul_output" placeholder="{{ __('Judul Output') }}" value="{{ old('judul_output') }}">
        @error('judul_output')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-style-1">
        <label>{{ __('Author') }}</label>
        <div id="input-anggota-video"></div>

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
        @enderror --}}
    </div>

    <div class="input-style-1">
        <label for="tautan">{{ __('Link Video') }}</label>
        <input @error('tautan') class="form-control is-invalid" @enderror type="text" name="tautan" id="tautan"
            placeholder="{{ __('gunakan http:// atau https:// ') }}" value="{{ old('tautan') }}">
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


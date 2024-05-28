<!-- ========== modal edit =========== -->
@foreach ($penelitian as $user)
    <div class="modal fade" id="modalEditPenelitian{{ $user->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true" style="">
        <div class="modal-dialog"
            style="min-height: 100vh; max-width:90%; width:800px; display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Skema Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="nameEdit{{ $user->id }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Judul Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="nameEdit{{ $user->id }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Ketua Tim') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="nameEdit{{ $user->id }}"
                                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}"
                                            required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="row">
                                    <div class="col-5" id="inputContainer">
                                        <div class="input-style-1">
                                            <input type="text"
                                                   name="name"
                                                   id="nameEdit{{ $user->id }}"
                                                   placeholder="{{ __('Name') }}"
                                                   value="{{ old('name', $user->name) }}"
                                                   required
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3" id="iconContainer">
                                        <div style="display: flex; flex-direction: column;">
                                            <button type="button" id="addButton" style="border: none; background: none;">
                                                <i class="lni lni-plus" style="color: black; margin:2px; font-size: 30px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Status Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 70%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Mitra Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 70%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Jenis Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 70%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Jangka Waktu Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-4 input-style-1">
                                            <input type="number" class="form-control">
                                        </div>
                                        <div class="col-8">
                                            <ul style="padding-left:0%;">
                                                <li style="font-weight: 400;font-size: 30px; text-align: left;">
                                                    {{ __('Bulan') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Pendanaan') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="number" class="form-control rupiah" @error('name') is-invalid @enderror"
                                        name="name" id="nameEdit{{ $user->id }}" placeholder="{{ __('Rupiah') }}"
                                        value="{{ old('name', $user->name) }}" required min="1">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('Tingkat TKT') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="number"class="form-control @error('name') is-invalid @enderror"name="name"id="nameEdit{{ $user->id }}"placeholder="{{ __('Name') }}"
                                               value="{{ old('name', $user->name) }}"required min="1"max="9">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- end col -->
                                <div class="col-4">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 500;font-size: 20px; text-align: left;">
                                                {{ __('File Penelitian') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="input-style-1">
                                        <input type="file"
                                               accept=".pdf"
                                               @error('name') class="form-control is-invalid" @enderror
                                               name="name"
                                               id="nameEdit{{ $user->id }}"
                                               placeholder="{{ __('Name') }}"
                                               value="{{ old('name', $user->name) }}"
                                               required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none; padding-left:15%;">
                                            <li style="font-weight: 400;font-size: 20px; text-align: left;color: gray;">
                                                {{ __('Note: Apabila penelitian sudah selesai silahkan laporkan tombol laporan output penelitian dibawah ini!') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end col -->
                                <!-- end col -->
                                <div class="action d-flex flex-wrap justify-content-end">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                        {{ __('Save') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                                    data-bs-dismiss="modal">
                                    Cancel
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
<!-- ========== modal end =========== -->

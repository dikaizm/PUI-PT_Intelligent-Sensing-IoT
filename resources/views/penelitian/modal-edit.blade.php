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
                        <h2>{{ __('Output Penelitian') }}</h2>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="name">{{ __('Nama Penelitian') }}</label>
                                        <input @error('name') class="form-control is-invalid" @enderror type="text"
                                            name="name" id="name" placeholder="{{ __('Skema Penelitian') }}"
                                            value="{{ old('name', auth()->user()->name) }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="input-style-1">
                                    <label for="statusPenelitian">Status Penelitian</label>
                                    <select id="statusPenelitian{{ $user->id }}" name="statusPenelitian" class="form-control" onchange="showAdditionalInput({{ $user->id }})">
                                        <option value="" disabled selected>Pilih Status Penelitian</option>
                                        <option value="publikasi">Publikasi</option>
                                        <option value="hki">HKI</option>
                                        <option value="foto">Foto/Poster</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                                
                                <!-- end col -->
                                <div class="col-12 pt-20">
                                    <div class="col-lg-12" id="tambahAnggotaContainer">
                                        <div style="display: flex; flex-direction: column;text-align:center;">
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#modalTambahAnggotaEksternal" style="font-size:20px; color: red !important;">
                                                {{ __('Tambahkan Output') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12 pt-40">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-toggle="modal" data-bs-target="#modalEditPenelitian{{ $user->id }}">
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->

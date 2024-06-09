<!-- ========== modal filter =========== -->
    <div class="modal fade" id="modalFilterLaporanKinerja" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 90%; width: 1000px;min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content card-style">
                <form id="tahunForm" action="{{ route('laporan-kinerja.store') }}" method="POST">
                    @csrf
                    <div class="modal-header px-0 border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-0" style="width: 100%; text-align: center;">
                        <div style="margin: auto;width: 90%;">
                            <div style="color: black; font-weight: 400;line-height: 35px;">
                                <div class="row mt-20" style="margin: auto;">
                                    <div class="col-xl-12 col-lg-12 col-sm-12">
                                        <div class="input-style-1">
                                            <label style="font-weight: 500; font-size: 25px; text-align: center;" for="tahunSelect">{{ __('Edit Dashboard') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-sm-12">
                                        <div class="input-style-1">
                                            <select id="tahunAwal" name="tahun1" style="height: 40px; width: 100%; padding: 8px; font-size: 16px; border-radius: 5px; text-align: center; text-align-last: center;">
                                                <!-- JavaScript akan menambahkan opsi select di sini -->
                                            </select>
                                            @error('tahunSelect')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-lg-2 col-sm-12">
                                        <h5>dan</h5>
                                    </div>
                                    <div class="col-xl-5 col-lg-5 col-sm-12">
                                        <div class="input-style-1">
                                            <select id="tahunAkhir" name="tahun2" style="height: 40px; width: 100%; padding: 8px; font-size: 16px; border-radius: 5px; text-align: center; text-align-last: center;">
                                                <!-- JavaScript akan menambahkan opsi select di sini -->
                                            </select>
                                            @error('tahunSelect')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-xl-3 col-lg-3 col-sm-12">
                                        <div class="input-style-1">
                                            <label style="font-weight: 500;font-size: 25px; text-align: center;"
                                            for="feedback">{{ __('Ubah Angka Target') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-sm-12">
                                        <div class="input-style-1">
                                            <label style="font-weight: 500;font-size: 25px; text-align: center; color:black;"
                                                for="#">{{ __('Penelitian') }}</label>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                                    <select style="height: 34px; padding: 5px 10px;" name="tahun" id="tahun" class="form-control @error('tahun') is-invalid @enderror">
                                                        <option value="">{{ __('Pilih Tahun') }}</option>
                                                        @for ($year = date('Y'); $year <= date('Y') + 100; $year++)
                                                            <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-sm-12">
                                                    <input style="height: 30px;" type="number" min="0" @error('feedback') class="form-control is-invalid" @enderror type="text"
                                                        name="feedback" id="feedback" placeholder="{{ __('Ubah Angka Target Penelitian') }}"
                                                        value="{{ old('feedback', auth()->user()->feedback) }}">
                                                    @error('feedback')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="action d-flex flex-wrap justify-content-end">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                        style="height:40px; width: 138px;background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                        {{ __('Simpan') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                                    data-bs-dismiss="modal" style="height:40px; width: 138px;">
                                        {{ __('Batal') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row pt-15" style="width-max:90% ">
                                <div class="col-xl-12 col-lg-12 col-sm-12">
                                    <div class="input-style-1">
                                        <label style="font-weight: 500;font-size: 25px; text-align: center;" for="statusPenelitian">{{ __('Tampilan Dashboard') }}</label>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none;">
                                            <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                {{ __('Status Penelitian') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <div class="base-list-box">
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-1">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-1" style="margin-left: 0;">Submitted</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-2">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-2" style="margin-left: 0;">Review</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-3">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-3" style="margin-left: 0;">Accepted</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-4">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-4" style="margin-left: 0;">Rejected</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-5">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-5" style="margin-left: 0;">On Going</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input" type="checkbox" checked value="" id="checkbox-status-penelitian-6">
                                                    <label class="form-check-label" for="checkbox-status-penelitian-6" style="margin-left: 0;">Finished</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none;">
                                            <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                {{ __('Jenis Output') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <div class="base-list-box">
                                        <ul style="list-style: none; padding: 0; margin: 0;">
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input checkbox-output" type="checkbox" checked value="" id="checkbox-jenis-output-1">
                                                    <label class="form-check-label label-output" for="checkbox-jenis-output-1" style="margin-left: 0;">Publikasi</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input checkbox-output" type="checkbox" checked value="" id="checkbox-jenis-output-2">
                                                    <label class="form-check-label label-output" for="checkbox-jenis-output-2" style="margin-left: 0;">HKI</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input checkbox-output" type="checkbox" checked value="" id="checkbox-jenis-output-3">
                                                    <label class="form-check-label label-output" for="checkbox-jenis-output-3" style="margin-left: 0;">Video</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input checkbox-output" type="checkbox" checked value="" id="checkbox-jenis-output-4">
                                                    <label class="form-check-label label-output" for="checkbox-jenis-output-4" style="margin-left: 0;">Poster</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-check" style="text-align: left;">
                                                    <input class="form-check-input checkbox-output" type="checkbox" checked value="" id="checkbox-jenis-output-5">
                                                    <label class="form-check-label label-output" for="checkbox-jenis-output-5" style="margin-left: 0;">Prototype</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="action d-flex flex-wrap justify-content-end mt-20">
                                        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                                            data-bs-dismiss="modal" style="height:40px; width: 138px; background: linear-gradient(90deg, #4737FF 0%, #2B2199 100%); color:white;border-color:#2B2199;">
                                            {{ __('Tampilkan') }}
                                        </button>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end form -->
            </div>
        </div>
    </div>
<!-- ========== modal end =========== -->

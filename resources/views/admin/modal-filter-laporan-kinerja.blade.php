<!-- ========== modal filter =========== -->
@foreach ($penelitian as  $item)
    <div class="modal fade" id="modalFilterLaporanKinerja{{ $item->id }}" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 90%; width: 1000px;min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content card-style">
                <form action="{{ route('penelitian.update-status-penelitian', ['uuid' => $item->uuid]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header px-0 border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-0" style="width: 100%; text-align: center;">
                        <div style="margin: auto;width: 90%;">
                            <div style="color: black; font-weight: 400;line-height: 35px;">
                                <div class="row mt-20">
                                    <div class="col-xl-3 col-lg-3 col-sm-12">
                                        <div class="input-style-1">
                                            <label style="font-weight: 500;font-size: 25px; text-align: center;"
                                                for="statusPenelitian{{ $item->id }}">{{ __('Pilih Tahun') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-sm-12">
                                        <div class="input-style-1">
                                            <select
                                                class="form-control @error('status_penelitian') is-invalid @enderror"
                                                name="status_penelitian"
                                                id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 100%; margin: 0 auto;">
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
                                            <input style="height: 30px;" type="number" min="0" @error('feedback') class="form-control is-invalid" @enderror type="text"
                                                name="feedback" id="feedback" placeholder="{{ __('Output') }}"
                                                value="{{ old('feedback', auth()->user()->feedback) }}">
                                            @error('feedback')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input style="height: 30px;" type="number" class="mt-15" min="0" @error('feedback') class="form-control is-invalid" @enderror type="text"
                                                name="feedback" id="feedback" placeholder="{{ __('Penelitian') }}"
                                                value="{{ old('feedback', auth()->user()->feedback) }}">
                                            @error('feedback')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div style="text-align: center;">
                                            <ul style="list-style: none;">
                                                <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                    {{ __('Jenis Output') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div class="base-list-box">
                                            <ul>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-jenis-output-1">
                                                  <label class="form-check-label" for="checkbox-jenis-output-1">Publikasi</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-jenis-output-2">
                                                  <label class="form-check-label" for="checkbox-jenis-output-2">HKI</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-jenis-output-3">
                                                  <label class="form-check-label" for="checkbox-jenis-output-3">Video</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-jenis-output-4">
                                                  <label class="form-check-label" for="checkbox-jenis-output-4">Poster</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-jenis-output-5">
                                                  <label class="form-check-label" for="checkbox-jenis-output-5">Prototype</label>
                                                </div>
                                              </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div style="text-align: center;">
                                            <ul style="list-style: none;">
                                                <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                    {{ __('Status Penelitian') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div class="base-list-box">
                                            <ul>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-1">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-1">Submitted</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-2">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-2">Review</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-3">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-3">Rejected</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-4">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-4">Accepted</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-5">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-5">On Going</label>
                                                </div>
                                              </li>
                                              <li>
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="" id="checkbox-status-penelitian-6">
                                                  <label class="form-check-label" for="checkbox-status-penelitian-6">Finished</label>
                                                </div>
                                              </li>
                                            </ul>
                                          </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div style="text-align: center;">
                                            <ul style="list-style: none;">
                                                <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                    {{ __('Tampilan Tahun') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xl-2 col-lg-2 col-sm-6">
                                        <div class="base-list-box">
                                            <ul>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-1">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-1">2024</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-2">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-2">2025</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-3">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-3">2026</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-4">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-4">2027</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-5">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-5">2028</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="form-check">
                                                        <input class="form-check-input limit-checkbox" type="checkbox" value="" id="checkbox-tampilan-tahun-6">
                                                        <label class="form-check-label" for="checkbox-tampilan-tahun-6">2029</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const checkboxes = document.querySelectorAll('.limit-checkbox');
                                            const maxChecked = 2;

                                            checkboxes.forEach(checkbox => {
                                                checkbox.addEventListener('change', function () {
                                                    let checkedCount = document.querySelectorAll('.limit-checkbox:checked').length;
                                                    if (checkedCount > maxChecked) {
                                                        this.checked = false;
                                                        alert('Anda hanya dapat memilih maksimal ' + maxChecked + ' opsi.');
                                                    }
                                                });
                                            });
                                        });
                                    </script>

                                </div>

                                    <!-- end row -->

                                <div class="action d-flex flex-wrap justify-content-end mt-20">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1"
                                        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);"
                                        data-bs-dismiss="modal">
                                        {{ __('Simpan') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1"
                                        style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);"
                                        data-bs-dismiss="modal">
                                        {{ __('Batalkan') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->

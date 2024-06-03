<!-- ========== modal status =========== -->
@foreach ($penelitian as $item)
    <div class="modal fade" id="modalStatusPenelitian{{ $item->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 90%; width: 400px;min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content card-style">
                <form action="{{ route('penelitian.update-status-penelitian', ['uuid' => $item->uuid]) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header px-0 border-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-0" style="width: 100%; text-align: center;">
                        <div class="col-xl-12 col-lg-12 col-md-12" style="margin: auto;width: 90%;">
                            <div style="color: black; font-weight: 400;line-height: 35px;">
                                <div class="row">
                                    <div style="text-align: center;">
                                        <ul style="list-style: none;">
                                            <li style="font-weight: 500;font-size: 25px; text-align: center;">
                                                {{ __('Status Sekarang') }}</li>
                                            <li style="font-weight: 400;font-size: 18px; text-align: center;">
                                                <span
                                                    class="badge rounded-pill bg-{{ $item->statusPenelitian->warna }}">
                                                    {{ $item->statusPenelitian->statusPenelitianKey->name }}
                                                    {{ $item->statusPenelitian->name }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label style="font-weight: 500;font-size: 25px; text-align: center;"
                                                for="statusPenelitian{{ $item->id }}">{{ __('Ubah Status Penelitian') }}</label>
                                            <select
                                                class="form-control @error('status_penelitian_id') is-invalid @enderror"
                                                name="status_penelitian_id" id="statusPenelitian{{ $item->id }}"
                                                style="max-width: 70%; margin: 0 auto;">
                                                @foreach ($status_penelitian as $status)
                                                    <option value="{{ $status->id }}"
                                                        @if (old('status_penelitian_id', $item->statusPenelitian->id) == $status->id) selected @endif>
                                                        {{ $status->statusPenelitianKey->name }} {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status_penelitian_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <!-- end col -->
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


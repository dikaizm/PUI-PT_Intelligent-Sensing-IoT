<!-- ========== modal detail =========== -->
@foreach ($penelitian as $user)
    <div class="modal fade" id="modalDetailPenelitian{{ $user->id }}" tabindex="-1"
        aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 90%; width: 800px;min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0" style="width: 100%; text-align: center;">
                    <div class="col-xl-6 col-lg-10 col-md-6" style="margin: auto;width: 90%;">
                        <div class="row g-0 auth-row" style="color: black; font-weight: 400;line-height: 35px;">
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Skema Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->keahlian) }} --}} Jojon
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Ketua Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->fakultas) }} --}}Docang
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Anggota Tim') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{ __('ddmmyy') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Status Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Mitra Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Jenis Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Jangka Waktu Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Pendanaan') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('Tingkatan TKT') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 15px; text-align: left;">
                                            {{ __('File Penelitian') }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 400;font-size: 14px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}} batu bgt
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- ========== modal end =========== -->

<!-- ========== modal detail =========== -->
@foreach ($penelitian as $user)
    <div class="modal fade" id="modalDetailPenelitian{{ $user->id }}" tabindex="-1"
        aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog"
            style="max-width: 90%; width: 800px; min-height: 100vh; display: flex; align-items: flex-start; justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0" style="width: 100%; text-align: left;">
                    <div class="col-12" style="text-align:left; width: 100%;">
                        <div class="row g-0 auth-row" style="color: black; font-weight: 400; line-height: 35px;">
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left: 5%; text-align: left;">
                                        <li style="font-weight: 500; font-size: 25px; text-align: left;">
                                            {{ __('Skema Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400; font-size: 18px; text-align: left;">
                                            {{ __('Skema Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Judul Keahlian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Judul Keahlian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Ketua Tim') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Ketua Tim') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Anggota Tim') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Anggota Tim') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Status Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Status Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Mitra Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Mitra Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Jangka Waktu Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Jangka Waktu Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Jenis Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Jenis Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Pendanaan') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Pendanaan') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Tingkatan TKT') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Tingkatan TKT') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('File Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('File Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h2 style="padding-left: 5%; color:gray;">{{ __('Output Penelitian') }}</h2>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Judul Output') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Judul Output') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('File Penelitian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('File Penelitian') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Author') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Author') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Corresponding Author') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Corresponding Author') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Jenis Luaran') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Jenis Luaran') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Tanggal Publish') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Tanggal Publish') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Publisher') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Publisher') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Status Jurnal') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Status Jurnal') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: left; width: 100%;">
                                    <ul style="list-style: none; padding-left:5%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Link Jurnal') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{ __('Link Jurnal') }}
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

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
                    <div class="col-12" style="margin: auto;width: 90%;">
                        <div class="row g-0 auth-row" style="color: black; font-weight: 400;line-height: 35px;">
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Nama Dosen') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->name) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Bidang Keahlian') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->keahlian) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Email Pengguna') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->email) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Fakultas') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->fakultas) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('NIP') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->nip) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('No Handphone') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->telp) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Link Google Scholar') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->telp) }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 row g-1">
                                <div style="text-align: center;">
                                    <ul style="list-style: none; padding-left:15%;">
                                        <li style="font-weight: 500;font-size: 25px; text-align: left;">
                                            {{ __('Link Sinta') }}
                                        </li>
                                        <li style="font-weight: 400;font-size: 18px; text-align: left;">
                                            {{-- {{ __($user->telp) }} --}}
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

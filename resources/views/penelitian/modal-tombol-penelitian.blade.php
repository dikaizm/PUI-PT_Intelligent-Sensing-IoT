<!-- ========== modal edit =========== -->
    <div class="modal fade" id="modalEditPenelitian" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="modal-title" id="ModalDeleteLabel">
                        <i class="lni lni-warning text-success me-2"></i> {{ __('Peringatan') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <p class="text-sm">
                            {{ __('Sudah yakin untuk edit ?') }}
                        </p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-end">
                        <form
                        {{-- action="{{ route('user.delete', ['id' => $user->id]) }}" --}}
                        method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="main-btn btn-sm success-btn btn-hover m-1">
                            Edit
                            </button>
                        </form>
                        <button type="button" class="main-btn btn-sm success-btn-outline btn-hover m-1"
                            data-bs-dismiss="modal">
                            Belum
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ========== modal end =========== -->

<!-- ========== modal laporkan output =========== -->
    <div class="modal fade" id="modalLaporkanOutput" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="modal-title" id="ModalDeleteLabel">
                        <i class="lni lni-warning text-primary me-2"></i> {{ __('Peringatan') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <p class="text-sm">
                            {{ __('Yakin penelitian sudah selesai ?') }}
                        </p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-end">
                        <form
                        {{-- action="{{ route('user.delete', ['id' => $user->id]) }}" --}}
                        method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1">
                                {{ __('Sudah') }}
                            </button>
                        </form>
                        <button type="button" class="main-btn btn-sm primary-btn-outline btn-hover m-1"
                            data-bs-dismiss="modal">
                            {{ __('Belum') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- ========== modal end =========== -->

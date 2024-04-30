@foreach ($status_jurnal as $item)
    <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
        aria-hidden="true">
        <div class="modal-dialog"
            style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="modal-title" id="ModalDeleteLabel">
                        <i class="lni lni-warning text-danger me-2"></i> {{ __('Delete') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <p class="text-sm">
                            {{ __('Are you sure you want to delete ' . $item->name . '?') }}
                        </p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-end">
                        <form action="{{ route('status-jurnal.destroy', ['id' => $item->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="main-btn btn-sm danger-btn btn-hover m-1">
                                Delete
                            </button>
                        </form>
                        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<!-- ========== modal archive =========== -->
@foreach ($penelitian as $item)
  <div class="modal fade" id="modalArchivePenelitian{{ $item->id }}" tabindex="-1" aria-labelledby="ModalFourLabel"
    aria-hidden="true">
    <div class="modal-dialog"
      style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
      <div class="modal-content card-style">
        <div class="modal-header border-0 px-0">
          <h5 class="modal-title" id="ModalArchiveLabel">
            <i class="lni lni-warning text-danger me-2"></i> {{ __('Archive') }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-0">

          @if (request()->query('arsip') != 'true')
            <div class="content mb-30">
              <p class="text-sm">
                {{ __('Are you sure you want to archive ' . $item->judul . '?') }}
              </p>
            </div>
            <div class="action d-flex justify-content-end flex-wrap">
              <form action="{{ route('penelitian.archive', ['uuid' => $item->uuid]) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1">
                  Archive
                </button>
              </form>
              <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
                Cancel
              </button>
            </div>
          @else
            <div class="content mb-30">
              <p class="text-sm">
                {{ __('Are you sure you want to unarchive ' . $item->judul . '?') }}
              </p>
            </div>
            <div class="action d-flex justify-content-end flex-wrap">
              <form action="{{ route('penelitian.unarchive', ['uuid' => $item->uuid]) }}" method="POST">
                @method('PUT')
                @csrf
                <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1">
                  Unarchive
                </button>
              </form>
              <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
                Cancel
              </button>
            </div>
          @endif

        </div>
      </div>
    </div>
  </div>
@endforeach
<!-- ========== modal end =========== -->

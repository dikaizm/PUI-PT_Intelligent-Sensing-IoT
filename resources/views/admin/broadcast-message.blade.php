@extends ('layouts.app')

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title mb-4">
          <h2>{{ __('Broadcast Message') }}</h2>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- ========== title-wrapper end ========== -->

  <div>
    {{-- Input message textarea --}}
    <form action="{{ route('broadcast-message.send') }}" method="POST">
      @csrf
      {{-- Select recipients checkbox grid --}}
      <div class="form-group">
        <label for="recipients" class="fs-5">{{ __('Pilih Penerima') }}</label>
        <div class="row" style="max-height: 280px; overflow-y: auto;">
          @foreach ($recipients as $recipient)
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $recipient->id }}"
                  id="recipient-{{ $recipient->id }}">
                <label class="form-check-label" for="recipient-{{ $recipient->id }}">
                  {{ $recipient->name }} ({{ $recipient->email }})
                </label>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Subject --}}
      <div class="form-group">
        <label for="subject" class="fs-5">{{ __('Subjek') }}</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan subjek pesan">
      </div>

      {{-- Message textarea --}}
      <div class="form-group">
        <label for="message" class="fs-5">{{ __('Pesan') }}</label>
        <textarea class="form-control" id="message" name="message" rows="8" placeholder="Ketik pesan disini..."></textarea>
      </div>

      {{-- Submit button --}}
      <button type="submit" class="main-btn primary-btn btn-hover text-center"
        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
        {{ __('Kirim') }}
      </button>
    </form>
  </div>
@endsection

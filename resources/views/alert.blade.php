@session('success')
    <div class="alert-box success-alert">
        <div class="alert">
            <h4 class="alert-heading">Berhasil</h4>
            <p class="text-medium">
                {{ $value }}
            </p>
        </div>
    </div>
@endsession

@session('danger')
    <div class="alert-box danger-alert">
        <div class="alert">
            <h4 class="alert-heading">Terjadi kesalahan :</h4>
            <p class="text-medium">
                {{ $value }}
            </p>
        </div>
    </div>
@endsession

@if ($errors->any())
    <div class="alert-box danger-alert">
        <div class="alert">
            <h4 class="alert-heading">Perhatian</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

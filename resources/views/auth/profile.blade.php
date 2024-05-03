@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('My profile') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles">
        <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
            <div class="card-content">

                @session('success')
                    <div class="alert-box success-alert">
                        <div class="alert">
                            <h4 class="alert-heading">Edit Berhasil</h4>
                            <p class="text-medium">
                                {{ $value }}
                            </p>
                        </div>
                    </div>
                @endsession

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                <h2>Akun</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="name">{{ __('Nama') }}</label>
                                <input @error('name') class="form-control is-invalid" @enderror type="text"
                                    name="name" id="name" placeholder="{{ __('Nama') }}"
                                    value="{{ old('name', auth()->user()->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="email">{{ __('Email') }}</label>
                                <input @error('email') class="form-control is-invalid" @enderror type="email"
                                    name="email" id="email" placeholder="{{ __('Email') }}"
                                    value="{{ old('email', auth()->user()->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password">{{ __('New password') }}</label>
                                <input type="password"
                                    @error('password') class="form-control is-invalid"
                                        @enderror
                                    name="password" id="password" placeholder="{{ __('New password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-12">
                            <div class="input-style-1">
                                <label for="password_confirmation">{{ __('New password confirmation') }}</label>
                                <input type="password"
                                    @error('password') class="form-control is-invalid"
                                        @enderror
                                    name="password_confirmation" id="password_confirmation"
                                    placeholder="{{ __('New password confirmation') }}">
                            </div>
                        </div>
                        <!-- end col -->

                        <h2>Biodata</h2>
                        <div class="input-style-1">
                            <label for="nip">{{ __('NIP') }}</label>
                            <input type="text" @error('nip') class="form-control is-invalid" @enderror
                                name="nip" id="nip" placeholder="{{ __('NIP') }}"
                                value="{{ old('nip', auth()->user()->nip) }}">
                            @error('nip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="telp">{{ __('Nomor Telepon') }}</label>
                            <input type="text" @error('telp') class="form-control is-invalid" @enderror
                                name="telp" id="telp" placeholder="{{ __('Nomor Telepon') }}"
                                value="{{ old('telp', auth()->user()->telp) }}">
                            @error('telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="keahlian">{{ __('Keahlian') }}</label>
                            <input type="text" @error('keahlian') class="form-control is-invalid" @enderror
                                name="keahlian" id="keahlian" placeholder="{{ __('Keahlian') }}"
                                value="{{ old('keahlian', auth()->user()->keahlian) }}">
                            @error('keahlian')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="fakultas">{{ __('Fakultas') }}</label>
                            <input type="text" @error('fakultas') class="form-control is-invalid" @enderror
                                name="fakultas" id="fakultas" placeholder="{{ __('Fakultas') }}"
                                value="{{ old('fakultas', auth()->user()->fakultas) }}">
                            @error('fakultas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="link_google_scholar">{{ __('Link Google Scholar') }}</label>
                            <input type="text" @error('link_google_scholar') class="form-control is-invalid" @enderror
                                name="link_google_scholar" id="link_google_scholar" placeholder="{{ __('Link Google Scholar') }}"
                                value="{{ old('link_google_scholar', auth()->user()->link_google_scholar) }}">
                            @error('link_google_scholar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="link_sinta">{{ __('Link Sinta') }}</label>
                            <input type="text" @error('link_sinta') class="form-control is-invalid" @enderror
                                name="link_sinta" id="link_sinta" placeholder="{{ __('Link Sinta') }}"
                                value="{{ old('link_sinta', auth()->user()->link_sinta) }}">
                            @error('link_sinta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-style-1">
                            <label for="email_verified_at">{{ __('Akun Terbuat') }}</label>
                            <input readonly type="text"
                                   name="email_verified_at"
                                   id="email_verified_at"
                                   placeholder="{{ __('Akun Terbuat') }}"
                                   value="{{ old('email_verified_at', auth()->user()->email_verified_at) }}">
                            @error('email_verified_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="button-group d-flex justify-content-center flex-wrap">
                                <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


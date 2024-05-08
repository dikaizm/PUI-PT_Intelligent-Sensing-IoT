@extends('layouts.guest')

@section('content')
    <div class="col-lg-7">
        <div style="height: 100vh; background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/auth/bg-login.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; position: relative;">
            <svg class="shape-image" width="60%" height="100%" viewBox="90 60 100 100" style="position: absolute; top: 0; left: 0;">
                <circle cx="100" cy="100" r="90" fill="url(#gradient)" />
                <image xlink:href="images/logo/login.png" x="110" y="75" width="70%" height="70%" />
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="90%" x2="0%" y2="10%">
                        <stop offset="10%" stop-color="#620707" />
                        <stop offset="100%" stop-color="#C80E0E" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
    </div>
    <!-- end col -->
    <div class="col-lg-5" style="font-family: DM Sans;">
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/auth/bg-login.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
            <div class="outer-card" style="background-color:#9B0B0B; padding: 30px; border-radius: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); width: 90%; height: 500px;">
                <div class="inner-card" style="background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); height:100%;display: flex; flex-direction: column; justify-content: center; padding: 20px;">
                    <form action="{{ route('register') }}" method="POST" style="max-width: 85%; width:400px; margin:auto;">
                        @csrf

                        <div style="text-align: center;letter-spacing: 0.02em;">
                            <h1 style="font-size: 24px;font-weight: 700;line-height: 31.25px;color: #590606;">
                                {{ __('Register') }}</h1>
                            <h1 style="font-size: 14px;font-weight: 500;line-height: 18.23px;color: #590606;">
                                {{ __('Create an account') }}</h1>
                        </div>

                            <div>
                                <label for="name" class="form-label"></label>
                                <input @error('name') class="form-control is-invalid" @else class="form-control" @enderror type="name" name="name" id="name" placeholder="{{ __('Name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <!-- end col -->
                            <div class="mb-3" >
                                <label for="email" class="form-label"></label>
                                    <input @error('email') class="form-control is-invalid" @else class="form-control" @enderror type="email" name="email" id="email" placeholder="{{ __('Email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <!-- end col -->
                            <div class="mb-3">
                                <input type="password" @error('password') class="form-control is-invalid" @else class="form-control" @enderror name="password" id="password" placeholder="{{ __('Password') }}" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- end col -->
                            <div class="mb-3">
                                <input type="password" @error('password_confirmation') class="form-control is-invalid" @else class="form-control" @enderror name="password_confirmation" id="password_confirmation" placeholder="{{ __('Password Confirmation') }}" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- end col -->
                            <div class="col-12 mb-3">
                                <div class="button-group d-flex justify-content-center flex-wrap">
                                    <button type="submit" style="background: linear-gradient(0deg, #620707 0%, #C80E0E 100%); color:white;width: 190px;height: 48px;top: 594px;left: 940px;gap: 0px;opacity: 0px;border-radius: 10px;align-items: center;">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>

                            <p class="text-sm text-medium text-dark text-center">
                                Already have an account? <a href="{{ route('home') }}" style="font-size: 14px;font-weight: 500;line-height: 18.23px;color: #590606;">Sign In</a>
                              </p>
                    <!-- end row -->
                   </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end col -->
@endsection

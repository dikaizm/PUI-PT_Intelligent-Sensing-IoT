@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Ouput Penelitian') }}</h2>
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
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-publikasi-tab" data-bs-toggle="pill" data-bs-target="#v-pills-publikasi" type="button" role="tab" aria-controls="v-pills-publikasi" aria-selected="true">
                            {{ __('Publikasi') }}
                        </button>
                        <button class="nav-link" id="v-pills-hki-tab" data-bs-toggle="pill" data-bs-target="#v-pills-hki" type="button" role="tab" aria-controls="v-pills-hki" aria-selected="false">
                            {{ __('HKI') }}
                        </button>
                        <button class="nav-link" id="v-pills-foto-tab" data-bs-toggle="pill" data-bs-target="#v-pills-foto" type="button" role="tab" aria-controls="v-pills-foto" aria-selected="false">
                            {{ __('Foto/Poster') }}
                        </button>
                        <button class="nav-link" id="v-pills-video-tab" data-bs-toggle="pill" data-bs-target="#v-pills-video" type="button" role="tab" aria-controls="v-pills-video" aria-selected="false">
                            {{ __('Video') }}
                        </button>
                    </div>
                    <div class="col-lg-10 tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-publikasi" role="tabpanel" aria-labelledby="v-pills-publikasi-tab">
                            @include('output.tambah-publikasi')
                        </div>
                        <div class="tab-pane fade" id="v-pills-hki" role="tabpanel" aria-labelledby="v-pills-hki-tab">
                            @include('output.tambah-hki')
                        </div>
                        <div class="tab-pane fade" id="v-pills-foto" role="tabpanel" aria-labelledby="v-pills-foto-tab">
                            @include('output.tambah-foto-poster')
                        </div>
                        <div class="tab-pane fade" id="v-pills-video" role="tabpanel" aria-labelledby="v-pills-video-tab">
                            @include('output.tambah-video')
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-12">
                    <div style="text-align: center;">
                        <ul style="list-style: none; padding-top:50px;">
                            <li style="font-weight: 400;font-size: 14px; text-align: left;color: black;">
                                {{ __('Reminder:') }} <br>
                                {{ __('Untuk seluruh member PUI-PT IS-IoT jangan lupa menggunakan affiliasi University Center of Excellence for Intelligent Sensing-IoT, Telkom University, Indonesia pada jurnal masing masing') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


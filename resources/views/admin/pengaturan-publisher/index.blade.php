@extends('layouts.app')

@section('content')

    <div class="title-wrapper pt-30">
        <div class="row align-items-top">

            @include('alert')

            <div class="col-md-5">

                <div class="title mb-30">
                    <h2>{{ __('Key') }}</h2>
                </div>

                <div class="card-styles" style="font-family: DM Sans">
                    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
                        <div class="card-content">

                            <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;">
                                <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahPublisherKey"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                                    {{ __('Tambahkan Data') }}
                                </button>
                            </div>

                            <div class="alert-box">
                                <div class="alert alert-info">
                                    <h4 class="alert-heading"><i class="lni lni-warning"></i> info</h4>
                                    <p class="text-medium">
                                        Untuk menghapus key, anda harus menghapus terlebih dahulu data di tabel relasi yang
                                        menggunakan key tersebut.
                                    </p>
                                </div>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table" id="dataTables2" style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                        <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                                                <h6>ID</h6>
                                            </th>
                                        <th style="border-bottom: 1px solid black; padding: 16px; text-align: left !important; width: 87%;">
                                                <h6>Key</h6>
                                            </th>
                                        <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publisher_key as $item)
                                            <tr>
                                                <td style="padding: 12px; text-align: center !important;">
                                                    <p>{{ $item->id }}</p>
                                                </td>
                                                <td style="padding: 12px; text-align: left !important;">
                                                    <p>{{ $item->name }}</p>
                                                </td>
                                                <td style="padding: 12px; text-align: center !important;">
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPublisherKey{{ $item->id }}">
                                                        <i class="lni lni-pencil" style="color: black;"></i>
                                                    </a>
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalDeletePublisherKey{{ $item->id }}">
                                                        <i class="lni lni-trash-can" style="color: red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">

                <div class="title mb-30">
                    <h2>{{ __('Publisher') }}</h2>
                </div>

                <div class="card-styles" style="font-family: DM Sans">
                    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
                        <div class="card-content">

                            <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;">
                                <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahPublisher"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                                    {{ __('Tambahkan Data') }}
                                </button>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table" id="dataTables" style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                                                <h6>ID</h6>
                                            </th>
                                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: left !important; width: 57%;">
                                                <h6>Key</h6>
                                            </th>
                                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 30%;">
                                                <h6>Tingkat Index</h6>
                                            </th>
                                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($publisher as $item)
                                            <tr>
                                                <td style="padding: 12px; text-align: center !important;">
                                                    <p>{{ $item->id }}</p>
                                                </td>
                                                <td style="padding: 12px; text-align: left !important;">
                                                    <p>{{ $item->publisherKey->name }}</p>
                                                </td>
                                                <td style="padding: 12px; text-align: center !important;">
                                                    <p>{{ $item->tingkat_index }}</p>
                                                </td>
                                                <td style="padding: 12px; text-align: center !important;">
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditPublisher{{ $item->id }}">
                                                        <i class="lni lni-pencil" style="color: black;"></i>
                                                    </a>
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalDeletePublisher{{ $item->id }}">
                                                        <i class="lni lni-trash-can" style="color: red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!-- end table row -->
                                    </tbody>
                                </table>
                                <!-- end table -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>

    <!-- ========== modal edit =========== -->
    @include('admin.pengaturan-publisher.modal-edit-publisher')
    @include('admin.pengaturan-publisher.modal-edit-publisher-key')
    <!-- ========== modal end =========== -->

    <!-- ========== modal tambah =========== -->
    @include('admin.pengaturan-publisher.modal-tambah-publisher')
    @include('admin.pengaturan-publisher.modal-tambah-publisher-key')
    <!-- ========== modal end =========== -->

    <!-- ========== modal delete =========== -->
    @include('admin.pengaturan-publisher.modal-delete-publisher')
    @include('admin.pengaturan-publisher.modal-delete-publisher-key')
    <!-- ========== modal end =========== -->
@endsection


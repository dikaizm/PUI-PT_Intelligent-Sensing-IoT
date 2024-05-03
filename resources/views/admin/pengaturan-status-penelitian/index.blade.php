@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
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
                                    data-bs-target="#modalTambah"
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
                                <table class="table striped-table" id="dataTables2">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">
                                                <h6>ID</h6>
                                            </th>
                                            <th class="text-center" style="width: 25%;">
                                                <h6>Key</h6>
                                            </th>
                                            <th class="text-center" style="width: 5%;">
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status_penelitian_key as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <p>{{ $item->id }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p>{{ $item->name }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditStatusPenelitianKey{{ $item->id }}">
                                                        <i class="lni lni-pencil" style="color: black;"></i>
                                                    </a>
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalDeleteStatusPenelitianKey{{ $item->id }}">
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
                    <h2>{{ __('Status Penelitian') }}</h2>
                </div>

                <div class="card-styles" style="font-family: DM Sans">
                    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
                        <div class="card-content">

                            <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;">
                                <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahStatusPenelitian"
                                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                                    {{ __('Tambahkan Data') }}
                                </button>
                            </div>
                            <div class="table-wrapper table-responsive">
                                <table class="table striped-table" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 5%;">
                                                <h6>ID</h6>
                                            </th>
                                            <th class="text-center" style="width: 25%;">
                                                <h6>Key</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th class="text-center" style="width: 5%;">
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($status_penelitian as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <p>{{ $item->id }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p>{{ $item->statusPenelitianKey->name }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $item->name }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditStatusPenelitian{{ $item->id }}">
                                                        <i class="lni lni-pencil" style="color: black;"></i>
                                                    </a>
                                                    <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalDeleteStatusPenelitian{{ $item->id }}">
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
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <!-- ========== modal edit =========== -->
    @include('admin.pengaturan-status-penelitian.modal-edit-status-penelitian-key')
    @include('admin.pengaturan-status-penelitian.modal-edit-status-penelitian')
    <!-- ========== modal end =========== -->

    <!-- ========== modal tambah =========== -->
    @include('admin.pengaturan-status-penelitian.modal-tambah-status-penelitian-key')
    @include('admin.pengaturan-status-penelitian.modal-tambah-status-penelitian')
    <!-- ========== modal end =========== -->

    <!-- ========== modal delete =========== -->
    @include('admin.pengaturan-status-penelitian.modal-delete-status-penelitian-key')
    @include('admin.pengaturan-status-penelitian.modal-delete-status-penelitian')
    <!-- ========== modal end =========== -->
@endsection


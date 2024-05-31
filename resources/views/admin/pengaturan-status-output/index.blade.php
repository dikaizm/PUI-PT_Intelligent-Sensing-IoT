@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Status Output') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles" style="font-family: DM Sans">
        <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
            <div class="card-content">

                @include('alert')

                <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;">
                    <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambah"
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
                                <th style="border-bottom: 1px solid black; padding: 16px; text-align: left !important; width: 87%;">
                                    <h6>Name</h6>
                                </th>
                                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                    <h6>Action</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status_output as $item)
                                <tr>
                                    <td style="padding: 12px; text-align: center !important;">
                                        <p>{{ $item->id }}</p>
                                    </td>
                                    <td style="padding: 12px; text-align: left !important;">
                                        <p>{{ $item->name }}</p>
                                    </td>
                                    <td style="padding: 12px; text-align: center !important;">
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                            <i class="lni lni-pencil" style="color: black;"></i>
                                        </a>
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete{{ $item->id }}">
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

    <!-- ========== modal edit =========== -->
    @include('admin.pengaturan-status-output.modal-edit')
    <!-- ========== modal end =========== -->

    <!-- ========== modal tambah =========== -->
    @include('admin.pengaturan-status-output.modal-tambah')
    <!-- ========== modal end =========== -->

    <!-- ========== modal delete =========== -->
    @include('admin.pengaturan-status-output.modal-delete')
    <!-- ========== modal end =========== -->
@endsection


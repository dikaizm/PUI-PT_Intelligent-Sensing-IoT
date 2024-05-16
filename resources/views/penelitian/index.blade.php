@extends('layouts.app')

@section('content')
<div class="card-styles">
    <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
        <div class="card-content">

            @include('alert')

            @can('mengelola-pengguna')
                <div class="menu-toggle-btn mr-20" style="text-align: right;">
                    <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalTambah"
                        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                        {{ __('Tambahkan Data') }}
                    </button>
                </div>
            @endcan

            <div class="table-wrapper table-responsive" style="font-family: DM Sans">
                <table class="table striped-table" id="dataTables" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                                <h6>No</h6>
                            </th>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 42%;">
                                <h6>Judul Penelitian</h6>
                            </th>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                <h6>Status</h6>
                            </th>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                <h6>Tgl Update</h6>
                            </th>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 28%;">
                                <h6>Feedback</h6>
                            </th>
                            <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 7%;">
                                <h6>Action</h6>
                            </th>
                        </tr>
                        <!-- end table row-->
                    </thead>
                    <tbody>
                        @foreach ($penelitian as $index => $item)
                            <tr>
                                <td style="padding: 12px; text-align: center !important;">
                                    <p>{{ $index + 1 }}</p>
                                </td>
                                <td style="padding: 12px; text-align: center !important;">
                                    <p>{{ $item->judul }}</p>
                                </td>
                                <td style="padding: 12px; text-align: center !important;">
                                    <p></p>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalStatus{{ $item->id }}" style="color: gray !important;">
                                        <span class="badge rounded-pill bg-{{ $item->statusPenelitian->warna }}">
                                            {{ $item->statusPenelitian->statusPenelitianKey->name }} {{ $item->statusPenelitian->name }}
                                        </span>
                                    </a>
                                </td>
                                <td style="padding: 12px; text-align: center !important;">
                                    <p>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}</p>
                                </td>
                                <td style="padding: 12px; text-align: center !important;">
                                    <a href="#" style="color: gray !important;">{{ $item->feedback }}</a>
                                </td>
                                <td style="padding: 8px; text-align: center !important;">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#{{ $item->judul }}">
                                        <i class="lni lni-magnifier" style="color: gray; margin:2px;"></i>
                                    </a>
                                    @can('mengelola-pengguna')
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#{{ $item->judul }}">
                                            <i class="lni lni-pencil" style="color: black; margin:2px;"></i>
                                        </a>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#{{ $item->judul }}">
                                            <i class="lni lni-trash-can" style="color: red; margin:2px;"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        <!-- end table row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ========== modal status =========== -->
@include('penelitian.modal-status')
<!-- ========== modal end =========== -->

<!-- ========== modal feedback =========== -->
@include('penelitian.modal-feedback')
<!-- ========== modal end =========== -->

@endsection

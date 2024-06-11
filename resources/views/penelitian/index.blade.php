@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-4">
                    <h2>{{ __('Penelitian') }}</h2>
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

                @include('alert')

                <div class="menu-toggle-btn mr-20" style="text-align: right;">
                    <a type="button "id="menu-toggle" class="main-btn btn-hover btn-md"
                        href="{{ route('penelitian.create') }}"
                        style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                        {{ __('Tambahkan Data') }}
                    </a>
                </div>

                <div class="table-wrapper table-responsive" style="font-family: DM Sans">
                    <table class="table striped-table" id="dataTables" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                                    <h6>No</h6>
                                </th>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 42%;">
                                    <h6>Judul Penelitian</h6>
                                </th>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                    <h6>Status</h6>
                                </th>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                    <h6>Tgl Update</h6>
                                </th>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 28%;">
                                    <h6>Feedback</h6>
                                </th>
                                <th
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 7%;">
                                    <h6>Action</h6>
                                </th>
                            </tr>
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
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalStatusPenelitian{{ $item->id }}"
                                            style="color: gray !important;">
                                            <span class="badge rounded-pill bg-{{ $item->statusPenelitian->warna }}">
                                                {{ $item->statusPenelitian->statusPenelitianKey->name }}
                                                {{ $item->statusPenelitian->name }}
                                            </span>
                                        </a>
                                    </td>
                                    <td style="padding: 12px; text-align: center !important;">
                                        <p>{{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y') }}</p>
                                    </td>
                                    <td style="padding: 12px; text-align: center !important;">
                                        @can('update-feedback')
                                            <a type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalFeedbackPenelitian{{ $item->id }}"
                                                style="color: gray !important;">
                                            @endcan
                                            {{ $item->feedback ? $item->feedback : 'Isi feedback' }}
                                            @can('update-feedback')
                                            </a>
                                        @endcan
                                    </td>
                                    <td style="padding: 8px; text-align: center !important;">
                                        <a type="button" href="{{ route('penelitian.show', ['uuid' => $item->uuid]) }}">
                                            <i class="lni lni-magnifier" style="color: gray; margin:2px;"></i>
                                        </a>
                                        @if (request()->query('arsip') != 'true')
                                            <a type="button"
                                                href="{{ route('penelitian.edit', ['uuid' => $item->uuid]) }}">
                                                <i class="lni lni-pencil" style="color: black; margin:2px;"></i>
                                            </a>
                                        @endif
                                        <a type="button" data-bs-toggle="modal"
                                            data-bs-target="#modalDeletePenelitian{{ $item->id }}">
                                            <i class="lni lni-trash-can" style="color: red; margin:2px;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== modal status =========== -->
    @include('penelitian.modal-status')
    <!-- ========== modal end =========== -->

    <!-- ========== modal detail =========== -->
    <!-- ========== modal end =========== -->

    <!-- ========== modal feedback =========== -->
    @include('penelitian.modal-feedback')
    <!-- ========== modal end =========== -->

    <!-- ========== modal delete =========== -->
    @include('penelitian.modal-delete')
    <!-- ========== modal end =========== -->
@endsection


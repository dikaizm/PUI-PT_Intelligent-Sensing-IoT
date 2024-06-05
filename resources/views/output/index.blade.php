@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-4">
                    <h2>{{ __('Output Penelitian') }}</h2>
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

            <div class="menu-toggle-btn pb-20" style="text-align: right;">
                <a type="button "id="menu-toggle" class="main-btn btn-hover btn-md"
                    href="#"
                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                    {{ __('Tambahkan Data') }}
                </a>
            </div>

            <div class="table-wrapper table-responsive" style="font-family: DM Sans">
                @php
                    $parentCounter = 1;
                @endphp

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Penelitian</td>
                            <td>Tgl Update</td>
                            <td>Feedback</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($output as $item)
                            <tr>
                                <td>{{ $parentCounter }}</td>
                                <td>{{ $item->penelitian->judul }}</td>
                                <td>{{ $item->penelitian->updated_at }}</td>
                                <td>{{ $item->penelitian->feedback }}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Output</td>
                                                <td>Judul Luaran</td>
                                                <td>Status Output</td>
                                                <td>Tautan</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $childCounter = 1;
                                            @endphp

                                            @foreach ($item->outputDetails as $detail)
                                                <tr>
                                                    <td>{{ $parentCounter }}.{{ $childCounter }}</td>
                                                    <td>{{ $detail->jenisOutput->jenisOutputKey->name }}</td>
                                                    <td>{{ $detail->judul }}</td>
                                                    <td>{{ $detail->statusOutput->name }}</td>
                                                    <td>{{ $detail->tautan }}</td>
                                                    <td>
                                                        <a type="button" data-bs-toggle="modal"
                                                        data-bs-target="#modalEditOutput{{ $item->id }}">
                                                            <i class="lni lni-pencil" style="color: black; margin:2px;"></i>
                                                        </a>
                                                        <a type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modalDeleteOutput{{ $item->id }}">
                                                            <i class="lni lni-trash-can" style="color: red; margin:2px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $childCounter++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @php
                                $parentCounter++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ========== modal delete =========== -->
    @include('output.modal-delete')
    <!-- ========== modal end =========== -->

@endsection

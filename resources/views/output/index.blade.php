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

                <div class="menu-toggle-btn mr-20 pb-20" style="text-align: right;">
                    <a type="button "id="menu-toggle" class="main-btn btn-hover btn-md"
                        href="{{ route('output-detail.create') }}"
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
                                <td
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                    No</td>
                                <td
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 30%;">
                                    Penelitian</td>
                                <td
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                    Tgl Update</td>
                                <td
                                    style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 60%;">
                                    Feedback</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($output as $item)
                                <tr>
                                    <td style="padding: 12px; text-align: center !important;"> {{ $parentCounter }}</td>
                                    <td style="padding: 12px; text-align: center !important;">{{ $item->penelitian->judul }}
                                    </td>
                                    <td style="padding: 12px; text-align: center !important;">
                                        {{ \Carbon\Carbon::parse($item->penelitian->updated_at)->format('d/m/Y') }}</td>
                                    <td style="padding: 12px; text-align: center !important;">
                                        {{ $item->penelitian->feedback }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <table class="table mb-0 striped-table">
                                            <thead>
                                                <tr>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 5%;">
                                                        No</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 15%;">
                                                        Output</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 45%;">
                                                        Judul Luaran</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 15%;">
                                                        Status Output</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 15%;">
                                                        Tanggal Publish / Granted</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 5%;">
                                                        Tautan</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 5%;">
                                                        File</td>
                                                    <td
                                                        style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                                                        Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $childCounter = 1;
                                                @endphp

                                                @foreach ($item->outputDetails as $detail)
                                                    <tr>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            {{ $parentCounter }}.{{ $childCounter }}</td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            {{ $detail->jenisOutput->jenisOutputKey->name }}</td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            {{ $detail->judul }}</td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            {{ $detail->statusOutput->name }}</td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            {{ $detail->published_at ? $detail->published_at : '' }}</td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            @if ($detail->tautan)
                                                                <a href="{{ $detail->tautan }}" target="_blank">
                                                                    <i class="lni lni-link"
                                                                        style="color: gray; margin: 2px;"></i>
                                                                </a>
                                                            @endif
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            @if ($detail->file)
                                                                <a href="{{ asset('storage/' . $detail->file) }}"
                                                                    target="_blank">
                                                                    <i class="lni lni-download"
                                                                        style="color: gray; margin: 2px;"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td style="padding: 12px; text-align: center !important;">
                                                            <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modalEdit{{ $detail->jenisOutput->jenisOutputKey->name }}{{ $detail->id }}">
                                                                <i class="lni lni-pencil" style="color: black;"></i>
                                                            </a>
                                                            <a type="button" data-bs-toggle="modal"
                                                                data-bs-target="#modalDelete{{ $detail->id }}">
                                                                <i class="lni lni-trash-can" style="color: red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @include('output.modal-edit.publikasi')
                                                    @include('output.modal-edit.hki')
                                                    @include('output.modal-edit.foto-poster')
                                                    @include('output.modal-edit.video')
                                                    @include('output.modal-delete')
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
                    {{ $output->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.app')

@section('content')
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
                                        <td>detail, edit, hapus</td>
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
@endsection

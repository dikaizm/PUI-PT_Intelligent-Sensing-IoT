@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Jenis Dokumen') }}</h2>
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
                <div class="table-wrapper table-responsive" style="font-family: DM Sans">
                    <table class="table" id="dataTables2">
                        <thead>
                            <tr>
                                <th scope="col">Tautan</th>
                                <th scope="col">Key</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($register_keys as $reg)
                                <tr>
                                    <th scope="row">{{ url('/register?key=' . $reg->key) }}</th>
                                    <td>{{ $reg->key }}</td>

                                    <td>
                                        <a type="button">salin</a>
                                        <a type="button" href="{{ route('register-key.new-key', ['id' => $reg->id]) }}">New
                                            Key</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

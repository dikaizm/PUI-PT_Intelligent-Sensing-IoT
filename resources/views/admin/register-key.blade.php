@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Register Key') }}</h2>
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
                                    <th scope="row" id="link-{{ $reg->id }}">{{ url('/register?key=' . $reg->key) }}</th>
                                    <td id="copyKey-{{ $reg->id }}">{{ $reg->key }}</td>
                                    <td>
                                        <a type="button" href="#" onclick="copyToClipboard('link-{{ $reg->id }}')">Salin Link</a> <br>
                                        <a type="button" href="#" onclick="copyToClipboard('copyKey-{{ $reg->id }}')">Salin Key</a> <br>
                                        <a class="pb-20" type="button" href="{{ route('register-key.new-key', ['id' => $reg->id]) }}">New Key</a>
                                    </td>
                                </tr>

                                <script>
                                function copyToClipboard(elementId) {
                                    // Create a temporary input element
                                    var tempInput = document.createElement('input');
                                    // Get the text content of the specified element
                                    var text = document.getElementById(elementId).textContent;
                                    // Set the input value to the text content
                                    tempInput.value = text;
                                    // Append the input element to the body
                                    document.body.appendChild(tempInput);
                                    // Select the input element content
                                    tempInput.select();
                                    // Execute the copy command
                                    document.execCommand('copy');
                                    // Remove the temporary input element
                                    document.body.removeChild(tempInput);
                                    // Alert the user that the text has been copied
                                    alert('Text copied to clipboard: ' + text);
                                }
                                </script>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

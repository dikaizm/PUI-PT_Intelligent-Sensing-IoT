@extends('layouts.app')

@section('content')
    @foreach ($output as $item)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>head</td>
                </tr>

            </thead>
            <tbody>
                ...
                <tr>
                    <td colspan="4">
                        <table class="table mb-0">
                            ...
                        </table>
                    </td>
                </tr>
                ...
            </tbody>
        </table>
    @endforeach
@endsection

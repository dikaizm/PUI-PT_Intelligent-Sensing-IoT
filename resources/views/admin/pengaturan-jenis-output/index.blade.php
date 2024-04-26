@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Jenis Output') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="card-styles"  style="font-family: DM Sans">
        <div class="card-style-3 mb-30" style="border-radius: 20px;border: 2px solid #000;">
            <div class="card-content">

                @session('success')
                <div class="alert-box success-alert">
                    <div class="alert">
                        <h4 class="alert-heading">Success</h4>
                        <p class="text-medium">
                            {{ $value }}
                        </p>
                    </div>
                </div>
                @endsession

                <div class="menu-toggle-btn mr-20 mb-3" style="text-align: right;" >
                    <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                        {{ __('Tambahkan Data') }}
                    </button>
                </div>
                <div class="table-wrapper table-responsive">
                    <table class="table striped-table" id="dataTables">
                        <thead>
                            <tr>
                                <th>
                                    <h6>ID</h6>
                                </th>
                                <th>
                                    <h6>Name</h6>
                                </th>
                                <th style="width: 20%;">
                                    <h6>Action</h6>
                                </th>
                            </tr>
                            <!-- end table row-->

    <!-- end table row-->
                        </thead>
                        {{-- <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <p>{{ $user->name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $user->nip }}</p>
                                    </td>
                                    <td>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="lni lni-pencil" style="color: black;"></i>
                                        </a>
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                            <i class="lni lni-trash-can" style="color: red;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- end table row -->
                        </tbody> --}}
                    </table>
                    <!-- end table -->

                    {{-- Modal --}}

                    {{-- {{ $users->links() }} --}}
                </div>

            </div>
        </div>
    </div>

    <!-- ========== modal edit =========== -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="name" placeholder="{{ __('Name') }}"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="action d-flex flex-wrap justify-content-end">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-dismiss="modal">
                                        {{ __('Add') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1" style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);" data-bs-dismiss="modal">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== modal end =========== -->

    <!-- ========== modal tambah =========== -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label for="name">{{ __('Nama') }}</label>
                                        <input type="text" @error('name') class="form-control is-invalid" @enderror
                                            name="name" id="name" placeholder="{{ __('Nama') }}"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="action d-flex flex-wrap justify-content-end">
                                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover m-1" style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%);" data-bs-dismiss="modal">
                                        {{ __('Save') }}
                                    </button>
                                    <button type="button" class="main-btn btn-sm danger-btn btn-hover m-1" style="background: linear-gradient(180deg, #DE0F0F 0%, #780808 100%);" data-bs-dismiss="modal">
                                        {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== modal end =========== -->

    <!-- ========== modal delete =========== -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="ModalFourLabel" aria-hidden="true">
        <div class="modal-dialog" style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
            <div class="modal-content card-style">
                <div class="modal-header px-0 border-0">
                    <h5 class="modal-title" id="ModalFourLabel">
                        <i class="lni lni-warning text-danger me-2"></i> {{ __('Delete') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-0">
                    <div class="content mb-30">
                        <p class="text-sm">
                            {{ __('Are you sure you want to delete it?') }}
                        </p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-end">
                        <button type="button" class="main-btn btn-sm primary-btn btn-hover m-1" data-bs-dismiss="modal">
                            Delete
                        </button>
                        <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ========== modal end =========== -->


@endsection


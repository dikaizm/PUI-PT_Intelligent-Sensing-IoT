@extends('layouts.app')

@section('content')
  <!-- ========== modal detail =========== -->
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title mb-30">
          <h2>{{ __('Detail Penelitian') }}</h2>
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

        <div class="row g-0 auth-row" style="color: black; font-weight: 400; line-height: 35px;">

          @include('alert')

          @if ($penelitian != null)
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left: 5%; text-align: left;">
                  <li style="font-weight: 500; font-size: 25px; text-align: left;">
                    {{ __('Skema Penelitian') }}
                  </li>
                  <li style="font-weight: 400; font-size: 18px; text-align: left;">
                    {{ $penelitian->skema->name }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Judul Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->judul }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Ketua Tim') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $is_ketua ? App\Models\User::find($is_ketua)->name : 'Belum ada ketua' }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Anggota Tim') }}
                  </li>
                  @foreach ($penelitian->users as $anggota)
                    <li style="font-weight: 400;font-size: 18px; text-align: left;">
                      {{ $anggota->name }}
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Status Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->statusPenelitian->name }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Mitra Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    @if (!empty($penelitian->mitra))
                      {{ $penelitian->mitra }}
                    @else
                      {{ __('Belum ada mitra') }}
                    @endif
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Penelitian dimulai') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->waktu_mulai }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Penelitian selesai') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    @if (!empty($penelitian->waktu_akhir))
                      {{ $penelitian->waktu_akhir }}
                    @else
                      {{ __('Tanggal belum ditentukan') }}
                    @endif
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Jangka Waktu Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->jangka_waktu . ' Bulan' }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Jenis Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->jenisPenelitian->name }}
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Pendanaan') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ 'Rp' . $penelitian->pendanaan }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Tingkatan TKT') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->tingkatan_tkt }}
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-12 row g-1">
              <div style="text-align: left; width: 100%;">
                <ul style="list-style: none; padding-left:5%;">
                  <li style="font-weight: 500;font-size: 25px; text-align: left;">
                    {{ __('Link Penelitian') }}
                  </li>
                  <li style="font-weight: 400;font-size: 18px; text-align: left;">
                    {{ $penelitian->link_penelitian }}
                  </li>
                </ul>
              </div>
            </div>

            {{-- <div class="col-12 row g-1">
            <div style="text-align: left; width: 100%;">
              <ul style="list-style: none; padding-left:5%;">
                <li style="font-weight: 500;font-size: 25px; text-align: left;">
                  {{ __('File Penelitian') }}
                </li>
                <li style="font-weight: 400;font-size: 18px; text-align: left;">
                  <a href="{{ asset('storage/' . $penelitian->file) }}" target="_blank">Download</a>
                </li>
              </ul>
            </div>
          </div> --}}

            @can('is-kaur')
              {{-- No show --}}
            @else
              <div class="menu-toggle-btn mr-20" style="text-align: right;">
                @if (!$penelitian->arsip)
                  <a type="button "id="menu-toggle" class="main-btn btn-hover btn-md"
                    href="{{ route('penelitian.edit', ['uuid' => $penelitian->uuid]) }}"
                    style="background: linear-gradient(180deg, #DDCE49 0%, #776F27 100%);color:white;">
                    {{ __('Edit Penelitian') }}
                  </a>
                @endif

                <a type="button" data-bs-toggle="modal" data-bs-target="#modalDeletePenelitian"
                  class="main-btn btn-hover btn-md"style="background: linear-gradient(180deg, #DE210F 0%, #781208 100%); color:white;">
                  {{ __('Hapus Penelitian') }}
                </a>
                <div class="modal fade" id="modalDeletePenelitian" tabindex="-1" aria-labelledby="ModalFourLabel"
                  aria-hidden="true">
                  <div class="modal-dialog"
                    style="min-height: 100vh;display: flex !important;align-items: center;justify-content: center;">
                    <div class="modal-content card-style">
                      <div class="modal-header border-0 px-0">
                        <h5 class="modal-title" id="ModalDeleteLabel">
                          <i class="lni lni-warning text-danger me-2"></i> {{ __('Delete') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body px-0">
                        <div class="content mb-30">
                          <p class="text-sm">
                            {{ __('Are you sure you want to delete ' . $penelitian->judul . '?') }}
                          </p>
                        </div>
                        <div class="action d-flex justify-content-end flex-wrap">
                          <form action="{{ route('penelitian.destroy', ['uuid' => $penelitian->uuid]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="main-btn btn-sm danger-btn btn-hover m-1">
                              Delete
                            </button>
                          </form>
                          <button type="button" class="main-btn btn-sm danger-btn-outline btn-hover m-1"
                            data-bs-dismiss="modal">
                            Cancel
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @if (!$penelitian->arsip)
                  <a type="button" id="menu-toggle" class="main-btn btn-hover btn-md"
                    href="{{ route('output-detail.create-from-penelitian', ['uuid' => $penelitian->uuid, 'judul' => $penelitian->judul]) }}"
                    style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
                    {{ __('Laporkan Output') }}
                  </a>
                @endif

              </div>
            @endcan
          @endif

          <h2 class="mt-5" style="color:gray;">{{ __('Output Penelitian') }}</h2>

          <table class="striped-table table-responsive table" id="dataTables"
            style="width: 100%; border-collapse: collapse;">
            <thead>
              <tr>
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                  <h6>Jenis Output</h6>
                </th>
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 42%;">
                  <h6>Judul Luaran</h6>
                </th>
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  <h6>Status Output</h6>
                </th>
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  <h6>Tanggal Publish / Granted</h6>
                </th>
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  <h6>Tautan</h6>
                </th>
                {{-- <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  <h6>File</h6>
                </th> --}}
                <th style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 28%;">
                  <h6>Action</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              @if ($output)
                @foreach ($output as $item)
                  <tr>
                    <td style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 3%;">
                      <h6>{{ $item->jenisOutput->jenisOutputKey->name }}
                        {{ $item->jenisOutput->name }}
                        @if ($item->jenisOutput->jenisOutputKey->name == 'Publikasi')
                          {{ $item->tipe }}
                        @endif
                      </h6>
                    </td>
                    <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 42%;">
                      <h6>{{ $item->judul }}</h6>
                    </td>
                    <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                      <h6>{{ $item->statusOutput->name }}</h6>
                    </td>
                    <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                      {{ $item->published_at ? $item->published_at : '' }}</td>
                    <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                      <h6><a href="{{ $item->tautan }}" target="_blank" class="btn btn-md"><i class="lni lni-link"
                            style="color: gray; margin:2px;"></i></a>
                      </h6>
                    </td>
                    {{-- <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                      <h6>
                        @if ($item->file)
                          <a href="{{ asset('storage/' . $item->file) }}" target="_blank">
                            <i class="lni lni-download" style="color: gray; margin: 2px;"></i>
                          </a>
                        @endif
                      </h6>
                    </td> --}}

                    <td
                      style="border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 28%;">

                      @if (request()->query('arsip') != 'true')
                      @php
                      // Find the related jenis output
                      $jenisOutput = $jenis_output->firstWhere('id', $item->jenis_output_id);
                      // Initialize the output key name
                      $jenisOutputKeyName = null;

                      if ($jenisOutput) {
                          // Find the related jenis output key
                          $jenisOutputKey = $jenis_output_key->firstWhere('id', $jenisOutput->jenis_output_key_id);

                          if ($jenisOutputKey && $jenisOutputKey->name === 'Foto/Poster') {
                              $jenisOutputKeyName = 'foto-poster';
                          } elseif ($jenisOutputKey) {
                              $jenisOutputKeyName = strtolower($jenisOutputKey->name);
                          }
                      }
                    @endphp

                        <a type="button" href="{{ route('output-detail.edit', ['id' => $item->id, 'output_type' => $jenisOutputKeyName]) }}">
                          <i class="lni lni-pencil" style="color: black;"></i>
                        </a>
                      @endif

                      <a type="button" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">
                        <i class="lni lni-trash-can" style="color: red;"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @include('penelitian.modal-edit-output.delete')
  {{-- @include('penelitian.modal-edit-output.foto-poster')
  @include('penelitian.modal-edit-output.hki')
  @include('penelitian.modal-edit-output.publikasi')
  @include('penelitian.modal-edit-output.video') --}}

@endsection

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

        @can('is-kaur')
          {{-- Hide button --}}
        @else
          <div class="menu-toggle-btn mr-20 pb-20" style="text-align: right;">
            <a type="button "id="menu-toggle" class="main-btn btn-hover btn-md" href="{{ route('output-detail.create') }}"
              style="background: linear-gradient(180deg, #0A4714 0%, #1BB834 100%); color:white;">
              {{ __('Tambahkan Data') }}
            </a>
          </div>
        @endcan

        <div class="table-wrapper table-responsive" style="font-family: DM Sans">
          @php
            $parentCounter = 1;
          @endphp

          <table id="dataTables_output" class="table-striped table-bordered table">
            <thead>
              <tr>
                <td
                  style="border-left: none; border-top: none; border-right: none; border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  No
                </td>
                <td
                  style="border-left: none; border-top: none; border-right: none; border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 30%;">
                  Penelitian
                </td>
                <td
                  style="border-left: none; border-top: none; border-right: none; border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 10%;">
                  Tgl Update
                </td>
                <td
                  style="border-left: none; border-top: none; border-right: none; border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 40%;">
                  Feedback
                </td>

                <td
                  style="border-left: none; border-top: none; border-right: none; border-bottom: 1px solid black; padding: 16px; text-align: center !important; width: 20%;">
                  Action
                </td>
              </tr>
            </thead>

            <tbody>
              @foreach ($output as $index => $item)
                <tr>
                  <td
                    style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: center !important;">
                    {{ $index + 1 }}
                  </td>
                  <td
                    style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: left !important;">
                    {{ $item->penelitian->judul }}
                  </td>
                  <td
                    style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: center !important;">
                    {{ \Carbon\Carbon::parse($item->penelitian->updated_at)->format('d/m/Y') }}
                  </td>

                  {{-- Tambah feedback admin only --}}
                  <td style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: center !important;">
                    @can('update-feedback')
                      <a type="button" {{-- class="badge badge-info"  --}} data-bs-toggle="modal"
                        data-bs-target="#modalFeedbackPenelitian{{ $item->penelitian->id }}" style="color: gray !important;">
                      @endcan
                      {{ $item->penelitian->feedback ? $item->penelitian->feedback : 'Isi feedback' }}
                      @can('update-feedback')
                      </a>
                    @endcan
                  </td>

                  {{-- Tombol tambah output penelitian --}}
                  <td
                    style="border-left: none; border-top: none; border-right: none; padding: 12px; text-align: center !important;">
                    <div class="d-flex justify-content-between gap-1 px-2">
                      {{-- Tombol tambah --}}
                      <a class="btn btn-success rounded-circle" type="button" id="menu-toggle"
                        href="{{ route('output-detail.create-from-penelitian', ['uuid' => $item->penelitian->uuid, 'judul' => $item->penelitian->judul]) }}">
                        <i class="fas fa-plus" style="color: white;"></i>
                      </a>

                      {{-- Tombol slidedown output --}}
                      <button type="button" id="btn_output_detail_{{ $item->penelitian->uuid }}"
                        class="btn btn-secondary rounded-circle" data-penelitian-id={{ $item->penelitian->uuid }}>
                        <i class="fas fa-caret-down icon-detail-caret" style="color: white;"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                {{-- @php
                  $parentCounter++;
                @endphp --}}
              @endforeach
            </tbody>
          </table>
          {{-- {{ $output->links() }} --}}
        </div>
      </div>
    </div>
  </div>
  @include('output.modal-feedback')
@endsection

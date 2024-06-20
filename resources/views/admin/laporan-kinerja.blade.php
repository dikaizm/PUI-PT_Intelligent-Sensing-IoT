@extends('layouts.app')

@section('content')
  <!-- ========== title-wrapper start ========== -->
  <div class="title-wrapper pt-30">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="title mb-4">
          <h2>{{ __('Laporan Kinerja') }}</h2>
        </div>
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- ========== title-wrapper end ========== -->

  <div class="row pt-3">
    <!-- Left Column: 2 col-2 cards stacked vertically -->
    <div class="col-xl-2 col-lg-2 col-sm-12 d-flex flex-column">
      <div class="menu-toggle-btn" style="text-align: center;">
        <button id="menu-toggle" class="main-btn btn-hover btn-sm" data-bs-toggle="modal"
          data-bs-target="#modalFilterLaporanKinerja"
          style="background: linear-gradient(0deg, #DE0F0F 0%, #780808 100%); color:white;width:100%;">
          {{ __('Filter') }}
        </button>
      </div>
      <div class="icon-card mt-15 mb-15 d-flex flex-column align-items-center justify-content-center"
        style="height: 100%;">
        <div class="content" style="text-align: center;">
          <h6 class="mb-10">{{ __('Jumlah Penelitian') }}</h6>
          <h3 class="text-bold mb-10">{{ $jumlah_penelitian }}</h3>
          @if ($difference_jumlah_penelitian >= 0)
            <p class="text-success text-sm">
              <i class="lni lni-arrow-up"></i> +{{ $difference_jumlah_penelitian }}
            </p>
          @else
            <p class="text-danger text-sm">
              <i class="lni lni-arrow-down"></i>{{ $difference_jumlah_penelitian }}
            </p>
          @endif
        </div>
      </div>
      <!-- End Icon Cart -->
      <div class="icon-card mb-30 d-flex flex-column align-items-center justify-content-center" style="height: 100%;">
        <div class="content" style="text-align: center;">
          <h6 class="mb-10">{{ __('Jumlah Output') }}</h6>
          <h3 class="text-bold mb-10">{{ $jumlah_output }}</h3>
          @if ($difference_jumlah_output >= 0)
            <p class="text-success text-sm">
              <i class="lni lni-arrow-up"></i> +{{ $difference_jumlah_output }}
            </p>
          @else
            <p class="text-danger text-sm">
              <i class="lni lni-arrow-down"></i>{{ $difference_jumlah_output }}
            </p>
          @endif
        </div>
      </div>
      <!-- End Icon Cart -->
    </div>
    <!-- End Left Column -->
    <!-- End  Row -->

    <!-- Right Column: 2 col-5 charts stacked vertically -->
    <div class="col-xl-10 col-lg-10 col-sm-12">
      <div class="row">
        <div class="col-6">
          <div class="icon-card mb-30" style="display: flex; flex-direction: column; align-items: center;">
            <div class="title" style="margin-bottom: 10px; text-align: center;">
              {{ __('Status Penelitian') }}
            </div>
            <div style="width: 100%; height: 100%;">
              <canvas id="donatPenelitian"></canvas>
            </div>
          </div>
        </div>
        <!-- End First Chart -->

        <div class="col-6">
          <div class="icon-card mb-30" style="display: flex; flex-direction: column; align-items: center;">
            <div class="title" style="margin-bottom: 10px; text-align: center;">
              {{ __('Jenis Output') }}
            </div>
            <div style="width: 100%; height: 100%;">
              <canvas id="donatOutput"></canvas>
            </div>
          </div>
        </div>
        <!-- End Second Chart -->
      </div>
    </div>
    <!-- End Right Column -->

  </div>

  <div class="row">
    <!-- End Col -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
      <div class="card-style mb-30">
        <div style="text-align: center">
          {{ __('Jumlah Output Per Kategori Tahun [1] dan [2]') }}
        </div>
        <div class="card-body">
          <canvas id="barchartOutput"></canvas>
        </div>
      </div>
    </div>
    <!-- End Col -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
      <div class="card-style mb-30">
        <div style="text-align: center">
          {{ __('Jumlah Penelitian dan Target Tahun [1] dan [2]') }}
        </div>
        <div class="card-body">
          <canvas id="barchartPenelitian"></canvas>
        </div>
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End  Row -->

  <div class="row">
    <!-- End Col -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
      <div class="card-style mb-30">
        <div style="text-align: center">
          {{ __('Penelitian Triwulan Tahun [1] dan [2]') }}
        </div>
        <div class="card-body">
          <canvas id="barchartPenelitianTriwulan"></canvas>
        </div>
      </div>
    </div>
    <!-- End Col -->
    <div class="col-xl-6 col-lg-6 col-sm-12">
      <div class="card-style mb-30">
        <div style="text-align: center">
          {{ __('Output Triwulan Tahun [1] dan [2]') }}
        </div>
        <div class="card-body">
          <canvas id="barchartOutputTriwulan"></canvas>
        </div>
      </div>
    </div>
    <!-- End Col -->
  </div>
  <!-- End  Row -->
@endsection

@include('admin.modal-filter-laporan-kinerja')

<script>
  window.statusCountsPenelitian = {!! $status_counts_penelitian !!};
  window.statusCountsOutput = {!! $status_counts_output !!};
  window.statusCountsOutputAwal = {!! $status_counts_output_awal !!};
  window.statusCountsOutputAkhir = {!! $status_counts_output_akhir !!};
  window.targetPenelitian = {!! $target_penelitian !!};
  var tahunAwal = '{{ $tahun_awal }}';
  var tahunAkhir = '{{ $tahun_akhir }}';
  var penelitianTahunAwal = {{ $penelitian_tahun_awal }};
  var penelitianTahunAkhir = {{ $penelitian_tahun_akhir }};

  window.penelitianAwalQrt = {!! $penelitian_awal_qrt !!};
  window.penelitianAkhirQrt = {!! $penelitian_akhir_qrt !!};

  window.outputAwalQrt = {!! $output_awal_qrt !!};
  window.outputAkhirQrt = {!! $output_akhir_qrt !!};
</script>

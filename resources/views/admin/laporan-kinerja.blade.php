@extends('layouts.app')

@section('content')

    <div class="row pt-30">
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon purple">
              <i class="lni lni-users"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Jumlah Penelitian</h6>
              <h3 class="text-bold mb-10">69</h3>
              <p class="text-sm text-success">
                <i class="lni lni-arrow-up"></i> +7
              </p>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon success">
              <i class="lni lni-eye"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Jumlah Publikasi</h6>
              <h3 class="text-bold mb-10">19</h3>
              <p class="text-sm text-danger">
                <i class="lni lni-arrow-down"></i> -2
              </p>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon primary">
              <i class="lni lni-thumbs-up"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Jumlah Anggota</h6>
              <h3 class="text-bold mb-10">420</h3>
              <p class="text-sm text-danger">
                <i class="lni lni-arrow-down"></i> -2
              </p>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon orange">
              <i class="lni lni-pie-chart"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Penelitian Aktif</h6>
              <h3 class="text-bold mb-10">14</h3>
              <p class="text-sm text-success">
                <i class="lni lni-arrow-up"></i> +20
              </p>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
      </div>

      <div class="row">
        <div class="col-lg-5">
            <div class="card-style mb-30">
                <div class="title d-flex justify-content-between">
                  <div class="left">
                    <h6 class="text-medium mb-20">Target Penelitian dan Publikasi 2024</h6>
                  </div>
                </div>
                <!-- End Title-->
                <div class="chart">
                  <canvas id="stackedBar1" style="width: 320px; height: 300px; display: block; box-sizing: border-box;" width="640" height="600"></canvas>
                </div>
                <!-- End Chart -->
              </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-7">
          <div class="card-style mb-30">
            <div class="title d-flex flex-wrap align-items-center justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-2">Target Penelitian dan Publikasi 2024</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart">
              <div id="legend3">
                <ul class="legend3 d-flex align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color primary-bg"> </span>
                      <div class="text">
                        <p class="text-sm text-dark">Penelitian</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color purple-bg"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Publikasi</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <canvas id="Chart3" style="width: 355px; height: 271px; margin-left: -35px; display: block; box-sizing: border-box;" width="710" height="542"></canvas>
            </div>
          </div>
        </div>
        <!-- End Col -->
      </div>

@endsection

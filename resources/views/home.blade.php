@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>{{ __('Dashboard') }}</h2>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="icon-card mb-30">
            <div class="icon purple">
              <i class="lni lni-users"></i>
            </div>
            <div class="content">
              <h6 class="mb-10">Users</h6>
              <h3 class="text-bold mb-10">6453</h3>
              <p class="text-sm text-success">
                <i class="lni lni-arrow-up"></i> +23.4%
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
              <h6 class="mb-10">Page views</h6>
              <h3 class="text-bold mb-10">876</h3>
              <p class="text-sm text-danger">
                <i class="lni lni-arrow-down"></i> -12.00%
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
              <h6 class="mb-10">Impressions</h6>
              <h3 class="text-bold mb-10">976</h3>
              <p class="text-sm text-danger">
                <i class="lni lni-arrow-down"></i> -2.00%
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
              <h6 class="mb-10">Bounce Rate</h6>
              <h3 class="text-bold mb-10">346</h3>
              <p class="text-sm text-success">
                <i class="lni lni-arrow-up"></i> +23.4%
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
                <h6 class="text-medium mb-2">Audience Overview</h6>
              </div>
            </div>
            <!-- End Title -->
            <div class="chart">
              <div id="legend4">
                <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                  <li>
                    <div class="d-flex">
                      <span class="bg-color primary-bg"> </span>
                      <div class="text">
                        <p class="text-sm text-success">
                          <span class="text-dark">New Visitor</span>
                          +25.55%
                          <i class="lni lni-arrow-up"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color danger-bg"></span>
                      <div class="text">
                        <p class="text-sm text-success">
                          <span class="text-dark">Unique Visitor</span>
                          -2.05%
                          <i class="lni lni-arrow-up"></i>
                        </p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <canvas id="Chart4" style="width: 355px; height: 426px; margin-left: -35px; display: block; box-sizing: border-box;" width="710" height="852"></canvas>
            </div>
            <!-- End Chart -->
          </div>
        </div>
        <!-- End Col -->
        <div class="col-lg-7">
          <div class="card-style mb-30">
            <div class="title d-flex flex-wrap align-items-center justify-content-between">
              <div class="left">
                <h6 class="text-medium mb-2">Web Traffic</h6>
              </div>
              <div class="right">
                <div class="select-style-1 mb-2">
                  <div class="select-position select-sm">
                    <select class="light-bg">
                      <option value="">Last Month</option>
                      <option value="">Last 3 Months</option>
                      <option value="">Last Year</option>
                    </select>
                  </div>
                </div>
                <!-- end select -->
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
                        <p class="text-sm text-dark">Store Visits</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex">
                      <span class="bg-color purple-bg"></span>
                      <div class="text">
                        <p class="text-sm text-dark">Visitors</p>
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

@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h1 style="font-family: DM Sans; font-size: 40px; font-weight: 700; line-height: 52.08px; text-align: left;">
                        {{ __('Selamat Datang di,') }}
                    </h1>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->

    <h2 style="font-family: DM Sans; font-size: 20px; font-weight: 500; line-height: 26.04px; text-align: left;">
        Aplikasi Monitoring Kolaborasi dan Penelitian Pusat Unggulan IPTEK Perguruan Tinggi Intelligence Sensing IoT.
    </h2>
    <h3 style="font-family: DM Sans; font-size: 24px; font-weight: 700; line-height: 31.25px; text-align: center; color: #6A0808; line-height: 3;">
        About PUI-PT
    </h3>
    <h4 style="font-size: 12px; text-align: center;">
        <span style="font-family: DM Sans; font-size: 16px; font-weight: 500; line-height: 20.83px; letter-spacing: 0.02em; text-align: center;">
            Teknologi Penginderaan Cerdas, Membentuk Masa Depan!
        </span>
        <span style="font-family: DM Sans;font-size: 14px;font-weight: 400;line-height: 18.23px;letter-spacing: 0.02em;text-align: center;">
            PUI-PT Intelligent Sensing-IoT Universitas Telkom merupakan pusat unggulan inovasi dan IPTEK di bidang Intelligent Sensing, yaitu teknologi yang mengumpulkan data dari berbagai fenomena fisik dan mengolahnya menjadi informasi yang penting dan akurat. Teknologi ini melibatkan sensor, pengumpul data seperti Wireless Sensor Network (WSN) dan Internet of Things (IoT), serta teknologi pengolah cerdas seperti Artificial Intelligence (AI).  Sistem informasi seperti aplikasi dashboard monitoring dan Decision Support System (DSS) juga turut mendukung proses ini.
            <br>Kami memiliki empat basis kompetensi, termasuk pengembangan perangkat sensor, platform pengumpul data, pengolah cerdas, dan sistem informasi yang bertujuan untuk berkontribusi pada  dimensi keberlanjutan: ekonomi, lingkungan, sosial dan manusia.
        </span>
    </h4>
    <h3 style="font-family: DM Sans; font-size: 24px; font-weight: 700; line-height: 31.25px; text-align: center; color: #6A0808; line-height: 3;">
        Our Activity
    </h3>
    <h4 style="font-family: DM Sans;font-size: 13px;font-weight: 500;line-height: 16.93px;letter-spacing: 0.02em;text-align: center;">
        Dari riset inovatif hingga kolaborasi industri, setiap aktivitas yang kami lakukan diarahkan untuk mendorong kemajuan dalam teknologi Intelligent Sensing dan IoT. Kami mengundang Anda untuk mengeksplorasi dan menemukan bagaimana kami, melalui upaya berkelanjutan dan dedikasi, berkontribusi dalam membentuk sebuah masa depan yang lebih terhubung, cerdas, dan berkelanjutan.
    </h4>
    <span style="white-space:normal;"></span>

    <div class="row">
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); height: 100%; width: 100%;">
                <div class="content" style="height: 80%; width: 100%;">
              <h4 class="mb-10" style="color: white; font-family: DM Sans;font-size: 20px;font-weight: 500;line-height: 26.04px;text-align: center;">
                Riset dan Publikasi
              </h4>
              <h5 class="text-bold mb-10" style="color: white; font-family: DM Sans;font-size: 13px;font-weight: 400;line-height: 16.93px;text-align: center;">
                PUI-PT IS-IoT berfokus pada riset di IoT dan Intelligent Sensing, mendorong inovasi melalui publikasi di jurnal dan konferensi terkemuka, memperkuat visi kami untuk masa depan berkelanjutan.
              </h5>
            </div>
          </div>
          <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); height: 100%; width: 100%;">
                <div class="content" style="height: 80%; width: 100%;">
                    <h4 class="mb-10" style="color: white; font-family: DM Sans;font-size: 20px;font-weight: 500;line-height: 26.04px;text-align: center;">
                        MBKM dan Magang
                    </h4>
                    <h5 class="text-bold mb-10" style="color: white; font-family: DM Sans;font-size: 13px;font-weight: 400;line-height: 16.93px;text-align: center;">
                        PUI-PT IS-IoT menawarkan program MBKM dan magang yang kaya pengalaman, menghubungkan mahasiswa dengan proyek nyata di IoT, memperkaya pembelajaran mereka melalui praktik industri dan penelitian terapan.
                    </h5>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
        <!-- End Col -->
        <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); height: 100%; width: 100%;">
                <div class="content" style="height: 80%; width: 100%;">
                    <h4 class="mb-10" style="color: white; font-family: DM Sans;font-size: 20px;font-weight: 500;line-height: 26.04px;text-align: center;">
                        Hilirisasi dan Komersialisasi
                    </h4>
                    <h5 class="text-bold mb-10" style="color: white; font-family: DM Sans;font-size: 13px;font-weight: 400;line-height: 16.93px;text-align: center;">
                        PUI-PT IS-IoT aktif dalam hilirisasi dan komersialisasi, mengubah riset menjadi produk inovatif IoT, mendukung pertumbuhan industri danm perusahaan rintisan dan mendorong pertumbuhan ekonomi melalui kemitraan strategis.
                    </h5>
                </div>
            </div>
            <!-- End Icon Cart -->
        </div>
          <!-- End Col -->
          <div class="col-xl-3 col-lg-4 col-sm-6">
            <div class="icon-card mb-30" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); height: 100%; width: 100%;">
                <div class="content" style="height: 80%; width: 100%;">
                <h4 class="mb-10" style="color: white; font-family: DM Sans;font-size: 20px;font-weight: 500;line-height: 26.04px;text-align: center;">
                    Workshop dan Pelatihan
                </h4>
                <h5 class="text-bold mb-10" style="color: white; font-family: DM Sans;font-size: 13px;font-weight: 400;line-height: 16.93px;text-align: center;">
                    PUI-PT IS-IoT menyelenggarakan workshop dan pelatihan yang memberikan pengetahuan praktis tentang teknologi IoT terbaru untuk meningkatkan keterampilan dan mendorong inovasi di kalangan profesional dan akademisi.
                </h5>
              </div>
            </div>
            <!-- End Icon Cart -->
          </div>
          <!-- End Col -->
    </div>

@endsection

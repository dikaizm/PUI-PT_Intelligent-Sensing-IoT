<ul>
    <li class="nav-item @if (request()->routeIs('home')) active @endif">
        <a href="{{ route('home') }}">
            <span class="icon" style="color: white;">
                <svg width="22" height="22" viewBox="0 0 22 22">
                    <path
                        d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                </svg>
            </span>
            <span class="text" style="color: white;">{{ __('Beranda') }}</span>
        </a>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_1"
            aria-controls="ddmenu_1" aria-expanded="true" aria-label="Toggle navigation">
            <span class="icon" style="color: white;">
                <i class="lni lni-files"></i>
            </span>
            <span class="text" style="color: white;">Laporan Kegiatan</span>
        </a>
        <ul id="ddmenu_1" class="dropdown-nav collapse" style="color: white;">
            <li>
                <a href="{{ route('laporan-kinerja.index') }}" style="color: white;">Laporan Kinerja</a>
            </li>
            <li>
                <a href="#" style="color: white;">Arsip Kegiatan</a>
            </li>
            <li>
                <a href="#" style="color: white;">Penelitian</a>
            </li>
            <li>
                <a href="#" style="color: white;">Publikasi</a>
            </li>
        </ul>
    </li>

    <li class="nav-item  @if (request()->routeIs('users.index')) active @endif">
        <a href="{{ route('users.index') }}">
            <span class="icon" style="color: white;">
                <i class="lni lni-users"></i>
            </span>
            <span class="text" style="color: white;">{{ __('Data Pengguna') }}</span>
        </a>
    </li>

    <li class="nav-item nav-item-has-children">
        <a class="collapsed" href="#0" class="" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
            aria-controls="ddmenu_2" aria-expanded="true" aria-label="Toggle navigation">
            <span class="icon" style="color: white;">
                <i class="lni lni-cog"></i>
            </span>
            <span class="text" style="color: white;">Pengaturan</span>
        </a>
        <ul id="ddmenu_2" class="dropdown-nav collapse" style="">
            <li>
                <a href="{{ route('jenis-dokumen.index') }}" style="color: white;">Jenis Output</a>
            </li>
            <li>
                <a href="{{ route('jenis-penelitian.index') }}" style="color: white;">Jenis Penelitian</a>
            </li>
            <li>
                <a href="{{ route('mitra.index') }}" style="color: white;">Mitra</a>
            </li>
            <li>
                <a href="{{ route('publisher.index') }}" style="color: white;">Publisher</a>
            </li>
            <li>
                <a href="{{ route('status-jurnal.index') }}" style="color: white;">Status Jurnal</a>
            </li>
            <li>
                <a href="{{ route('status-penelitian.index') }}" style="color: white;">Status Laporan</a>
            </li>
            <li>
                <a href="#" style="color: white;">Laporan</a>
            </li>
        </ul>
    </li>

    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}" style="position: sticky; top: 100px;">
            @csrf
            <a class="dropdown-item" style="color: white;" href="{{ route('logout') }}"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <span class="icon" style="color: white;">
                    <i class="lni lni-exit"></i>
                </span>
                <span class="text" style="color: white;">{{ __('Logout') }}</span>
            </a>
        </form>
    </li>

</ul>


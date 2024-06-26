<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class=" col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Seleksi Aslab</span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto" id="menu">
                    {{-- <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="{{ url('/dashboardadmin') }}" class="nav-link px-0 align-middle {{ Request::is('dashboardadmin*') ? 'active' : '' }}">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ url('alternatif') }}" class="nav-link px-0 align-middle {{ Request::is('alternatif*') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Data Alternatif</span> </a>
                    </li>
                    <li>
                        <a href="{{ url('kriteria') }}" class="nav-link px-0 align-middle {{ Request::is('kriteria*') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Data Kriteria</span> </a>
                    </li>
                    <li>
                        <a href="{{ url('subkriteria') }}" class="nav-link px-0 align-middle {{ Request::is('subkriteria*') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Data Sub Kriteria</span> </a>
                    </li>
                    @if (Auth::check() && Auth::user()->name === 'aslab ai' || Auth::user()->name === 'kalab artificial intelligence')
                    <li>
                        <a href="{{ url('smart') }}" class="nav-link px-0 align-middle {{ Request::is('smart*') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Proses SPK</span> </a>
                    </li>
                    @elseif (Auth::check() && Auth::user()->name === 'aslab pc' || Auth::user()->name === 'kalab pertanian cerdas')
                    <li>
                        <a href="{{ url('smartpc') }}" class="nav-link px-0 align-middle {{ Request::is('smartpc*') ? 'active' : '' }}">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Proses SPK</span> </a>
                    </li>
                    @elseif(Auth::check() && Auth::user()->name === 'aslab it' ||Auth::user()->name === 'kalab infrastruktur teknologi')
                    <li>
                        <a href="{{ url('smartit') }}" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Proses SPK</span> </a>
                    </li>
                    @elseif(Auth::check() && Auth::user()->name === 'aslab rpl' ||Auth::user()->name === 'kalab rekayasa perangkat lunak')
                    <li>
                        <a href="{{ url('smartrpl') }}" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Proses SPK</span> </a>
                    </li>

                    @endif
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">Admin <br> {{ Auth::user()->name }} <br></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            @include('komponen.alert')
            @yield('konten')
        </div>
    </div>
</div>
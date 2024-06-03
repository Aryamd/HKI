<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('assets/images/users/user-9.jpg')}}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">James Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('dashboard.index') }}">
                        <i data-feather="airplay"></i>
                        <span> Beranda </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarPaten" data-bs-toggle="collapse">
                        <i data-feather="layers"></i>
                        <span> Paten </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPaten">
                        <ul class="nav-second-level">
                            {{-- <li>
                                <a href="{{ route('paten.index') }}">Daftar Paten</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('paten.pengajuan-awal') }}">Pengajuan Awal</a>
                            </li>
                            <li>
                                <a href="{{ route('paten.terdaftar') }}">Terdaftar</a>
                            </li>
                            <li>
                                <a href="{{ route('paten.kelengkapan-dokumen') }}">Kelengkapan Dokumen</a>
                            </li>
                            <li>
                                <a href="{{ route('paten.mediasi') }}">Mediasi</a>
                            </li>
                            <li>
                                <a href="{{ route('paten.granted') }}">Granted</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('merek.index') }}">
                        <i data-feather="activity"></i>
                        <span> Merek </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('hak-cipta.index') }}">
                        <i data-feather="pocket"></i>
                        <span> Hak Cipta </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('desain-industri.index') }}">
                        <i data-feather="share-2"></i>
                        <span> Desain Industri </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dtlst.index') }}">
                        <i data-feather="cpu"></i>
                        <span> DTLST </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Report</li>

                @role('Admin')
                <li>
                    <a href="#sidebarLaporan" data-bs-toggle="collapse">
                        <i data-feather="bar-chart-2"></i>
                        <span> Laporan </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarLaporan">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('laporan.index') }}">Aktivitas Konsultan</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan.index') }}">KI Pegawai</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole

                @role('Dosen')
                <li>
                    <a href="{{ route('laporan.index') }}">
                        <i data-feather="bar-chart-2"></i>
                        <span> Laporan </span>
                    </a>
                </li>
                @endrole

                @role('Admin')
                <li class="menu-title mt-2">Master</li>

                <li>
                    <a href="#sidebarMasterData" data-bs-toggle="collapse">
                        <i data-feather="file-text"></i>
                        <span> Master Data </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMasterData">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('status-ki.index') }}">Status KI</a>
                            </li>
                            <li>
                                <a href="{{ route('kategori-ki.index') }}">Kategori KI</a>
                            </li>
                            <li>
                                <a href="{{ route('kategori-hc.index') }}">Kategori Hak Cipta</a>
                            </li>
                            <li>
                                <a href="{{ route('kategori-merek.index') }}">Kategori Merek</a>
                            </li>
                            <li>
                                <a href="{{ route('kategori-dtlst.index') }}">Kategori Desain Industri</a>
                            </li>
                            <li>
                                <a href="{{ route('kategori-dtlst.index') }}">Kategori DTLST</a>
                            </li>
                            <li>
                                <a href="{{ route('konsultan.index') }}">Konsultan</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('setting.index') }}">
                        <i class="fe-settings"></i>
                        <span> Pengaturan </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}">
                        <i data-feather="users"></i>
                        <span> Pengguna </span>
                    </a>
                </li>
                @endrole

                <li class="menu-title mt-2">Account</li>

                <li>
                    <a href="{{ route('profile.index') }}">
                        <i class="fe-user"></i>
                        <span> Profile </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('logout.index') }}">
                        <i class="fe-log-out"></i>
                        <span> Logout </span>
                    </a>
                </li>

                {{-- <li>
                    <a href="#sidebarMultilevel" data-bs-toggle="collapse">
                        <i data-feather="share-2"></i>
                        <span> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarMultilevel">
                        <ul class="nav-second-level">
                            <li>
                                <a href="#sidebarMultilevel2" data-bs-toggle="collapse">
                                    Second Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel2">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="javascript: void(0);">Item 2</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#sidebarMultilevel3" data-bs-toggle="collapse">
                                    Third Level <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMultilevel3">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="javascript: void(0);">Item 1</a>
                                        </li>
                                        <li>
                                            <a href="#sidebarMultilevel4" data-bs-toggle="collapse">
                                                Item 2 <span class="menu-arrow"></span>
                                            </a>
                                            <div class="collapse" id="sidebarMultilevel4">
                                                <ul class="nav-second-level">
                                                    <li>
                                                        <a href="javascript: void(0);">Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript: void(0);">Item 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

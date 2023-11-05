        <aside class="main-sidebar sidebar-light-primary elevation-4">

            <a href="index3.html" class="brand-link">
                <img src="{{ asset('AdminLTE') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt=""
                            class="img-circle elevation-2">
                        {{--  @if (Storage::disk('public')->exists(auth()->user()->path_image))
                            <img src="{{ Storage::disk('public')->url(auth()->user()->path_image) }}" alt=""
                                class="img-circle elevation-2">
                        @else
                            <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt=""
                                class="img-circle elevation-2">
                        @endif  --}}
                    </div>
                    <div class="info">
                        <a href="{{ route('profile.show') }}" class="d-block" data-toggle="tooltip" data-placement="top"
                            title="Edit Profil">
                            {{ auth()->user()->name }}
                            <i class="fas fa-pencil-alt ml-2 text-sm text-primary"></i>
                        </a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MASTER</li>
                        <li class="nav-item">
                            <a href="{{ route('pelanggan.index') }}"
                                class="nav-link {{ request()->is('pelanggan*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Pelanggan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('provider.index') }}"
                                class="nav-link {{ request()->is('provider*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-wifi"></i>
                                <p>
                                    Provider
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pulsa.index') }}"
                                class="nav-link {{ request()->is('pulsa*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-mobile-alt"></i>
                                <p>
                                    Pulsa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}" class="nav-link {{ request()->is('produk*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-money-check"></i>
                                <p>
                                    Vocer
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">TRANSAKSI</li>
                         <li class="nav-item">
                            <a href="{{ route('pembelian.index') }}" class="nav-link {{ request()->is('pembelian*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-download"></i>
                                <p>
                                    Pembelian
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pengeluaran.index') }}" class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-money-check"></i>
                                <p>
                                    Pengeluaran
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('admin/category*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-upload"></i>
                                <p>
                                    Penjualan
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">REPORT</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('admin/report*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-file-pdf"></i>
                                <p>
                                    Laporan
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">SISTEM</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->is('admin/setting*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>
                                    Pengaturan
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>

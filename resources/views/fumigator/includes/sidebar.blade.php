<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon ">
                    <img src="{{asset('template/img/logo_prana.png')}}" style="width: 50px; height: 50px;" alt="">
                </div>
                <div class="sidebar-brand-text mx-3">PT.Prana</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            @if (Auth::guard('users')->user()->role=="fumigator"||Auth::guard('users')->user()->role=="manager")
            <li class="nav-item">
                <a class="nav-link" href="/persediaan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Persediaan</span></a>
            </li>                  
            @endif
            

            <li class="nav-item">
                <a class="nav-link" href="/pesanan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pesanan</span></a>
            </li>
            @if (Auth::guard('users')->user()->role=="fumigator"||Auth::guard('users')->user()->role=="manager")
            <li class="nav-item">
                <a class="nav-link" href="/penggunaan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Penggunaan</span></a>
            </li>
            @endif
            @if (Auth::guard('users')->user()->role=="fumigator"||Auth::guard('users')->user()->role=="manager")
            <li class="nav-item">
                <a class="nav-link" href="/pemasukan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pemasukan</span></a>
            </li>
            @endif 
            @if (Auth::guard('users')->user()->role=="fumigator"||Auth::guard('users')->user()->role=="manager")
            <li class="nav-item">
                <a class="nav-link" href="/pemesanan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Pemesanan</span></a>
            </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
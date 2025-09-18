<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SIKAWAN - Dashboard</title>
    <!-- CSS -->

    <!-- dashboard.css tetap dipakai -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- master.css setelahnya -->
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data="{ dark: localStorage.getItem('theme') === 'dark' }" x-init="$watch('dark', val => {
    document.body.classList.toggle('dark', val);
    localStorage.setItem('theme', val ? 'dark' : 'light');
})" x-bind:class="dark ? 'dark app' : 'app'">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            SIKAWAN
            <button @click="dark = !dark"
                style="margin-left:auto;background:none;border:none;cursor:pointer;font-size:18px">
                <span x-show="!dark">🌙</span>
                <span x-show="dark">☀️</span>
            </button>
        </div>

        <nav style="margin-top:20px; display:flex; flex-direction:column; gap:6px;">
            <!-- Dashboard -->
            <div @click="window.location='{{ route('dashboard') }}'"
                class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer
                        {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                Dashboard
            </div>



            <!-- Dropdown Menu -->
            <!-- Sidebar Master Dropdown Fixed -->
            <div x-data="{ openMaster: false }" class="flex flex-col relative">
                <!-- Button Master -->
                <div @click="openMaster = !openMaster"
                    class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer
                {{ request()->routeIs('master.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                    Master
                </div>

                <!-- Dropdown Menu -->
                <div x-show="openMaster" x-transition
                    style="display:flex; flex-direction:column; margin-top:2px; overflow-visible; position:relative; z-index:50;">
                    <a href="{{ route('master.jenisPegawai') }}"
                        class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700
           {{ request()->routeIs('master.jenisPegawai') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Jenis Pegawai
                    </a>
                    <a href="{{ route('master.statusPegawai') }}"
                        class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700
           {{ request()->routeIs('master.statusPegawai') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Status Pegawai
                    </a>
                    <a href="{{ route('master.agama') }}"
                        class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700
           {{ request()->routeIs('master.agama') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Agama
                    </a>
                    <a href="{{ route('master.unit') }}"
                        class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700
           {{ request()->routeIs('master.unit') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Unit
                    </a>
                    <a href="{{ route('master.subunit') }}"
                        class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700
           {{ request()->routeIs('master.subunit') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                        Sub Unit
                    </a>
                </div>
            </div>

            </div>

            <!-- Other Menu Items -->
            <div class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">Kepegawaian
            </div>
            <div class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">Presensi
            </div>
            <div class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">Tunjangan
            </div>
            <div class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">Setting
            </div>
            <div class="menu-item px-3 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">Report
            </div>
        </nav>

        <div style="position:absolute;bottom:16px;left:18px;right:18px">
            <div class="footer">2025 © <a href="#" style="color:#4f6bf3;text-decoration:none">UPT TIK</a></div>
        </div>
    </aside>

    <!-- Main -->
    <div class="main">
        <header class="header">
            <div class="left">☰</div>
            <div class="right">
                <div style="text-align:right;margin-right:10px">
                    <div style="font-size:13px">{{ auth()->check() ? auth()->user()->email : 'guest@example.com' }}
                    </div>
                    <div style="font-size:12px;color:rgba(255,255,255,0.8)">
                        {{ auth()->check() ? ucfirst(auth()->user()->role) : '' }}</div>
                </div>
                <div style="width:40px;height:40px;border-radius:999px;background:#fff;overflow:hidden">
                    <img src="https://i.pravatar.cc/100" style="width:100%;height:100%;object-fit:cover" alt="avatar">
                </div>
            </div>
        </header>

        <div class="content">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>

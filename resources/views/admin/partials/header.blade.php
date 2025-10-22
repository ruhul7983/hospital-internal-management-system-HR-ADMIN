<header class="sticky top-0 z-30 bg-slate-50/80 backdrop-blur border-b border-slate-200">
    <div class="px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
        {{-- Left: Brand --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') ?? '#' }}" class="flex items-center gap-2">
                <i class="fa-solid fa-stethoscope text-emerald-600"></i>
                <span class="text-lg font-semibold tracking-wide text-slate-800">Admin Dashboard</span>
            </a>
        </div>

        {{-- Right: Actions --}}
        <div class="flex items-center gap-4 sm:gap-6">
            {{-- Notifications --}}
            <button id="notifyBtn"
                    class="relative inline-flex items-center justify-center h-9 w-9 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Notifications">
                <span class="absolute top-1.5 right-1.5 inline-block h-2 w-2 rounded-full bg-rose-500"></span>
                <i class="fa-regular fa-bell text-[18px]"></i>
            </button>

            {{-- Profile dropdown --}}
            <div class="relative">
                <button id="userMenuButton"
                        class="flex items-center gap-2 rounded-md px-2 py-1.5 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('assets/images/ruhul.jpg') }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover">
                    <span class="hidden sm:inline-block text-sm text-slate-800">Md Ruhul Amin</span>
                    <i class="chevron fa-solid fa-chevron-down text-slate-500 text-[12px]"></i>
                </button>

                <div id="userMenu"
                     class="hidden absolute right-0 mt-2 w-48 rounded-md border border-slate-200 bg-white shadow-lg overflow-hidden">
                    <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <i class="fa-regular fa-user"></i> Profile
                    </a>
                    <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <i class="fa-solid fa-gear"></i> Settings
                    </a>
                    <div class="h-px bg-slate-200"></div>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 flex items-center gap-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>

            {{-- ✅ Hamburger visible on mobile, hidden on lg+ --}}
            <button id="sidebarToggle"
                    class="lg:hidden inline-flex items-center justify-center h-9 w-9 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Toggle sidebar" aria-pressed="false">
                <i class="fa-solid fa-bars text-[18px]"></i>
            </button>
        </div>
    </div>
</header>

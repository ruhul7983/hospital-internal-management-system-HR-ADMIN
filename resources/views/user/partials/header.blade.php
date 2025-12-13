<header class="sticky top-0 z-30 bg-slate-50/80 backdrop-blur border-b border-slate-200">
    <div class="px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
        {{-- Left: Brand & Hospital Name (Dynamic) --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') ?? '#' }}" class="flex items-center gap-2">
                <i class="fa-solid fa-stethoscope text-emerald-600"></i>
                <span class="text-lg font-semibold tracking-wide text-slate-800">
                    {{ $headerData['hospitalName'] ?? 'Admin Dashboard' }}
                </span>
            </a>
        </div>

        {{-- Right: Actions (No Notifications/Settings link) --}}
        <div class="flex items-center gap-4 sm:gap-6">
            
            {{-- Profile dropdown --}}
            <div class="relative">
                <button id="userMenuButton"
                        class="flex items-center gap-2 rounded-md px-2 py-1.5 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        aria-haspopup="true" aria-expanded="false">
                    
                    {{-- User Avatar/Initial --}}
                    {{-- Check if a picture exists, otherwise show initials --}}
                    @if (isset($headerData['profilePic']))
                        <img src="{{ asset('storage/' . $headerData['profilePic']) }}" alt="Avatar" class="h-8 w-8 rounded-full object-cover">
                    @else
                         <div class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                            {{ $headerData['initial'] ?? '?' }}
                        </div>
                    @endif
                    
                    <span class="hidden sm:inline-block text-sm text-slate-800">{{ $headerData['name'] ?? 'Admin User' }}</span>
                    <i class="chevron fa-solid fa-chevron-down text-slate-500 text-[12px]"></i>
                </button>

                {{-- Profile Dropdown Menu --}}
                <div id="userMenu"
                     class="hidden absolute right-0 mt-2 w-48 rounded-md border border-slate-200 bg-white shadow-lg overflow-hidden z-40">
                    
                    {{-- Profile Link --}}
                    <a href="#" class="flex items-center gap-2 px-3 py-2 text-sm text-slate-700 hover:bg-slate-50">
                        <i class="fa-regular fa-user"></i> Profile
                    </a>
                    
                    {{-- Settings Link REMOVED --}}
                    
                    <div class="h-px bg-slate-200"></div>
                    
                    {{-- Logout Form --}}
                    <form method="POST" action="{{ route('admin.logout') ?? '#' }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 flex items-center gap-2">
                            <i class="fa-solid fa-right-from-bracket"></i> Sign out
                        </button>
                    </form>
                </div>
            </div>

            {{-- Hamburger Toggle (Remains for sidebar visibility) --}}
            <button id="sidebarToggle"
                    class="lg:hidden inline-flex items-center justify-center h-9 w-9 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Toggle sidebar" aria-pressed="false">
                <i class="fa-solid fa-bars text-[18px]"></i>
            </button>
        </div>
    </div>
</header>
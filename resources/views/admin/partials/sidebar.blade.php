<aside id="sidebar"
       class="fixed top-14 bottom-0 left-0 z-50 w-72 transform -translate-x-full lg:translate-x-0 bg-white border-r border-gray-200 overflow-y-auto transition-transform"
       aria-label="Sidebar">
    <div class="p-4">
        <nav class="space-y-1" id="sidebarNav">
            {{-- Dashboard --}}
            <a href="#" class="nav-item group flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-gauge text-gray-400 group-hover:text-gray-600"></i>
                <span>Dashboard</span>
            </a>

            {{-- Setup (Nested) --}}
            <div class="nav-group">
                <button class="nav-trigger w-full flex items-center justify-between px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
                        aria-expanded="false" aria-controls="group-setup">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-screwdriver-wrench text-gray-400"></i>
                        <span>Setup</span>
                    </span>
                    <i class="chevron fa-solid fa-chevron-down text-[12px] transition-transform"></i>
                </button>
                <div id="group-setup" class="nav-panel hidden pl-11 pr-3 mt-1 space-y-1">
                    <a href={{ route("admin.pages.setup.shifts.index") }} class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Shifts</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Departments</a>
                    <a href={{ route("admin.pages.setup.overtimes.index") }} class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Overtimes</a>
                </div>
            </div>

            {{-- Appointments (Nested) --}}
            <div class="nav-group">
                <button class="nav-trigger w-full flex items-center justify-between px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
                        aria-expanded="false" aria-controls="group-appointments">
                    <span class="flex items-center gap-3">
                        <i class="fa-regular fa-calendar-days text-gray-400"></i>
                        <span>Appointments</span>
                    </span>
                    <i class="chevron fa-solid fa-chevron-down text-[12px] transition-transform"></i>
                </button>
                <div id="group-appointments" class="nav-panel hidden pl-11 pr-3 mt-1 space-y-1">
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Calendar</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Create Appointment</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Pending Approvals</a>
                </div>
            </div>

            {{-- Employees --}}
            <a href={{ route("admin.pages.employees.index") }} class="nav-item group flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-file-invoice-dollar text-gray-400 group-hover:text-gray-600"></i>
                <span>Employees</span>
            </a>
            {{-- Duty --}}
            <a href={{ route("admin.pages.duty-management.index") }} class="nav-item group flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-file-invoice-dollar text-gray-400 group-hover:text-gray-600"></i>
                <span>Duty Management</span>
            </a>
            {{-- Billing --}}
            <a href="#" class="nav-item group flex items-center gap-3 px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="fa-solid fa-file-invoice-dollar text-gray-400 group-hover:text-gray-600"></i>
                <span>Billing</span>
            </a>

            {{-- Salaries (Nested) --}}
            <div class="nav-group">
                <button class="nav-trigger w-full flex items-center justify-between px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
                        aria-expanded="false" aria-controls="group-settings">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-gear text-gray-400"></i>
                        <span>Salary Management</span>
                    </span>
                    <i class="chevron fa-solid fa-chevron-down text-[12px] transition-transform"></i>
                </button>
                <div id="group-settings" class="nav-panel hidden pl-11 pr-3 mt-1 space-y-1">
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Salary Head</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Setup Salary</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Generate Salary</a>
                </div>
            </div>

            {{-- Settings (Nested) --}}
            <div class="nav-group">
                <button class="nav-trigger w-full flex items-center justify-between px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100"
                        aria-expanded="false" aria-controls="group-settings">
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-gear text-gray-400"></i>
                        <span>Settings</span>
                    </span>
                    <i class="chevron fa-solid fa-chevron-down text-[12px] transition-transform"></i>
                </button>
                <div id="group-settings" class="nav-panel hidden pl-11 pr-3 mt-1 space-y-1">
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Users</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Roles & Permissions</a>
                    <a href="#" class="block px-2 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100">Preferences</a>
                </div>
            </div>
        </nav>
    </div>
</aside>

<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'User Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="h-full bg-gray-50">
    {{-- Header partial --}}
    @include('user.partials.header')

    {{-- Backdrop for mobile --}}
    <div id="sidebarBackdrop" class="fixed inset-0 bg-black/40 hidden lg:hidden z-40"></div>

    {{-- Sidebar partial --}}
    @include('user.partials.sidebar')

    {{-- Main (independent scroll) --}}
    <main id="mainWrapper" class="pt-0 lg:pl-72">
        <div class="h-[calc(100vh-3.5rem)] overflow-y-auto">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- Your existing JS --}}
    <script src="{{ asset('assets/js/admin/dashboard.js') }}"></script>
</body>

</html>

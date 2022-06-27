<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8" />

    <title>@yield('title') @yield('subtitle') : {{ config('app.name', '') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        html,
        body {
            font-family: 'Athiti', sans-serif;
        }
    </style>



    @livewireStyles

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        function ConfirmLogout() {
	return confirm("Are you sure you want to logout?");
}
    </script>

    <script>
        function myHide()
    {
        document.getElementById('hidepage').style.display='block';//content ที่ต้องการแสดงหลังจากเพจโหลดเสร็จ
        document.getElementById('hidepage2').style.display='none';//content ที่ต้องการแสดงระหว่างโหลดเพจ
    }
    </script>


</head>

<body class="font-Athiti antialiased" onload="myHide();">



    @livewire('navigation-menu')



    <!-- Page Heading -->
    {{-- <header class="bg-white shadow">

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                 {{ $header }}
    </div>
    </header> --}}


    <!-- Page Content -->


    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        {{ $slot }}
    </main>


    </div>
    </div> {{-- close navigation-menu --}}


    @stack('modals')

    @livewireScripts




</body>

</html>
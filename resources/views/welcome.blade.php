<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="{{ asset('storage/logo.png') }}" />
    <title>{{ config('app.name', '') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">

    <style>
        html,
        body,
        button {
            font-family: 'Athiti', sans-serif;
        }

        /* This example part of kwd-dashboard see https://kamona-wd.github.io/kwd-dashboard/ */
        /* So here we will write some classes to simulate dark mode and some of tailwind css config in our project */
        :root {
            --light: #edf2f9;
            --dark: #152e4d;
            --darker: #12263f;

            --color-red: #dc2626;
            --color-green: #16a34a;
            --color-blue: #2563eb;
            --color-cyan: #0891b2;
            --color-teal: #0d9488;
            --color-fuchsia: #c026d3;
            --color-orange: #ea580c;
            --color-yellow: #ca8a04;
            --color-violet: #7c3aed;
        }

        [x-cloak] {
            display: none;
        }

        .dark .dark\:text-light {
            color: var(--light);
        }

        .dark .dark\:bg-dark {
            background-color: var(--dark);
        }

        .dark .dark\:bg-darker {
            background-color: var(--darker);
        }

        .dark .dark\:text-gray-300 {
            color: #D1D5DB;
        }

        .dark .dark\:text-blue-500 {
            color: #3B82F6;
        }

        .dark .dark\:text-blue-100 {
            color: #DBEAFE;
        }

        .dark .dark\:hover\:text-light:hover {
            color: var(--light);
        }

        .dark .dark\:border-blue-800 {
            border-color: #1e40af;
        }

        .dark .dark\:border-blue-700 {
            border-color: #1D4ED8;
        }

        .dark .dark\:bg-blue-600 {
            background-color: #2563eb;
        }

        .dark .dark\:hover\:bg-blue-600:hover {
            background-color: #2563eb;
        }

        .hover\:overflow-y-auto:hover {
            overflow-y: auto;
        }
    </style>

    <style type="text/css">
        .resp-container {
            position: relative;
            overflow: hidden;
            padding-top: 56.25%;
        }

        .resp-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>

    <div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" :class="{ 'dark': isDark}">
        <!--  -->
        <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
            <!-- Loading screen -->
            <div x-ref="loading"
                class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-opacity-90 bg-blue-800">
                Loading.....
            </div>

            <!-- Sidebar -->
            <aside class="flex-shrink-0 hidden w-64 bg-white border-r dark:border-blue-800 dark:bg-darker md:block">
                <div class="flex flex-col h-full">
                    <!-- Sidebar links -->
                    <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
                        <!-- Dashboards links -->
                        {{--  <div x-data="{ isActive: false, open: false}">
                            <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> Dashboards </span>
                                <span class="ml-auto" aria-hidden="true">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    Default
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                    Project Mangement
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                    E-Commerce
                                </a>
                            </div>
                        </div> --}}

                        <div x-data="{ isActive: false, open: false}">
                            <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                            <a href="{{ url('?history=show') }}"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> ความเป็นมาของระบบ </span>
                                <span class="ml-auto" aria-hidden="true">

                                </span>
                            </a>

                            {{--     </div> <a href="{{ url('?history=show') }}" role="menuitem" class="block p-2
                            text-sm text-gray-400 transition-colors duration-200 rounded-md
                            dark:hover:text-light hover:text-gray-700">
                            ความเป็นมาของระบบ
                            </a> --}}


                            <!-- Components links -->
                            <div x-data="{ isActive: false, open: false }">
                                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> รายงานตามปีงบประมาณ </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                    <a href="{{ url('?page=std01') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        1. สถานการณ์รวม
                                    </a>
                                    <a href="{{ url('?page=std02') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        2. เขตบริการสุขภาพ-จังหวัด
                                    </a>
                                    <a href="{{ url('?page=std03') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        3. เขตบริการสุขภาพ-จังหวัด(map)
                                    </a>
                                    <a href="{{ url('?page=std04') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        4. ภาพรวมรายปี
                                    </a>
                                    <a href="{{ url('?page=std05') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        5. ตามเดือน และช่วงเวลาที่เกิดเหตุ
                                    </a>
                                    <a href="{{ url('?page=std06') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        6. ตามเขตสุขภาพ
                                    </a>
                                    <a href="{{ url('?page=std07') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        7. ตามเขตสุขภาพ (อัตรา)
                                    </a>
                                    <a href="{{ url('?page=std08') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        8. ภาพรวมเขต
                                    </a>
                                    <a href="{{ url('?page=std09') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        9. อัตราผู้เสียชีวิตต่อแสนประชากร รายจังหวัด
                                    </a>
                                    <a href="{{ url('?page=std10') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">

                                        10. แผนที่แสดงจำนวน
                                    </a>
                                    <a href="{{ url('?page=std11') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        11. อันดับของอัตราผู้เสียชีวิตต่อแสนประชากร
                                    </a>
                                </div>
                            </div>

                            {{-- <!-- Pages links -->
                        <div x-data="{ isActive: true, open: open }">
                            <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                            <a href="#" @click="$event.preventDefault(); open = !open"
                                class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                <span aria-hidden="true">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </span>
                                <span class="ml-2 text-sm"> Pages </span>
                                <span aria-hidden="true" class="ml-auto">
                                    <!-- active class 'rotate-180' -->
                                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </a>
                            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                                    Blank
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                    Profile
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                    Pricing
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                    Kanban
                                </a>
                                <a href="#" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                    Feed
                                </a>
                            </div>
                        </div> --}}


                            <!-- Components links -->
                            <div x-data="{ isActive: false, open: false }">
                                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> รายงานตามปีปฏิทิน </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                    <a href="{{ url('?page=std01') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        1. สถานการณ์รวม
                                    </a>
                                    <a href="{{ url('?page=std02') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        2. เขตบริการสุขภาพ-จังหวัด
                                    </a>
                                    <a href="{{ url('?page=std03') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        3. เขตบริการสุขภาพ-จังหวัด(map)
                                    </a>
                                    <a href="{{ url('?page=std04') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        4. ภาพรวมรายปี
                                    </a>
                                    <a href="{{ url('?page=std05') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        5. ตามเดือน และช่วงเวลาที่เกิดเหตุ
                                    </a>
                                    <a href="{{ url('?page=std06') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        6. ตามเขตสุขภาพ
                                    </a>
                                    <a href="{{ url('?page=std07') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        7. ตามเขตสุขภาพ (อัตรา)
                                    </a>
                                    <a href="{{ url('?page=std08') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        8. ภาพรวมเขต
                                    </a>
                                    <a href="{{ url('?page=std09') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        9. อัตราผู้เสียชีวิตต่อแสนประชากร รายจังหวัด
                                    </a>
                                    <a href="{{ url('?page=std10') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">

                                        10. แผนที่แสดงจำนวน
                                    </a>
                                    <a href="{{ url('?page=std11') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        11. อันดับของอัตราผู้เสียชีวิตต่อแสนประชากร
                                    </a>
                                </div>
                            </div>

                            <!-- Authentication links -->
                            <div x-data="{ isActive: false, open: false}">
                                <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> ระบบประมวลผล </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform"
                                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" aria-label="Authentication">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->


                                    @auth
                                    <a href="{{ url('/dashboard') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        ระบบบูรณาการ
                                    </a>
                                    @else
                                    <a href="{{ route('login') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        เข้าสู่ระบบ (สำหรับเจ้าหน้าที่)
                                    </a>
                                    {{--   @if (Route::has('register'))
                                    <a href="{{ route('register') }}" role="menuitem"
                                    class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md
                                    dark:hover:text-light hover:text-gray-700">
                                    ลงทะเบียน
                                    </a>
                                    @endif --}}
                                    @endauth


                                </div>
                            </div>
                    </nav>

                    <!-- Sidebar footer -->
                    <div class="flex-shrink-0 px-2 py-4 space-y-2">
                        <button @click="openSettingsPanel" type="button"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-700 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark">
                            <span aria-hidden="true"">
                      <svg
                        class=" w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </span>
                            <span>Customize</span>
                        </button>
                    </div>
                </div>
            </aside>

            <div class="flex flex-col flex-1 min-h-screen overflow-x-hidden overflow-y-auto">
                <!-- Navbar -->
                <header class="relative bg-white dark:bg-darker">
                    <div class="flex items-center justify-between p-2 border-b dark:border-blue-800">
                        <!-- Mobile menu button -->
                        <button @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                            class="p-1 text-blue-400 transition-colors duration-200 rounded-md bg-blue-50 hover:text-blue-600 hover:bg-blue-100 dark:hover:text-light dark:hover:bg-blue-700 dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open main manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                        </button>

                        <!-- Brand -->
                        <a href="#"
                            class="inline-block text-2xl font-bold tracking-wider text-blue-700 uppercase dark:text-light">
                            {{--   RTDDI :: ระบบบูรณาการข้อมูลการตายจากข้อมูล 3 ฐาน --}}
                            <img src="{{ asset('storage/logo.png') }}" width="100%" />

                        </a>

                        <!-- Mobile sub menu button -->
                        {{--   <button @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                            class="p-1 text-blue-400 transition-colors duration-200 rounded-md bg-blue-50 hover:text-blue-600 hover:bg-blue-100 dark:hover:text-light dark:hover:bg-blue-700 dark:bg-dark md:hidden focus:outline-none focus:ring">
                            <span class="sr-only">Open sub manu</span>
                            <span aria-hidden="true">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </span>
                        </button> --}}

                        <!-- Desktop Right buttons -->
                        <nav aria-label="Secondary" class="hidden space-x-2 md:flex md:items-center">
                            <!-- Toggle dark theme button -->
                            {{--  <button aria-hidden="true" class="relative focus:outline-none" x-cloak @click="toggleTheme">
                                <div class="w-12 h-6 transition bg-blue-100 rounded-full outline-none dark:bg-blue-400">
                                </div>
                                <div class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-150 transform scale-110 rounded-full shadow-sm"
                                    :class="{ 'translate-x-0 -translate-y-px  bg-white text-blue-700': !isDark, 'translate-x-6 text-blue-100 bg-blue-800': isDark }">
                                    <svg x-show="!isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <svg x-show="isDark" class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                            </button> --}}

                            {{--  <!-- Notification button -->
                            <button @click="openNotificationsPanel"
                                class="p-2 text-blue-400 transition-colors duration-200 rounded-full bg-blue-50 hover:text-blue-600 hover:bg-blue-100 dark:hover:text-light dark:hover:bg-blue-700 dark:bg-dark focus:outline-none focus:bg-blue-100 dark:focus:bg-blue-700 focus:ring-blue-800">
                                <span class="sr-only">Open Notification panel</span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button> --}}

                            {{--      <!-- Search button -->
                            <button @click="openSearchPanel"
                                class="p-2 text-blue-400 transition-colors duration-200 rounded-full bg-blue-50 hover:text-blue-600 hover:bg-blue-100 dark:hover:text-light dark:hover:bg-blue-700 dark:bg-dark focus:outline-none focus:bg-blue-100 dark:focus:bg-blue-700 focus:ring-blue-800">
                                <span class="sr-only">Open search panel</span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
 --}}
                            {{--   <!-- Settings button -->
                            <button @click="openSettingsPanel"
                                class="p-2 text-blue-400 transition-colors duration-200 rounded-full bg-blue-50 hover:text-blue-600 hover:bg-blue-100 dark:hover:text-light dark:hover:bg-blue-700 dark:bg-dark focus:outline-none focus:bg-blue-100 dark:focus:bg-blue-700 focus:ring-blue-800">
                                <span class="sr-only">Open settings panel</span>
                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </button> --}}

                            <!-- User avatar button -->
                            {{--   <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open; $nextTick(() => { if(open){ $refs.userMenu.focus() } })"
                                    type="button" aria-haspopup="true" :aria-expanded="open ? 'true' : 'false'"
                                    class="transition-opacity duration-200 rounded-full dark:opacity-75 dark:hover:opacity-100 focus:outline-none focus:ring dark:focus:opacity-100">
                                    <span class="sr-only">User menu</span>
                                    <img class="w-10 h-10 rounded-full"
                                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                        alt="Ahmed Kamel" />
                                </button>

                                <!-- User dropdown menu -->
                                <div x-show="open" x-ref="userMenu"
                                    x-transition:enter="transition-all transform ease-out"
                                    x-transition:enter-start="translate-y-1/2 opacity-0"
                                    x-transition:enter-end="translate-y-0 opacity-100"
                                    x-transition:leave="transition-all transform ease-in"
                                    x-transition:leave-start="translate-y-0 opacity-100"
                                    x-transition:leave-end="translate-y-1/2 opacity-0" @click.away="open = false"
                                    @keydown.escape="open = false"
                                    class="absolute right-0 w-48 py-1 bg-white rounded-md shadow-lg top-12 ring-1 ring-black ring-opacity-5 dark:bg-dark focus:outline-none"
                                    tabindex="-1" role="menu" aria-orientation="vertical" aria-label="User menu">
                                    <a href="#" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
                                        Your Profile
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
                                        Settings
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block px-4 py-2 text-sm text-gray-700 transition-colors hover:bg-gray-100 dark:text-light dark:hover:bg-blue-600">
                                        Logout
                                    </a>
                                </div>
                            </div> --}}
                        </nav>

                    </div>
                    <!-- Mobile main manu -->
                    <div class="border-b md:hidden dark:border-blue-800" x-show="isMobileMainMenuOpen"
                        @click.away="isMobileMainMenuOpen = false">
                        <nav aria-label="Main"
                            class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
                            <!-- Dashboards links -->
                            {{--  <div x-data="{ isActive: false, open: false}">
                                <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> Dashboards </span>
                                    <span class="ml-auto" aria-hidden="true">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Dashboards">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        Default
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        Project Mangement
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        E-Commerce
                                    </a>
                                </div>
                            </div> --}}

                            <div x-data="{ isActive: false, open: false}">
                                <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="{{ url('?history=show') }}"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> ความเป็นมาของระบบ </span>
                                    <span class="ml-auto" aria-hidden="true">

                                    </span>
                                </a>

                                {{--     </div> <a href="{{ url('?history=show') }}" role="menuitem" class="block p-2
                                text-sm text-gray-400 transition-colors duration-200 rounded-md
                                dark:hover:text-light hover:text-gray-700">
                                ความเป็นมาของระบบ
                                </a> --}}


                                <!-- Components links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                        :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                        </span>
                                        <span class="ml-2 text-sm"> รายงานตามปีงบประมาณ </span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ url('?page=std01') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                            1. สถานการณ์รวม
                                        </a>
                                        <a href="{{ url('?page=std02') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                            2. เขตบริการสุขภาพ-จังหวัด
                                        </a>
                                        <a href="{{ url('?page=std03') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            3. เขตบริการสุขภาพ-จังหวัด(map)
                                        </a>
                                        <a href="{{ url('?page=std04') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            4. ภาพรวมรายปี
                                        </a>
                                        <a href="{{ url('?page=std05') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            5. ตามเดือน และช่วงเวลาที่เกิดเหตุ
                                        </a>
                                        <a href="{{ url('?page=std06') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            6. ตามเขตสุขภาพ
                                        </a>
                                        <a href="{{ url('?page=std07') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            7. ตามเขตสุขภาพ (อัตรา)
                                        </a>
                                        <a href="{{ url('?page=std08') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            8. ภาพรวมเขต
                                        </a>
                                        <a href="{{ url('?page=std09') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            9. อัตราผู้เสียชีวิตต่อแสนประชากร รายจังหวัด
                                        </a>
                                        <a href="{{ url('?page=std10') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">

                                            10. แผนที่แสดงจำนวน
                                        </a>
                                        <a href="{{ url('?page=std11') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            11. อันดับของอัตราผู้เสียชีวิตต่อแสนประชากร
                                        </a>
                                    </div>
                                </div>

                                {{-- <!-- Pages links -->
                            <div x-data="{ isActive: true, open: open }">
                                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                                <a href="#" @click="$event.preventDefault(); open = !open"
                                    class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                    :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                    aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                    <span aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <span class="ml-2 text-sm"> Pages </span>
                                    <span aria-hidden="true" class="ml-auto">
                                        <!-- active class 'rotate-180' -->
                                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </a>
                                <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pages">
                                    <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                    <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-700 transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-gray-700">
                                        Blank
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                        Profile
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        Pricing
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        Kanban
                                    </a>
                                    <a href="#" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                        Feed
                                    </a>
                                </div>
                            </div> --}}


                                <!-- Components links -->
                                <div x-data="{ isActive: false, open: false }">
                                    <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                        :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }" role="button"
                                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                        </span>
                                        <span class="ml-2 text-sm"> รายงานตามปีปฏิทิน </span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Components">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                                        <a href="{{ url('?page=std01') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                            1. สถานการณ์รวม
                                        </a>
                                        <a href="{{ url('?page=std02') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:text-gray-400 dark:hover:text-light hover:text-gray-700">
                                            2. เขตบริการสุขภาพ-จังหวัด
                                        </a>
                                        <a href="{{ url('?page=std03') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            3. เขตบริการสุขภาพ-จังหวัด(map)
                                        </a>
                                        <a href="{{ url('?page=std04') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            4. ภาพรวมรายปี
                                        </a>
                                        <a href="{{ url('?page=std05') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            5. ตามเดือน และช่วงเวลาที่เกิดเหตุ
                                        </a>
                                        <a href="{{ url('?page=std06') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            6. ตามเขตสุขภาพ
                                        </a>
                                        <a href="{{ url('?page=std07') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            7. ตามเขตสุขภาพ (อัตรา)
                                        </a>
                                        <a href="{{ url('?page=std08') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            8. ภาพรวมเขต
                                        </a>
                                        <a href="{{ url('?page=std09') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            9. อัตราผู้เสียชีวิตต่อแสนประชากร รายจังหวัด
                                        </a>
                                        <a href="{{ url('?page=std10') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">

                                            10. แผนที่แสดงจำนวน
                                        </a>
                                        <a href="{{ url('?page=std11') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            11. อันดับของอัตราผู้เสียชีวิตต่อแสนประชากร
                                        </a>
                                    </div>
                                </div>

                                <!-- Authentication links -->
                                <div x-data="{ isActive: false, open: false}">
                                    <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                                    <a href="#" @click="$event.preventDefault(); open = !open"
                                        class="flex items-center p-2 text-gray-500 transition-colors rounded-md dark:text-light hover:bg-blue-100 dark:hover:bg-blue-600"
                                        :class="{'bg-blue-100 dark:bg-blue-600': isActive || open}" role="button"
                                        aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
                                        <span aria-hidden="true">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </span>
                                        <span class="ml-2 text-sm"> ระบบประมวลผล </span>
                                        <span aria-hidden="true" class="ml-auto">
                                            <!-- active class 'rotate-180' -->
                                            <svg class="w-4 h-4 transition-transform transform"
                                                :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </span>
                                    </a>
                                    <div x-show="open" class="mt-2 space-y-2 px-7" role="menu"
                                        aria-label="Authentication">
                                        <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                                        <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->


                                        @auth
                                        <a href="{{ url('/dashboard') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            ระบบบูรณาการ
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}" role="menuitem"
                                            class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md dark:hover:text-light hover:text-gray-700">
                                            เข้าสู่ระบบ (สำหรับเจ้าหน้าที่)
                                        </a>
                                        {{--   @if (Route::has('register'))
                                        <a href="{{ route('register') }}" role="menuitem"
                                        class="block p-2 text-sm text-gray-400 transition-colors duration-200 rounded-md
                                        dark:hover:text-light hover:text-gray-700">
                                        ลงทะเบียน
                                        </a>
                                        @endif --}}
                                        @endauth


                                    </div>
                                </div>
                        </nav>

                    </div>
                </header>


                <div
                    class="space-x-2 bg-blue-50 p-4 rounded flex items-start text-blue-600 my-4 shadow-lg mx-auto max-w-2xl">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.5 5h3l-1 10h-1l-1-10zm1.5 14.25c-.69 0-1.25-.56-1.25-1.25s.56-1.25 1.25-1.25 1.25.56 1.25 1.25-.56 1.25-1.25 1.25z" />
                        </svg>
                    </div>
                    <h3 class="text-blue-800 tracking-wider flex-1">
                        ข้อมูลผู้เสียชีวิตล่าสุดในฐานข้อมูลคือ
                        @php //
                        $lastdata = App\Models\Integration_final::latest('DeadDate_en')->first();
                        //echo $lastdata['DeadDate_en'] ;
                        @endphp
                        {{ Carbon\Carbon::parse($lastdata['DeadDate_en'])->addYear(543)->format('d/m/Y') }}
                    </h3>

                </div>




                @if(empty($_GET['page']))

                <div class="m-10 bg-white p-5 shadow-2xl">

                    <div class="grid grid-cols-1">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500">
                                    <path
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#"
                                        class="underline text-gray-900 dark:text-white">ความเป็นมา </a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <p> ระบบข้อมูลเป็นหัวใจสำคัญในการผลักดันให้เกิดกระแสการป้องกันอุบัติเหตุทางถนนในระดับชาติและการขับเคลื่อนยุทศาสตร์การดำเนินงานต่างๆ
                                        การจัดทำแผนงาน โครงการที่ดีนั้น
                                        จะต้องอาศัยข้อมูลสถานการณ์ที่สามารถมองเห็นแนวโน้มความรุนแรงของปัญหา
                                        ทำให้ทราบถึงสาเหตุและปัจจัยที่ทำให้เกิดอุบัติเหตุทางถนน
                                        เพื่อนำไปสู่การแก้ไขปัญหาอย่างเป็นรูปธรรม
                                        แต่ในปัจจุบันข้อมูลที่นำมาใช้มาจากหลายหน่วยงาน
                                        มีวัตถุประสงค์ในการเก็บข้อมูลแตกต่างกัน
                                        ทำให้ข้อมูลจำนวนผู้บาดเจ็บและเสียชีวิตแตกต่างกันไป
                                        และไม่มีข้อมูลจากหน่วยงานใดที่มีความครอบคลุม ครบถ้วน
                                        จึงได้ทำการบูรณาการข้อมูลการตายจากข้อมูล 3 ฐาน ได้แก่
                                        ข้อมูลจากมรณบัตรและหนังสือรับรองการตาย
                                        เป็นระบบลงทะเบียนการตายของผู้เสียชีวิตทุกรายที่มีการแจ้งตาย ข้อมูลจากระบบ POLIS
                                        เป็นระบบบันทึกข้อมูลคดี และข้อมูลจากระบบ E-Claim
                                        เป็นระบบบันทึกข้อมูลสำหรับเบิกจ่ายเงินค่าสินไหมทดแทนส่วนใหญ่เป็นรถจักรยานยนต์
                                        เพื่อให้ได้ข้อมูลการตายที่มีความครอบคลุมมากที่สุด</p>
                                    <p>
                                        จากปัญหาที่เกิดขึ้น ทำให้ข้อมูลของประเทศไทยไม่เป็นที่น่าเชื่อถือ
                                        ศูนย์อำนวยการความปลอดภัยทางถนนเห็นถึงความสำคัญ
                                        จึงแต่งตั้งคณะอนุกรรมการด้านบริหารจัดการข้อมูล ติดตาม ประเมินผล
                                        โดยมีนายแพทย์นพพร
                                        ชื่นกลิ่น รองอธิบดีกรมควบคุมโรคเป็นประธาน และสำนักโรคไม่ติดต่อเป็นฝ่ายเลขานุการ
                                        ประกอบกับมติคณะรัฐมนตรี เมื่อวันที่ 29 กันยายน 2553
                                        ได้มอบหมายให้กระทรวงสาธารณสุขเป็นแกนหลัก ในการประสานหน่วยงานที่เกี่ยวข้อง
                                        เพื่อปรับปรุงการดำเนินการจัดเก็บข้อมูล และสถิติการเกิดอุบัติเหตุ
                                        ทางถนนของหน่วยงานต่างๆ ให้เป็นระบบ มีความถูกต้อง และเป็นเอกภาพ
                                        เพื่อให้ได้ข้อมูลที่มีประสิทธิภาพในการกำหนดนโยบาย / แผนงาน และมาตรการที่ดี
                                        รวมทั้งใช้ในการติดตาม ประเมินผล
                                        และกำกับตัวชี้วัดการดำเนินงานทศวรรษแห่งความปลอดภัยทางถนน
                                        ตลอดจนใช้ในการผลักดันนโยบาย
                                    </p>
                                    <p>
                                        จากมติคณะอนุกรรมการด้านบริหารจัดการข้อมูลฯ
                                        ให้มีการบูรณาการข้อมูลการตายจากอุบัติเหตุทางถนน โดยใช้ข้อมูลจาก 3 หน่วยงาน
                                        (สาธารณสุข ตำรวจ และบริษัทกลางฯ) จึงได้แต่งตั้งคณะทำงานขึ้นมา 2 คณะ คือ
                                        คณะทำงานออกแบบระบบบริหารจัดการข้อมูล(System Design)
                                        และคณะทำงานออกแบบการประมวลผลและรายงาน (output design) เริ่มดำเนินการมาตั้งแต่ปี
                                        2556
                                        เป็นต้นมา ซึ่งได้ดำเนินการกิจกรรมต่างๆมาอย่างต่อเนื่อง
                                        มีการปรับเปลี่ยนผู้รับผิดชอบของแต่ละหน่วยงานหลายท่าน ตลอดระยะเวลา 3 ปี
                                        จนกระทั่งการดำเนินงานประสบผลสำเร็จและจะนำเสนอข้อมูลดังกล่าวให้เป็น based line
                                        ของทศวรรษแห่งความปลอดภัยทางถนนที่เป็นภาพรวมการดำเนินงานของประเทศต่อไป
                                    </p>



                                </div>
                            </div>





                        </div>


                    </div>
                </div>


                @else

                <div class="resp-container">
                    @if(empty($_GET['page']))
                    <iframe class="resp-iframe" src="https://dip.ddc.moph.go.th/rti_dashboard/view/rtddi/std01.php"
                        gesture="media" allow="encrypted-media" allowfullscreen="allowfullscreen"></iframe>

                    @else
                    <iframe class="resp-iframe"
                        src="https://dip.ddc.moph.go.th/rti_dashboard/view/rtddi/{{$_GET['page']}}.php" gesture="media"
                        allow="encrypted-media" allowfullscreen="allowfullscreen"></iframe>
                    @endif
                </div>


                {{--   <img src="{{ asset('storage/logo.png') }}" class=" object-center" width="50%" /> --}}
                @endif



                <!-- Panels -->

                <!-- Settings Panel -->
                <!-- Backdrop -->
                <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    x-show="isSettingsPanelOpen" @click="isSettingsPanelOpen = false"
                    class="fixed inset-0 z-10 bg-blue-800" style="opacity: 0.5" aria-hidden="true"></div>
                <!-- Panel -->
                <section x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                    x-ref="settingsPanel" tabindex="-1" x-show="isSettingsPanelOpen"
                    @keydown.escape="isSettingsPanelOpen = false"
                    class="fixed inset-y-0 right-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none"
                    aria-labelledby="settinsPanelLabel">
                    <div class="absolute left-0 p-2 transform -translate-x-full">
                        <!-- Close button -->
                        <button @click="isSettingsPanelOpen = false"
                            class="p-2 text-white rounded-md focus:outline-none focus:ring">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Panel content -->
                    <div class="flex flex-col h-screen">
                        <!-- Panel header -->
                        <div
                            class="flex flex-col items-center justify-center flex-shrink-0 px-4 py-8 space-y-4 border-b dark:border-blue-700">
                            <span aria-hidden="true" class="text-gray-500 dark:text-blue-600">
                                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </span>
                            <h2 id="settinsPanelLabel" class="text-xl font-medium text-gray-500 dark:text-light">
                                Settings
                            </h2>
                        </div>
                        <!-- Content -->
                        <div class="flex-1 overflow-hidden hover:overflow-y-auto">
                            <!-- Theme -->
                            <div class="p-4 space-y-4 md:p-8">
                                <h6 class="text-lg font-medium text-gray-400 dark:text-light">Mode</h6>
                                <div class="flex items-center space-x-8">
                                    <!-- Light button -->
                                    <button @click="setLightTheme"
                                        class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-blue-700 dark:hover:text-blue-100 dark:hover:border-blue-500 focus:outline-none focus:ring focus:ring-blue-400 dark:focus:ring-indigo-700"
                                        :class="{ 'border-gray-900 text-gray-900 dark:border-blue-500 dark:text-blue-100': !isDark, 'text-gray-500 dark:text-blue-500': isDark }">
                                        <span>
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        </span>
                                        <span>Light</span>
                                    </button>

                                    <!-- Dark button -->
                                    <button @click="setDarkTheme"
                                        class="flex items-center justify-center px-4 py-2 space-x-4 transition-colors border rounded-md hover:text-gray-900 hover:border-gray-900 dark:border-blue-700 dark:hover:text-indigo-100 dark:hover:border-blue-500 focus:outline-none focus:ring focus:ring-blue-400 dark:focus:ring-blue-700"
                                        :class="{ 'border-gray-900 text-gray-900 dark:border-blue-500 dark:text-blue-100': isDark, 'text-gray-500 dark:text-blue-500': !isDark }">
                                        <span>
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                            </svg>
                                        </span>
                                        <span>Dark</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Notification panel -->
                <!-- Backdrop -->
                <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    x-show="isNotificationsPanelOpen" @click="isNotificationsPanelOpen = false"
                    class="fixed inset-0 z-10 bg-blue-800 bg-opacity-25" style="opacity: .5;" aria-hidden="true"></div>
                <!-- Panel -->
                <section x-cloak x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-ref="notificationsPanel" x-show="isNotificationsPanelOpen"
                    @keydown.escape="isNotificationsPanelOpen = false" tabindex="-1"
                    aria-labelledby="notificationPanelLabel"
                    class="fixed inset-y-0 z-20 w-full max-w-xs bg-white dark:bg-darker dark:text-light sm:max-w-md focus:outline-none">
                    <div class="absolute right-0 p-2 transform translate-x-full">
                        <!-- Close button -->
                        <button @click="isNotificationsPanelOpen = false"
                            class="p-2 text-white rounded-md focus:outline-none focus:ring">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex flex-col h-screen" x-data="{ activeTabe: 'action' }">
                        <!-- Panel header -->
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-between px-4 pt-4 border-b dark:border-blue-800">
                                <h2 id="notificationPanelLabel" class="pb-4 font-semibold">Notifications</h2>
                                <div class="space-x-2">
                                    <button @click.prevent="activeTabe = 'action'"
                                        class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                        :class="{'border-blue-700 dark:border-blue-600': activeTabe == 'action', 'border-transparent': activeTabe != 'action'}">
                                        Action
                                    </button>
                                    <button @click.prevent="activeTabe = 'user'"
                                        class="px-px pb-4 transition-all duration-200 transform translate-y-px border-b focus:outline-none"
                                        :class="{'border-blue-700 dark:border-blue-600': activeTabe == 'user', 'border-transparent': activeTabe != 'user'}">
                                        User
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Panel content (tabs) -->
                        <div class="flex-1 pt-4 overflow-y-hidden hover:overflow-y-auto">
                            <!-- Action tab -->
                            <div class="space-y-4" x-show.transition.in="activeTabe == 'action'">
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span
                                                class="z-10 inline-block p-2 overflow-visible text-blue-500 rounded-full bg-blue-50 dark:bg-blue-800">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                                New project "KWD Dashboard" created
                                            </h5>
                                            <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                Looks like there might be a new theme soon
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 9h ago
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span
                                                class="inline-block p-2 overflow-visible text-blue-500 rounded-full bg-blue-50 dark:bg-blue-800">
                                                <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                                KWD Dashboard v0.0.2 was released
                                            </h5>
                                            <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                Successful new version was released
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 2d ago
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <template x-for="i in 20" x-key="i">
                                    <a href="#" class="block">
                                        <div class="flex px-4 space-x-4">
                                            <div class="relative flex-shrink-0">
                                                <span
                                                    class="inline-block p-2 overflow-visible text-blue-500 rounded-full bg-blue-50 dark:bg-blue-800">
                                                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                    </svg>
                                                </span>
                                                <div
                                                    class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                                </div>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                                                    New project "KWD Dashboard" created
                                                </h5>
                                                <p
                                                    class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                    Looks like there might be a new theme soon
                                                </p>
                                                <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 9h
                                                    ago
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>

                            <!-- User tab -->
                            <div class="space-y-4" x-show.transition.in="activeTabe == 'user'">
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                                <img class="object-cover rounded-full w-9 h-9"
                                                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                    alt="Ahmed kamel" />
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel
                                            </h5>
                                            <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                Shared new project "K-WD Dashboard"
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 1d ago
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                                <img class="object-cover rounded-full w-9 h-9"
                                                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                    alt="Ahmed kamel" />
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel
                                            </h5>
                                            <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                Commit new changes to K-WD Dashboard project.
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 10h ago
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="block">
                                    <div class="flex px-4 space-x-4">
                                        <div class="relative flex-shrink-0">
                                            <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                                <img class="object-cover rounded-full w-9 h-9"
                                                    src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                    alt="Ahmed kamel" />
                                            </span>
                                            <div
                                                class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                            </div>
                                        </div>
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel
                                            </h5>
                                            <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                Release new version "K-WD Dashboard"
                                            </p>
                                            <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 20d ago
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <template x-for="i in 10" x-key="i">
                                    <a href="#" class="block">
                                        <div class="flex px-4 space-x-4">
                                            <div class="relative flex-shrink-0">
                                                <span class="relative z-10 inline-block overflow-visible rounded-ful">
                                                    <img class="object-cover rounded-full w-9 h-9"
                                                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                                        alt="Ahmed kamel" />
                                                </span>
                                                <div
                                                    class="absolute h-24 p-px -mt-3 -ml-px bg-blue-50 left-1/2 dark:bg-blue-800">
                                                </div>
                                            </div>
                                            <div class="flex-1 overflow-hidden">
                                                <h5 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed
                                                    Kamel
                                                </h5>
                                                <p
                                                    class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                                    Release new version "K-WD Dashboard"
                                                </p>
                                                <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> 20d
                                                    ago
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Search panel -->
                <!-- Backdrop -->
                <div x-transition:enter="transition duration-300 ease-in-out" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300 ease-in-out"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="isSearchPanelOpen"
                    @click="isSearchPanelOpen = false" class="fixed inset-0 z-10 bg-blue-800 bg-opacity-25"
                    style="opacity: .5;" aria-hidden="ture"></div>
                <!-- Panel -->
                <section x-cloak x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    x-show="isSearchPanelOpen" @keydown.escape="isSearchPanelOpen = false"
                    class="fixed inset-y-0 z-20 w-full max-w-xs bg-white shadow-xl dark:bg-darker dark:text-light sm:max-w-md focus:outline-none">
                    <div class="absolute right-0 p-2 transform translate-x-full">
                        <!-- Close button -->
                        <button @click="isSearchPanelOpen = false"
                            class="p-2 text-white rounded-md focus:outline-none focus:ring">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <h2 class="sr-only">Search panel</h2>
                    <!-- Panel content -->
                    <div class="flex flex-col h-screen">
                        <!-- Panel header (Search input) -->
                        <div
                            class="relative flex-shrink-0 px-4 py-8 text-gray-400 border-b dark:border-blue-800 dark:focus-within:text-light focus-within:text-gray-700">
                            <span class="absolute inset-y-0 inline-flex items-center px-4">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input x-ref="searchInput" type="text"
                                class="w-full py-2 pl-10 pr-4 border rounded-full dark:bg-dark dark:border-transparent dark:text-light focus:outline-none focus:ring"
                                placeholder="Search..." />
                        </div>

                        <!-- Panel content (Search result) -->
                        <div class="flex-1 px-4 pb-4 space-y-4 overflow-y-hidden font-sans h hover:overflow-y-auto">
                            <h3 class="py-2 text-sm font-semibold text-gray-600 dark:text-light">History</h3>
                            <a href="#" class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-lg"
                                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                        alt="Post cover" />
                                </div>
                                <div class="flex-1 max-w-xs overflow-hidden">
                                    <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Header</h4>
                                    <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                        Lorem ipsum dolor, sit amet consectetur.
                                    </p>
                                    <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> Post </span>
                                </div>
                            </a>
                            <a href="#" class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-lg"
                                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                        alt="Ahmed Kamel" />
                                </div>
                                <div class="flex-1 max-w-xs overflow-hidden">
                                    <h4 class="text-sm font-semibold text-gray-600 dark:text-light">Ahmed Kamel</h4>
                                    <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                        Last activity 3h ago.
                                    </p>
                                    <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> Offline </span>
                                </div>
                            </a>
                            <a href="#" class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-10 h-10 rounded-lg"
                                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                        alt="K-WD Dashboard" />
                                </div>
                                <div class="flex-1 max-w-xs overflow-hidden">
                                    <h4 class="text-sm font-semibold text-gray-600 dark:text-light">K-WD Dashboard</h4>
                                    <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    </p>
                                    <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> Updated 3h ago.
                                    </span>
                                </div>
                            </a>
                            <template x-for="i in 10" x-key="i">
                                <a href="#" class="flex space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-lg"
                                            src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                                            alt="K-WD Dashboard" />
                                    </div>
                                    <div class="flex-1 max-w-xs overflow-hidden">
                                        <h4 class="text-sm font-semibold text-gray-600 dark:text-light">K-WD Dashboard
                                        </h4>
                                        <p class="text-sm font-normal text-gray-400 truncate dark:text-blue-400">
                                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                        </p>
                                        <span class="text-sm font-normal text-gray-400 dark:text-blue-500"> Updated 3h
                                            ago.
                                        </span>
                                    </div>
                                </a>
                            </template>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@0.6.x/dist/component.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

        <script>
            const setup = () => {
            const getTheme = () => {
              if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
              }
              return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
            }
    
            const setTheme = (value) => {
              window.localStorage.setItem('dark', value)
            }
    
            return {
              loading: true,
              isDark: getTheme(),
              toggleTheme() {
                this.isDark = !this.isDark
                setTheme(this.isDark)
              },
              setLightTheme() {
                this.isDark = false
                setTheme(this.isDark)
              },
              setDarkTheme() {
                this.isDark = true
                setTheme(this.isDark)
              },
              isSettingsPanelOpen: false,
              openSettingsPanel() {
                this.isSettingsPanelOpen = true
                this.$nextTick(() => {
                  this.$refs.settingsPanel.focus()
                })
              },
              isNotificationsPanelOpen: false,
              openNotificationsPanel() {
                this.isNotificationsPanelOpen = true
                this.$nextTick(() => {
                  this.$refs.notificationsPanel.focus()
                })
              },
              isSearchPanelOpen: false,
              openSearchPanel() {
                this.isSearchPanelOpen = true
                this.$nextTick(() => {
                  this.$refs.searchInput.focus()
                })
              },
              isMobileSubMenuOpen: false,
              openMobileSubMenu() {
                this.isMobileSubMenuOpen = true
                this.$nextTick(() => {
                  this.$refs.mobileSubMenu.focus()
                })
              },
              isMobileMainMenuOpen: false,
              openMobileMainMenu() {
                this.isMobileMainMenuOpen = true
                this.$nextTick(() => {
                  this.$refs.mobileMainMenu.focus()
                })
              },
            }
          }
        </script>
        </body>

</html>
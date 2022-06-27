<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">


        <div class="space-x-2 bg-blue-50 p-4 rounded flex items-start text-blue-600 my-4 shadow-lg mx-auto max-w-2xl">
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
            <div class="inline-flex items-center space-x-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-4 pt-1" viewBox="0 0 24 24">
                    <path
                        d="M13.025 1l-2.847 2.828 6.176 6.176h-16.354v3.992h16.354l-6.176 6.176 2.847 2.828 10.975-11z" />
                </svg>
            </div>
        </div>

        @if ($page=='std01')
        <div class="resp-container"><iframe class="resp-iframe"
                src="https://dip.ddc.moph.go.th/rti_dashboard/view/rtddi/std01.php" gesture="media"
                allow="encrypted-media" allowfullscreen="allowfullscreen"></iframe></div>
        @elseif ($page=='adv01')
        <div class="resp-container"><iframe class="resp-iframe"
                src="https://dip.ddc.moph.go.th/rti_dashboard/view/rtddi/adv01.php" gesture="media"
                allow="encrypted-media" allowfullscreen="allowfullscreen"></iframe></div>
        @elseif ($page=='seven')
        {{ $page }}
        @endif





    </div>


</x-app-layout>
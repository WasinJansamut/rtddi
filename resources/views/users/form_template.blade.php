@section('title','ข้อมูลผู้ใช้')
@section('subtitle',Request::path() )
<x-app-layout>

    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">จัดการข้อมูลผู้ใช้งาน</h3>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">


                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">








                    </div>
                    <!--/Card-->
                </div>


            </div>
        </div>





</x-app-layout>
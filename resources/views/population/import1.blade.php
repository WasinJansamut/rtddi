@section('title','Import1')
@section('subtitle',Request::path() )
<x-app-layout>

    <style>
        input.text {
            focus: ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300
        }
    </style>
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">นำเข้าข้อมูลจำนวนประชากร</h3>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">

                    @if ($errors->any())
                    <div class="px-4 py-3 leading-normal text-white-700 bg-red-100 rounded-lg" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <!--Card-->
                    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


                        <div> <a href="{{ asset('storage/template/population_template.xlsx') }}">
                                <h1 class="mb-4 text-center font-black text-gray-700 text-xl">>> Download Template
                                    ที่นี่
                                    <<</h1> </a> <div class="flex">
                                        <div class="w-1/3 text-center px-6">
                                            <div
                                                class="bg-green-300 rounded-lg flex items-center justify-center border border-gray-200">
                                                <div
                                                    class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="w-2/3 bg-green-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                                    <h2 class="font-bold text-lg">1. อัพโหลด</h2>
                                                    <p class="text-xs text-gray-600">
                                                        อัพโหลดไฟล์ Excel หรือ CSV ตามที่กำหนด
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" />
                                            </svg>
                                        </div>
                                        <div class="w-1/3 text-center px-6">
                                            <div
                                                class="bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200">
                                                <div
                                                    class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                                    <h2 class="font-bold text-lg">2. เช็คข้อมูล</h2>
                                                    <p class="text-xs text-gray-600">
                                                        เช็คข้อมูลว่าถูกต้องหรือไม่ หากถูกต้องให้กดบันทึก
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" />
                                            </svg>
                                        </div>
                                        <div class="w-1/3 text-center px-6">
                                            <div
                                                class="bg-gray-300 rounded-lg flex items-center justify-center border border-gray-200">
                                                <div
                                                    class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                                                        </path>
                                                    </svg>
                                                </div>
                                                <div
                                                    class="w-2/3 bg-gray-200 h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                                                    <h2 class="font-bold text-lg">3. เสร็จสิ้น</h2>
                                                    <p class="text-xs text-gray-600">
                                                        แสดงจำนวนข้อมูลที่ถูกนำเข้า
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                    </div>


                </div>
                <!--/Card-->

                <br>

                <!--Card-->
                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">



                    <form action="{{ route('import') }}" method="POST" id="import1" enctype="multipart/form-data">
                        @csrf


                        <div class="bg-white p7 rounded w-9/12 mx-auto">
                            <div x-data="dataFileDnD()"
                                class="relative flex flex-col p-4 text-gray-400 border border-gray-200 rounded">
                                <div x-ref="dnd"
                                    class="relative flex flex-col text-gray-400 border border-gray-200 border-dashed rounded cursor-pointer">


                                    {{--  <input type="file" name="file" class="form-control"> --}}

                                    @error('file')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror

                                    <input accept="*" type="file"
                                        class="absolute inset-0 z-50 w-full h-full p-0 m-0 outline-none opacity-0 cursor-pointer"
                                        @change="addFiles($event)"
                                        @dragover="$refs.dnd.classList.add('border-blue-400'); $refs.dnd.classList.add('ring-4'); $refs.dnd.classList.add('ring-inset');"
                                        @dragleave="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                        @drop="$refs.dnd.classList.remove('border-blue-400'); $refs.dnd.classList.remove('ring-4'); $refs.dnd.classList.remove('ring-inset');"
                                        title="" name="file" />

                                    <div class="flex flex-col items-center justify-center py-10 text-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12">
                                            </path>
                                        </svg>
                                        <p class="m-0">ลากไฟล์เข้ามาหรือคลิกเพื่อเลือกไฟล์ที่ต้องการ ( ไฟล์ xlsx , xls ,
                                            csv เท่านั้น)</p>
                                    </div>
                                </div>
                                <template x-if="files.length > 0">
                                    <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-6" @drop.prevent="drop($event)"
                                        @dragover.prevent="$event.dataTransfer.dropEffect = 'move'">
                                        <template x-for="(_, index) in Array.from({ length: files.length })">
                                            <div class="relative flex flex-col items-center overflow-hidden text-center bg-gray-100 border rounded cursor-move select-none"
                                                style="padding-top: 100%;" @dragstart="dragstart($event)"
                                                @dragend="fileDragging = null"
                                                :class="{'border-blue-600': fileDragging == index}" draggable="true"
                                                :data-index="index">
                                                <button
                                                    class="absolute top-0 right-0 z-50 p-1 bg-white rounded-bl focus:outline-none"
                                                    type="button" @click="remove(index)">
                                                    <svg class="w-4 h-4 text-gray-700"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                                <template x-if="files[index].type.includes('audio/')">
                                                    <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                                                    </svg>
                                                </template>
                                                <template
                                                    x-if="files[index].type.includes('application/') || files[index].type === ''">
                                                    <svg class="absolute w-12 h-12 text-gray-400 transform top-1/2 -translate-y-2/3"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                </template>
                                                <template x-if="files[index].type.includes('image/')">
                                                    <img class="absolute inset-0 z-0 object-cover w-full h-full border-4 border-white preview"
                                                        x-bind:src="loadFile(files[index])" />
                                                </template>
                                                <template x-if="files[index].type.includes('video/')">
                                                    <video
                                                        class="absolute inset-0 object-cover w-full h-full border-4 border-white pointer-events-none preview">
                                                        <fileDragging x-bind:src="loadFile(files[index])"
                                                            type="video/mp4">
                                                    </video>
                                                </template>

                                                <div
                                                    class="absolute bottom-0 left-0 right-0 flex flex-col p-2 text-xs bg-white bg-opacity-50">
                                                    <span class="w-full font-bold text-gray-900 truncate"
                                                        x-text="files[index].name">Loading</span>
                                                    <span class="text-xs text-gray-900"
                                                        x-text="humanFileSize(files[index].size)">...</span>
                                                </div>

                                                <div class="absolute inset-0 z-40 transition-colors duration-300"
                                                    @dragenter="dragenter($event)" @dragleave="fileDropping = null"
                                                    :class="{'bg-blue-200 bg-opacity-80': fileDropping == index && fileDragging != index}">
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>


                        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800  p-4 shadow-lg max-w-2xl">
                            {{-- 
                            <textarea class="description sec p-3 h-20 border border-gray-300 outline-none"
                                spellcheck="false" placeholder="Note..."></textarea>
                            <br> --}}
                            <a class="btn btn-warning" href="{{ route('export') }}">ก่อน Import สำรองข้อมูลได้ที่นี่
                                Click ! </a>
                        </div>

                        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer>
                        </script>
                        <script src="https://unpkg.com/create-file-list"></script>
                        <script>
                            function dataFileDnD() {
                            return {
                                files: [],
                                fileDragging: null,
                                fileDropping: null,
                                humanFileSize(size) {
                                    const i = Math.floor(Math.log(size) / Math.log(1024));
                                    return (
                                        (size / Math.pow(1024, i)).toFixed(2) * 1 +
                                        " " +
                                        ["B", "kB", "MB", "GB", "TB"][i]
                                    );
                                },
                                remove(index) {
                                    let files = [...this.files];
                                    files.splice(index, 1);
                        
                                    this.files = createFileList(files);
                                },
                                drop(e) {
                                    let removed, add;
                                    let files = [...this.files];
                        
                                    removed = files.splice(this.fileDragging, 1);
                                    files.splice(this.fileDropping, 0, ...removed);
                        
                                    this.files = createFileList(files);
                        
                                    this.fileDropping = null;
                                    this.fileDragging = null;
                                },
                                dragenter(e) {
                                    let targetElem = e.target.closest("[draggable]");
                        
                                    this.fileDropping = targetElem.getAttribute("data-index");
                                },
                                dragstart(e) {
                                    this.fileDragging = e.target
                                        .closest("[draggable]")
                                        .getAttribute("data-index");
                                    e.dataTransfer.effectAllowed = "move";
                                },
                                loadFile(file) {
                                    const preview = document.querySelectorAll(".preview");
                                    const blobUrl = URL.createObjectURL(file);
                        
                                    preview.forEach(elem => {
                                        elem.onload = () => {
                                            URL.revokeObjectURL(elem.src); // free memory
                                        };
                                    });
                        
                                    return blobUrl;
                                },
                                addFiles(e) {
                                    const files = createFileList([...this.files], [...e.target.files]);
                                    this.files = files;
                                    this.form.formData.files = [...files];
                                }
                            };
                        }
                        </script>





                        <div class="row">
                            <div class="w-full mx-auto">
                                <div class="sm:grid grid-cols-4 gap-5 mx-auto px-16">
                                    <div class="col-start-1 col-end-3 my-2">
                                        <a href="{{ url('population')}}">
                                            <div
                                                class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md">
                                                <h3 class="text-2xl mb-3 font-semibold inline-flex">
                                                    <svg class="mr-2" width="24" height="30" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.02698 11.9929L5.26242 16.2426L6.67902 14.8308L4.85766 13.0033L22.9731 13.0012L22.9728 11.0012L4.85309 11.0033L6.6886 9.17398L5.27677 7.75739L1.02698 11.9929Z"
                                                            fill="currentColor" /></svg>
                                                    ย้อนกลับ
                                                </h3>
                                                <p class="text-lg">ไปหน้าข้อมูลประชากร</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-end-5 col-span-2 my-2">
                                        <a href="#" onclick="document.getElementById('import1').submit();">
                                            <div
                                                class="h-full p-6 dark:bg-gray-800 bg-white hover:shadow-xl rounded border-b-4 border-red-500 shadow-md text-right">
                                                <h3 class="text-2xl mb-3 font-semibold inline-flex ">
                                                    อัพโหลด

                                                    <svg class="ml-2" width="24" height="30" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M23.0677 11.9929L18.818 7.75739L17.4061 9.17398L19.2415 11.0032L0.932469 11.0012L0.932251 13.0012L19.2369 13.0032L17.4155 14.8308L18.8321 16.2426L23.0677 11.9929Z"
                                                            fill="currentColor" /></svg>
                                                </h3>
                                                <p class="text-lg">เพื่อตรวจสอบข้อมูลก่อนนำเข้า</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>


                </div>
                <!--/Card-->


            </div>


        </div>
    </div>


    </div>


</x-app-layout>
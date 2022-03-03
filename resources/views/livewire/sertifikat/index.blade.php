<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            {{ Form::select('status',$statuses,null,['class' => 'w-full py-2.5 px-4 text-sm text-gray-600 rounded-xl focus:outline-none mb-2 shadow-md','id' => 'status','wire:model'=>'status'])}}
        </div>

        <div style="display:none" x-data="{show: false}" x-show.transition.opacity.out.duration.1500ms="show" x-init="@this.on('saved',() => {show = true; setTimeout(()=>{show=false;},2000)})" class="px-6 py-2 mt-4" id="alert">
            <div>
                @if(session()->has('info'))
                    <h1 class="text-sm text-green-500">{{ session('info') }}</h1>
                @elseif(session()->has('delete'))
                    <h1 class="text-sm text-red-500">{{ session('delete') }}</h1>
                @endif
            </div>
        </div>

        @if ($isUpdate)
            @include('livewire.sertifikat.confirm')
        @endif

        @if ($isLaporan)
            @include('livewire.sertifikat.audit.laporan')
        @endif

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class=" px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID REG
                                </th>
                                <th scope="col" class=" px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA PU
                                </th>
                                <th scope="col" class="hidden sm:table-cell px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NO DAFTAR
                                </th>
                                <th scope="col" class="hidden md:table-cell px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA JENIS DAFTAR
                                </th>
                                <th scope="col" class="hidden sm:table-cell px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA JENIS USAHA
                                </th>
                                {{-- <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA JENIS LAYANAN
                                </th> --}}
                                <th scope="col" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($permohonans as $permohonan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['id_reg'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['nama_pu'] }}
                                    </td>

                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['no_daftar'] }}
                                    </td>

                                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['nama_jenis_daftar'] }}
                                    </td>

                                    <td class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['nama_jenis_usaha'] }}
                                    </td>

                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $permohonan['nama_jenis_layanan'] }}
                                    </td> --}}

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        @if ($status==10020)
                                            <button onclick="location.href=' {{ route( 'dbiaya',[$permohonan['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="mx-1">Biaya</span>
                                                </div>
                                        </button>
                                        @endif
                                        @if ($status==10030)
                                            <button onclick="location.href=' {{ route( 'daudit',[$permohonan['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                                    </svg>
                                                    <span class="mx-1">Audit</span>
                                                </div>
                                            </button>
                                        @endif
                                        @if ($status==10040)
                                            <button onclick="location.href=' {{ route( 'haudit',[$permohonan['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="mx-1">Laporan</span>
                                                </div>
                                            </button>
                                        @endif
                                        <button onclick="location.href=' {{ route( 'dreg',[$permohonan['id_reg'],$status] ) }} '"class="mx-2 bg-yellow-400 hover:bg-yellow-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                                </svg>
                                                <span class="mx-1">Detail</span>
                                            </div>
                                        </button>
                                        @if ($status==10030)
                                            <button wire:click="openUpdate({{ $permohonan['id_reg'] }})"class="mx-2 bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                                    </svg>
                                                    <span class="mx-1">Update</span>
                                                </div>
                                            </button>
                                        @endif
                                        @if (in_array($status,[10010,10020]))
                                            <button wire:click="showUpdate({{ $permohonan['id_reg'] }})"class="mx-2 bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                                <div class="flex">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                                    </svg>
                                                    <span class="mx-1">Update</span>
                                                </div>
                                            </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="ml-4">
                            @if ($permohonans!=[])
                                {{ $permohonans->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

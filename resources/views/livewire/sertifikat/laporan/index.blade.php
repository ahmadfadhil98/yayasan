<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex w-full ">
            <div class="w-full md:w-2/3">
                <div class="flex">
                    <div class="text-xl font-bold text-gray-600">
                        {{ $reg['nama_pu'] }} ({{ $reg['id_reg'] }})
                    </div>
                </div>
            </div>
            <div class="w-full grid justify-items-end">
                <div class="flex">
                        <button wire:click="showLaporan()"class="mx-2 bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="mx-1">Add Laporan</span>
                            </div>
                        </button>
                </div>
            </div>
        </div>

        <div wire:loading>
            @include('loading')
        </div>

        @if ($isLaporan)
            @include('livewire.sertifikat.audit.laporan')
        @endif

        <div style="display:none" x-data="{show: false}" x-show.transition.opacity.out.duration.1500ms="show" x-init="@this.on('saved',() => {show = true; setTimeout(()=>{show=false;},2000)})" class="px-6 py-2 mt-4" id="alert">
            <div>
                @if(session()->has('info'))
                    <h1 class="text-sm text-green-500">{{ session('info') }}</h1>
                @elseif(session()->has('delete'))
                    <h1 class="text-sm text-red-500">{{ session('delete') }}</h1>
                @endif
            </div>
        </div>

        <div class="flex flex-col mt-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID Audit Hasil
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Selesai
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Hasil Audit
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($laporans)
                                    @foreach ($laporans as $laporan)
                                        @if ($laporan['id_reg']==$reg_id)
                                            <tr>
                                                <td class="relative px-6 py-4 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                                    {{ $laporan['id_audit_hasil'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-center text-sm leading-5 text-gray-500">
                                                    {{ $laporan['tgl_selesai'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                    {{ $laporan['keterangan'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                                    {{ $laporan['hasil_audit'] }}
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

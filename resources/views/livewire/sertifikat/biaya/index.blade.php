<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex">
                <div class="text-xl font-bold text-gray-600">
                    {{ $reg['nama_pu'] }} ({{ $reg['id_reg'] }})
                </div>
            </div>

            <div class="flex mt-4">
                <div class="w-full md:w-2/3">
                    <button wire:click="openModal()" class=" bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="mx-1">Add Biaya</span>
                        </div>
                    </button>
                    <button onclick="location.href=' {{ route( 'dreg',[$reg_id,$status] ) }} '" class="mx-2 bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            <span class="mx-1">Detail</span>
                        </div>
                    </button>
                    <button wire:click="showUpdate()" class=" bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                            </svg>
                            <span class="mx-1">Update</span>
                        </div>
                    </button>
                </div>
            </div>

        @if($isModal)
            @include('livewire.sertifikat.biaya.form')
        @endif

        @if($isDel)
            @include('layouts.delete')
        @endif

        @if($isUpdate)
            @include('livewire.sertifikat.confirm')
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
                                    ID BIAYA
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    KETERANGAN
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    QTY
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    HARGA
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TOTAL
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            @php
                                $total = 0;
                            @endphp
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($biayas as $biaya)
                                @php
                                    $total = $total + $biaya['total'];

                                    $keteranganApi = $biaya['keterangan'];
                                    $qtyApi = $biaya['qty'];
                                    $hargaApi = $biaya['harga'];
                                    $totalApi = $biaya['total'];
                                    $idBiayaApi = $biaya['id_biaya'];
                                @endphp
                                <tr>
                                    <td class="relative px-6 py-4 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $biaya['id_biaya'] }}
                                        {{-- @if ($notif->contains('id_biaya', $biaya['id_biaya']))
                                            <span class="badge mt-2">new</span>
                                        @endif --}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-center text-sm leading-5 text-gray-500">
                                        {{ $biaya['keterangan'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                        {{ $biaya['qty'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 text-center">
                                        {{ $biaya['harga'] }}
                                    </td>
                                    <td class="px-6 text-center py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{ $biaya['total'] }}
                                    </td>
                                    <td class="flex px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        <button wire:click="edit(
                                            {{ $idBiayaApi }},
                                            '{{ $keteranganApi }}',
                                            {{ $qtyApi }},
                                            {{ $hargaApi }}
                                        )" class="mx-2 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span class="mx-1">Edit</span>
                                            </div>
                                        </button>
                                        <button wire:click="showDel({{ $biaya['id_biaya'] }})" class="mx-2 bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                                <span class="mx-1">Hapus</span>
                                            </div>
                                        </button>
                                </tr>
                            @endforeach
                            @if ($total)
                                <tr>
                                    <td class="px-6 text-center py-4 whitespace-nowrap text-xl font-bold text-gray-900" colspan="4">
                                        Total
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xl font-bold text-gray-900">
                                        Rp. {{ number_format($total, 0, ',', '.') }} ,-
                                    </td>
                                    <td></td>
                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

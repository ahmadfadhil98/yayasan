<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <button wire:click="openModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">Add Biaya</button>
        </div>

        @if($isModal)
            @include('livewire.biaya.form')
        @endif

        @if($isDel)
            @include('layouts.delete')
        @endif

        @if($isUpdate)
            @include('livewire.update')
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

        <div class="flex flex-col">
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
                                    ID REG
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
                            @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $biaya['id_biaya'] }}
                                        @php
                                            $id_biayaApi = $biaya['id_biaya'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $biaya['id_reg'] }}
                                        @php
                                            $id_regApi = $biaya['id_reg'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $biaya['keterangan'] }}
                                        @php
                                            $keteranganApi = $biaya['keterangan'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $biaya['qty'] }}
                                        @php
                                            $qtyApi = $biaya['qty'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{-- {{ $biaya['harga'] }} --}}
                                        Rp. {{ number_format($biaya['harga'], 0, ',', '.') }} ,-
                                        @php
                                            $hargaApi = $biaya['harga'];
                                        @endphp

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        Rp. {{ number_format($biaya['total'], 0, ',', '.') }} ,-
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 border border-blue-500 rounded"
                                        wire:click="edit({{$id_biayaApi}},{{$id_regApi}},'{{$keteranganApi}}',{{$qtyApi}},{{$hargaApi}})"
                                        >Edit</button>
					                    <button wire:click="update({{$id_regApi}})" class="mx-2 bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-1 px-2 border border-amber-500 rounded">Update</button>
					                    <button wire:click="openDel({{$id_biayaApi}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">Delete</button>

                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="px-6 text-center py-4 whitespace-nowrap text-xl font-bold text-gray-900" colspan="5">
                                    Total
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-xl font-bold text-gray-900">
                                    Rp. {{ number_format($total, 0, ',', '.') }} ,-
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="flex">
                <div class="w-full md:w-2/3">
                    <div class="text-xl font-bold text-gray-600">
                        Referensi
                    </div>
                </div>
                <div class="flex w-full pl-5 text-gray-400 duration-300 transform border-2 border-gray-200 rounded-lg shadow-inner hover:scale-95 bg-gray-50 md:w-1/3">
                    @include('search')
                </div>
            </div>
        <div class="flex flex-col mt-10">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ref Id
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ref Group Id
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ref Desc
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    F Aktif
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ref Init
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Long Init
                                </th>
                                {{-- <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NAMA JENIS LAYANAN
                                </th> --}}
                                {{-- <th scope="col" class="px-6 py-3 bg-gray-50">

                                </th> --}}
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($references as $ref)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['ref_id'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['ref_group_id'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['ref_desc'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['f_aktif'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['ref_init'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $ref['long_init'] }}
                                    </td>

                                    {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        @if ($status==10020)
                                            <button onclick="location.href=' {{ route( 'dbiaya',[$permohonan['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">Biaya</button>
                                        @endif
                                        @if ($status==10030)
                                            <button onclick="location.href=' {{ route( 'daudit',[$permohonan['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">Audit</button>
                                        @endif
                                        <button onclick="location.href=' {{ route( 'dreg',[$permohonan['id_reg'],$status] ) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">Detail</button>
					                    <button wire:click="showUpdate({{ $permohonan['id_reg'] }})"class="mx-2 bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-1 px-2 border border-amber-500 rounded">Update</button>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $references->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

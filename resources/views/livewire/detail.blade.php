<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <div class="text-xl font-bold text-gray-600">
                    Detail Reg ~ {{ $reg['nama_pu'] }} ({{ $reg['id_reg'] }})
                </div>

        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <div class="min-w-full divide-y divide-gray-200 w-full">
                            <div class="grid grid-cols-2 gap-4 mx-10 my-4">
                                @foreach ($reg as $key => $item)
                                    @if ($key=='factories'||$key=='penyelia')
                                        <div class="col-span-2">
                                            <div class="text-gray-400">{{ucwords(str_replace('_', ' ', $key)) }}</div>
                                            @if ($item)
                                                <div class="mx-2">
                                                    <table>
                                                        @foreach ($item[0] as $kunci=>$items)
                                                            <tr>
                                                                <td class="text-gray-400">{{ucwords(str_replace('_', ' ', $kunci))}}</td>
                                                                <td class="px-4">{{$items}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            @else
                                                <div> {Belum ada} </div>
                                            @endif
                                        </div>
                                    @elseif ($key=='pu')
                                        <div>
                                            <div class="text-gray-400">{{ucwords(str_replace('_', ' ', $key))}}</div>
                                            @if ($item)
                                                <div class="mx-2">
                                                    <table>
                                                        @foreach ($item as $kunci=>$items)
                                                            <tr>
                                                                <td class="text-gray-400">{{ucwords(str_replace('_', ' ', $kunci))}}</td>
                                                                <td class="px-4">{{$items}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            @else
                                                <div> {Belum ada} </div>
                                            @endif
                                        </div>
                                    @elseif ($key=='products'||$key=='documents')
                                        <div class="col-span-2">
                                            <div class="text-gray-400">{{ucwords(str_replace('_', ' ', $key))}}</div>
                                            @if ($item)
                                                <div class="mx-2">
                                                    @php
                                                        $no=0;
                                                    @endphp
                                                    <table>
                                                        @foreach ($item as $items)
                                                            @if ($no==0)
                                                                <tr>
                                                                    @foreach ($items as $kunci=>$i)
                                                                        <td class="text-gray-400">{{ucwords(str_replace('_', ' ', $kunci))}}</td>
                                                                    @endforeach
                                                                </tr>
                                                                @php
                                                                    $no=1;
                                                                @endphp
                                                            @endif
                                                            <tr>
                                                                @foreach ($items as $kunci=>$i)
                                                                    <td class="px-4">{{$i}}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                    @php
                                                        $no=0;
                                                    @endphp
                                                </div>
                                            @else
                                                <div> {Belum ada} </div>
                                            @endif
                                        </div>
                                    @else
                                        <div>
                                            <div class="text-gray-400">{{ucwords(str_replace('_', ' ', $key))}}</div>
                                            @if ($item)
                                                <div>{{$item}}</div>
                                            @else
                                                <div> {Belum ada} </div>
                                            @endif
                                        </div>
                                    @endif

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

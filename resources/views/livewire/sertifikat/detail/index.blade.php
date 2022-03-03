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
                    @if ($status==10020)
                        <button onclick="location.href=' {{ route( 'dbiaya',[$reg['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="mx-1">Biaya</span>
                            </div>
                        </button>
                    @endif
                    @if ($status==10030)
                        <button onclick="location.href=' {{ route( 'daudit',[$reg['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                </svg>
                                <span class="mx-1">Audit</span>
                            </div>
                        </button>
                    @endif
                    @if ($status==10040)
                        <button onclick="location.href=' {{ route( 'haudit',[$reg['id_reg'],$status]) }} '"class="mx-2 bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="mx-1">Laporan</span>
                            </div>
                        </button>
                    @endif
                    @if ($status==10030)
                        <button wire:click="openUpdate({{ $reg['id_reg'] }})"class="mx-2 bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                </svg>
                                <span class="mx-1">Update</span>
                            </div>
                        </button>
                    @endif
                    @if (in_array($status,[10010,10020]))
                        <button wire:click="showUpdate({{ $reg['id_reg'] }})"class="mx-2 bg-indigo-500 hover:bg-indigo-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
                                </svg>
                                <span class="mx-1">Update</span>
                            </div>
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex bg-white mt-2">
            @foreach ($reg['pu'] as $key=>$item)
                <div class="w-full border-2 rounded p-1">
                    <div class="pt-2 text-gray-600 text-base rounded font-semibold text-center">{{ ucwords(str_replace('_', ' ', $key)) }} </div>
                    <div class="text-gray-700 text-sm ml-4 text-center">{{ $item }}</div>
                </div>
            @endforeach
        </div>

        @if ($isUpdate)
            @include('livewire.sertifikat.confirm')
        @endif

        @if ($isLaporan)
            @include('livewire.sertifikat.audit.laporan')
        @endif

        <div
            x-data="{
            openTab: 1,
            activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
            inactiveClasses: 'text-blue-500 hover:text-blue-800'
            }"
            class="p-6"
        >
            <ul class="flex border-b">
                <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                    <a :class="openTab === 1 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                    Detail
                    </a>
                </li>
                <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                    <a :class="openTab === 2 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Pabrik</a>
                </li>
                <li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <a :class="openTab === 3 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Produk</a>
                </li>
                <li @click="openTab = 4" :class="{ '-mb-px': openTab === 4 }" class="mr-1">
                    <a :class="openTab === 4 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Penyelia</a>
                </li>
                <li @click="openTab = 5" :class="{ '-mb-px': openTab === 5 }" class="mr-1">
                    <a :class="openTab === 5 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Dokumen</a>
                </li>
            </ul>
            <div class="w-full bg-white mt-0.5 pb-6">
                <div x-show="openTab === 1">
                    <div class="mx-10 grid grid-cols-2 gap-4">
                        @foreach ($reg as $key=>$item)
                            @if (!in_array($key,['factories','products','pu','penyelia','documents']))
                                <div>
                                    <div class="pt-2 text-gray-600 text-base font-semibold">{{ ucwords(str_replace('_', ' ', $key)) }}: </div>
                                    @if ($item)
                                        <div class="text-gray-700 text-sm ml-4">{{ $item }}</div>
                                    @else
                                        <div class="text-gray-700 text-sm ml-4">{Kosong}</div>
                                    @endif

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div x-show="openTab === 2">
                    <table class="divide-y divide-gray-200 w-full">
                        @php
                            $head = 0;
                        @endphp
                        @foreach ($reg['factories'] as $items)
                            @if ($head==0)
                                <thead>
                                    <tr>
                                        @foreach ($items as $key=>$item)
                                            <th scope="col" class="p-2 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    @php
                                        $head = 1;
                                    @endphp
                                </thead>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @foreach ($items as $key=>$item)
                                        <td class=" py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $item }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div x-show="openTab === 3">
                    <table class="divide-y divide-gray-200 w-full">
                        @php
                            $head = 0;
                        @endphp
                        @foreach ($reg['products'] as $items)
                            @if ($head==0)
                                <thead>
                                    <tr>
                                        @foreach ($items as $key=>$item)
                                            <th scope="col" class="p-2 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    @php
                                        $head = 1;
                                    @endphp
                                </thead>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @foreach ($items as $key=>$item)
                                        <td class=" py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $item }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div x-show="openTab === 4">
                    <table class="divide-y divide-gray-200 w-full">
                        @php
                            $head = 0;
                        @endphp
                        @foreach ($reg['penyelia'] as $items)
                            @if ($head==0)
                                <thead>
                                    <tr>
                                        @foreach ($items as $key=>$item)
                                            <th scope="col" class="p-2 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    @php
                                        $head = 1;
                                    @endphp
                                </thead>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @foreach ($items as $key=>$item)
                                        <td class=" py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $item }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div x-show="openTab === 5">
                    <table class="divide-y divide-gray-200 w-full">
                        @php
                            $head = 0;
                        @endphp
                        @foreach ($reg['documents'] as $items)
                            @if ($head==0)
                                <thead>
                                    <tr>
                                        @foreach ($items as $key=>$item)
                                            <th scope="col" class="p-2 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                    @php
                                        $head = 1;
                                    @endphp
                                </thead>
                            @endif
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    @foreach ($items as $key=>$item)
                                        <td class=" py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                            {{ $item }}
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


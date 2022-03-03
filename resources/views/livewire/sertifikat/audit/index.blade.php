<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <div class="flex">
                <div class="text-xl font-bold text-gray-600">
                    {{ $reg['nama_pu'] }} ({{ $reg['id_reg'] }})
                </div>
            </div>

            <div class="flex mt-6 w-full ">
                <div class="w-full md:w-2/3">
                    <button wire:click="openAudit()" class=" bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                            </svg>
                            <span class="mx-1">Add Audit</span>
                        </div>
                    </button>
                    <button wire:click="openAuditor()" class=" bg-blue-700 hover:bg-blue-900 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="mx-1">Add Auditor</span>
                        </div>
                    </button>
                </div>
                <div class="w-full grid justify-items-end">
                    <div class="flex">
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
            </div>

        </div>

        @if($isAudit)
            @include('livewire.sertifikat.audit.audit_form')
        @endif

        @if($isAuditor)
            @include('livewire.sertifikat.audit.auditor_form')
        @endif

        @if($isDelAudit)
            @include('layouts.delete')
        @endif

        @if($isDelAuditor)
            @include('layouts.delete')
        @endif

        @if ($isUpdate)
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

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID AUDIT
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    JADWAL AWAL
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    JADWAL AKHIR
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    JUMLAH HARI
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($audits['audit'] as $audit)
                            @php
                                $id_auditApi = $audit['id_audit'];
                                $id_regApi = $audit['id_reg'];
                                $awalAPI = $audit['jadwal_awal'];
                                $akhirAPI = $audit['jadwal_akhir'];
                                $jmlHariApi = $audit['jml_hari'];
                            @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['id_audit'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ date('d-m-Y', strtotime($audit['jadwal_awal'])) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ date('d-m-Y', strtotime($audit['jadwal_akhir'])) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['jml_hari'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        <button wire:click="edit(
                                            {{ $id_auditApi }},
                                            {{ $id_regApi }},
                                            '{{ $awalAPI }}',
                                            '{{ $akhirAPI }}',
                                            {{ $jmlHariApi }}
                                        )" class="mx-2 bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span class="mx-1">Edit</span>
                                            </div>
                                        </button>
                                        <button wire:click="delAudit({{$id_auditApi}})" class="mx-2 bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                                <span class="mx-1">Hapus</span>
                                            </div>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                                    ID AUDIT PERSON
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    AUDITOR_ID
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CREATE BY
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CREATE ON
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($audits['auditor'] as $audit)
                            @php
                                $id_auditApi = $audit['id_audit_person'];
                                $id_regApi = $audit['id_reg'];
                                $auditorId = $audit['auditor_id'];
                                $createByApi = $audit['create_by'];
                                $createOnApi = $audit['create_on'];
                            @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['id_audit_person'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['auditor_id'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['create_by'] }}
                                    </td>

                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ date('d-m-Y', strtotime($audit['create_on'])) }}

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        <button wire:click="delAuditor({{$id_regApi}})" class="mx-2 bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 border border-amber-500 rounded">
                                            <div class="flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                                <span class="mx-1">Hapus</span>
                                            </div>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

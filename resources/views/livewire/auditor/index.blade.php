<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <button wire:click="openModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded">Add Audit</button>
        </div>

        @if($isModal)
            @include('livewire.auditor.form')
        @endif

        @if($isDel)
            @include('layouts.delete')
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
                                    ID AUDIT PERSON
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ID REG
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
                            @foreach ($audits as $audit)
                            @php
                                // $total = $total + $audit['total'];
                            @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['id_audit_person'] }}
                                        @php
                                            $id_auditApi = $audit['id_audit_person'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['id_reg'] }}
                                        @php
                                            $id_regApi = $audit['id_reg'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['auditor_id'] }}
                                        @php
                                            $auditorId = $audit['auditor_id'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['create_by'] }}
                                        @php
                                            $createByApi = $audit['create_by'];
                                        @endphp
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $audit['create_on'] }}
                                        {{-- Rp. {{ number_format($audit['harga'], 0, ',', '.') }} ,- --}}
                                        @php
                                            $createOnApi = $audit['create_on'];
                                        @endphp

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
					                    <button wire:click="update()"class="mx-2 bg-yellow-300 hover:bg-yellow-500 text-white font-bold py-1 px-2 border border-amber-500 rounded">Update</button>
					                    <button wire:click="openDel({{$id_regApi}})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 border border-red-500 rounded">Delete</button>

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

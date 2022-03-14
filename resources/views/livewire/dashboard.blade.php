

<div>
    <div class="w-full text-center mt-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">
                <div class="w-full">
                    <div class="max-w-sm bg-white rounded-xl shadow-md px-7 py-5">
                        <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo-400 h-12 w-12 border-indigo-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        <div class="pb-5 text-base text-gray-500 font-semibold">Halo, selamat datang!</div>
                        <div class="py-5 rounded-xl shadow-inner bg-gray-50">
                            <div class="grid justify-center text-gray-600">
                                <div class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                            </div>
                            <div class="mt-2 text-base font-bold text-gray-600">{{Auth::user()->name}}</div>
                        </div>
                    </div>
                    <div class=" bg-green-600 mt-8 max-w-sm bg-white rounded-xl shadow-md px-7 py-5">
                        <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                <img class="h-12 w-12 rounded-full object-cover" src="https://halalbm.org/wp-content/uploads/2021/12/cropped-logo1.png" />
                            </div>
                        <div class="pb-3 text-left text-base font-semibold text-white">Sistem Informasi Lembaga Pemeriksa Halal</div>
                        <div class="text-left text-sm font-semibold text-white">Yayasan Bersama Halal Madani</div>
                    </div>
                </div>
                <div class="w-full col-span-3">
                    <div class="grid grid-cols-4 gap-4">
                        <button class="focus:outline-none max-w-sm bg-white rounded-xl shadow-md px-7 py-5"
                        @if ($ajuan)
                            onclick="location.href=' {{ route( 'certificate',10010) }} '"
                        @endif
                        >
                            <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-blue-400 h-12 w-12 border-blue-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <div class="pb-5 text-base text-gray-500 font-semibold">Dikirim ke LPH</div>
                            <div class="py-5 rounded-xl shadow-inner bg-gray-50">
                                <div class="mt-2 text-base font-bold text-gray-600">
                                    @if ($ajuan)
                                        {{$ajuan}} Pelaku Usaha
                                    @else
`                                        Belum ada
                                    @endif
                                </div>
                            </div>
                        </button>
                        <button class="focus:outline-none max-w-sm bg-white rounded-xl shadow-md px-7 py-5"
                        @if ($biaya)
                            onclick="location.href=' {{ route( 'certificate',10020) }} '"
                        @endif>
                            <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-400 h-12 w-12 border-yellow-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <div class="pb-5 text-base text-gray-500 font-semibold">Penetapan Biaya</div>
                            <div class="py-5 rounded-xl shadow-inner bg-gray-50">
                                <div class="grid justify-center text-gray-600">

                                </div>
                                <div class="mt-2 text-base font-bold text-gray-600">
                                    @if ($biaya)
                                        {{$biaya}} Pelaku Usaha
                                    @else
                                        Belum ada
                                    @endif
                                </div>
                            </div>
                        </button>
                        <button class="focus:outline-none max-w-sm bg-white rounded-xl shadow-md px-7 py-5"
                        @if ($audit)
                            onclick="location.href=' {{ route( 'certificate',10030) }} '"
                        @endif>
                            <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-red-400 h-12 w-12 border-red-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9 9a2 2 0 114 0 2 2 0 01-4 0z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a4 4 0 00-3.446 6.032l-2.261 2.26a1 1 0 101.414 1.415l2.261-2.261A4 4 0 1011 5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <div class="pb-5 text-base text-gray-500 font-semibold">Proses di LPH</div>
                            <div class="py-5 rounded-xl shadow-inner bg-gray-50">
                                <div class="mt-2 text-base font-bold text-gray-600">
                                    @if ($audit)
                                        {{$audit}} Pelaku Usaha
                                    @else
`                                        Belum ada
                                    @endif
                                </div>
                            </div>
                        </button>
                        <button class="focus:outline-none max-w-sm bg-white rounded-xl shadow-md px-7 py-5"
                        @if ($fatwa)
                            onclick="location.href=' {{ route( 'certificate',10040) }} '"
                        @endif>
                            <div class="-mx-4 flex justify-center md:justify-start -mt-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-green-400 h-12 w-12 border-green-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            <div class="pb-5 text-base text-gray-500 font-semibold">Selesai Proses LPH</div>
                            <div class="py-5 rounded-xl shadow-inner bg-gray-50">
                                <div class="mt-2 text-base font-bold text-gray-600">
                                    @if ($fatwa)
                                        {{$fatwa}} Pelaku Usaha
                                    @else
`                                        Belum ada
                                    @endif
                                </div>
                            </div>
                        </button>
                    </div>
                    <div class="focus:outline-none w-full bg-white rounded-xl shadow-md px-7 py-5 my-8">
                        <div class="-mx-4 flex md:justify-start -mt-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-orange-400 h-12 w-12 border-yellow-500 object-cover" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
                                <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                            </svg>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($notifs as $notif)
                                <div class="max-w-sm bg-white rounded-xl shadow-md p-5">
                                    <div class="flex">
                                        <div class="flex-1 text-left text-base font-bold text-gray-600">
                                            {{$notif->no_daftar}}
                                        </div>
                                        <button onclick="location.href=' {{ route( 'dreg',[$notif->id_reg,$notif->status_reg] ) }} '" class="focus:outline-none flex rounded-xl bg-green-400 p-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            <span class="mx-1 text-xs font-bold">Lihat</span>
                                        </button>

                                    </div>
                                    <div class=" my-2 py-4 px-2 rounded-xl shadow-inner bg-gray-50">
                                        <div class="grid grid-cols-2">

                                            <div class="text-left text-xs">
                                                <div class="text-gray-400">
                                                    Nama
                                                </div>
                                                {{$notif->nama_pu}}
                                            </div>
                                            <div class="text-right text-xs">
                                                <div class="text-gray-400">
                                                    Jenis Usaha
                                                </div>
                                                {{$notif->nama_jenis_usaha}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-orange-400 font-bold mx-auto rounded">
                                        {{$notif->nama_jenis_daftar}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            {{$notifs->links('pagination_section')}}
                        </div>
                    </div>
                </div>

                {{-- <div class="mt-10 text-base font-semibold text-green-500">Sistem Informasi S3 Pertanian</div>
                <div class="flex justify-center font-semibold text-base text-green-500">
                    <div class="">Universitas Andalas</div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div> --}}
            </div>
        </div>
    </div>
</div>

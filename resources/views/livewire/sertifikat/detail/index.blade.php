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

        @if ($isUpdate)
            @include('livewire.sertifikat.confirm')
        @endif

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

        <div
            x-data="{
            openTab: 1,
            activeClasses: 'border-l border-t border-r rounded-t text-blue-700',
            inactiveClasses: 'text-blue-500 hover:text-blue-800'
            }" class="py-6"
        >
            <ul class="flex border-b">
                <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                    <a :class="openTab === 1 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                    Data Pengajuan
                    </a>
                </li>
                <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                    <a :class="openTab === 2 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Pabrik</a>
                </li>
                <li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <a :class="openTab === 3 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Produk</a>
                </li>
                <li @click="openTab = 4" :class="{ '-mb-px': openTab === 4 }" class="mr-1">
                    <a :class="openTab === 4 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Penanggung Jawab</a>
                </li>
                <li @click="openTab = 5" :class="{ '-mb-px': openTab === 5 }" class="mr-1">
                    <a :class="openTab === 5 ? activeClasses : inactiveClasses" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Dokumen</a>
                </li>
            </ul>

    {{-- "status_code": 200,
    "payload": {
        "id_reg": 56156,
        "no_daftar": "SH2021-1-018478",
        "tgl_daftar": "2021-12-17T00:00:00.000Z",
        "nama_pu": "PT. GRAHA RODITHA BERSAUDARA",
        "alamat_pu": "JL. PANGERAN ANTASARI - PASAR PAGI NO.41 KELAYAN LUAR BANJARMASIN TENGAH",
        "kota_pu": "KOTA BANJARMASIN",
        "jenis_usaha": "JBU.1",
        "email": "rodithahotel@yahoo.com",
        "no_telp": "05113362345",
        "jenis_daftar": "JD.1",
        "status_reg": "OF50",
        "verifikator_id": null,
        "creator_id": null,
        "serah_terima_id": null,
        "skala_usaha": "JU.4",
        "nama_pj": "Heppi Lestari",
        "no_kontak_pj": "082250450954",
        "email_pj": "rodithabanjarmasinnew@gmail.com",
        "alamat_pabrik": null,
        "status_pabrik": null,
        "jenis_produk": "JP.25",
        "merek_dagang": "Hotel Roditha Banjarmasin",
        "area_pemasaran": "MKT01",
        "tgl_penerimaan_dok": null,
        "diterima_oleh": null,
        "no_sp": "",
        "tgl_sp": "2021-12-30T00:00:00.000Z",
        "wilayah_id": "63",
        "create_on": "2021-10-14T00:00:00.000Z",
        "create_by": "hrd.rodithabjm@gmail.com",
        "tgl_kirim": null,
        "kirim_oleh": null,
        "taken_by": "SAEPURRO",
        "file_sp": null,
        "no_mohon": "037/SK-HRD/X/2021",
        "tgl_mohon": "2021-10-14T00:00:00.000Z",
        "jenis_layanan": "L.002",
        "prov_pu": "KALIMANTAN SELATAN",
        "negara_pu": "INDONESIA",
        "kode_pos_pu": "70241",
        "file_ttd": "56156-TTD--895424494.pdf",
        "f_updated": null,
        "f_updated_by": null,
        "lph_id": "D085464D-162F-4A0E-9ED1-A584F8EDF3FB",
        "channel_id": "CH001",
        "fac_id": null,
        "id_pu": "D891694F-2A59-4C08-869F-5D8BEF600D8D",
        "id_negara": "00062",
        "id_prov": "63",
        "nama_pu_alt": "HOTEL DAN RESTORAN",
        "f_apv": 0,
        "ref_no_sert": null,
        "ref_id_reg": null,
        "ref_sumber_data": null,
        "perseroan_daerah_id": "6371051012",
        "id_unik": "F3B6F479-55BA-4B98-A45D-DF8B68D38CBA",
        "f_umk": 1,
        "f_ln": 0,
        "factories": [
            {
                "id_pabrik": 136184,
                "id_reg": 56156,
                "nama": "Hotel Roditha Banjarmasin",
                "alamat": "Jalan Pangeran Atasari Pasar Pagi, No 41 Banjarmasin",
                "kab_kota": "Banjarmasin",
                "provinsi": "Kalimantan Selatan",
                "negara": "Indonesia",
                "kode_pos": "70249",
                "status_milik": "SF.01",
                "fasil_id": "FAPAB",
                "id_fas": "A3D6C329-CC2E-4A53-844D-47D61A0FFEC6"
            },
            {
                "id_pabrik": 136185,
                "id_reg": 56156,
                "nama": "Angkringan Hotel Roditha Banjarmasin",
                "alamat": "Jalan Pangeran Antasari Pasar Pagi, No 41 ",
                "kab_kota": "Banjarmasin",
                "provinsi": "Kalimantan Selatan",
                "negara": "Indonesia",
                "kode_pos": "70249",
                "status_milik": null,
                "fasil_id": "FAOUT",
                "id_fas": "39CC670C-D6A8-4364-99A5-5001BCD060A2"
            },
            {
                "id_pabrik": 136186,
                "id_reg": 56156,
                "nama": "Restoran Hotel Roditha Banjarmasin",
                "alamat": "Jalan Pangeran Antasari Pasar Pagi, No 41 Banjarmasin",
                "kab_kota": "Banjarmasin",
                "provinsi": "Kalimantan Selatan",
                "negara": "Indonesia",
                "kode_pos": "70249",
                "status_milik": null,
                "fasil_id": "FAOUT",
                "id_fas": "2BE0F7E5-EC44-48B0-9D79-C1C68BBD1797"
            }
        ],
        "products": [
            {
                "id_reg_prod": 907237,
                "id_reg": 56156,
                "reg_prod_name": "1\tRODHITA SALAD 2\tSPRING ROLL 3\tGADO-GADO 4\tBROCCOLY  CREAM SOUP 5\tASPARAGUS CHICKEN CORN SOUP 6\tTOM YUM GOONG 7\tYOUR FAVOURITE SPAGHETTI 8\tCLUB SANDWICH 9\tCHEESE BURGER 10\tSIRLOIN WAGYU (STEAK LOVER)",
                "reg_publish": true,
                "id_pabrik": null,
                "foto_produk": null
            },
            {
                "id_reg_prod": 907243,
                "id_reg": 56156,
                "reg_prod_name": "CHICKEN STEAK (STEAK LOVER ) SALMON STEAK (STEAK LOVER ) BEEF CHOICE SAUCE CHICKEN CHOICE SAUCE PRAWN CHOICE SAUCE FISH CHOICE SAUCE MIE RODHITA SUP BUNTUT RAWON  POK COY GARLIC MUSHROOM",
                "reg_publish": true,
                "id_pabrik": null,
                "foto_produk": null
            },
            {
                "id_reg_prod": 907244,
                "id_reg": 56156,
                "reg_prod_name": "KANGKUNG CAH SEAFOOD/AYAM CAP CAY SEAFOOD/AYAM NASI GORENG RODHITA NASI GORENG IKAN ASIN NASI GORENG SEAFOOD TAHU GARAM PEDAS TEMPE GORENG BAWANG TAHU ISI PISANG GORENG SEASONAL FRUIT PLATTER",
                "reg_publish": true,
                "id_pabrik": null,
                "foto_produk": null
            },
            {
                "id_reg_prod": 907246,
                "id_reg": 56156,
                "reg_prod_name": "CAPPUCINO REGULER TEA LEMON TEA LECHY TEA GINGER TEA AVOCADO JUICE ORANGE JUICE PINEAPLE BOOSTER MANGO KING SATE TELOR PUYUH",
                "reg_publish": true,
                "id_pabrik": null,
                "foto_produk": null
            },
            {
                "id_reg_prod": 907248,
                "id_reg": 56156,
                "reg_prod_name": "TEMPE BACEM TEMPE MENDOAN SATE CEKER SATE USUS SATE KEPALA SATE HATI AYAM SATE BAKSO SATE NUGET SATE SOSIS SAYAP AYAM PAHA AYAM BAKWAN SAYUR NASI BAKAR AYAM GORENG KALASAN",
                "reg_publish": true,
                "id_pabrik": null,
                "foto_produk": null
            }
        ],
        "pu": {
            "id_pu": "D891694F-2A59-4C08-869F-5D8BEF600D8D",
            "no_ndpu": "PU2121503",
            "nama_pu": "PT. GRAHA RODITHA BERSAUDARA",
            "no_urut_ndpu": 13935
        },
        "penyelia": [
            {
                "penyelia_id": 85818,
                "id_pu": null,
                "id_reg": 56156,
                "nama": "Muliyadi",
                "no_ktp": "6303160205920001",
                "no_sertifikat": "",
                "tgl_sertifikat": null,
                "no_sk": "032/HRD-SKK/XII/2021",
                "tgl_sk": "2021-10-26T00:00:00.000Z",
                "no_kontak": "085651062223",
                "id_penyelia": "9A34E434-434E-49E1-B8E9-089192E8D5CD"
            },
            {
                "penyelia_id": 85819,
                "id_pu": null,
                "id_reg": 56156,
                "nama": "Hendrawan",
                "no_ktp": "6303053108890003",
                "no_sertifikat": "",
                "tgl_sertifikat": null,
                "no_sk": "032/HRD-SKK/XII/2021",
                "tgl_sk": "2021-10-26T00:00:00.000Z",
                "no_kontak": "08134332169",
                "id_penyelia": "06DC1C50-9BD0-4589-9E52-AF669050E6FB"
            },
            {
                "penyelia_id": 85820,
                "id_pu": null,
                "id_reg": 56156,
                "nama": "Ade Fachrurozi",
                "no_ktp": "3217112506790002",
                "no_sertifikat": "",
                "tgl_sertifikat": null,
                "no_sk": "032/HRD-SKK/XII/2021",
                "tgl_sk": "2021-10-26T00:00:00.000Z",
                "no_kontak": "087720976649",
                "id_penyelia": "CFB4BA6F-3450-4991-8FE6-FEE857998D3F"
            }
        ],
        "documents": [
            {
                "dok_id": 447450,
                "id_reg": 56156,
                "file_dok": "56156-447450--955902322.pdf",
                "tipe_dok": "D.001",
                "ket_lainnya": null,
                "ck_list": true
            },
            {
                "dok_id": 447451,
                "id_reg": 56156,
                "file_dok": "56156-447451--955902322.pdf",
                "tipe_dok": "D.002",
                "ket_lainnya": null,
                "ck_list": false
            },
            {
                "dok_id": 447452,
                "id_reg": 56156,
                "file_dok": "56156-447452--955902322.pdf",
                "tipe_dok": "D.003",
                "ket_lainnya": null,
                "ck_list": false
            },
            {
                "dok_id": 447455,
                "id_reg": 56156,
                "file_dok": "56156-447455-2128025324.pdf",
                "tipe_dok": "D.006",
                "ket_lainnya": null,
                "ck_list": true
            },
            {
                "dok_id": 447457,
                "id_reg": 56156,
                "file_dok": "56156-447457--955902322.pdf",
                "tipe_dok": "D.008",
                "ket_lainnya": null,
                "ck_list": false
            },
            {
                "dok_id": 447458,
                "id_reg": 56156,
                "file_dok": "56156-447458-2128025324.pdf",
                "tipe_dok": "D.100",
                "ket_lainnya": null,
                "ck_list": false
            },
            {
                "dok_id": 772800,
                "id_reg": 56156,
                "file_dok": "56156-772800--1207941250.pdf",
                "tipe_dok": "D.007",
                "ket_lainnya": null,
                "ck_list": false
            },
            {
                "dok_id": 772814,
                "id_reg": 56156,
                "file_dok": "56156-772814-1791299120.pdf",
                "tipe_dok": "D.005",
                "ket_lainnya": null,
                "ck_list": true
            },
            {
                "dok_id": 785224,
                "id_reg": 56156,
                "file_dok": "56156-785224--40320274.pdf",
                "tipe_dok": "D.004",
                "ket_lainnya": null,
                "ck_list": true
            }
        ]
    }
} --}}
            <div class="bg-white mt-0.5 pb-6">
                <div x-show="openTab === 1" class="py-2">
                    <table class="mx-10 table-auto">
                        <tbody>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4 text-green-500">
                                        <span>Pengajuan Sertifikasi</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">ID REG</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['id_reg'])
                                        {{ $reg['id_reg'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nomor Daftar</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['no_daftar'])
                                        {{ $reg['no_daftar'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Tanggal Daftar</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['tgl_daftar'])
                                        {{ $reg['tgl_daftar'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nama PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['nama_pu'])
                                        {{ $reg['nama_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Alamat PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['alamat_pu'])
                                        {{ $reg['alamat_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Kota PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['kota_pu'])
                                        {{ $reg['kota_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Jenis Usaha</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['jenis_usaha'])
                                        {{ $reg['jenis_usaha'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Email</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['email'])
                                        {{ $reg['email'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nomor Telepon</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['no_telp'])
                                        {{ $reg['no_telp'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Jenis Daftar</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['jenis_daftar'])
                                        {{ $reg['jenis_daftar'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Status Reg</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['status_reg'])
                                        {{ $reg['status_reg'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Verifikator Id</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['verifikator_id'])
                                        {{ $reg['verifikator_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Creator ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['creator_id'])
                                        {{ $reg['creator_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Serah Terima ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['serah_terima_id'])
                                        {{ $reg['serah_terima_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Skala Usaha</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['skala_usaha'])
                                        {{ $reg['skala_usaha'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4">
                                        <hr>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mx-10 table-auto">
                        <tbody>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4 text-green-500">
                                        <span>Penanggung Jawab</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nama</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['nama_pj'])
                                        {{ $reg['no_kontak_pj'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">No Kontak</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['no_kontak_pj'])
                                        {{ $reg['no_kontak_pj'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Email</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['email_pj'])
                                        {{ $reg['email_pj'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4">
                                        <hr>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mx-10 table-auto">
                        <tbody >
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4 text-green-500">
                                        <span>Pabrik</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Alamat Pabrik</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['alamat_pabrik'])
                                        {{ $reg['alamat_pabrik'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Status Pabrik</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['status_pabrik'])
                                        {{ $reg['status_pabrik'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Jenis Produk</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['jenis_produk'])
                                        {{ $reg['jenis_produk'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Merek Dagang</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['merek_dagang'])
                                        {{ $reg['merek_dagang'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Area Pemasaran</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['area_pemasaran'])
                                        {{ $reg['area_pemasaran'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4">
                                        <hr>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mx-10 table-auto">
                        <tbody>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4 text-green-500">
                                        <span>Penerima Dokumen</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Tanggal Penerimaan</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['tgl_penerimaan_dok'])
                                        {{ $reg['tgl_penerimaan_dok'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Diterima Oleh</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['diterima_oleh'])
                                        {{ $reg['diterima_oleh'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">No SP</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['no_sp'])
                                        {{ $reg['no_sp'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Tanggal SP</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['tgl_sp'])
                                        {{ $reg['tgl_sp'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Wilayah ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['wilayah_id'])
                                        {{ $reg['wilayah_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Create On</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['create_on'])
                                        {{ $reg['create_on'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Create By</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['create_by'])
                                        {{ $reg['create_by'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Tanggal Kirim</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['tgl_kirim'])
                                        {{ $reg['tgl_kirim'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Kirim Oleh</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['kirim_oleh'])
                                        {{ $reg['kirim_oleh'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Taken By</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['taken_by'])
                                        {{ $reg['taken_by'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">File SP</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['file_sp'])
                                        <a class="text-blue-700" href="https://ptsp.halal.go.id/files/{{ $reg['file_sp'] }}" target="_blank">{{ $item }}</a>
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nomor Mohon</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['no_mohon'])
                                        {{ $reg['no_mohon'] }}

                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Tanggal Mohon</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['tgl_mohon'])
                                        {{ $reg['tgl_mohon'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4">
                                        <hr>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mx-10 table-auto">
                        <tbody>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4 text-green-500">
                                        <span>Data PU</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Jenis Layanan</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['jenis_layanan'])
                                        {{ $reg['jenis_layanan'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Provinsi PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['prov_pu'])
                                        {{ $reg['prov_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Negara PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['negara_pu'])
                                        {{ $reg['negara_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Kode Pos PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['kode_pos_pu'])
                                        {{ $reg['kode_pos_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">File TTD</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['file_ttd'])
                                        <a class="text-blue-700" href="https://ptsp.halal.go.id/files/{{ $reg['file_ttd'] }}" target="_blank">
                                            {{ $reg['file_ttd'] }}
                                        </a>
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">File Updated</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['f_updated'])
                                        {{ $reg['f_updated'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">File Update By</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['f_updated_by'])
                                        {{ $reg['f_updated_by'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">LPH ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['lph_id'])
                                        {{ $reg['lph_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Channel ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['channel_id'])
                                        {{ $reg['channel_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Fac ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['fac_id'])
                                        {{ $reg['fac_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">ID PU</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['id_pu'])
                                        {{ $reg['id_pu'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">ID Negara</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['id_negara'])
                                        {{ $reg['id_negara'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">ID Provinsi</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['id_prov'])
                                        {{ $reg['id_prov'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Nama PU Alt</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['nama_pu_alt'])
                                        {{ $reg['nama_pu_alt'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">File APV</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['f_apv'])
                                        {{ $reg['f_apv'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Ref No Sert</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['ref_no_sert'])
                                        {{ $reg['ref_no_sert'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Ref ID Reg</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['ref_id_reg'])
                                        {{ $reg['ref_id_reg'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Ref Sumber Data</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['ref_sumber_data'])
                                        {{ $reg['ref_sumber_data'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">Perseroan Daerah ID</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['perseroan_daerah_id'])
                                        {{ $reg['perseroan_daerah_id'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">ID Unik</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['id_unik'])
                                        {{ $reg['id_unik'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">F UMK</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['f_umk'])
                                        {{ $reg['f_umk'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm font-bold">
                                    <div class="py-1">F ln</div>
                                </td>
                                <td class="text-sm">
                                    <div class="mx-3">:</div>
                                </td>
                                <td class="text-sm">
                                    @if ($reg['f_ln'])
                                        {{ $reg['f_ln'] }}
                                    @else
                                        {Data Kosong}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-left">
                                    <div class="py-1 -mx-4">
                                        <hr>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                                            @if ($key=='file_dok')
                                                <a class="text-blue-700" href="https://ptsp.halal.go.id/files/{{$item}}" target="_blank">{{ $item }}</a>
                                            @elseif($key=='tipe_dok')
                                                {{ $refs[$item] }}
                                            @else
                                                {{ $item }}
                                            @endif
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


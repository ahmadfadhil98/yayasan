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
                                <div>
                                    <div class="text-gray-400">Nama</div>
                                    @if ($reg['nama_pu'])
                                        <div>{{$reg['nama_pu']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Nomor Daftar</div>
                                    @if ($reg['no_daftar'])
                                        <div>{{$reg['no_daftar']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Tanggal Daftar</div>
                                    @if ($reg['tgl_daftar'])
                                        <div>{{$reg['tgl_daftar']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Alamat PU</div>
                                    @if ($reg['alamat_pu'])
                                        <div>{{$reg['alamat_pu']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Jenis Usaha</div>
                                    @if ($reg['jenis_usaha'])
                                        <div>{{$reg['jenis_usaha']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Email Usaha</div>
                                    @if ($reg['email'])
                                        <div>{{$reg['email']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Nomor Telphone</div>
                                    @if ($reg['no_telp'])
                                        <div>{{$reg['no_telp']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Jenis Daftar</div>
                                    @if ($reg['jenis_daftar'])
                                        <div>{{$reg['jenis_daftar']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Status Reg</div>
                                    @if ($reg['status_reg'])
                                        <div>{{$reg['status_reg']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Verifikator Id</div>
                                    @if ($reg['verifikator_id'])
                                        <div>{{$reg['verifikator_id']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif

                                </div>
                                <div>
                                    <div class="text-gray-400">Creator Id</div>
                                    @if ($reg['creator_id'])
                                        <div>{{$reg['creator_id']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Serah Terima Id</div>
                                    @if ($reg['serah_terima_id'])
                                        <div>{{$reg['serah_terima_id']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Skala Usaha</div>
                                    @if ($reg['skala_usaha'])
                                        <div>{{$reg['skala_usaha']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Penanggung Jawab</div>
                                    <div class="mx-2">
                                        <table>
                                            <tr>
                                                <td class="text-gray-400">Nama</td>
                                                @if ($reg['nama_pj'])
                                                    <td class="px-4">{{$reg['nama_pj']}}</td>
                                                @else
                                                    <td class="px-4">{Belum ada}</td>
                                                @endif

                                            </tr>
                                            <tr>
                                                <td class="text-gray-400">Nomor Kontak</td>
                                                @if ($reg['no_kontak_pj'])
                                                    <td class="px-4">{{$reg['no_kontak_pj']}}</td>
                                                @else
                                                    <td class="px-4">{Belum ada}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td class="text-gray-400">Email</td>
                                                @if ($reg['email_pj'])
                                                    <td class="px-4">{{$reg['email_pj']}}</td>
                                                @else
                                                    <td class="px-4">{Belum ada}</td>
                                                @endif
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-gray-400">Alamat Pabrik</div>
                                    @if ($reg['alamat_pabrik'])
                                        <div>{{$reg['alamat_pabrik']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Status Pabrik</div>
                                    @if ($reg['status_pabrik'])
                                        <div>{{$reg['status_pabrik']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Jenis Produk</div>
                                    @if ($reg['jenis_produk'])
                                        <div>{{$reg['jenis_produk']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Merek Dagang</div>
                                    @if ($reg['merek_dagang'])
                                        <div class="px-2">{{$reg['merek_dagang']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Area Pemasaran</div>
                                    @if ($reg['area_pemasaran'])
                                        <div>{{$reg['area_pemasaran']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Penerimaan Dokumen</div>
                                    @if ($reg['tgl_penerimaan_dok'])
                                        <div class="mx-2">
                                            <table>
                                                <tr>
                                                    <td class="text-gray-400">Tanggal Penerimaan Dokumen</td>
                                                    <td class="px-4">{{$reg['tgl_penerimaan_dok']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-gray-400">Diterima Oleh</td>
                                                    <td class="px-4">{{$reg['diterima_oleh']}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif

                                </div>
                                <div>
                                    <div class="text-gray-400">No SP</div>
                                    @if ($reg['no_sp'])
                                        <div>{{$reg['no_sp']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Tanggal SP</div>
                                    @if ($reg['tgl_sp'])
                                        <div>{{$reg['tgl_sp']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-gray-400">Wilayah Id</div>
                                    @if ($reg['tgl_sp'])
                                        <div>{{$reg['tgl_sp']}}</div>
                                    @else
                                        <div> {Belum ada} </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

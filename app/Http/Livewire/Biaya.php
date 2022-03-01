<?php

namespace App\Http\Livewire;

use App\Models\Biaya as ModelsBiaya;
use App\Models\NotifBiaya;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Biaya extends Component
{
    public $isModal,$isDel,$delId,$isUpdate;
    public $biayaId,$id_reg,$keterangan,$qty,$harga;
    public $baseUrl,$user;
    public $cookie;
    public $lph_mapped_id,$status;
    public $regIds = [];
    public $titleRegId;
    public $no =0;
    public $total=0;
    public $isEdit;

    public function render()
    {
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        $lph_id = 'D10217E0-383E-42F3-9841-827915AE0438';
        // $cookie = '__bpjph_ct=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTE0OTA3OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.DSQ83OzX8EKNKSRHIhwmtzL1cscSTDrgTdu6I3GyEp8; __bpjph_rt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTc1Mzg0OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.FCZwWbE-_VbaLS7wDP7sJGWLe83JDBhqD-lnnRXoJ0s';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        // $lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        // dd($cookie);
            try{
                $client = new Client();
                    $res = $client->request('GET', $this->baseUrl.'api/v1/data_list/10010/'.$lph_id,[
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

                if($res->getStatusCode() == 200){
                    $json = $res->getBody();
                    $json = json_decode($json, true);
                    $reg = $json['payload'];
                    foreach($reg as $key => $value){
                        $this->regIds[$value['id_reg']] = $value['id_reg'].' ('.$value['nama_pu'].')';
                    }
                }
            }catch(Exception $e){
                $this->regIds = [];
            }

        try{
            $client = new Client();
                $res = $client->request('GET', $this->baseUrl.'api/v1/costs',[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);
                $biayas = $json['payload'];

                $keys = array_column($biayas, 'id_reg');
                array_multisort($keys, SORT_DESC, $biayas);
                // dd($biayas);

                foreach ($biayas as $item){
                    $biayaDb = ModelsBiaya::firstOrNew(
                        ['id_biaya' => $item['id_biaya'],
                        'id_reg' => $item['id_reg'],
                        'keterangan' => $item['keterangan'],
                        'qty' => $item['qty'],
                        'harga' => $item['harga'],
                        'total' => $item['total']
                    ]);
                    $biayaDb->save();
                }

                $notif = NotifBiaya::select('id_biaya')->get();

                $statuses = config('central.status');

                return view('livewire.biaya.index',[
                    'biayas' => $biayas,
                    'statuses' => $statuses,
                    'notif' => $notif
                ]);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }

    }

    public function resetNotif(){
        NotifBiaya::truncate();
    }

    public function hapusNotif($id){
        NotifBiaya::where('id_biaya',$id)->delete();
    }

    public function update($id)
    {
        $this->id_reg = $id;
        $this->openUpdate();
    }

    public function openUpdate()
    {
        $this->isUpdate = true;
    }

    public function storeUpdate()
    {
        try{
            $client = new Client();

                    $res = $client->request('POST', $this->baseUrl.'api/v1/updatestatus',[
                        'form_params' => [
                            'reg_id' => $this->id_reg,
                            'status' => $this->status,
                            'lph_mapped_id' => $this->lph_mapped_id,
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie,
                        ]
                    ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', 'Berhasil Mengupdate Status');
                $this->emit('saved');
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $this->hideModal();
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function hideModal()
    {

        $this->biayaId = null;
        $this->id_reg = null;
        $this->keterangan = null;
        $this->qty = null;
        $this->harga = null;
        $this->lph_mapped_id = null;
        $this->status = null;

        $this->isEdit = false;
        $this->isUpdate = false;
        $this->isModal = false;
    }

    public function openDel($id)
    {
        $this->delId = $id;
        $this->isDel = true;
    }

    public function hideDel()
    {
        $this->isDel = false;
    }

    public function store(){
        try{
            $client = new Client();

                if($this->biayaId == null){
                    $res = $client->request('POST', $this->baseUrl.'api/v1/costs',[
                        'form_params' => [
                            'id_reg' => $this->id_reg,
                            'keterangan' => $this->keterangan,
                            'qty' => $this->qty,
                            'harga' => $this->harga
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }else{
                    $res = $client->request('PUT', $this->baseUrl.'api/v1/costs/'.$this->biayaId,[
                        'form_params' => [
                            'id_reg' => $this->id_reg,
                            'keterangan' => $this->keterangan,
                            'qty' => $this->qty,
                            'harga' => $this->harga
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', $this->biayaId ? 'Berhasil Diedit' : 'Berhasil Menambahkan');
                $this->emit('saved');
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $this->hideModal();
    }

    public function edit(
        $id_biayaApi,
        $id_regApi,
        $keteranganApi,
        $qtyApi,
        $hargaApi
    ){
        $this->biayaId = $id_biayaApi;
        $this->id_reg = $id_regApi;
        $this->keterangan = $keteranganApi;
        $this->qty = $qtyApi;
        $this->harga = $hargaApi;
        $this->isEdit = true;
        $this->openModal();
    }

    public function delete($id)
    {
        try {
            $client = new Client();

            $res = $client->request('DELETE', $this->baseUrl.'api/v1/costs/'.$id,[
                'headers' => [
                    'Cookie' => $this->cookie
                ]
            ]);

            session()->flash('delete', 'Berhasil Dihapus');
            $this->emit('saved');
            $this->hideDel();
        } catch (Exception $e) {
            session()->flash('delete', 'Tidak Bisa Menghapus, Coba Beberapa Saat Lagi');
            $this->emit('saved');
        }
    }

}

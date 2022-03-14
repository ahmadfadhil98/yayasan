<?php

namespace App\Http\Livewire;

use App\Models\Biaya;
use App\Models\NotifBiaya;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailBiaya extends Component
{
    public $reg_id;
    public $reg,$notif;
    public $isModal,$isDel,$isUpdate,$delId,$updateId;
    public $biayaId,$keterangan,$qty,$harga;
    public $search;
    public $lph_id;
    public $status;
    public $biayas=[];

    public function mount($reg_id,$status)
    {
        $this->reg_id = $reg_id;
        $this->status = $status;
    }

    public function render()
    {
        $statuses = config('central.status_permohonan');
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        try{
            $client = new Client();

            $res = $client->request('GET', $this->baseUrl.'api/v1/reg/'.$this->reg_id,[
                'headers' => [
                'Cookie' => $this->cookie,
                ]
            ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);
                $this->reg = $json['payload'];

            }

            $res1 = $client->request('GET', $this->baseUrl.'api/v1/costs',[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);

            if($res1->getStatusCode() == 200){
                $json = $res1->getBody();
                $json = json_decode($json, true);
                $biayaApi = $json['payload'];
            }

            foreach($biayaApi as $key=>$item){
                if($item['id_reg']==$this->reg_id){
                    $this->biayas[$key] = $item;
                }
            }


        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }


        return view('livewire.sertifikat.biaya.index',[
            'statuses' => $statuses,
        ]);
    }


    public function openModal(){
        $this->isModal = true;
    }

    public function hideModal(){
        $this->isModal = false;
        $this->keterangan = null;
        $this->qty = null;
        $this->harga = null;
    }

    public function store(){
        try{
            $client = new Client();

                if($this->biayaId == null){
                    $res = $client->request('POST', $this->baseUrl.'api/v1/costs',[
                        'form_params' => [
                            'id_reg' => $this->reg_id,
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
                            'id_reg' => $this->reg_id,
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

    public function edit($idBiaya,$keterangan,$qty,$harga){
        $this->biayaId = $idBiaya;
        $this->keterangan = $keterangan;
        $this->qty = $qty;
        $this->harga = $harga;
        $this->openModal();
    }

    public function showDel($id){
        $this->delId = $id;
        $this->isDel = true;
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

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('delete', 'Berhasil Dihapus');
                $this->emit('saved');
            }

            $this->hideDel();
        } catch (Exception $e) {
            session()->flash('delete', 'Tidak Bisa Menghapus, Coba Beberapa Saat Lagi');
            $this->emit('saved');
        }
    }

    public function hideDel()
    {
        $this->isDel = false;
    }

    public function showUpdate()
    {
        $this->updateId = $this->reg_id;
        $this->isUpdate = true;
    }

    public function hideUpdate()
    {
        $this->isUpdate = false;
    }

    public function update($id){
        $statuses = config('central.status_update');
        try{
                $client = new Client();
                    $res = $client->request('POST', $this->baseUrl.'api/v1/data_list/updatestatus',[
                        'form_params' => [
                            'status' => $statuses[$this->status],
                            'reg_id' => $id,
                            'lph_mapped_id' => $this->lph_id
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

                if($res->getStatusCode() == 200){
                    $json = $res->getBody();
                    $json = json_decode($json, true);

                    redirect()->route('daudit',[$this->reg_id,$this->status]);
                }
            }catch(Exception $e){
                $this->permohonans = [];
                session()->flash('delete', $e->getMessage());
                $this->emit('saved');
            }
    }
}

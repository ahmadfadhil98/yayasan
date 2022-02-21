<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Auditor extends Component
{
    public $isModal,$isDel,$delId;
    public $baseUrl,$user;
    public $auditId,$id_reg,$auditor_id,$create_by;
    public $regIds;
    public $cookie;

    public function render()
    {
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        $lph_id = 'D10217E0-383E-42F3-9841-827915AE0438';
        // $lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
            try{
                $client = new Client();
                    $res = $client->request('GET', $this->baseUrl.'api/v1/data_list/10030/'.$lph_id,[
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
                $res = $client->request('GET', $this->baseUrl.'api/v1/reg_auditor',[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);
                $audits = $json['payload'];

                return view('livewire.auditor.index',[
                    'audits' => $audits
                ]);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function hideModal()
    {
        $this->auditId = null;
        $this->id_reg = null;
        $this->auditor_id = null;
        $this->create_by = null;

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

                    $res = $client->request('POST', $this->baseUrl.'api/v1/reg_auditor',[
                        'form_params' => [
                            'id_reg' => $this->id_reg,
                            'auditor_id' => $this->auditor_id,
                            'create_by' => $this->create_by,
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', $this->auditId ? 'Berhasil Diedit' : 'Berhasil Menambahkan');
                $this->emit('saved');
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $this->hideModal();
    }

    public function delete($id)
    {
        try {
            $client = new Client();

            $res = $client->request('DELETE', $this->baseUrl.'api/v1/reg_auditor/'.$id,[
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

<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Audit extends Component
{
    public $isModal,$isDel,$delId;
    public $baseUrl,$user;
    public $auditId, $id_reg,$jadwal_awal,$jadwal_akhir,$jml_hari;
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
                    $res = $client->request('GET', $this->baseUrl.'api/v1/data_list/10020/'.$lph_id,[
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
                $res = $client->request('GET', $this->baseUrl.'api/v1/audit_schedule',[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);
                $audits = $json['payload'];

                return view('livewire.audit.index',[
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
        $this->jadwal_awal = null;
        $this->jadwal_akhir = null;
        $this->jml_hari = null;

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

                if($this->auditId == null){
                    $res = $client->request('POST', $this->baseUrl.'api/v1/audit_schedule',[
                        'form_params' => [
                            'id_reg' => $this->id_reg,
                            'jadwal_awal' => $this->jadwal_awal,
                            'jadwal_akhir' => $this->jadwal_akhir,
                            'jml_hari' => $this->jml_hari
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }else{
                    $res = $client->request('PUT', $this->baseUrl.'api/v1/audit_schedule/'.$this->auditId,[
                        'form_params' => [
                            'id_reg' => $this->id_reg,
                            'jadwal_awal' => $this->jadwal_awal,
                            'jadwal_akhir' => $this->jadwal_akhir,
                            'jml_hari' => $this->jml_hari
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }

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

    public function edit(
        $id_auditApi,
        $id_regApi,
        $awalApi,
        $akhirAPi,
        $jmlHariApi
    ){
        $this->auditId = $id_auditApi;
        $this->id_reg = $id_regApi;
        $this->jadwal_awal = $awalApi;
        $this->jadwal_akhir = $akhirAPi;
        $this->jml_hari = $jmlHariApi;

        $this->openModal();
    }

    public function delete($id)
    {
        try {
            $client = new Client();

            $res = $client->request('DELETE', $this->baseUrl.'api/v1/audit_schedule/'.$id,[
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

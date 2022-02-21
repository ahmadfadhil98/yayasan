<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Permohonan extends Component
{
    public $status;
    public $permohonans = [];
    public $cookie;
    public $lph_id;

    public function render()
    {
        $statuses = config('central.status_permohonan');
        // $lph_id = 'D10217E0-383E-42F3-9841-827915AE0438';

        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');

        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;

        if($this->status){
            try{
                $client = new Client();
                    $res = $client->request('GET', $this->baseUrl.'api/v1/data_list/'.$this->status.'/'.$this->lph_id,[
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

                if($res->getStatusCode() == 200){
                    $json = $res->getBody();
                    $json = json_decode($json, true);
                    $this->permohonans = $json['payload'];
                }
            }catch(Exception $e){
                $this->permohonans = [];
                session()->flash('delete', $e->getMessage());
                $this->emit('saved');
            }
        }
        return view('livewire.permohonan.index',[
            'statuses' => $statuses
        ]);
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
                    session()->flash('info', 'Berhasil Mengupdate Status');
                    $this->emit('saved');
                }
            }catch(Exception $e){
                $this->permohonans = [];
                session()->flash('delete', $e->getMessage());
                $this->emit('saved');
            }
    }
}

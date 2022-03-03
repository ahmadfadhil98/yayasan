<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HasilAudit extends Component
{
    public $user,$baseUrl,$cookie;
    public $laporans,$reg;
    public $reg_id,$status;

    public function mount($reg_id,$status)
    {
        $this->reg_id = $reg_id;
        $this->status = $status;
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
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

            $res1 = $client->request('GET', $this->baseUrl.'api/v1/audit_result?limit=99999',[
                'headers' => [
                'Cookie' => $this->cookie,
                ]
            ]);

            if($res1->getStatusCode() == 200){
                $json = $res1->getBody();
                $json = json_decode($json, true);
                $hasil = $json['payload'];
            }

            foreach ($hasil as $item){
                if($item['id_reg'] == 70507){
                    $this->laporans[] = $item;
                }
            }

        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }
        return view('livewire.sertifikat.laporan.index');
    }

}

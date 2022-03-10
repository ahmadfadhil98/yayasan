<?php

namespace App\Http\Livewire;

use App\Models\Biaya;
use App\Models\NotifBiaya;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $user, $baseUrl, $cookie;
    public $biayas;
    public $ajuan,$biaya,$audit,$fatwa;

    public function render()
    {
        $statuses = config('central.status');
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        // $lph_id = 'D10217E0-383E-42F3-9841-827915AE0438';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        $lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        // dd($cookie);

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
                $this->biayas = $json['payload'];

                $biayaApi = [];

                foreach($this->biayas as $key => $value){
                    $biayaApi[] = $value['id_biaya'];
                }

                $biayaDb = Biaya::select('id_biaya')->get();
                $biayaDb = $biayaDb->pluck('id_biaya')->toArray();

                $biaya = array_diff($biayaApi,$biayaDb);

                foreach($biaya as $key => $value){
                    $badge = NotifBiaya::updateOrCreate(['id_biaya' => $value],
                        [
                            'id_user' => $this->user->id,
                        ]);
                }

            }
        }catch(Exception $e){
            // dd($e->getMessage());
        }

        foreach ([10010,10020,10030,10040] as $item) {
            try{
                $client = new Client();
                $res = $client->request('GET', $this->baseUrl.'api/v1/data_list/'.$item.'/'.$lph_id,[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);

                if($res->getStatusCode() == 200){
                    $json = $res->getBody();
                    $json = json_decode($json, true);
                        if ($item == 10010){
                            $this->ajuan = $json['count'];
                        }elseif($item == 10020){
                            $this->biaya = $json['count'];
                        }elseif($item == 10030){
                            $this->audit = $json['count'];
                        }elseif($item == 10040){
                            $this->fatwa = $json['count'];
                        }
                }
            }catch(Exception $e){
                // dd($e->getMessage());
            }
        }

        return view('livewire.dashboard',[
            'statuses' => $statuses
        ]);

    }
}

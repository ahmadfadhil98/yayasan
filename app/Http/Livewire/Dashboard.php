<?php

namespace App\Http\Livewire;

use App\Models\Biaya;
use App\Models\NotifBiaya;
use App\Models\NotifReg;
use App\Models\Registar;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;
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
                            $data = $json['payload'];
                            $dataDb = Registar::where('status_reg',$item)->get();
                            $dataDb = $dataDb->pluck('id')->toArray();

                            foreach ($data as $i) {
                                if(!in_array($i['id_reg'],$dataDb)){
                                    $registar =Registar::create([
                                        'id_reg' => $i['id_reg'],
                                        'nama_pu'=> $i['nama_pu'],
                                        'no_daftar'=> $i['no_daftar'],
                                        'nama_jenis_daftar'=> $i['nama_jenis_daftar'],
                                        'nama_jenis_usaha'=> $i['nama_jenis_usaha'],
                                        'status_reg'=> $item
                                    ]);
                                }
                            }

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

        $notifs = Registar::where('notif',0)->paginate(3);
        return view('livewire.dashboard',[
            'statuses' => $statuses,
            'notifs' => $notifs
        ]);

    }
}

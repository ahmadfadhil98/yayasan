<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetailReg extends Component
{
    public $reg_id;

    public function mount($reg_id)
    {
        $this->reg_id = $reg_id;
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        // $cookie = '__bpjph_ct=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTE0OTA3OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.DSQ83OzX8EKNKSRHIhwmtzL1cscSTDrgTdu6I3GyEp8; __bpjph_rt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTc1Mzg0OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.FCZwWbE-_VbaLS7wDP7sJGWLe83JDBhqD-lnnRXoJ0s';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        // $lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        // dd($cookie);
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
                $reg = $json['payload'];
                // dd($reg);

                return view('livewire.detail',[
                    'reg' => $reg
                ]);
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }


    }
}

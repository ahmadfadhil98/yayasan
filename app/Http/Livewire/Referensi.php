<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Referensi extends Component
{
    use WithPagination;
    public $user,$baseUrl,$cookie;
    public $search;

    public function render()
    {
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        try{
            $client = new Client();

            if($this->search){
                $res = $client->request('GET', $this->baseUrl.'api/v1/ref?keywords='.$this->search,[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);
            }else{
                $res = $client->request('GET', $this->baseUrl.'api/v1/ref',[
                    'headers' => [
                        'Cookie' => $this->cookie
                    ]
                ]);
            }


            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);
                $references = $this->paginate($json['payload']);


                return view('livewire.referensi.index',[
                    'references' => $references
                ]);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }

    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class HasilAudit extends Component
{
    use WithFileUploads;
    public $user,$baseUrl,$cookie;
    public $laporans,$reg;
    public $reg_id,$status;
    public $isLaporan;
    public $file,$keterangan,$tgl_selesai,$hasil_audit;

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

            $res1 = $client->request('GET', $this->baseUrl.'api/v1/audit_result?order_dir=asc&limit=8000',[
                'headers' => [
                'Cookie' => $this->cookie,
                ]
            ]);

            if($res1->getStatusCode() == 200){
                $json = $res1->getBody();
                $json = json_decode($json, true);
                $this->laporans = $json['payload'];
            }

        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }
        return view('livewire.sertifikat.laporan.index');
    }

    public function showLaporan(){
        $this->isLaporan = true;
    }

    public function hideModal(){
        $this->file = null;
        $this->keterangan = null;
        $this->tgl_selesai = null;
        $this->hasil_audit = null;
        $this->isLaporan = false;
    }

    public function storeLaporan(){
        $statuses = config('central.status_update');
        try{
            $client = new Client();

            $res = $client->request('POST', $this->baseUrl.'api/v1/audit_result',[
                'form_params' => [
                    'id_reg' => $this->reg_id,
                    'file' => $this->file,
                    'keterangan' => $this->keterangan,
                    'tgl_selesai' => $this->tgl_selesai,
                    'hasil_audit' => $this->hasil_audit,
                ],
                'headers' => [
                    'Cookie' => $this->cookie
                ]
            ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                $res1 = $client->request('POST', $this->baseUrl.'api/v1/data_list/updatestatus',[
                        'form_params' => [
                            'status' => $statuses[$this->status],
                            'reg_id' => $this->reg_id,
                            'lph_mapped_id' => $this->lph_id
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);


                if($res1->getStatusCode() == 200){

                    redirect()->route('haudit',[$this->reg_id,$this->status]);
                }
                session()->flash('info', 'Berhasil Menambahkan');
                $this->emit('saved');
            }

        }catch(Exception $e){
            $this->hideModal();
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }
    }

}

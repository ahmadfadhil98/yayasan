<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class HasilAudit extends Component
{
    use WithFileUploads;
    public $user,$baseUrl,$cookie;
    public $laporans,$reg;
    public $reg_id,$status;
    public $isLaporan;
    public $file,$keterangan,$tgl_selesai,$hasil_audit;
    public $lph_id;

    public function mount($reg_id,$status)
    {
        $this->reg_id = $reg_id;
        $this->status = $status;
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
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

            $res1 = $client->request('GET', $this->baseUrl.'api/v1/audit_result?order_dir=asc&limit=999999',[
                'headers' => [
                'Cookie' => $this->cookie,
                ]
            ]);

            if($res1->getStatusCode() == 200){
                $json = $res1->getBody();
                $json = json_decode($json, true);
                $laporans = $json['payload'];
            }

            foreach($laporans as $key=>$laporan){
                if($laporan['id_reg'] == $this->reg_id){
                    $this->laporans[$key] = $laporan;
                }
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
        $file               = $this->file;
        $file_path          = $file->getRealPath();
        $file_uploaded_name = $file->getClientOriginalName();
        try{
            $client = new Client();

            $res = $client->request('POST', $this->baseUrl.'api/v1/audit_result',[
                'multipart' => [
                    [
                        'name' => 'file',
                        'filename' => $file_uploaded_name,
                        'contents' => File::get($file_path),
                    ],
                    [
                        'name' => 'id_reg',
                        'contents' => $this->reg_id,
                    ],
                    [
                        'name' => 'keterangan',
                        'contents' => $this->keterangan,
                    ],
                    [
                        'name' => 'tgl_selesai',
                        'contents' => $this->tgl_selesai,
                    ],
                    [
                        'name' => 'hasil_audit',
                        'contents' => $this->hasil_audit,
                    ],
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

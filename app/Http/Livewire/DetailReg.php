<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailReg extends Component
{
    use WithFileUploads;
    public $reg_id;
    public $status;
    public $isUpdate,$isLaporan;
    public $lph_id;
    public $file,$keterangan,$tgl_selesai,$hasil_audit;

    public function mount($reg_id,$status)
    {
        $this->reg_id = $reg_id;
        $this->status = $status;
    }

    public function render()
    {
        $statuses = config('central.status_permohonan');
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');
        // $cookie = '__bpjph_ct=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTE0OTA3OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.DSQ83OzX8EKNKSRHIhwmtzL1cscSTDrgTdu6I3GyEp8; __bpjph_rt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiJzdXJ2ZXlvciIsIm5hbWUiOiJTdXJ2ZXlvciBJbmRvbmVzaWEiLCJpYXQiOjE2NDUxNDkwNDksImV4cCI6MTY0NTc1Mzg0OSwiYXVkIjoic2loYWxhbC5icGpwaC5nby5pZCIsImlzcyI6InNpaGFsYWwuYnBqcGguZ28uaWQifQ.FCZwWbE-_VbaLS7wDP7sJGWLe83JDBhqD-lnnRXoJ0s';
        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;
        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
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

                return view('livewire.sertifikat.detail.index',[
                    'reg' => $reg,
                    'statuses' => $statuses,
                ]);
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

    }

    public function showUpdate($id)
    {
        $this->updateId = $id;
        $this->isUpdate = true;
    }

    public function hideUpdate()
    {
        $this->isUpdate = false;
    }

    public function update($id){
        $statuses = config('central.status_update');
        try{
                $client = new Client();
                    $res = $client->request('POST', $this->baseUrl.'api/v1/data_list/updatestatus',[
                        'form_params' => [
                            'status' => $statuses[$this->status],
                            'reg_id' => $this->reg_id,
                            'lph_mapped_id' => $this->lph_id
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

                if($res->getStatusCode() == 200){
                    $json = $res->getBody();
                    $json = json_decode($json, true);

                    redirect()->route('dreg',[
                        'reg_id' => $this->reg_id,
                        'status' => $this->status+10
                    ]);

                    session()->flash('info', 'Berhasil Mengupdate Status');
                    $this->emit('saved');
                }
            }catch(Exception $e){
                dd($e->getMessage());
                session()->flash('delete', $e->getMessage());
                $this->emit('saved');
            }
    }

    public function openUpdate($id){
        $this->isLaporan = true;
        $this->reg_id = $id;
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

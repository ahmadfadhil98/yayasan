<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Certificate extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $status;
    public $cookie;
    public $lph_id;
    public $isUpdate;
    public $isLaporan;
    public $reg_id;
    public $file,$keterangan,$tgl_selesai,$hasil_audit;

    public function mount($id){
        $this->status = $id;
    }

    public function render()
    {
        $statuses = config('central.status_permohonan');
        // $lph_id = 'D10217E0-383E-42F3-9841-827915AE0438';

        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
        $this->user = Auth::user();
        $this->baseUrl = config('central.baseUrl');

        $this->cookie = '__bpjph_ct='.$this->user->token.'; __bpjph_rt='.$this->user->refreshToken;

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
                $permohonans = $this->paginate($json['payload']);
            }

            return view('livewire.sertifikat.index',[
                'statuses' => $statuses,
                'permohonans' => $permohonans
            ]);

        }catch(Exception $e){
            session()->flash('delete', 'Data tidak ditemukan');
            $this->emit('saved');
            return view('livewire.sertifikat.index',[
                'statuses' => $statuses,
                'permohonans' => []
        ]);
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

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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

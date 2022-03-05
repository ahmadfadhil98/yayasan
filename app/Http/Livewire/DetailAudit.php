<?php

namespace App\Http\Livewire;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use stdClass;

class DetailAudit extends Component
{
    use WithFileUploads;
    public $reg_id,$status;
    public $user,$baseUrl,$cookie;
    public $audits,$reg;
    public $isAudit,$isAuditor,$isDelAudit,$isDelAuditor,$isUpdate,$delId,$updateId;
    public $jadwal_awal,$jadwal_akhir,$jml_hari;
    public $auditor_id,$create_by,$auditId;
    public $file,$tgl_selesai,$hasil_audit,$keterangan;
    public $lph_id;

    public function mount($reg_id,$status)
    {
        $this->reg_id = $reg_id;
        $this->status = $status;
    }

    public function render()
    {
        $this->lph_id = '3822C979-4364-4D50-80C2-F1106FEE7949';
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

            $res0 = $client->request('GET', $this->baseUrl.'api/v1/audit_schedule',[
                'headers' => [
                    'Cookie' => $this->cookie
                ]
            ]);

            if($res0->getStatusCode() == 200){
                $json = $res0->getBody();
                $json = json_decode($json, true);
                $auditApi = $json['payload'];
            }

            $res1 = $client->request('GET', $this->baseUrl.'api/v1/reg_auditor?limit=100000',[
                'headers' => [
                    'Cookie' => $this->cookie
                ]
            ]);

            if($res1->getStatusCode() == 200){
                $json = $res1->getBody();
                $json = json_decode($json, true);
                $auditorApi = $json['payload'];

            }
            // dd($auditApi);

            $audits = [];
            $itemAudit = [];
            $itemAuditor = [];

            foreach($auditApi as $item){
                if($item['id_reg']==$this->reg_id){
                    $itemAudit[] = $item;
                }
            }

            foreach($auditorApi as $item){
                if($item['id_reg']==$this->reg_id){
                    $itemAuditor[] = $item;
                }
            }

            $audits['audit'] = $itemAudit;
            $audits['auditor'] = $itemAuditor;

            $this->audits = $audits;

        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $auditors = [
            'Agus' => 'BF9A193B-81CD-4C61-BB5D-10EB381BECBD',
            'Budi' => '42224C90-11A8-40B3-9385-FFEEBF2EFE5E',
            'Caca' => 'D9D9D9D9-D9D9-D9D9-D9D9-D9D9D9D9D9D9',
            'Dede' => 'E9E9E9E9-E9E9-E9E9-E9E9-E9E9E9E9E9E9',
            'Eli' => 'F9F9F9F9-F9F9-F9F9-F9F9-F9F9F9F9F9F9',

        ];
        return view('livewire.sertifikat.audit.index',[
            'auditors' => $auditors,
        ]);
    }

    public function openAudit(){
        $this->isAudit = true;
    }

    public function hideModal(){
        $this->jadwal_awal = null;
        $this->jadwal_akhir = null;
        $this->jml_hari = null;
        $this->auditor_id = null;
        $this->create_by = null;

        $this->file = null;
        $this->keterangan = null;
        $this->tgl_selesai = null;
        $this->hasil_audit = null;

        $this->isUpdate = false;
        $this->isAudit = false;
        $this->isAuditor = false;
    }

    public function storeAudit(){
        try{
            $client = new Client();
                if($this->auditId == null){
                    $res = $client->request('POST', $this->baseUrl.'api/v1/audit_schedule',[
                        'form_params' => [
                            'id_reg' => $this->reg_id,
                            'jadwal_awal' => $this->jadwal_awal,
                            'jadwal_akhir' => $this->jadwal_akhir,
                            'jml_hari' => $this->jml_hari
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }else{
                    $res = $client->request('PUT', $this->baseUrl.'api/v1/audit_schedule/'.$this->auditId,[
                        'form_params' => [
                            'id_reg' => $this->reg_id,
                            'jadwal_awal' => $this->jadwal_awal,
                            'jadwal_akhir' => $this->jadwal_akhir,
                            'jml_hari' => $this->jml_hari
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', $this->auditId ? 'Berhasil Diedit' : 'Berhasil Menambahkan');
                $this->emit('saved');
                $this->isAudit = false;
                $this->isModal = false;
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function edit(
        $id_auditApi,
        $id_regApi,
        $awalApi,
        $akhirAPi,
        $jmlHariApi
    ){
        $this->auditId = $id_auditApi;
        $this->id_reg = $id_regApi;
        $this->jadwal_awal = $awalApi;
        $this->jadwal_akhir = $akhirAPi;
        $this->jml_hari = $jmlHariApi;

        $this->openAudit();
    }

    public function openAuditor(){
        $this->isAuditor = true;
        $this->create_by = $this->user->username;
    }

    public function storeAuditor(){
        try{
            $client = new Client();

                    $res = $client->request('POST', $this->baseUrl.'api/v1/reg_auditor',[
                        'form_params' => [
                            'id_reg' => $this->reg_id,
                            'auditor_id' => $this->auditor_id,
                            'create_by' => $this->create_by,
                        ],
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', $this->auditId ? 'Berhasil Diedit' : 'Berhasil Menambahkan');
                $this->emit('saved');
            }
        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $this->hideModal();
    }

    public function delAudit($id){
        $this->delId = $id;
        $this->isDelAudit = true;
    }

    public function delAuditor($id){
        $this->delId = $id;
        $this->isDelAuditor = true;
    }

    public function hideDel(){
        $this->isDelAudit = false;
        $this->isDelAuditor = false;
    }

    public function delete($id){
        try{
            $client = new Client();

                if($this->isDelAudit){
                    $res = $client->request('DELETE', $this->baseUrl.'api/v1/audit_schedule/'.$id,[
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }else{
                    $res = $client->request('DELETE', $this->baseUrl.'api/v1/reg_auditor/'.$id,[
                        'headers' => [
                            'Cookie' => $this->cookie
                        ]
                    ]);
                }

            if($res->getStatusCode() == 200){
                $json = $res->getBody();
                $json = json_decode($json, true);

                session()->flash('info', 'Berhasil Dihapus');
                $this->emit('saved');
            }

        }catch(Exception $e){
            session()->flash('delete', $e->getMessage());
            $this->emit('saved');
        }

        $this->hideDel();
    }

    public function showUpdate(){
        $this->isUpdate = true;
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

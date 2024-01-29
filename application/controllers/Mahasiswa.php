<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController {

    public function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mahasiswa');
        $this->methods['index_get']['limit'] = 10;
        $this->methods['index_delete']['limit'] = 10;
        $this->methods['index_post']['limit'] = 10;
        $this->methods['index_put']['limit'] = 10;
        error_reporting(0);
    }


    
    public function index_get()
    {

        $id = $this->get('id');
        $nrp = $this->get('nrp');
        if($id == null && $nrp == null){
            $mahasiswa = $this->mahasiswa->getMahasiswa();
            
        } else {
            $mahasiswa = $this->mahasiswa->getMahasiswa($id,$nrp);
        }

        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        }else{
            $this->response([
                'status' => false,
                'massage' => "id it's not found"
            ], 404); 
        } 
    }


    public function index_delete() {
        $id = $this->delete('id');
        $nrp = $this->delete('nrp');
    
        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => "Provide an id"
            ], 400);
    
        } else {
            $deletedRows = $this->mahasiswa->deleteMahasiswa($id);
            if ($deletedRows > 0) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'Deleted'
                ], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => "Id not found or already deleted"
                ], 404);
            }
        }
    }

    public function index_post(){

        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        $addRows = $this->mahasiswa->createMahasiswa($data);

        if ($addRows > 0){
            $this->response([
                'status' => true,
                'message' => 'new Mahasiswa has been created with nrp'
            ], 200);

        } else{
            $this->response([
                'status' => false,
                'message' => "failed to create new data"
            ], 404);

        }

        
    }

    public function index_put(){
        $data = [
            'nrp' => $this->put('nrp'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan'),
            'nama' => $this->put('nama'),
        ];


        $id = $this->put('id');
        $addRows = $this->mahasiswa->updateMahasiswa($data,$id);
        if ($addRows > 0){
            $this->response([
                'status' => true,
                'message' => 'new Mahasiswa has been update'
            ], 200);

        } else{
            $this->response([
                'status' => false,
                'message' => "failed to upadate"
            ], 404);

        }   
    }    
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\models\prodimodel;
use PhpParser\Node\Stmt\TryCatch;

class Prodi extends BaseController
{

    protected $pm;
    private $menu;
    private $rules; 
    public function __construct()
    {
        $this->pm = new prodimodel();

        $this->menu = [
            'beranda' => [
                'title' => 'beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif' => '',
            ],
            'prodi' => [
                'title' => 'program studi',
                'link' => base_url() . '/prodi',
                'icon' => 'fa-solid fa-building-columns',
                'aktif' => 'active',
            ],
            'semester' => [
                'title' => 'semester',
                'link' => base_url() . '/semester',
                'icon' => 'fa-solid fa-list',
                'aktif' => '',
            ],
            'mahasiswa' => [
                'title' => 'mahasiswa',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif' => '',
            ],
        ];
        $this->rules =[
            'kdprodi' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'kode prodi tidak boleh kosong',
                ]
            ],
            'nama_prodi' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'nama prodi tidak boleh kosong',
                ]
            ],
            'fakultas' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => ' fakultas tidak boleh kosong',
                ]
            ],
            'password' => [
                'rules'=>'required',
                'errors'=>[
                    'required' => 'password tidak boleh kosong',
                ]
            ],
        ];
    }

    public function index()
    {


        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">prodi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="' . base_url() . '">beranda</a></li>
                        <li class="breadcrumb-item  active" >prodi</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "data prodi";

        $query = $this->pm->find();
        $data['data_prodi'] = $query;
        return view('prodi/content', $data);
    }

    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">prodi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="' . base_url() . '">beranda</a></li>
                        <li class="breadcrumb-item"><a href="' . base_url() . '/prodi">prodi</a></li>
                        <li class="breadcrumb-item active">tambah prodi</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'tambah prodi';
        $data['action'] = base_url() . 'prodi/simpan';
        return View('prodi/input', $data);
    }

    public function simpan()
    {
       
         if (strtolower($this->request->getMethod())!=='post') {
           
            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)){

            return redirect()->back()->withInput();
        }

        $dt = $this->request->getPost();
        try {
            $simpan = $this->pm->insert($dt);
        return redirect()->to('prodi')->with('success','Data berhasil di simpan');

        } catch ( \CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
        return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    { 
      if (empty($id)){
        return redirect()->back()->with('error','hapus data gagal di lakukan parameter tidak valid');
      }  

      try {
        $this->pm->delete($id);
        return redirect()->to('prodi')->with('success','Data prodi dengan kode'.$id.'berhasil di hapus ');
      } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
        return redirect()->to('prodi')->with('error',$e->getMessage());
        }
    }

    public function edit($id) {

        $breadcrumb = '<div class="col-sm-6">
                        <h1 class="m-0">prodi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="' . base_url() . '">beranda</a></li>
                        <li class="breadcrumb-item"><a href="' . base_url() . '/prodi">prodi</a></li>
                        <li class="breadcrumb-item active">Edit Prodi</li>
                        </ol>
                    </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Prodi';
        $data['action'] = base_url() . 'prodi/update';

        $data['edit_data'] = $this->pm->find($id);
        return View('prodi/input', $data);
    }
    public function update(){
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['password']);

        if (!$this->validate($this->rules)){

            return redirect()->back()->withInput();
        }

        if(empty($dtEdit['password'])){
            unset($dtEdit['password']);
        }

        try {
            $this->pm->update($param, $dtEdit);
            return redirect()->to('prodi')->with('succes','data berhasil di update');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
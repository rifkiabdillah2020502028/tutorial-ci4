<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda' => [
                'title' => 'beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif'=>'active',
            ],
            'prodi' => [
                'title' => 'program studi',
                'link' => base_url() . '/prodi',
                'icon' => 'fa-solid fa-building-columns',
                'aktif'=>'',
            ],
            'semester' => [
                'title' => 'semester',
                'link' => base_url() . '/semester',
                'icon' => 'fa-solid fa-list',
                'aktif'=>'',
            ],
            'mahasiswa' => [
                'title' => 'mahasiswa',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif'=>'',
            ],
        ];

        $breadcrumb ='<div class="col-sm-6">
                        <h1 class="m-0">beranda</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item  active" >beranda</li>
                        </ol>
                    </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card']="welcome to my site";
        $data['selamat_datang']="selamat datang di palikasi sederhana";
        return view('template/content', $data);
    }
}

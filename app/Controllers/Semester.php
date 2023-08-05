<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Semester extends BaseController
{
    public function index()
    {
         $menu = [
            'beranda' => [
                'title' => 'beranda',
                'link' => base_url(),
                'icon' => 'fa-solid fa-house',
                'aktif'=>'',
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
                'aktif'=>'active',
            ],
            'mahasiswa' => [
                'title' => 'mahasiswa',
                'link' => base_url() . '/mahasiswa',
                'icon' => 'fa-solid fa-users',
                'aktif'=>'',
            ],
        ];

        $breadcrumb ='<div class="col-sm-6">
                        <h1 class="m-0">semester</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="' . base_url() . '">beranda</a></li>
                        <li class="breadcrumb-item  active" >semester</li>
                        </ol>
                    </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        return view('semester/content',$data);
    }
}

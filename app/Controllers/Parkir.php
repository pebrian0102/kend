<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Parkir extends BaseController
{

    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $kend = $this->db->table('tbkend');
        if (sp_no() != null) {
            $kend = $kend->where('kdsp', sp_no());
        }
        $kend = $kend->where('deleteby', null)
            ->get()->getResult();
        $data = [
            'title' => 'Data Parkir',
            'no_kend' => null,
            'parkir' => null,
            'no_kend' => null,
            'kend' => $kend,
            'uri' => $this->uri,
        ];
        return view('parkir/index', $data);
    }
    public function show()
    {
        $kend = $this->db->table('tbkend');
        if (sp_no() != null) {
            $kend = $kend->where('kdsp', sp_no());
        }
        $kend = $kend->where('deleteby', null)
            ->get()->getResult();
        $no_kend = $this->request->getVar('no_kend');
        $parkir = $this->db->table('tbbiaya')->where('no_kend', $no_kend)->where('deleteby', null)->orderBy('tgl', 'DESC')->get()->getResult();
        $data = [
            'title' => 'Data Parkir ' . get_no($no_kend),
            'parkir' => $parkir,
            'no_kend' => $no_kend,
            'kend' => $kend,
            'uri' => $this->uri,
        ];
        return view('parkir/index', $data);
    }
    public function store()
    {
        $no_kend = $this->request->getVar('no_kend');
        $cek = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        $tgl = $this->request->getVar('tgl');
        $parkir = $this->request->getVar('parkir');
        $kuli = $this->request->getVar('kuli');
        $tol = $this->request->getVar('tol');
        $lain = $this->request->getVar('lain');
        $ket = $this->request->getVar('ket');
        $parkir = str_replace('.', '', $parkir);
        $parkir = str_replace(',', '', $parkir);
        $kuli = str_replace('.', '', $kuli);
        $kuli = str_replace(',', '', $kuli);
        $tol = str_replace('.', '', $tol);
        $tol = str_replace(',', '', $tol);
        $lain = str_replace('.', '', $lain);
        $lain = str_replace(',', '', $lain);

        $data = [
            'no_kend' => $no_kend,
            'kdsp' => $cek->kdsp,
            'tgl' => $tgl,
            'ket' => $ket,
            'parkir' => (int) $parkir,
            'kuli' => (int) $kuli,
            'tol' => (int) $tol,
            'lain' => (int) $lain,
            'inputby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbiaya')->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('parkir/show?no_kend=' . $no_kend);
    }
    public function update()
    {
        $no_kend = $this->request->getVar('no_kend');
        $cek = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        $inputby = $this->request->getVar('inputby');
        $tgl = $this->request->getVar('tgl');
        $parkir = $this->request->getVar('parkir');
        $kuli = $this->request->getVar('kuli');
        $tol = $this->request->getVar('tol');
        $lain = $this->request->getVar('lain');
        $ket = $this->request->getVar('ket');
        $parkir = str_replace('.', '', $parkir);
        $parkir = str_replace(',', '', $parkir);
        $kuli = str_replace('.', '', $kuli);
        $kuli = str_replace(',', '', $kuli);
        $tol = str_replace('.', '', $tol);
        $tol = str_replace(',', '', $tol);
        $lain = str_replace('.', '', $lain);
        $lain = str_replace(',', '', $lain);

        $parkir = $this->db->table('tbbiaya')->where('no_kend', $no_kend)->where('inputby', $inputby)->get()->getRow();
        $parkir = $this->db->table('tbbiaya')->where('no_kend', $no_kend)->where('tgl <', $parkir->tgl)->orderBy('tgl', 'DESC')->get()->getRow();

        $data = [
            'no_kend' => $no_kend,
            'kdsp' => $cek->kdsp,
            'tgl' => $tgl,
            'ket' => $ket,
            'parkir' => (int) $parkir,
            'kuli' => (int) $kuli,
            'tol' => (int) $tol,
            'lain' => (int) $lain,
            'editby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbiaya')->where('no_kend', $no_kend)->where('inputby', $inputby)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('parkir/show?no_kend=' . $no_kend);
    }
    public function remove()
    {
        $no_kend = $this->request->getVar('no_kend');
        $inputby = $this->request->getVar('inputby');

        $data = [
            'deleteby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbiaya')->where('no_kend', $no_kend)->where('inputby', $inputby)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('parkir/show?no_kend=' . $no_kend);
    }
}

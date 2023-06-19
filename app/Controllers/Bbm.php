<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Config\Database;
use App\Controllers\BaseController;

class Bbm extends BaseController
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
            'title' => 'Data BBM',
            'no_kend' => null,
            'bbm' => null,
            'no_kend' => null,
            'kend' => $kend,
            'uri' => $this->uri,
        ];
        return view('bbm/index', $data);
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
        $bbm = $this->db->table('tbbbm')
            ->where('no_kend', $no_kend);
        if (sp_no() != null) {
            $bbm = $bbm->where('kdsp', sp_no());
        }
        $bbm = $bbm->where('deleteby', null)
            ->orderBy('tglisi', 'DESC')
            ->get()->getResult();
        $data = [
            'title' => 'Data BBM ' . get_no($no_kend),
            'bbm' => $bbm,
            'no_kend' => $no_kend,
            'kend' => $kend,
            'uri' => $this->uri,
        ];
        return view('bbm/index', $data);
    }
    public function store()
    {
        $no_kend = $this->request->getVar('no_kend');
        $km = $this->request->getVar('km');
        $rp = $this->request->getVar('rp');
        $liter = $this->request->getVar('liter');
        $rp = str_replace('.', '', $rp);
        $rp = str_replace(',', '', $rp);
        $bbm = $this->db->table('tbbbm')->where('no_kend', $no_kend)->orderBy('tglisi', 'DESC')->get()->getRow();
        $kend = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        if ($bbm) {
            $avg = abs(($km - $bbm->km)) / $liter;
        } else {
            $avg = 0;
        }

        $data = [
            'tglisi' => $this->request->getVar('tglisi'),
            'no_kend' => $no_kend,
            'kdsp' => $kend->kdsp,
            'km' => $km,
            'rp' => $rp,
            'liter' => $liter,
            'avg' => $avg,
            'inputby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbbm')->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('bbm/show?no_kend=' . $no_kend);
    }
    public function update()
    {
        $no_kend = $this->request->getVar('no_kend');
        $inputby = $this->request->getVar('inputby');
        $tglisi = $this->request->getVar('tglisi');
        $km = $this->request->getVar('km');
        $rp = $this->request->getVar('rp');
        $liter = $this->request->getVar('liter');
        $rp = str_replace('.', '', $rp);
        $rp = str_replace(',', '', $rp);
        $bbm = $this->db->table('tbbbm')->where('no_kend', $no_kend)->where('tglisi <', $tglisi)->where('deleteby', null)->orderBy('tglisi', 'DESC')->get()->getRow();
        if ($bbm) {
            $avg = abs(($km - $bbm->km)) / $liter;
        } else {
            $avg = 0;
        }

        $data = [
            'tglisi' => $tglisi,
            'no_kend' => $no_kend,
            'km' => $km,
            'rp' => $rp,
            'liter' => $liter,
            'avg' => $avg,
            'editby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbbm')->where('no_kend', $no_kend)->where('inputby', $inputby)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('bbm/show?no_kend=' . $no_kend);
    }
    public function remove()
    {
        $no_kend = $this->request->getVar('no_kend');
        $inputby = $this->request->getVar('inputby');

        $data = [
            'deleteby' => $this->time . ";" . user()->username
        ];
        $this->db->table('tbbbm')->where('no_kend', $no_kend)->where('inputby', $inputby)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('bbm/show?no_kend=' . $no_kend);
    }
}

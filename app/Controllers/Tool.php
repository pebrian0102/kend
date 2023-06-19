<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Tool extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function cek_nomor()
    {
        $data = [
            'title' => 'Data Service Kendaraan',
            'result' => null,
            'nosrv' => null,
        ];
        return view('tool/cek_nomor', $data);
    }
    public function cek_nomor_action()
    {
        $nosrv = $this->request->getVar('nosrv');
        $result = $this->db->table('tbservice s')
            ->select('k.*,s.*,j.jenis,f.fungsi,s.foto,')
            ->join('tbkend k', 'k.no_kend=s.no_kend')
            ->join('tbjns j', 'j.no=k.kdjns')
            ->join('tbfungsi f', 'f.no=k.kdfung')
            ->where('s.nosrv', $nosrv)
            ->where('s.deleteby', null);
        if (sp_no()) {
            $result = $result->where('s.kdsp', sp_no());
        }
        $result = $result->get()->getResult();
        if ($result) {
            $data = [
                'title' => 'Data Service Kendaraan',
                'result' => $result,
                'nosrv' => $nosrv,
            ];
            return view('tool/cek_nomor', $data);
        } else {
            session()->setFlashdata('failed', 'Data tidak ditemukan!');
            return redirect()->to('tool/cek_nomor');
        }
    }
    public function cek_kend()
    {
        $data = [
            'title' => 'Data Service Kendaraan',
            'result' => null,
            'no_kend' => null,
        ];
        return view('tool/cek_kend', $data);
    }
    public function cek_kend_action()
    {
        $no_kend = $this->request->getVar('no_kend');
        $result = $this->db->table('tbkend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('no_kend', $no_kend)
            ->where('deleteby', null);
        if (sp_no()) {
            $result = $result->where('kdsp', sp_no());
        }
        $result = $result->get()->getResult();
        if ($result) {
            $data = [
                'title' => 'Data Service Kendaraan',
                'result' => $result,
                'no_kend' => $no_kend,
            ];
            return view('tool/cek_kend', $data);
        } else {
            session()->setFlashdata('failed', 'Data tidak ditemukan!');
            return redirect()->to('tool/cek_kend');
        }
    }
    public function cetak_kend()
    {
        $sp = $this->db->table('tbsp')->where('sp !=', '00')->get()->getResult();
        $data = [
            'title' => 'Data Kendaraan',
            'sp' => $sp,
            'validation' => \Config\Services::validation(),
        ];
        return view('tool/cetak_kend', $data);
    }
    public function cetak_kend_action()
    {
        $kdsp = $this->request->getVar('kdsp');
        $kend = $this->db->table('tbkend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('kdsp', $kdsp)
            ->get()->getResult();
        $data = [
            'title' => 'Lihat Data Kendaraan',
            'kend' => $kend,
            'kdsp' => $kdsp,
        ];
        return view('data/kend/show_kend_all', $data);
    }
}

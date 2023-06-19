<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Laporan extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function sp()
    {
        $sp = $this->db->table('tbsp')->where('sp !=', '00')->get()->getResult();
        $data = [
            'title' => 'Laporan Per Stock Point',
            'result' => null,
            'kdsp' => null,
            'tglaw' => null,
            'tglak' => null,
            'sp' => $sp,
        ];
        return view('laporan/sp', $data);
    }
    public function sp_action()
    {
        $sp = $this->db->table('tbsp')->get()->getResult();
        $tglaw = $this->request->getVar('tglaw');
        $tglak = $this->request->getVar('tglak');
        $kdsp = $this->request->getVar('kdsp');
        $data = [
            'title' => 'Laporan Per Stock Point',
            'kdsp' => $kdsp,
            'tglaw' => $tglaw,
            'tglak' => $tglak,
            'sp' => $sp,
        ];
        return view('laporan/sp', $data);
    }
    public function kend()
    {
        $kend = $this->db->table('tbkend')->where('deleteby', null)->get()->getResult();
        $data = [
            'title' => 'Laporan Per Kendaraan',
            'result' => null,
            'no_kend' => null,
            'tglaw' => null,
            'tglak' => null,
            'kend' => $kend,
        ];
        return view('laporan/kend', $data);
    }
    public function kend_action()
    {
        $kend = $this->db->table('tbkend')->where('deleteby', null)->get()->getResult();
        $tglaw = $this->request->getVar('tglaw');
        $tglak = $this->request->getVar('tglak');
        if (substr($tglaw, 0, 4) != substr($tglak, 0, 4)) {
            session()->setFlashdata('failed', 'Tahun Harus Sama');
            return redirect()->to('laporan/kend');
        }
        $no_kend = $this->request->getVar('no_kend');
        $data = [
            'title' => 'Laporan Per Kendaraan',
            'no_kend' => $no_kend,
            'tglaw' => $tglaw,
            'tglak' => $tglak,
            'kend' => $kend,
        ];
        return view('laporan/kend', $data);
    }
    public function kend_jual()
    {
        $result = $this->db->table('tbjual')
            ->join('tbkend', 'tbkend.no_kend=tbjual.no_kend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('deleteby', null)->get()->getResult();
        $data = [
            'title' => 'Laporan Penjualan Kendaraan',
            'result' => $result,
        ];
        return view('laporan/kend_jual', $data);
    }
    public function bbm_show($no_kend, $tglaw, $tglak, $bln)
    {
        $thn = substr($tglaw, 0, 4);
        $bbm = $this->db->query('SELECT * FROM `tbbbm` where tglisi>="' . $tglaw . '" and tglisi<="' . $tglak . '" and MONTH(tglisi)=' . $bln . ' and no_kend="' . $no_kend . '" and isnull(deleteby)')->getResult();
        $data = [
            'title' => 'Laporan BBM Kendaraan' . $no_kend,
            'no_kend' => $no_kend,
            'kdsp' => null,
            'thn' => $thn,
            'bln' => $bln,
            'bbm' => $bbm,
        ];
        return view('laporan/bbm_show', $data);
    }
    public function service_show($no_kend, $tglaw, $tglak, $bln, $kdjns)
    {
        $thn = substr($tglaw, 0, 4);
        $result = $this->db->query('SELECT * FROM `tbservice` right join tbservice_d on tbservice_d.nosrv=tbservice.nosrv where tglsrv>="' . $tglaw . '" and tglsrv<="' . $tglak . '" and no_kend="' . $no_kend . '" and MONTH(tglsrv)=' . $bln . ' and isnull(deleteby) and kdjns="' . $kdjns . '"')->getResult();
        $data = [
            'title' => 'Laporan Service Kendaraan' . $no_kend,
            'no_kend' => $no_kend,
            'kdsp' => null,
            'thn' => $thn,
            'bln' => $bln,
            'kdjns' => $kdjns,
            'result' => $result,
        ];
        return view('laporan/service_show', $data);
    }
    public function biaya_show($no_kend, $tglaw, $tglak, $bln, $jns)
    {
        $thn = substr($tglaw, 0, 4);
        $result = $this->db->query('SELECT * FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and no_kend="' . $no_kend . '" and MONTH(tgl)=' . $bln . ' and isnull(deleteby)')->getResult();
        $data = [
            'title' => 'Laporan Service Kendaraan' . $no_kend,
            'no_kend' => $no_kend,
            'kdsp' => null,
            'thn' => $thn,
            'bln' => $bln,
            'jns' => $jns,
            'result' => $result,
        ];
        return view('laporan/biaya_show', $data);
    }
    public function bbm_show_sp($kdsp, $tglaw, $tglak, $bln)
    {
        $thn = substr($tglaw, 0, 4);
        $bbm = $this->db->query('SELECT * FROM `tbbbm` where tglisi>="' . $tglaw . '" and tglisi<="' . $tglak . '" and MONTH(tglisi)=' . $bln . ' and kdsp="' . $kdsp . '" and isnull(deleteby)')->getResult();
        $data = [
            'title' => 'Laporan BBM Kendaraan' . $kdsp,
            'kdsp' => $kdsp,
            'no_kend' => null,
            'thn' => $thn,
            'bln' => $bln,
            'bbm' => $bbm,
        ];
        return view('laporan/bbm_show', $data);
    }
    public function service_show_sp($kdsp, $tglaw, $tglak, $bln, $kdjns)
    {
        $thn = substr($tglaw, 0, 4);
        $result = $this->db->query('SELECT * FROM `tbservice` right join tbservice_d on tbservice_d.nosrv=tbservice.nosrv where tglsrv>="' . $tglaw . '" and tglsrv<="' . $tglak . '" and kdsp="' . $kdsp . '" and MONTH(tglsrv)=' . $bln . ' and isnull(deleteby) and kdjns="' . $kdjns . '"')->getResult();
        $data = [
            'title' => 'Laporan Service Kendaraan' . $kdsp,
            'kdsp' => $kdsp,
            'no_kend' => null,
            'thn' => $thn,
            'bln' => $bln,
            'kdjns' => $kdjns,
            'result' => $result,
        ];
        return view('laporan/service_show', $data);
    }
    public function biaya_show_sp($kdsp, $tglaw, $tglak, $bln, $jns)
    {
        $thn = substr($tglaw, 0, 4);
        $result = $this->db->query('SELECT * FROM `tbbiaya` where tgl>="' . $tglaw . '" and tgl<="' . $tglak . '" and kdsp="' . $kdsp . '" and MONTH(tgl)=' . $bln . ' and isnull(deleteby)')->getResult();
        $data = [
            'title' => 'Laporan Service Kendaraan' . $kdsp,
            'kdsp' => $kdsp,
            'no_kend' => null,
            'thn' => $thn,
            'bln' => $bln,
            'jns' => $jns,
            'result' => $result,
        ];
        return view('laporan/biaya_show', $data);
    }

    public function mutasi()
    {
        $kend = $this->db->table('tbkend')->where('deleteby', null)->get()->getResult();
        $data = [
            'title' => 'Data Mutasi Kendaraan',
            'result' => null,
            'no_kend' => null,
            'kend' => $kend,
        ];
        return view('laporan/mutasi', $data);
    }
    public function mutasi_action()
    {
        $no_kend = $this->request->getVar('no_kend');
        $result = $this->db->table('tbmutasi m')
            ->join('tbkend k', 'k.no_kend=m.no_kend')
            ->join('tbjns j', 'j.no=k.kdjns')
            ->join('tbfungsi f', 'f.no=k.kdfung')
            ->where('m.no_kend', $no_kend)
            ->where('k.deleteby', null)->get()->getResult();
        $kend = $this->db->table('tbkend')->where('deleteby', null)->get()->getResult();
        if ($result) {
            $data = [
                'title' => 'Data Mutasi Kendaraan',
                'result' => $result,
                'no_kend' => $no_kend,
                'kend' => $kend,
            ];
            return view('laporan/mutasi', $data);
        } else {
            session()->setFlashdata('failed', 'Data tidak ditemukan!');
            return redirect()->to('laporan/mutasi');
        }
    }
}

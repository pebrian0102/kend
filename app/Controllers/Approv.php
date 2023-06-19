<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Approv extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $result = $this->db->table('tbservice s')
            ->select('k.*,s.*,j.jenis,f.fungsi,s.foto,d.*')
            ->join('tbservice_d d', 'd.nosrv=s.nosrv')
            ->join('tbkend k', 'k.no_kend=s.no_kend')
            ->join('tbjns j', 'j.no=k.kdjns')
            ->join('tbfungsi f', 'f.no=k.kdfung')
            ->where('k.sts', 1)
            ->where('k.deleteby', null)
            ->where('s.deleteby', null);
        if (has_permission('spv')) {
            $result = $result
                ->where('s.kdsp', sp_no())
                ->where('s.app1', 0);
        } elseif (has_permission('nsm')) {
            $result = $result
                ->where('s.app1', 1)
                ->where('s.app2', 0);
        } elseif (has_permission('audit')) {
            $result = $result
                ->where('s.app1', 1)
                ->where('s.app2', 1);
        } else {
            $result = $result->where('s.app1 !=', 1)
                ->where('s.app1 !=', 2)
                ->where('s.app2 !=', 1)
                ->where('s.app2 !=', 2);
        }
        $result = $result->groupBy('s.nosrv')->get()->getResult();
        $data = [
            'title' => 'Data Service',
            'uri' => $this->uri,
            'result' => $result
        ];
        return view('approv/index', $data);
    }
    public function app_detail($nosrv = null)
    {
        if (!$nosrv) {
            $nosrv = $this->request->getVar('nosrv');
        }
        $srv = $this->db->table('tbservice s')
            ->select('k.*,s.*,j.jenis,f.fungsi,s.foto,')
            ->join('tbkend k', 'k.no_kend=s.no_kend')
            ->join('tbjns j', 'j.no=k.kdjns')
            ->join('tbfungsi f', 'f.no=k.kdfung')
            ->where('s.nosrv', $nosrv)
            ->where('s.deleteby', null);
        if (has_permission('spv') || has_permission('sp')) {
            $srv = $srv->where('s.kdsp', sp_no());
        }
        $srv = $srv->get()->getRow();
        if ($srv) {
            $srv_d = $this->db->table('tbservice_d d')
                ->where('d.nosrv', $nosrv)
                ->get()->getResult();
            $history = $this->db->table('tbservice_d')
                ->join('tbservice', 'tbservice.nosrv=tbservice_d.nosrv')
                ->join('tbmservice', 'tbmservice.no=tbservice_d.kdjns')
                ->where('tbservice.no_kend', $srv->no_kend)
                ->where('app1', 1)
                ->where('app2', 1)
                ->where('nilai_real !=', 0)
                ->where('deleteby', null)
                ->get()->getResult();
            $data = [
                'title' => 'Show Data Service',
                'srv' => $srv,
                'srv_d' => $srv_d,
                'history' => $history,
            ];
            return view('approv/app_detail', $data);
        }
        session()->setFlashdata('failed', 'Data tidak ditemukan!');
        return redirect()->to('approv/index');
    }
    public function app()
    {
        $nosrv = $this->request->getVar('nosrv');
        if (has_permission('spv')) {
            $data = [
                'app1' => 1,
                'tglapp1' => $this->time,
            ];
        } elseif (has_permission('nsm')) {
            $data = [
                'app2' => 1,
                'tglapp2' => $this->time,
            ];
        } elseif (has_permission('audit')) {
            $data = [
                'app3' => 1,
                'tglapp3' => $this->time,
            ];
        } else {
            session()->setFlashdata('failed', 'Akses Ditolak!');
            return redirect()->to('approv/index');
        }
        $this->db->table('tbservice')->where('nosrv', $nosrv)->update($data);
        session()->setFlashdata('success', 'Berhasil diUpdate');
        return redirect()->to('approv/index');
    }
    public function danied()
    {
        $nosrv = $this->request->getVar('nosrv');
        if (has_permission('spv')) {
            $data = [
                'app1' => 2,
                'tglapp1' => $this->time,
            ];
        } elseif (has_permission('nsm')) {
            $data = [
                'app2' => 2,
                'tglapp2' => $this->time,
            ];
        } elseif (has_permission('audit')) {
            $data = [
                'app3' => 2,
                'tglapp3' => $this->time,
            ];
        } else {
            session()->setFlashdata('failed', 'Akses Ditolak!');
            return redirect()->to('approv/index');
        }
        $this->db->table('tbservice')->where('nosrv', $nosrv)->update($data);
        session()->setFlashdata('success', 'Berhasil diUpdate');
        return redirect()->to('approv/index');
    }
}

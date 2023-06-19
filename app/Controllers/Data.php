<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Data extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }


    // Service
    public function service()
    {
        $result = $this->db->table('tbservice')
            ->select('tbkend.*,tbservice.*,tbjns.jenis,tbfungsi.fungsi,tbservice.foto,')
            ->join('tbservice_d', 'tbservice_d.nosrv=tbservice.nosrv')
            ->join('tbkend', 'tbkend.no_kend=tbservice.no_kend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('tbservice.deleteby', null)
            ->where('tbservice.app1 !=', 2)
            ->where('tbservice.app2 !=', 2)
            ->where('tbservice.tglsrv', null)
            ->where('tbservice.kdsp', sp_no())
            ->groupBy('nosrv')
            ->get()->getResult();
        $data = [
            'title' => 'Data Service Kendaraan',
            'result' => $result,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/service/service', $data);
    }
    public function add_service()
    {
        $service = $this->db->table('tbmservice')->get()->getResult();
        $kend = $this->db->table('tbkend')
            ->where('deleteby', null)
            ->where('sts', 1)
            ->where('kdsp', sp_no())
            ->get()->getResult();
        $data = [
            'title' => 'Tambah Data Service Kendaraan',
            'service' => $service,
            'kend' => $kend,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/service/add_service', $data);
    }
    public function service_store()
    {
        // Mendapatkan Nomor Service
        $result = $this->db->table('tbservice')->where('kdsp', sp_no())->orderBy('nosrv', 'DESC')->get()->getRow();
        if ($result) {
            if (mb_strlen(substr($result->nosrv, 5, 4) + 1) == 1) {
                $nomor = '000' . substr($result->nosrv, 5, 4) + 1;
            } elseif (mb_strlen(substr($result->nosrv, 5, 4) + 1) == 2) {
                $nomor = '00' . substr($result->nosrv, 5, 4) + 1;
            } elseif (mb_strlen(substr($result->nosrv, 5, 4) + 1) == 3) {
                $nomor = '0' . substr($result->nosrv, 5, 4) + 1;
            } else {
                $nomor = substr($result->nosrv, 5, 4) + 1;
            }
        } else {
            $nomor = '0001';
        }
        $nosrv = "S" . sp_no() . substr(gettime()->getYear(), 2, 2) . $nomor;
        $no_kend = $this->request->getVar('no_kend');
        $no_kend = str_replace(' ', '', $no_kend);

        // Validasi
        if (!$this->validate([
            'no_kend' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Kendaraan harus diisi.',
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Data Gagal Disimpan');
            return redirect()->to('/data/add_service')->withInput();
        };

        // Insert data detail
        $jml = $this->request->getVar('jml');
        $nilai_awal = 0;
        for ($i = 0; $i < $jml; $i++) {
            $nilai = $this->request->getVar('nilai' . $i);
            $kdjns = $this->request->getVar('kdjns' . $i);
            $detail = $this->request->getVar('detail' . $i);
            $km = $this->request->getVar('km' . $i);
            $nilai = str_replace(',', '', $nilai);
            $nilai = str_replace('.', '', $nilai);
            $nilai = (int)$nilai;
            $nilai_awal += $nilai;
            $cek = $this->db->table('tbservice_d')->where('nosrv', $nosrv)->orderBy('urut', 'DESC')->get()->getRow();
            if (!$cek) {
                $urut = 1;
            } else {
                $urut = $cek->urut + 1;
            }

            $data_d = [
                'nosrv' => $nosrv,
                'urut' => $urut,
                'kdjns' => $kdjns,
                'nilai' => $nilai,
                'detail' => $detail,
                'km' => $km,
                'editby' => $this->time . ';' . user()->username
            ];
            $this->db->table('tbservice_d')->insert($data_d);
        }

        $data = [
            'nosrv' => $nosrv,
            'no_kend' => $no_kend,
            'kdsp' => sp_no(),
            'nilai_awal' => $nilai_awal,
            'inputby' => $this->time . ';' . user()->username,
        ];
        $this->db->table('tbservice')->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Disimpan <br> Nomor :' . $nosrv);
        return redirect()->to('data/service');
    }
    public function edit_service($nosrv = null)
    {
        if (!$nosrv) {
            $nosrv = $this->request->getVar('nosrv');
        }
        $serv = $this->db->table('tbservice')
            ->where('nosrv', $nosrv)
            ->where('deleteby', null)
            ->get()->getRow();
        if ($serv) {
            $service = $this->db->table('tbmservice')->get()->getResult();
            $kend = $this->db->table('tbkend')
                ->where('deleteby', null)
                ->where('sts', 1)
                ->where('kdsp', sp_no())
                ->get()->getResult();

            $serv_d = $this->db->table('tbservice_d')
                ->where('nosrv', $nosrv)
                ->get()->getResult();

            $data = [
                'title' => 'Tambah Data Service Kendaraan',
                'service' => $service,
                'kend' => $kend,
                'serv' => $serv,
                'serv_d' => $serv_d,
                'validation' => \Config\Services::validation(),
            ];
            return view('data/service/edit_service', $data);
        } else {
            session()->setFlashdata('failed', 'Gagal!');
            return redirect()->to('home/dashboard');
        }
    }
    public function show_service($nosrv = null)
    {
        if (!$nosrv) {
            $nosrv = $this->request->getVar('nosrv');
        }
        $srv = $this->db->table('tbservice')
            ->select('tbkend.*,tbservice.*,tbservice.foto,tbservice_d.kdjns')
            ->join('tbkend', 'tbkend.no_kend=tbservice.no_kend')
            ->join('tbservice_d', 'tbservice_d.nosrv=tbservice.nosrv', 'left')
            ->where('tbservice.nosrv', $nosrv)
            ->where('tbservice.deleteby', null);
        if (has_permission('spv') || has_permission('sp')) {
            $srv = $srv->where('tbservice.kdsp', sp_no());
        }
        $srv = $srv->get()->getRow();
        $srv_d = $this->db->table('tbservice_d')
            ->join('tbmservice', 'tbmservice.no=tbservice_d.kdjns')
            ->where('nosrv', $nosrv)
            ->get()->getResult();
        $data = [
            'title' => 'Show Data Service',
            'srv' => $srv,
            'srv_d' => $srv_d,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/service/show_service', $data);
    }
    public function show_pengajuan($nosrv = null)
    {
        if (!$nosrv) {
            $nosrv = $this->request->getVar('nosrv');
        }
        $srv = $this->db->table('tbservice')
            ->select('tbkend.*,tbservice.*,tbservice.foto,tbservice_d.kdjns')
            ->join('tbkend', 'tbkend.no_kend=tbservice.no_kend')
            ->join('tbservice_d', 'tbservice_d.nosrv=tbservice.nosrv', 'left')
            ->where('tbservice.nosrv', $nosrv)
            ->where('tbservice.deleteby', null);
        if (has_permission('spv') || has_permission('sp')) {
            $srv = $srv->where('tbservice.kdsp', sp_no());
        }
        $srv = $srv->get()->getRow();
        $srv_d = $this->db->table('tbservice_d')
            ->join('tbmservice', 'tbmservice.no=tbservice_d.kdjns')
            ->where('nosrv', $nosrv)
            ->get()->getResult();
        $data = [
            'title' => 'Show Data Service',
            'srv' => $srv,
            'srv_d' => $srv_d,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/service/show_service_pengajuan', $data);
    }
    public function service_update()
    {
        $nosrv = $this->request->getVar('nosrv');
        $result = $this->db->table('tbservice')->where('deleteby', null)->where('nosrv', $nosrv)->get()->getRow();
        if ($result == null) {
            session()->setFlashdata('failed', 'Data Tidak ditemukan!');
        }
        $no_kend = $this->request->getVar('no_kend');
        $no_kend = str_replace(' ', '', $no_kend);

        // Validasi
        if (!$this->validate([
            'no_kend' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Kendaraan harus diisi.',
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Data Gagal Disimpan');
            return redirect()->to('/data/add_service')->withInput();
        };

        // Insert data detail
        $jml = $this->request->getVar('jml');
        $nilai_awal = 0;
        $this->db->table('tbservice_d')->where('nosrv', $nosrv)->delete();
        for ($i = 0; $i < $jml; $i++) {
            $nilai = $this->request->getVar('nilai' . $i);
            $kdjns = $this->request->getVar('kdjns' . $i);
            $detail = $this->request->getVar('detail' . $i);
            $km = $this->request->getVar('km' . $i);
            $nilai = str_replace(',', '', $nilai);
            $nilai = str_replace('.', '', $nilai);
            $nilai = (int)$nilai;
            $nilai_awal += $nilai;
            $cek = $this->db->table('tbservice_d')->where('nosrv', $nosrv)->orderBy('urut', 'DESC')->get()->getRow();
            if (!$cek) {
                $urut = 1;
            } else {
                $urut = $cek->urut + 1;
            }

            $data_d = [
                'nosrv' => $nosrv,
                'urut' => $urut,
                'kdjns' => $kdjns,
                'km' => $km,
                'nilai' => $nilai,
                'detail' => $detail,
                'editby' => $this->time . ';' . user()->username
            ];
            $this->db->table('tbservice_d')->insert($data_d);
        }

        $data = [
            'nosrv' => $nosrv,
            'no_kend' => $no_kend,
            'kdsp' => sp_no(),
            'nilai_awal' => $nilai_awal,
            'inputby' => $this->time . ';' . user()->username,
        ];
        $this->db->table('tbservice')->where('nosrv', $nosrv)->update($data);
        session()->setFlashdata('success', 'Data Berhasil Diupdate <br> Nomor :' . $nosrv);
        return redirect()->to('data/service');
    }
    public function service_delete()
    {
        $nosrv = $this->request->getVar('nosrv');
        $cek = $this->db->table('tbservice')->where('nosrv', $nosrv)->get()->getRow();
        if ($cek) {
            $data = [
                'deleteby' => $this->time . ';' . user()->username,
            ];
            $this->db->table('tbservice')->where('nosrv', $nosrv)->update($data);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to('data/service');
        } else {
            session()->setFlashdata('failed', 'Data Tidak Ditemukan!');
            return redirect()->to('data/service');
        }
    }
    public function real($nosrv = null)
    {
        if (!$nosrv) {
            $nosrv = $this->request->getVar('nosrv');
        }
        $srv = $this->db->table('tbservice')
            ->select('tbkend.*,tbservice.*,tbservice.foto,tbservice_d.kdjns')
            ->join('tbkend', 'tbkend.no_kend=tbservice.no_kend')
            ->join('tbservice_d', 'tbservice_d.nosrv=tbservice.nosrv', 'left')
            ->where('tbservice.nosrv', $nosrv)
            ->where('tbservice.deleteby', null);
        if (has_permission('spv') || has_permission('sp')) {
            $srv = $srv->where('tbservice.kdsp', sp_no());
        }
        $srv = $srv->get()->getRow();
        $srv_d = $this->db->table('tbservice_d')
            ->join('tbmservice', 'tbmservice.no=tbservice_d.kdjns')
            ->where('nosrv', $nosrv)->get()->getResult();
        $data = [
            'title' => 'Realisasi',
            'uri' => $this->uri,
            'srv' => $srv,
            'srv_d' => $srv_d,
        ];
        return view('data/service/real', $data);
    }
    public function service_real()
    {
        $nosrv = $this->request->getVar('nosrv');
        $result = $this->db->table('tbservice')->where('deleteby', null)->where('nosrv', $nosrv)->get()->getRow();
        if ($result == null) {
            session()->setFlashdata('failed', 'Data Tidak ditemukan!');
        }

        // Validasi
        if (!$this->validate([
            'nota' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Nota harus diisi.',
                ]
            ],
            'tglsrv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Service harus diisi.',
                ]
            ],
            'nm_srv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Tempat Service harus diisi.',
                ]
            ],
            'alm_srv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Tempat Service harus diisi.',
                ]
            ],
        ])) {
            session()->setFlashdata('failed', 'Data Gagal Disimpan');
            return redirect()->to('/data/service')->withInput();
        };

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $nosrv . "." . $fileFoto->getExtension();
        $fileFoto->move('assets/img/nota', $namaFoto);

        // Insert data detail
        $nilai_real = 0;
        foreach (srv_d($nosrv) as $n) {
            $detail2 = $this->request->getVar('detail2' . $n->urut);
            $nilai2 = $this->request->getVar('nilai2' . $n->urut);
            $nilai2 = str_replace(',', '', $nilai2);
            $nilai2 = str_replace('.', '', $nilai2);
            $nilai_real += $nilai2;

            $data_d = [
                'nilai2' => $nilai2,
                'detail2' => $detail2,
                'editby' => $this->time . ';' . user()->username
            ];
            $this->db->table('tbservice_d')->where('nosrv', $nosrv)->where('urut', $n->urut)->update($data_d);
        }

        $njasa = $this->request->getVar('njasa');
        if (!$njasa) {
            $njasa = 0;
        }
        $njasa = str_replace(',', '', $njasa);
        $njasa = str_replace('.', '', $njasa);
        $njasa = (int)$njasa;
        $ppn = $this->request->getVar('ppn');
        if (!$ppn) {
            $ppn = 0;
        }
        $ppn = str_replace(',', '', $ppn);
        $ppn = str_replace('.', '', $ppn);
        $ppn = (int)$ppn;

        $pph = $this->request->getVar('pph');
        if (!$pph) {
            $pph = 0;
        }
        $pph = str_replace(',', '', $pph);
        $pph = str_replace('.', '', $pph);
        $pph = (int)$pph;
        $nm_srv = $this->request->getVar('nm_srv');
        $alm_srv = $this->request->getVar('alm_srv');

        $nilai_total = $nilai_real + $njasa + $ppn - $pph;
        $cek_bengkel = $this->db->table('tbbengkel')->where('nama', $nm_srv)->get()->getRow();
        if (!$cek_bengkel) {
            $this->db->table('tbbengkel')->insert(['nama' => strtoupper($nm_srv), 'alamat' => strtoupper($alm_srv)]);
        }

        $data = [
            'nosrv' => $nosrv,
            'nota' => $this->request->getVar('nota'),
            'tglsrv' => $this->request->getVar('tglsrv'),
            'nilai_real' => $nilai_real,
            'nilai_total' => $nilai_total,
            'njasa' => $njasa,
            'ppn' => $ppn,
            'pph' => $pph,
            'nm_srv' => $nm_srv,
            'alm_srv' => $alm_srv,
            'foto' => $namaFoto,
            'inputby' => $this->time . ';' . user()->username,
        ];
        $this->db->table('tbservice')->where('nosrv', $nosrv)->update($data);
        session()->setFlashdata('success', 'Data Berhasil Diupdate <br> Nomor :' . $nosrv);
        return redirect()->to('data/service');
    }
    // End Service



    // History
    public function history()
    {
        $data = [
            'title' => 'Data History Service Kendaraan',
            'result' => null,
            'tglaw' => null,
            'tglak' => null,
        ];
        return view('data/history/index', $data);
    }
    public function history_action()
    {
        $tglaw = $this->request->getVar('tglaw');
        $tglak = $this->request->getVar('tglak');
        $result = $this->db->table('tbservice s')
            ->select('k.*,s.*,j.jenis,f.fungsi,s.foto,')
            ->join('tbkend k', 'k.no_kend=s.no_kend')
            ->join('tbjns j', 'j.no=k.kdjns')
            ->join('tbfungsi f', 'f.no=k.kdfung')
            ->where('s.deleteby', null)
            ->where('s.tglsrv >=', $tglaw)
            ->where('s.tglsrv <=', $tglak);
        if (sp_no()) {
            $result = $result->where('s.kdsp', sp_no());
        }
        $result = $result->get()->getResult();
        if ($result) {
            $data = [
                'title' => 'Data History Service Kendaraan',
                'result' => $result,
                'tglaw' => $tglaw,
                'tglak' => $tglak,
            ];
            return view('data/history/index', $data);
        } else {
            session()->setFlashdata('failed', 'Data tidak ditemukan!');
            return redirect()->to('data/history');
        }
    }

    // End History

    public function cek_bengkel()
    {
        $nama = $this->request->getVar('nama');
        $result =  $this->db->table('tbbengkel')->where('nama', $nama)->get()->getRow();
        if ($result) {
            return json_encode($result);
        }
        return false;
    }
}

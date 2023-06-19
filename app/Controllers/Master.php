<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class Master extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Data Kendaraan

    public function kend()
    {
        $result = $this->db->table('tbkend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('deleteby', null)
            ->get()->getResult();
        $sp = $this->db->table('tbsp')->get()->getResult();
        $data = [
            'title' => 'Data Kendaraan',
            'result' => $result,
            'sp' => $sp,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/kend/kend', $data);
    }
    public function add_kend()
    {
        $fungsi = $this->db->table('tbfungsi')->get()->getResult();
        $jenis = $this->db->table('tbjns')->get()->getResult();
        $sp = $this->db->table('tbsp')->get()->getResult();
        $data = [
            'title' => 'Tambah Data Kendaraan',
            'fungsi' => $fungsi,
            'jenis' => $jenis,
            'sp' => $sp,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/kend/add_kend', $data);
    }
    public function kend_store()
    {
        $no_kend = $this->request->getVar('no_kend');
        $no_kend = str_replace(' ', '', $no_kend);


        // Validasi
        if (!$this->validate([
            'no_kend' => [
                'rules' => 'required|is_unique[tbkend.no_kend]',
                'errors' => [
                    'required' => 'Nomor Kendaraan harus diisi.',
                    'is_unique' => 'Nomor Kendaraan sudah ada',
                ]
            ],
            'kdsp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stock Point harus diisi.',
                ]
            ],
            'kdfung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Fungsi Kendaraan harus diisi.',
                ]
            ],
            'kdjns' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kendaraan harus diisi.',
                ]
            ],
            'no_stnk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor STNK harus diisi.',
                ]
            ],
            'nm_stnk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pemilik STNK harus diisi.',
                ]
            ],
            'no_pjk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Pajak harus diisi.',
                ]
            ],
            'exp_pjk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Pajak STNK harus diisi.',
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Merk Kendaraan harus diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Kendaraan harus diisi.',
                ]
            ],
            'warna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Warna Kendaraan harus diisi.',
                ]
            ],
            'isi_slndr' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi Slinder harus diisi.',
                ]
            ],
            'tgl_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pembelian harus diisi.',
                ]
            ],
            'thn_buat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Pembuatan harus diisi.',
                ]
            ],
            'no_rangka' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Rangka harus diisi.',
                ]
            ],
            'no_mesin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Mesin harus diisi.',
                ]
            ],
            'sopir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sopir harus diisi.',
                ]
            ],
            'foto1' => [
                'rules' => 'max_size[foto1,3072]|is_image[foto1]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto2' => [
                'rules' => 'max_size[foto2,3072]|is_image[foto2]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto3' => [
                'rules' => 'max_size[foto3,3072]|is_image[foto3]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto4' => [
                'rules' => 'max_size[foto4,3072]|is_image[foto4]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            return redirect()->to('/master/add_kend')->withInput();
        };

        $fileFoto = $this->request->getFile('foto1');
        $namaFoto = $no_kend . '_1.' . $fileFoto->getExtension();
        $fileFoto->move('assets/img/foto_kendaraan', $namaFoto);

        $fileFoto2 = $this->request->getFile('foto2');
        $namaFoto2 = $no_kend . '_2.' . $fileFoto2->getExtension();
        $fileFoto2->move('assets/img/foto_kendaraan', $namaFoto2);

        $fileFoto3 = $this->request->getFile('foto3');
        $namaFoto3 = $no_kend . '_3.' . $fileFoto3->getExtension();
        $fileFoto3->move('assets/img/foto_kendaraan', $namaFoto3);

        $fileFoto4 = $this->request->getFile('foto4');
        $namaFoto4 = $no_kend . '_4.' . $fileFoto4->getExtension();
        $fileFoto4->move('assets/img/foto_kendaraan', $namaFoto4);


        $data = [
            'no_kend' => $no_kend,
            'kdsp' => $this->request->getVar('kdsp'),
            'kdfung' => $this->request->getVar('kdfung'),
            'kdjns' => $this->request->getVar('kdjns'),
            'no_stnk' => $this->request->getVar('no_stnk'),
            'nm_stnk' => $this->request->getVar('nm_stnk'),
            'exp_stnk' => $this->request->getVar('exp_stnk'),
            'no_pjk' => $this->request->getVar('no_pjk'),
            'exp_pjk' => $this->request->getVar('exp_pjk'),
            'merk' => $this->request->getVar('merk'),
            'type' => $this->request->getVar('type'),
            'warna' => $this->request->getVar('warna'),
            'isi_slndr' => $this->request->getVar('isi_slndr'),
            'tgl_beli' => $this->request->getVar('tgl_beli'),
            'thn_buat' => $this->request->getVar('thn_buat'),
            'no_rangka' => $this->request->getVar('no_rangka'),
            'no_mesin' => $this->request->getVar('no_mesin'),
            'sopir' => $this->request->getVar('sopir'),
            'kernet' => $this->request->getVar('kernet'),
            'foto1' => $namaFoto,
            'foto2' => $namaFoto2,
            'foto3' => $namaFoto3,
            'foto4' => $namaFoto4,
            'sts' => 1,
            'inputby' => $this->time . ';' . user()->username,
        ];
        $this->db->table('tbkend')->insert($data);
        session()->setFlashdata('success', 'Data Berhasil Disimpan');
        return redirect()->to('master/kend');
    }
    public function edit_kend($no_kend = null)
    {
        if (!$no_kend) {
            $no_kend = $this->request->getVar('no_kend');
        }
        $kend = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        $fungsi = $this->db->table('tbfungsi')->get()->getResult();
        $jenis = $this->db->table('tbjns')->get()->getResult();
        $sp = $this->db->table('tbsp')->get()->getResult();
        $data = [
            'title' => 'Tambah Data Kendaraan',
            'fungsi' => $fungsi,
            'jenis' => $jenis,
            'sp' => $sp,
            'kend' => $kend,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/kend/edit_kend', $data);
    }
    public function show_kend($no_kend = null)
    {
        if (!$no_kend) {
            $no_kend = $this->request->getVar('no_kend');
        }
        $kend = $this->db->table('tbkend')
            ->join('tbjns', 'tbjns.no=tbkend.kdjns')
            ->join('tbfungsi', 'tbfungsi.no=tbkend.kdfung')
            ->where('no_kend', $no_kend)
            ->get()->getRow();
        $data = [
            'title' => 'Show Data Kendaraan',
            'kend' => $kend,
            'validation' => \Config\Services::validation(),
        ];
        return view('data/kend/show_kend', $data);
    }
    public function kend_update()
    {
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
            'kdsp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stock Point harus diisi.',
                ]
            ],
            'kdfung' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Fungsi Kendaraan harus diisi.',
                ]
            ],
            'kdjns' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kendaraan harus diisi.',
                ]
            ],
            'no_stnk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor STNK harus diisi.',
                ]
            ],
            'nm_stnk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pemilik STNK harus diisi.',
                ]
            ],
            'no_pjk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Pajak harus diisi.',
                ]
            ],
            'exp_pjk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Pajak STNK harus diisi.',
                ]
            ],
            'merk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Merk Kendaraan harus diisi.',
                ]
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Type Kendaraan harus diisi.',
                ]
            ],
            'warna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Warna Kendaraan harus diisi.',
                ]
            ],
            'isi_slndr' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Isi Slinder harus diisi.',
                ]
            ],
            'tgl_beli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Pembelian harus diisi.',
                ]
            ],
            'thn_buat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tahun Pembuatan harus diisi.',
                ]
            ],
            'no_rangka' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Rangka harus diisi.',
                ]
            ],
            'no_mesin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nomor Mesin harus diisi.',
                ]
            ],
            'sopir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sopir harus diisi.',
                ]
            ],
            'foto1' => [
                'rules' => 'max_size[foto1,3072]|is_image[foto1]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto2' => [
                'rules' => 'max_size[foto2,3072]|is_image[foto2]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto3' => [
                'rules' => 'max_size[foto3,3072]|is_image[foto3]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'foto4' => [
                'rules' => 'max_size[foto4,3072]|is_image[foto4]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            return redirect()->to('/master/edit_kend/' . $no_kend)->withInput();
        };

        $fileFoto = $this->request->getFile('foto1');
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama1');
        } else {
            $namaFoto = $no_kend . '_1.' . $fileFoto->getExtension();
            if ($this->mRequest->getVar('fotoLama1') != 'sample.png') {
                unlink('assets/img/foto_kendaraan/' . $this->request->getVar('fotoLama1'));
            }
            $fileFoto->move('assets/img/foto_kendaraan', $namaFoto);
        }
        $fileFoto2 = $this->request->getFile('foto2');
        if ($fileFoto2->getError() == 4) {
            $namaFoto2 = $this->request->getVar('fotoLama2');
        } else {
            $namaFoto2 = $no_kend . '_2.' . $fileFoto2->getExtension();
            if ($this->mRequest->getVar('fotoLama2') != 'sample.png') {
                unlink('assets/img/foto_kendaraan/' . $this->request->getVar('fotoLama2'));
            }
            $fileFoto2->move('assets/img/foto_kendaraan', $namaFoto2);
        }
        $fileFoto3 = $this->request->getFile('foto3');
        if ($fileFoto3->getError() == 4) {
            $namaFoto3 = $this->request->getVar('fotoLama3');
        } else {
            $namaFoto3 = $no_kend . '_3.' . $fileFoto3->getExtension();
            if ($this->mRequest->getVar('fotoLama3') != 'sample.png') {
                unlink('assets/img/foto_kendaraan/' . $this->request->getVar('fotoLama3'));
            }
            $fileFoto3->move('assets/img/foto_kendaraan', $namaFoto3);
        }
        $fileFoto4 = $this->request->getFile('foto4');
        if ($fileFoto4->getError() == 4) {
            $namaFoto4 = $this->request->getVar('fotoLama4');
        } else {
            $namaFoto4 = $no_kend . '_4.' . $fileFoto4->getExtension();
            if ($this->mRequest->getVar('fotoLama4') != 'sample.png') {
                unlink('assets/img/foto_kendaraan/' . $this->request->getVar('fotoLama4'));
            }
            $fileFoto4->move('assets/img/foto_kendaraan', $namaFoto4);
        }


        $data = [
            'no_kend' => $no_kend,
            'kdsp' => $this->request->getVar('kdsp'),
            'kdfung' => $this->request->getVar('kdfung'),
            'kdjns' => $this->request->getVar('kdjns'),
            'no_stnk' => $this->request->getVar('no_stnk'),
            'nm_stnk' => $this->request->getVar('nm_stnk'),
            'exp_stnk' => $this->request->getVar('exp_stnk'),
            'no_pjk' => $this->request->getVar('no_pjk'),
            'exp_pjk' => $this->request->getVar('exp_pjk'),
            'merk' => $this->request->getVar('merk'),
            'type' => $this->request->getVar('type'),
            'warna' => $this->request->getVar('warna'),
            'isi_slndr' => $this->request->getVar('isi_slndr'),
            'tgl_beli' => $this->request->getVar('tgl_beli'),
            'thn_buat' => $this->request->getVar('thn_buat'),
            'no_rangka' => $this->request->getVar('no_rangka'),
            'no_mesin' => $this->request->getVar('no_mesin'),
            'sopir' => $this->request->getVar('sopir'),
            'kernet' => $this->request->getVar('kernet'),
            'foto1' => $namaFoto,
            'foto2' => $namaFoto2,
            'foto3' => $namaFoto3,
            'foto4' => $namaFoto4,
            'editby' => $this->time . ';' . user()->username,
        ];
        $this->db->table('tbkend')->where('no_kend', $no_kend)->update($data);
        session()->setFlashdata('success', 'Data Berhasil Diupdate');
        return redirect()->to('master/kend');
    }
    public function kend_delete()
    {
        $no_kend = $this->request->getVar('no_kend');
        $cek = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        if ($cek) {
            $data = [
                'deleteby' => $this->time . ';' . user()->username,
            ];
            $this->db->table('tbkend')->where('no_kend', $no_kend)->update($data);
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to('master/kend');
        } else {
            session()->setFlashdata('failed', 'Data Tidak Ditemukan!');
            return redirect()->to('master/kend');
        }
    }
    public function kend_mutasi()
    {
        $no_kend = $this->request->getVar('no_kend');
        $cek = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();
        if ($cek) {
            $data = [
                'kdsp' => $this->request->getVar('kdsp'),
                'editby' => $this->time . ';' . user()->username,
            ];
            $data_mutasi = [
                'no_kend' => $no_kend,
                'from' => sp($cek->kdsp),
                'to' => sp($this->request->getVar('kdsp')),
                'tgl' => $this->request->getVar('tgl'),
                'ket' => $this->request->getVar('ket'),
            ];
            $this->db->table('tbmutasi')->insert($data_mutasi);
            $this->db->table('tbkend')->where('no_kend', $no_kend)->update($data);
            session()->setFlashdata('success', 'Data Berhasil Diupdate');
            return redirect()->to('master/kend');
        } else {
            session()->setFlashdata('failed', 'Data Tidak Ditemukan!');
            return redirect()->to('master/kend');
        }
    }
    public function kend_sell()
    {
        $no_kend = $this->request->getVar('no_kend');
        $cek = $this->db->table('tbkend')->where('no_kend', $no_kend)->get()->getRow();

        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $no_kend . '.' . $fileFoto->getExtension();
        $fileFoto->move('assets/img/nota_jual', $namaFoto);

        if ($cek) {
            $data = [
                'no_kend' => $no_kend,
                'tgl_jual' => $this->request->getVar('tgl_jual'),
                'ket' => $this->request->getVar('ket'),
                'file' => $namaFoto,
                'nm' => $this->request->getVar('nm'),
                'nik' => $this->request->getVar('nik'),
                'npwp' => $this->request->getVar('npwp'),
                'alamat' => $this->request->getVar('alamat'),
                'inputby' => $this->time . ';' . user()->username,
            ];
            $data2 = [
                'sts' => 0,
                'editby' => $this->time . ';' . user()->username,
            ];
            $this->db->table('tbjual')->insert($data);
            $this->db->table('tbkend')->where('no_kend', $no_kend)->update($data2);
            session()->setFlashdata('success', 'Data Berhasil DiUpdate');
            return redirect()->to('master/kend');
        } else {
            session()->setFlashdata('failed', 'Data Tidak Ditemukan!');
            return redirect()->to('master/kend');
        }
    }
    // End Data Kendaraan

    // Master Service 

    public function service()
    {
        $result = $this->db->table('tbmservice')->get()->getResult();
        $data = [
            'title' => 'Data Service',
            'result' => $result
        ];
        return view('master/service', $data);
    }
    public function service_store()
    {
        $no = $this->request->getVar('no');
        $service = $this->request->getVar('service');
        $data = [
            'no' => $no,
            'service' => $service,
        ];
        $this->db->table('tbmservice')->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('master/service');
    }
    public function service_update()
    {
        $no = $this->request->getVar('no');
        $service = $this->request->getVar('service');
        $data = [
            'service' => $service,
        ];
        $this->db->table('tbmservice')->where('no', $no)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('master/service');
    }
    public function service_delete()
    {
        $no = $this->request->getVar('no');
        $this->db->table('tbmservice')->where('no', $no)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('master/service');
    }

    // End Master Service

    // Master Fungsi 

    public function fungsi()
    {
        $result = $this->db->table('tbfungsi')->get()->getResult();
        $data = [
            'title' => 'Data Fungsi',
            'result' => $result
        ];
        return view('master/fungsi', $data);
    }
    public function fungsi_store()
    {
        $no = $this->request->getVar('no');
        $fungsi = $this->request->getVar('fungsi');
        $data = [
            'no' => $no,
            'fungsi' => $fungsi,
        ];
        $this->db->table('tbfungsi')->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('master/fungsi');
    }
    public function fungsi_update()
    {
        $no = $this->request->getVar('no');
        $fungsi = $this->request->getVar('fungsi');
        $data = [
            'fungsi' => $fungsi,
        ];
        $this->db->table('tbfungsi')->where('no', $no)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('master/fungsi');
    }
    public function fungsi_delete()
    {
        $no = $this->request->getVar('no');
        $this->db->table('tbfungsi')->where('no', $no)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('master/fungsi');
    }

    // End Fungsi


    // Master Jenis 

    public function jenis()
    {
        $result = $this->db->table('tbjns')->get()->getResult();
        $data = [
            'title' => 'Data Jenis',
            'result' => $result
        ];
        return view('master/jenis', $data);
    }
    public function jenis_store()
    {
        $no = $this->request->getVar('no');
        $jenis = $this->request->getVar('jenis');
        $data = [
            'no' => $no,
            'jenis' => $jenis,
        ];
        $this->db->table('tbjns')->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('master/jenis');
    }
    public function jenis_update()
    {
        $no = $this->request->getVar('no');
        $jenis = $this->request->getVar('jenis');
        $data = [
            'jenis' => $jenis,
        ];
        $this->db->table('tbjns')->where('no', $no)->update($data);
        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('master/jenis');
    }
    public function jenis_delete()
    {
        $no = $this->request->getVar('no');
        $this->db->table('tbjns')->where('no', $no)->delete();
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('master/jenis');
    }

    // End Jenis

    public function info()
    {
        $info = $this->db->table('tbinfo')->orderBy('inputby', 'DESC')->get()->getRow();
        $data = [
            'title' => 'Data Pengumuman',
            'info' => $info
        ];
        return view('master/info', $data);
    }
    public function info_action()
    {
        $info = $this->request->getVar('info');
        $data = [
            'info' => $info,
            'inputby' => $this->time . ";" . user()->username,
        ];
        $this->db->table('tbinfo')->insert($data);
        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('master/info');
    }
}

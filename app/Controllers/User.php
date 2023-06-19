<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
        $this->userModel = new ModelUser();
    }
    //--------------------------------------------------------------------
    // INDEX
    //--------------------------------------------------------------------

    /**
     * Menampilkan beberapa fungsi yang ada 
     * di dalam menu INDEX
     */
    public function index()
    {
        $id = user_id();
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as userid,username,email,image');
        $this->builder->where('users.id', $id);
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data = [
            'title' => 'User Profile',
            'uri' => $this->uri,
            'user' => $query->getRow(),
            'validation' => \Config\Services::validation(),
        ];
        return view('user/index', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $username = $this->request->getVar('username');
        // cek fullnamenya
        $usernameLama = $this->userModel->getUser($this->request->getVar('usernameLama'));
        if ($usernameLama['username'] == $this->request->getVar('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[users.username]|alpha_dash';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => ' username harus diisi.',
                    'is_unique' => ' username sudah ada',
                    'alpha_dash' => 'jangan spasi(ganti dengan -,_)'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png,image/JPG]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/user')->withInput();
        };

        $fileFoto = $this->mRequest->getFile('foto');

        // cek gambar apakah tetap gambar lama
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->mRequest->getVar('fotoLama');
        } else {
            // generate nama file
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('assets/img/user', $namaFoto);
            // hapus gambar lama
            if ($this->mRequest->getVar('fotoLama') != 'default.png') {
                unlink('assets/img/user/' . $this->mRequest->getVar('fotoLama'));
            }
        }
        $data = [
            'image' => $namaFoto,
            'username' => $username
        ];
        $this->builder = $this->db->table('users');
        $this->builder->select('*');
        $this->builder->where('id', $id);
        $this->builder->update($data);

        session()->setFlashdata('success', 'Data berhasil di ubah');
        return redirect()->to('/user');
    }

    public function change_pass()
    {
        $id = $this->request->getVar('id');
        $password = $this->request->getVar('pass');
        $users = model(UserModel::class);
        $user = $users->where('id', $id)
            ->first();

        $user->password         = $password;
        $user->reset_at         = date('Y-m-d H:i:s');
        $users->save($user);
        session()->setFlashdata('success', 'Edit Password Success!');
        return redirect()->to('/logout');
    }

    //  END INDEX

    //--------------------------------------------------------------------
    // IFRAME
    //--------------------------------------------------------------------

    /**
     * Menampilkan beberapa fungsi yang ada 
     * di dalam menu IFRAME
     */
    public function iframe()
    {
        $data = [
            'title' => 'Iframe',
            'uri' => $this->uri,
        ];
        return view('iframe', $data);
    }

    //  END IFRAME

}

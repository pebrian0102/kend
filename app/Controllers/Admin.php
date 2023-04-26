<?php

namespace App\Controllers;

use Config\Database;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function index()
    {
        $this->builder = $this->db->table('auth_logins');
        $this->builder->select('*');
        $this->builder->limit(20);
        $this->builder->orderBy('date', 'DESC');
        $result = $this->builder->get()->getResult();
        $data = [
            'title' => "Administrator | Dashboard",
            'uri' => $this->uri,
            'result' => $result
        ];
        return view('admin/index', $data);
    }
    public function role()
    {
        $this->builder = $this->db->table('auth_groups');
        $this->builder->select('*');
        $this->builder->orderBy('id', 'DESC');
        $group_all = $this->builder->get()->getResult();

        $this->builder = $this->db->table('auth_permissions');
        $this->builder->select('*');
        $this->builder->orderBy('id', 'DESC');
        $perm_all = $this->builder->get()->getResult();

        $data = [
            'title' => "Administrator | Role",
            'uri' => $this->uri,
            'group_all' => $group_all,
            'perm_all' => $perm_all,
        ];
        return view('admin/role', $data);
    }
    public function change_role()
    {
        $id_g = $this->mRequest->getVar('id_g');
        $name_g = $this->mRequest->getVar('name_g');
        $desc_g = $this->mRequest->getVar('desc_g');
        $id_p = $this->mRequest->getVar('id_p');
        $name_p = $this->mRequest->getVar('name_p');
        $desc_p = $this->mRequest->getVar('desc_p');

        if ($id_g) {
            $this->builder = $this->db->table('auth_groups');
            $this->builder->select('*');
            $this->builder->where('id', $id_g);
            $result = $this->builder->get()->getRow();

            $data = [
                'name' => $name_g,
                'description' => $desc_g,
            ];
            if ($result) {
                $this->builder = $this->db->table('auth_groups');
                $this->builder->where('id', $id_g);
                $this->builder->update($data);
                session()->setFlashdata('pesan', 'Success!');
            } else {
                session()->setFlashdata('gagal', 'Failed!');
            }
        } else {
            $this->builder = $this->db->table('auth_permissions');
            $this->builder->select('*');
            $this->builder->where('id', $id_p);
            $result = $this->builder->get()->getRow();

            $data = [
                'name' => $name_p,
                'description' => $desc_p,
            ];
            if ($result) {
                $this->builder = $this->db->table('auth_permissions');
                $this->builder->where('id', $id_p);
                $this->builder->update($data);
                session()->setFlashdata('pesan', 'Success!');
            } else {
                session()->setFlashdata('gagal', 'Failed!');
            }
        }
        return redirect()->to('admin/role');
    }
    public function add_role()
    {
        $name_g = $this->mRequest->getVar('name_g');
        $desc_g = $this->mRequest->getVar('desc_g');
        $name_p = $this->mRequest->getVar('name_p');
        $desc_p = $this->mRequest->getVar('desc_p');

        if ($name_g) {
            $this->builder = $this->db->table('auth_groups');
            $this->builder->select('*');
            $this->builder->where('name', $name_g);
            $result = $this->builder->get()->getRow();

            $data = [
                'name' => $name_g,
                'description' => $desc_g,
            ];
            if ($result) {
                session()->setFlashdata('gagal', 'Failed!, Name Already Exists');
            } else {
                $this->builder = $this->db->table('auth_groups');
                $this->builder->insert($data);
                session()->setFlashdata('pesan', 'Success!');
            }
        } else {
            $this->builder = $this->db->table('auth_permissions');
            $this->builder->select('*');
            $this->builder->where('name', $name_p);
            $result = $this->builder->get()->getRow();

            $data = [
                'name' => $name_p,
                'description' => $desc_p,
            ];
            if ($result) {
                session()->setFlashdata('gagal', 'Failed!, Name Already Exists');
            } else {
                $this->builder = $this->db->table('auth_permissions');
                $this->builder->insert($data);
                session()->setFlashdata('pesan', 'Success!');
            }
        }
        return redirect()->to('admin/role');
    }
    public function delete_role()
    {
        $id_g = $this->mRequest->getVar('id_g');
        $id_p = $this->mRequest->getVar('id_p');

        if ($id_g) {
            $this->builder = $this->db->table('auth_groups');
            $this->builder->where('id', $id_g);
            $this->builder->delete();
            session()->setFlashdata('pesan', 'Success!');
        } else {
            $this->builder = $this->db->table('auth_permissions');
            $this->builder->where('id', $id_p);
            $this->builder->delete();
            session()->setFlashdata('pesan', 'Success!');
        }
        return redirect()->to('admin/role');
    }
    public function role_perm()
    {
        $this->builder = $this->db->table('auth_groups_permissions');
        $this->builder->select('auth_groups.name as gn,auth_permissions.name as pn,group_id,permission_id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_permissions.group_id');
        $this->builder->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id');
        $this->builder->orderBy('group_id', 'ASC');
        $group = $this->builder->get()->getResult();

        $this->builder = $this->db->table('auth_groups');
        $this->builder->select('*');
        $group_all = $this->builder->get()->getResult();

        $this->builder = $this->db->table('auth_permissions');
        $this->builder->select('*');
        $perm_all = $this->builder->get()->getResult();

        $data = [
            'title' => "Administrator | Group and Permission",
            'uri' => $this->uri,
            'group' => $group,
            'group_all' => $group_all,
            'perm_all' => $perm_all,
        ];
        return view('admin/role_perm', $data);
    }
    public function change_role_perm()
    {
        $group = $this->mRequest->getVar('group');
        $perm = $this->mRequest->getVar('perm');

        $this->builder = $this->db->table('auth_groups_permissions');
        $this->builder->select('*');
        $this->builder->where('group_id', $group);
        $result = $this->builder->get()->getRow();

        $data = [
            'group_id' => $group,
            'permission_id' => $perm,
        ];
        if ($result) {
            $this->builder = $this->db->table('auth_groups_permissions');
            $this->builder->where('group_id', $group);
            $this->builder->update($data);
            session()->setFlashdata('pesan', 'Success!');
        } else {
            session()->setFlashdata('gagal', 'Failed!');
        }
        return redirect()->to('admin/role_perm');
    }
    public function add_role_perm()
    {
        $group = $this->mRequest->getVar('group');
        $perm = $this->mRequest->getVar('perm');

        $this->builder = $this->db->table('auth_groups_permissions');
        $this->builder->select('*');
        $this->builder->where('group_id', $group);
        $result = $this->builder->get()->getRow();

        $data = [
            'group_id' => $group,
            'permission_id' => $perm,
        ];
        if ($result) {
            session()->setFlashdata('gagal', 'Failed, Data already exists!');
        } else {
            $this->builder = $this->db->table('auth_groups_permissions');
            $this->builder->insert($data);
            session()->setFlashdata('pesan', 'Success!');
        }
        return redirect()->to('admin/role_perm');
    }
    public function user()
    {
        $this->builder = $this->db->table('users');
        $this->builder->select('*');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left');
        $this->builder->orderBy('id', 'DESC');
        $result = $this->builder->get()->getResult();

        $this->builder = $this->db->table('auth_groups');
        $this->builder->select('*');
        $group_all = $this->builder->get()->getResult();

        $data = [
            'title' => "Administrator | User",
            'uri' => $this->uri,
            'result' => $result,
            'group_all' => $group_all,
        ];
        return view('admin/user', $data);
    }
    public function change_role_user()
    {
        $group = $this->mRequest->getVar('group');
        $user = $this->mRequest->getVar('user_id');

        $this->builder = $this->db->table('auth_groups_users');
        $this->builder->select('*');
        $this->builder->where('user_id', $user);
        $result = $this->builder->get()->getRow();

        $data = [
            'user_id' => $user,
            'group_id' => $group,
        ];
        if ($result) {
            $this->builder = $this->db->table('auth_groups_users');
            $this->builder->where('user_id', $user);
            $this->builder->update($data);
            session()->setFlashdata('pesan', 'Success!');
        } else {
            session()->setFlashdata('gagal', 'Failed!');
        }
        return redirect()->to('admin/user');
    }
    public function add_role_user()
    {
        $group = $this->mRequest->getVar('group');
        $user = $this->mRequest->getVar('user_id');

        $this->builder = $this->db->table('auth_groups_users');
        $this->builder->select('*');
        $this->builder->where('user_id', $user);
        $result = $this->builder->get()->getRow();

        $data = [
            'user_id' => $user,
            'group_id' => $group,
        ];
        if ($result) {
            session()->setFlashdata('gagal', 'Failed!');
        } else {
            $this->builder = $this->db->table('auth_groups_users');
            $this->builder->insert($data);
            session()->setFlashdata('pesan', 'Success!');
        }
        return redirect()->to('admin/user');
    }
    public function active_user($id)
    {
        $data = [
            'active' => 1,
        ];
        $this->builder = $this->db->table('users');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashdata('pesan', 'Berhasil!');
        return redirect()->to('admin/user');
    }
    public function nonactive_user($id)
    {
        $data = [
            'active' => 0,
        ];
        $this->builder = $this->db->table('users');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashdata('pesan', 'Berhasil!');
        return redirect()->to('admin/user');
    }
    public function delete_user()
    {
        $id = $this->mRequest->getVar('id');
        $this->builder = $this->db->table('users');
        $this->builder->where('id', $id);
        $this->builder->delete();
        session()->setFlashdata('pesan', 'Berhasil Dihapus!');
        return redirect()->to('admin/user');
    }
    public function edit_user()
    {
        $id = $this->mRequest->getVar('id');
        $username = $this->mRequest->getVar('username');
        $email = $this->mRequest->getVar('email');
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]',
            'email'    => 'required|valid_email',
        ];
        $data = [
            'email' => $email,
            'username' => $username,
            'updated_at' => $this->time,
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('gagal', 'Edit User Failed!');
            return redirect()->to('admin/user');
        }

        $this->builder = $this->db->table('users');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashdata('pesan', 'Edit User Success!');
        return redirect()->to('admin/user');
    }
    public function change_pass()
    {
        $id = $this->mRequest->getVar('id');
        $password = $this->mRequest->getVar('pass');

        // $data = [
        //     'password_hash' => $pass_hash,
        //     'updated_at' => $this->time,
        // ];
        $users = model(UserModel::class);
        $user = $users->where('id', $id)
            ->first();

        $user->password         = $password;
        $user->reset_at         = date('Y-m-d H:i:s');
        $users->save($user);

        // $this->builder = $this->db->table('users');
        // $this->builder->where('id', $id);
        // $this->builder->update($data);
        session()->setFlashdata('pesan', 'Edit Password Success!');
        return redirect()->to('admin/user');
    }
}

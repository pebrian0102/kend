<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User</h3>
                <p class="text-subtitle text-muted">
                    Data User
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/admin">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            User
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="container-fluid">
            <?= view('Myth\Auth\Views\_message_block') ?>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                            <button type="button" class="btn btn-outline-primary block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-add">
                                Tambah User
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Active</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($result as $r) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $r->email ?></td>
                                            <td><?= $r->username ?></td>
                                            <td>
                                                <?php if ($r->active == 1) : ?>
                                                    <a href="<?= base_url() ?>/admin/nonactive_user/<?= $r->id ?>" class="badge bg-primary">aktif</a>
                                                <?php else : ?>
                                                    <a href="<?= base_url() ?>/admin/active_user/<?= $r->id ?>" class="badge bg-secondary">nonaktif</a>
                                                <?php endif; ?>
                                            </td>
                                            <?php if (role($r->id) == null) : ?>
                                                <td><a class="badge bg-secondary">Null <?= $r->id ?></a></td>
                                            <?php else : ?>
                                                <td><a class="badge bg-success"><?= role($r->id)->name ?></a></td>
                                            <?php endif; ?>
                                            <td>
                                                <button type="button" class="badge bg-primary block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $r->id ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="badge bg-danger block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-delete<?= $r->id ?>">
                                                    Hapus
                                                </button>
                                                <?php if (role($r->id) == null) : ?>
                                                    <button type="button" class="badge bg-success block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-addrole<?= $r->id ?>">
                                                        Add Role
                                                    </button>
                                                <?php else : ?>
                                                    <button type="button" class="badge bg-warning block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-editrole<?= $r->id ?>">
                                                        Change Role
                                                    </button>
                                                <?php endif; ?>
                                                <button type="button" class="badge bg-success block  float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-change-pass<?= $r->id ?>">
                                                    Change Password
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Active</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="<?= base_url() ?>/register" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="image" value="default.png">
                        <div class="form-group">
                            <label for="email"><?= lang('Auth.email') ?></label>
                            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                            <small id="emailHelp" class="form-text text-muted"><?= lang('Auth.weNeverShare') ?></small>
                        </div>

                        <div class="form-group">
                            <label for="username"><?= lang('Auth.username') ?></label>
                            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                        </div>

                        <div class="form-group">
                            <label for="password"><?= lang('Auth.password') ?></label>
                            <input type="text" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                            <input type="text" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Add</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <?php foreach ($result as $r) : ?>
        <!-- Modal -->
        <div class="modal fade" id="modal-change-pass<?= $r->id ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Password</h4>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>/admin/change_pass" method="POST">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" value="<?= $r->id ?>" name="id">
                            <input type="text" name="pass" id="pass" class="form-control" placeholder="New Password">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php endforeach; ?>
    <?php foreach ($result as $r) : ?>
        <!-- Modal -->
        <div class="modal fade" id="modal-delete<?= $r->id ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Data</h4>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>/delete_user" method="POST">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapusnya?
                            <input type="hidden" value="<?= $r->id ?>" name="id">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php endforeach; ?>
    <?php foreach ($result as $r) : ?>
        <!-- Modal -->
        <div class="modal fade" id="modal-edit<?= $r->id ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>/admin/edit_user" method="POST">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" value="<?= $r->id ?>" name="id">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email" required value="<?= $r->email ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username" required value="<?= $r->username ?>">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Edit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php endforeach; ?>
    <!-- role -->
    <?php foreach ($result as $g) : ?>
        <!-- Modal -->
        <div class="modal fade" id="modal-editrole<?= $g->id ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Role</h4>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>/admin/change_role_user" method="POST">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="user_id">Users</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option selected value="<?= $g->id ?>"><?= $g->username ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="group">Group</label>
                                    <select name="group" id="group" class="form-control choices">
                                        <?php foreach ($group_all as $ga) : ?>
                                            <option value="<?= $ga->id ?>" <?= ($g->group_id == $ga->id) ? 'selected' : '' ?>><?= $ga->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-key"></i> Change</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <?php endforeach; ?>

    <?php foreach ($result as $r) : ?>
        <div class="modal fade" id="modal-addrole<?= $r->id ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Role</h4>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?= base_url() ?>/admin/add_role_user" method="POST">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="user_id">Users</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="<?= $r->id ?>" selected><?= $r->username ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="group">Group</label>
                                    <select name="group" id="group" class="form-control choices" required>
                                        <option value="" selected disabled>-- Select --</option>
                                        <?php foreach ($group_all as $ga) : ?>
                                            <option value="<?= $ga->id ?>"><?= $ga->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-key"></i> Add</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Group And Permission</h3>
                <p class="text-subtitle text-muted">
                    Data Group And Permission
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/admin">Admin</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Group And Permission
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Group and Permission</h3>
                        <button type="button" class="btn btn-outline-primary block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-add">
                            Add Role
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Group</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>

                                <?php foreach ($group as $g) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $g->gn; ?></td>
                                        <td><?= $g->pn; ?></td>
                                        <td>
                                            <button type="button" class="badge bg-primary block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#modal-edit<?= $g->group_id ?>">
                                                Change Role
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Group</th>
                                    <th>Permission</th>
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
    </section>
</div>
<?php foreach ($group as $g) : ?>
    <!-- Modal -->
    <div class="modal fade" id="modal-edit<?= $g->group_id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>/admin/change_role_perm" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="group">Group</label>
                                <select name="group" id="group" class="form-control">
                                    <option selected value="<?= $g->group_id ?>"><?= $g->gn ?></option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="perm">Permission</label>
                                <select name="perm" id="perm" class="form-control choices">
                                    <?php foreach ($perm_all as $pa) : ?>
                                        <option value="<?= $pa->id ?>" <?= ($g->permission_id == $pa->id) ? 'selected' : '' ?>><?= $pa->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<div class="modal fade" id="modal-add">
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
            <form action="<?= base_url() ?>/admin/add_role_perm" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="group">Group</label>
                            <select name="group" id="group" class="form-control choices" required>
                                <option value="" selected disabled>-- Select --</option>
                                <?php foreach ($group_all as $ga) : ?>
                                    <option value="<?= $ga->id ?>"><?= $ga->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="perm">Permission</label>
                            <select name="perm" id="perm" class="form-control choices" required>
                                <option value="" selected disabled>-- Select --</option>
                                <?php foreach ($perm_all as $pa) : ?>
                                    <option value="<?= $pa->id ?>"><?= $pa->name ?></option>
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
<?= $this->endSection() ?>
<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Mutasi Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Mutasi Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Mutasi Kendaraan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <h4>Filter Data</h4>
                            <form action="<?= base_url() ?>/laporan/mutasi_action" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_kend">Kendaraan</label>
                                            <select name="no_kend" id="no_kend" required class="form-control choices">
                                                <option value="" disabled selected>-- Pilih --</option>
                                                <?php foreach ($kend as $k) : ?>
                                                    <option value="<?= $k->no_kend ?>" <?= (($no_kend ? $no_kend : "") == $k->no_kend ? 'selected' : '') ?>><?= $k->no_kend ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($result) : ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Data Mutasi Kendaraan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped" style="width:2500px;">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                            <th>Stock Point</th>
                                            <th>No. Polisi</th>
                                            <th>Merk/Type</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Fungsi Kendaraan</th>
                                            <th>Asal</th>
                                            <th>Tujuan</th>
                                            <th>Tanggal Mutasi</th>
                                            <th>Keterangan</th>
                                            <th class="bg-primary text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>

                                        <?php foreach ($result as $r) : ?>
                                            <tr>
                                                <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                                <td><?= sp($r->kdsp) ?></td>
                                                <td><?= $r->no_kend; ?></td>
                                                <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                                <td><?= $r->jenis; ?></td>
                                                <td><?= $r->fungsi; ?></td>
                                                <td><?= $r->from; ?></td>
                                                <td><?= $r->to; ?></td>
                                                <td><?= $r->tgl; ?></td>
                                                <td><?= $r->ket; ?></td>
                                                <td class="bg-primary text-white d-flex">
                                                    <div class="btn-group dropstart">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li class="dropdown-item">
                                                                <button type="button" onclick="open_service('<?= $r->no_kend ?>')" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Lihat data">
                                                                    <i class="fas fa-eye"></i> Lihat Data
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
<script>
    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
    }
</script>


<?= $this->endSection() ?>
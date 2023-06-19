<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Kendaraan
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
                            <form action="<?= base_url() ?>/tool/cek_kend_action" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_kend">Nomor Kendaraan</label>
                                            <input type="text" name="no_kend" id="no_kend" class="form-control" required value="<?= ($no_kend) ? $no_kend : '' ?>" placeholder="Nomor Kendaraan">
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
                            <h4 class="card-title">Data Kendaraan</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped" style="width:2000px;">
                                    <thead>
                                        <tr>
                                            <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                            <th>Stock Point</th>
                                            <th>Nomor Polisi</th>
                                            <th>Nomor STNK</th>
                                            <th>Merk/Type</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Fungsi Kendaraan</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Tahun Pembuatan</th>
                                            <th>Isi Silinder</th>
                                            <th>Warna</th>
                                            <th>Nomor Rangka</th>
                                            <th>Nomor Mesin</th>
                                            <th>Status Kendaraan</th>
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
                                                <td><?= $r->no_stnk; ?></td>
                                                <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                                <td><?= $r->jenis; ?></td>
                                                <td><?= $r->fungsi; ?></td>
                                                <td><?= $r->tgl_beli; ?></td>
                                                <td><?= $r->thn_buat; ?></td>
                                                <td><?= $r->isi_slndr; ?></td>
                                                <td><?= $r->warna; ?></td>
                                                <td><?= $r->no_rangka; ?></td>
                                                <td><?= $r->no_mesin; ?></td>
                                                <td>
                                                    <?php if ($r->sts == 0) : ?>
                                                        <span class="badge bg-danger">Sudah Dijual</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-success">Aktif</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="bg-primary text-white">
                                                    <button type="button" onclick="open_service('<?= $r->no_kend ?>')" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Lihat data">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
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
    function open_service(no_kend) {
        window.open('<?= base_url() ?>/data/show_kend/' + no_kend, '_blank');
    }
</script>

<?= $this->endSection() ?>
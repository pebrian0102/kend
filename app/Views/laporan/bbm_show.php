<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-column">
                        <h4 class="card-title">Data BBM ( <?= ($no_kend) ? get_no($no_kend) : '' ?> )</h4>
                        <small>Tahun : <?= $thn ?></small>
                        <small>Bulan : <?= $bln ?></small>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped" style="width:1100px;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Stock Point</th>
                                        <th>Tanggal</th>
                                        <th>KM</th>
                                        <th>Rupiah</th>
                                        <th>Jumlah Liter</th>
                                        <th>Rata-rata KM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($bbm) : ?>
                                        <?php $i = 1 ?>

                                        <?php foreach ($bbm as $r) : ?>
                                            <tr>
                                                <td><?= $i++ ?></td>
                                                <td><?= sp($r->kdsp) ?></td>
                                                <td><?= $r->tglisi; ?></td>
                                                <td><?= $r->km; ?></td>
                                                <td><?= number_format($r->rp, ((int) $r->rp == $r->rp ? 0 : 0), '.', ',')  ?></td>
                                                <td><?= $r->liter; ?></td>
                                                <td><?= $r->avg; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
    }
</script>

<?= $this->endSection() ?>
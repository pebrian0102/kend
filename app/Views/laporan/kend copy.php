<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Laporan Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Laporan Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/laporan">Laporan</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Laporan Kendaraan
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
                            <form action="<?= base_url() ?>/laporan/kend_action" method="post">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tglaw">Tanggal Awal</label>
                                            <input type="date" name="tglaw" id="tglaw" class="form-control" required value="<?= ($tglaw) ? $tglaw : gettime()->toDateString() ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tglak">Tanggal Akhir</label>
                                            <input type="date" name="tglak" id="tglak" class="form-control" required value="<?= ($tglak) ? $tglak : gettime()->toDateString() ?>">
                                        </div>
                                    </div>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Keseluruhan Biaya ( <?= ($no_kend ? get_no($no_kend) : '') ?> )</h4>
                    </div>
                    <div class="card-body">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">
                                Mengklik pada masing-masing kolom akan menampilkan data yang lebih detail. Bagan ini memanfaatkan fitur telusuri di Bagan Tinggi untuk beralih antar set data dengan mudah.
                            </p>
                        </figure>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php if ($no_kend) : ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        function open_service(nosrv) {
            window.open('<?= base_url() ?>/data/show_service/' + nosrv, '_blank');
        }
        // Create the chart
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Data Pengeluaran Biaya Kendaraan'
            },
            subtitle: {
                align: 'left',
                text: 'Nomor Kendaraan :  <?= ($no_kend ? get_no($no_kend) : '') ?> '
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Biaya'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    cursor: 'pointer',
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
            },

            series: [{
                name: 'Home',
                colorByPoint: true,
                data: [{
                        name: 'Service',
                        y: <?= get_service_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Service'
                    },
                    {
                        name: 'BBM',
                        y: <?= get_bbm_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'BBM'
                    },
                    {
                        name: 'Parkir',
                        y: <?= get_parkir_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Parkir'
                    },
                    {
                        name: 'Tol',
                        y: <?= get_tol_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Tol'
                    },
                    {
                        name: 'Kuli',
                        y: <?= get_kuli_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Kuli'
                    },
                    {
                        name: 'Lain-lain',
                        y: <?= get_lain_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Lain-lain'
                    },
                ]
            }],

            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [
                    {
                        name: 'Service Detail Mesin',
                        id: 'Service Detail Mesin',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R01") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R01") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R01") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R01") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R01") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R01") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R01") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R01") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R01") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R01") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R01") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R01") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service Detail Body',
                        id: 'Service Detail Body',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R02") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R02") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R02") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R02") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R02") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R02") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R02") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R02") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R02") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R02") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R02") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R02") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service Detail Transmisi',
                        id: 'Service Detail Transmisi',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R03") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R03") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R03") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R03") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R03") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R03") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R03") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R03") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R03") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R03") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R03") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R03") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service Detail Ban',
                        id: 'Service Detail Ban',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R04") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R04") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R04") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R04") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R04") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R04") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R04") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R04") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R04") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R04") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R04") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R04") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service Detail Non Mesin',
                        id: 'Service Detail Non Mesin',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R05") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R05") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R05") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R05") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R05") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R05") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R05") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R05") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R05") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R05") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R05") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R05") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service Detail Ganti Olie',
                        id: 'Service Detail Ganti Olie',
                        data: [
                            [
                                'Januari',
                                <?= get_service_details($no_kend, "01", "R06") ?>
                            ],
                            [
                                'Februari',
                                <?= get_service_details($no_kend, "02", "R06") ?>
                            ],
                            [
                                'Maret',
                                <?= get_service_details($no_kend, "03", "R06") ?>
                            ],
                            [
                                'April',
                                <?= get_service_details($no_kend, "04", "R06") ?>
                            ],
                            [
                                'Mei',
                                <?= get_service_details($no_kend, "05", "R06") ?>
                            ],
                            [
                                'Juni',
                                <?= get_service_details($no_kend, "06", "R06") ?>
                            ],
                            [
                                'Juli',
                                <?= get_service_details($no_kend, "07", "R06") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_service_details($no_kend, "08", "R06") ?>
                            ],
                            [
                                'September',
                                <?= get_service_details($no_kend, "09", "R06") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_service_details($no_kend, "10", "R06") ?>
                            ],
                            [
                                'November',
                                <?= get_service_details($no_kend, "11", "R06") ?>
                            ],
                            [
                                'Desember',
                                <?= get_service_details($no_kend, "12", "R06") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Parkir',
                        id: 'Parkir',
                        data: [
                            [
                                'Januari',
                                <?= get_parkir_detail($no_kend, "01") ?>
                            ],
                            [
                                'Februari',
                                <?= get_parkir_detail($no_kend, "02") ?>
                            ],
                            [
                                'Maret',
                                <?= get_parkir_detail($no_kend, "03") ?>
                            ],
                            [
                                'April',
                                <?= get_parkir_detail($no_kend, "04") ?>
                            ],
                            [
                                'Mei',
                                <?= get_parkir_detail($no_kend, "05") ?>
                            ],
                            [
                                'Juni',
                                <?= get_parkir_detail($no_kend, "06") ?>
                            ],
                            [
                                'Juli',
                                <?= get_parkir_detail($no_kend, "07") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_parkir_detail($no_kend, "08") ?>
                            ],
                            [
                                'September',
                                <?= get_parkir_detail($no_kend, "09") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_parkir_detail($no_kend, "10") ?>
                            ],
                            [
                                'November',
                                <?= get_parkir_detail($no_kend, "11") ?>
                            ],
                            [
                                'Desember',
                                <?= get_parkir_detail($no_kend, "12") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Lain-lain',
                        id: 'Lain-lain',
                        data: [
                            [
                                'Januari',
                                <?= get_lain_detail($no_kend, "01") ?>
                            ],
                            [
                                'Februari',
                                <?= get_lain_detail($no_kend, "02") ?>
                            ],
                            [
                                'Maret',
                                <?= get_lain_detail($no_kend, "03") ?>
                            ],
                            [
                                'April',
                                <?= get_lain_detail($no_kend, "04") ?>
                            ],
                            [
                                'Mei',
                                <?= get_lain_detail($no_kend, "05") ?>
                            ],
                            [
                                'Juni',
                                <?= get_lain_detail($no_kend, "06") ?>
                            ],
                            [
                                'Juli',
                                <?= get_lain_detail($no_kend, "07") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_lain_detail($no_kend, "08") ?>
                            ],
                            [
                                'September',
                                <?= get_lain_detail($no_kend, "09") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_lain_detail($no_kend, "10") ?>
                            ],
                            [
                                'November',
                                <?= get_lain_detail($no_kend, "11") ?>
                            ],
                            [
                                'Desember',
                                <?= get_lain_detail($no_kend, "12") ?>
                            ],
                        ]
                    },
                    {
                        name: 'BBM',
                        id: 'BBM',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_bbm_detail($no_kend, $thn, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    tahun: <?= $thn ?>,
                                    bulan: "<?= $i ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            location.href = '<?= base_url() ?>/lapor/bbm_show/' +
                                                this.options.no + '/' + this.options.tahun + '/' + this.options.bulan;
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Tol',
                        id: 'Tol',
                        data: [
                            [
                                'Januari',
                                <?= get_tol_detail($no_kend, "01") ?>
                            ],
                            [
                                'Februari',
                                <?= get_tol_detail($no_kend, "02") ?>
                            ],
                            [
                                'Maret',
                                <?= get_tol_detail($no_kend, "03") ?>
                            ],
                            [
                                'April',
                                <?= get_tol_detail($no_kend, "04") ?>
                            ],
                            [
                                'Mei',
                                <?= get_tol_detail($no_kend, "05") ?>
                            ],
                            [
                                'Juni',
                                <?= get_tol_detail($no_kend, "06") ?>
                            ],
                            [
                                'Juli',
                                <?= get_tol_detail($no_kend, "07") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_tol_detail($no_kend, "08") ?>
                            ],
                            [
                                'September',
                                <?= get_tol_detail($no_kend, "09") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_tol_detail($no_kend, "10") ?>
                            ],
                            [
                                'November',
                                <?= get_tol_detail($no_kend, "11") ?>
                            ],
                            [
                                'Desember',
                                <?= get_tol_detail($no_kend, "12") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Kuli',
                        id: 'Kuli',
                        data: [
                            [
                                'Januari',
                                <?= get_kuli_detail($no_kend, "01") ?>
                            ],
                            [
                                'Februari',
                                <?= get_kuli_detail($no_kend, "02") ?>
                            ],
                            [
                                'Maret',
                                <?= get_kuli_detail($no_kend, "03") ?>
                            ],
                            [
                                'April',
                                <?= get_kuli_detail($no_kend, "04") ?>
                            ],
                            [
                                'Mei',
                                <?= get_kuli_detail($no_kend, "05") ?>
                            ],
                            [
                                'Juni',
                                <?= get_kuli_detail($no_kend, "06") ?>
                            ],
                            [
                                'Juli',
                                <?= get_kuli_detail($no_kend, "07") ?>
                            ],
                            [
                                'Agustus',
                                <?= get_kuli_detail($no_kend, "08") ?>
                            ],
                            [
                                'September',
                                <?= get_kuli_detail($no_kend, "09") ?>
                            ],
                            [
                                'Oktober',
                                <?= get_kuli_detail($no_kend, "10") ?>
                            ],
                            [
                                'November',
                                <?= get_kuli_detail($no_kend, "11") ?>
                            ],
                            [
                                'Desember',
                                <?= get_kuli_detail($no_kend, "12") ?>
                            ],
                        ]
                    },
                    {
                        name: 'Service',
                        id: 'Service',
                        data: [{
                                name: 'Mesin',
                                y: <?= get_service_alls($no_kend, $thn, "R01") ?>,
                                drilldown: 'Service Detail Mesin'
                            },
                            {
                                name: 'Body',
                                y: <?= get_service_alls($no_kend, $thn, "R02") ?>,
                                drilldown: 'Service Detail Body'
                            },
                            {
                                name: 'Transmisi',
                                y: <?= get_service_alls($no_kend, $thn, "R03") ?>,
                                drilldown: 'Service Detail Transmisi'
                            },
                            {
                                name: 'Ban',
                                y: <?= get_service_alls($no_kend, $thn, "R04") ?>,
                                drilldown: 'Service Detail Ban'
                            },
                            {
                                name: 'Non Mesin',
                                y: <?= get_service_alls($no_kend, $thn, "R05") ?>,
                                drilldown: 'Service Detail Non Mesin'
                            },
                            {
                                name: 'Ganti Olie',
                                y: <?= get_service_alls($no_kend, $thn, "R06") ?>,
                                drilldown: 'Service Detail Ganti Olie'
                            },
                        ]
                    }
                ]
            },


        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
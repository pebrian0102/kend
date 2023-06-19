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
            <div class="col-md-12">
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
                        name: 'Kuli',
                        y: <?= get_kuli_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Kuli'
                    },
                    {
                        name: 'Tol',
                        y: <?= get_tol_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Tol'
                    },
                    {
                        name: 'Lain Lain',
                        y: <?= get_lain_all($no_kend, $tglaw, $tglak) ?>,
                        drilldown: 'Lain Lain'
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
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R01") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R01",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service Detail Body',
                        id: 'Service Detail Body',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R02") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R02",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service Detail Transmisi',
                        id: 'Service Detail Transmisi',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R03") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R03",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service Detail Ban',
                        id: 'Service Detail Ban',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R04") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R04",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service Detail Non Mesin',
                        id: 'Service Detail Non Mesin',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R05") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R05",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service Detail Ganti Olie',
                        id: 'Service Detail Ganti Olie',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_service_details($no_kend, $tglaw, $tglak, $i, "R06") ?>,
                                    no: "<?= $no_kend ?>",
                                    kdjns: "R06",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/service_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/' + this.options.kdjns, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Service',
                        id: 'Service',
                        data: [{
                                name: 'Mesin',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R01") ?>,
                                drilldown: 'Service Detail Mesin'
                            },
                            {
                                name: 'Body',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R02") ?>,
                                drilldown: 'Service Detail Body'
                            },
                            {
                                name: 'Transmisi',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R03") ?>,
                                drilldown: 'Service Detail Transmisi'
                            },
                            {
                                name: 'Ban',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R04") ?>,
                                drilldown: 'Service Detail Ban'
                            },
                            {
                                name: 'Non Mesin',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R05") ?>,
                                drilldown: 'Service Detail Non Mesin'
                            },
                            {
                                name: 'Ganti Olie',
                                y: <?= get_service_alls($no_kend, $tglaw, $tglak, "R06") ?>,
                                drilldown: 'Service Detail Ganti Olie'
                            },
                        ]
                    },
                    {
                        name: 'BBM',
                        id: 'BBM',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_bbm_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/bbm_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        stack: 'BBM',
                        name: 'BBM2',
                        id: 'BBM',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_bbm_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/bbm_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan, "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Parkir',
                        id: 'Parkir',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_parkir_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/biaya_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/01', "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Kuli',
                        id: 'Kuli',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_kuli_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/biaya_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/02', "_blank");
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
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_tol_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/biaya_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/03', "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                    {
                        name: 'Lain Lain',
                        id: 'Lain Lain',
                        data: [
                            <?php for ($i = 1; $i <= 12; $i++) : ?> {
                                    y: <?= get_lain_detail($no_kend, $tglaw, $tglak, $i) ?>,
                                    no: "<?= $no_kend ?>",
                                    bulan: "<?= $i ?>",
                                    tglaw: "<?= $tglaw ?>",
                                    tglak: "<?= $tglak ?>",
                                    name: "<?= get_nm_bln($i) ?>",
                                    events: {
                                        click() {
                                            window.open('<?= base_url() ?>/laporan/biaya_show/' +
                                                this.options.no + '/' + this.options.tglaw + '/' + this.options.tglak + '/' + this.options.bulan + '/04', "_blank");
                                        }
                                    }
                                },
                            <?php endfor; ?>
                        ]
                    },
                ]
            },


        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
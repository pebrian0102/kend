<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Edit Form Pengajuan Service Kendaraan</h4>
                        <h2 id="total">Total : <?= $serv->nilai_awal ?></h2>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="<?= base_url() ?>/data/service_update" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="nosrv" value="<?= $serv->nosrv ?>">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_kend">Nomor Kendaraan</label>
                                            <select name="no_kend" id="no_kend" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($kend as $f) : ?>
                                                    <option value="<?= $f->no_kend ?>" <?= ((old('no_kend') ? old('no_kend') : $serv->no_kend) == $f->no_kend ? 'selected' : '') ?>><?= $f->no_kend ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_kend') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Rincian Service</h4>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="btn btn-primary" onclick="add()">Tambah</span>
                                        <span class="btn btn-danger" onclick="remove()">Hapus</span>
                                    </div>
                                </div>
                                <div id="service">
                                    <?php foreach ($serv_d as $x => $s) : ?>
                                        <div class="row mt-2 mb-2 rounded service" style="border:1px solid #ededed; padding:10px;">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="kdjns<?= $x ?>">Jenis Service Kendaraan</label>
                                                    <select name="kdjns<?= $x ?>" id="kdjns<?= $x ?>" required class="form-control choices2" onchange="jns(this,0)">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <?php foreach ($service as $f) : ?>
                                                            <option value="<?= $f->no ?>" <?= ($s->kdjns == $f->no) ? 'selected' : '' ?>><?= $f->service ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="nilai<?= $x ?>">Pengajuan Nilai / Biaya Service (Rupiah)</label>
                                                    <input type="text" required id="nilai<?= $x ?>" required class="form-control nilai" placeholder="Nilai / Biaya Service (Rupiah)" name="nilai<?= $x ?>" onchange="cek_nilai(this)" value="<?= $s->nilai ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="detail<?= $x ?>">Rincian Masalah</label>
                                                    <textarea required name="detail<?= $x ?>" id="detail<?= $x ?>" cols="30" rows="3" class="form-control" placeholder="Contoh: Kerusakan AKI Mobil"><?= $s->detail ?></textarea>
                                                </div>
                                            </div>
                                            <?php if ($s->kdjns == "R06" || $s->kdjns == "R01" || $s->kdjns == "R04") : ?>
                                                <div class="col-md-2 col-12 km<?= $x ?>">
                                                    <div class="form-group">
                                                        <label for="km<?= $x ?>">Kilometer</label>
                                                        <input type="text" placeholder="Km" name="km<?= $x ?>" id="km<?= $x ?>" class="form-control" value="<?= $s->km ?>">
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-md-2 col-12 km<?= $x ?> d-none">
                                                    <div class="form-group">
                                                        <label for="km<?= $x ?>">Kilometer</label>
                                                        <input type="text" placeholder="Km" name="km<?= $x ?>" id="km<?= $x ?>" class="form-control" value="<?= $s->km ?>">
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <input type="hidden" value="<?= count($serv_d) ?>" name="jml" class="jml">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary btn-submit me-1 mb-1">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                        Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.min.js"></script>
<script>
    function jns(e, l) {
        if (e.value == "R06" || e.value == "R01" || e.value == "R04") {
            $('.km' + l).removeClass('d-none');
            $('.km input' + l).removeAttr('required');
        } else {
            $('.km' + l).addClass('d-none');
            $('.km input' + l).prop('required', true);
        }
    }
    var choices2 = $('.choices2');
    for (let i = 0; i < choices2.length; i++) {
        new Choices(choices2[i], {
            shouldSort: false,
        });
    }

    function format(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function remove_format(x) {
        return x.toString().replace(",", "");
    }

    function NumericInput(inp, locale) {
        var numericKeys = '0123456789';
        inp.addEventListener('keypress', function(e) {
            var event = e || window.event;
            var target = event.target;
            if (event.charCode == 0) {
                return;
            }
            if (-1 == numericKeys.indexOf(event.key)) {
                event.preventDefault();
                return;
            }
        });
        inp.addEventListener('blur', function(e) {
            var event = e || window.event;
            var target = event.target;

            var tmp = target.value.replace(/[,.]/g, '');
            var val = Number(tmp).toLocaleString(locale);

            if (tmp == '') {
                target.value = '';
            } else {
                target.value = val;
            }
        });

        inp.addEventListener('focus', function(e) {
            var event = e || window.event;
            var target = event.target;
            var val = target.value.replace(/[,.]/g, '');

            target.value = val;
        });
    }

    function cek_nilai(e) {
        var nilai = 0;
        for (let i = 0; i < $('.nilai').length; i++) {
            const element = $('.nilai')[i];
            nilai += parseInt(remove_format(element.value));
        }
        $('#total').html('Total : ' + format(nilai));
        var text = new NumericInput(e);
    }

    function add() {
        var e = document.querySelectorAll('.service');
        $('#service').append(`<div class="row mt-2 mb-2 rounded service" style="border:1px solid #ededed; padding:10px;">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kdjns` + e.length + `">Jenis Service Kendaraan</label>
                                            <select name="kdjns` + e.length + `" id="kdjns` + e.length + `" required class="form-control choices2" onchange="jns(this,` + e.length + `)">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($service as $f) : ?>
                                                    <option value="<?= $f->no ?>"><?= $f->service ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nilai` + e.length + `">Pengajuan Nilai / Biaya Service (Rupiah)</label>
                                            <input type="text" required id="nilai` + e.length + `" required class="form-control nilai" placeholder="Nilai / Biaya Service (Rupiah)" name="nilai` + e.length + `" onchange="cek_nilai(this)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="detail` + e.length + `">Rincian Masalah</label>
                                            <textarea required name="detail` + e.length + `" id="detail` + e.length + `" cols="30" rows="3" class="form-control" placeholder="Contoh: Kerusakan AKI Mobil"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12 km` + e.length + ` d-none">
                                            <div class="form-group">
                                                <label for="km` + e.length + `">Kilometer</label>
                                                <input type="text" placeholder="Km" name="km` + e.length + `" id="km` + e.length + `" class="form-control">
                                            </div>
                                        </div>
                                </div>`);
        var choices = $('.choices2');
        for (let i = 0; i < choices.length; i++) {
            initChoice = new Choices(choices[i], {
                shouldSort: false,
            });
        }
        $('.jml').val(e.length + 1);
    }

    function remove() {
        var e = document.querySelectorAll('.service');
        if (e.length != 1) {
            $('#service .service').last().remove();
        }
        var nilai = 0;
        for (let i = 0; i < $('.nilai').length; i++) {
            const element = $('.nilai')[i];
            nilai += parseInt(remove_format(element.value));
        }
        $('#total').html('Total : ' + format(nilai));
        $('.jml').val(e.length - 1);
    }
</script>
<?= $this->endSection() ?>
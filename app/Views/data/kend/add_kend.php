<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Tambah Data Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/master">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Tambah Data Kendaraan
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
                    <div class="card-header">
                        <h4 class="card-title">Form Tambah Data Kendaraan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="<?= base_url() ?>/master/kend_store" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <h6 class="mt-2 mb-2">Data Awal</h6>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kdsp">Stock Point</label>
                                            <select name="kdsp" id="kdsp" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($sp as $f) : ?>
                                                    <option value="<?= $f->sp ?>" <?= ((old('kdsp') ? old('kdsp') : "") == $f->sp ? 'selected' : '') ?>><?= $f->nmsp ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('kdsp') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_kend">Nomor Kendaraan</label>
                                            <input type="text" id="no_kend" required class="form-control" placeholder="contoh : E1234FGH" name="no_kend" value="<?= (old('no_kend') ? old('no_kend') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_kend') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kdfung">Fungsi Kendaraan</label>
                                            <select name="kdfung" id="kdfung" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($fungsi as $f) : ?>
                                                    <option value="<?= $f->no ?>" <?= ((old('kdfung') ? old('kdfung') : '') == $f->no) ? 'selected' : '' ?>><?= $f->fungsi ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('kdfung') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kdjns">Jenis Kendaraan</label>
                                            <select name="kdjns" id="kdjns" required class="form-control choices">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <?php foreach ($jenis as $f) : ?>
                                                    <option value="<?= $f->no ?>" <?= ((old('kdjns') ? old('kdjns') : '') == $f->no) ? 'selected' : '' ?>><?= $f->jenis ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('kdjns') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="sopir">Sopir</label>
                                            <input type="text" id="sopir" required class="form-control" placeholder="Sopir" name="sopir" value="<?= (old('sopir') ? old('sopir') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('sopir') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kernet">Kernet</label>
                                            <input type="text" id="kernet" class="form-control" placeholder="Kernet" name="kernet" value="<?= (old('kernet') ? old('kernet') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('kernet') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mt-2 mb-2">Data STNK</h6>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_stnk">Nomor STNK</label>
                                            <input type="text" id="no_stnk" required class="form-control" placeholder="contoh : 12345678" name="no_stnk" value="<?= (old('no_stnk') ? old('no_stnk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_stnk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nm_stnk">Nama Pemilik (STNK)</label>
                                            <input type="text" id="nm_stnk" required class="form-control" placeholder="Nama Pemilik" name="nm_stnk" value="<?= (old('nm_stnk') ? old('nm_stnk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('nm_stnk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="exp_stnk">Masa Berlaku STNK</label>
                                            <input type="date" id="exp_stnk" required class="form-control" name="exp_stnk" value="<?= (old('exp_stnk') ? old('exp_stnk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('exp_stnk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mt-2 mb-2">Data Pajak</h6>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_pjk">Nomor Pajak</label>
                                            <input type="text" id="no_pjk" required class="form-control" placeholder="contoh : 12345678" name="no_pjk" value="<?= (old('no_pjk') ? old('no_pjk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_pjk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="exp_pjk">Masa Berlaku Pajak</label>
                                            <input type="date" id="exp_pjk" required class="form-control" name="exp_pjk" value="<?= (old('exp_pjk') ? old('exp_pjk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('exp_pjk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mt-2 mb-2">Data Detail</h6>
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="merk">Merk Kendaraan</label>
                                            <input type="text" id="merk" required class="form-control" placeholder="contoh : MITSUBISHI" name="merk" value="<?= (old('merk') ? old('merk') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('merk') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="type">Type Kendaraan</label>
                                            <input type="text" id="type" required class="form-control" placeholder="contoh : FE 304" name="type" value="<?= (old('type') ? old('type') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('type') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="warna">Warna Kendaraan</label>
                                            <input type="text" id="warna" required class="form-control" placeholder="contoh : HITAM" name="warna" value="<?= (old('warna') ? old('warna') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('warna') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="isi_slndr">Isi Silinder</label>
                                            <input type="text" id="isi_slndr" required class="form-control" placeholder="contoh : Isi Silinder" name="isi_slndr" value="<?= (old('isi_slndr') ? old('isi_slndr') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('isi_slndr') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tgl_beli">Tanggal Pembelian</label>
                                            <input type="date" id="tgl_beli" required class="form-control" name="tgl_beli" value="<?= (old('tgl_beli') ? old('tgl_beli') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('tgl_beli') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="thn_buat">Tahun Pembuatan</label>
                                            <input type="number" min="1900" max="2099" step="1" required class="form-control" value="<?= (old('thn_buat') ? old('thn_buat') : gettime()->getYear()) ?>" name="thn_buat" id="thn_buat" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('thn_buat') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_rangka">Nomor Rangka</label>
                                            <input type="text" id="no_rangka" required class="form-control" placeholder="Nomor Rangka" name="no_rangka" value="<?= (old('no_rangka') ? old('no_rangka') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_rangka') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_mesin">Nomor Mesin</label>
                                            <input type="text" id="no_mesin" required class="form-control" placeholder="Nomor Mesin" name="no_mesin" value="<?= (old('no_mesin') ? old('no_mesin') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('no_mesin') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 col-12">
                                        <h5>Foto Nampak Depan</h5>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url() ?>/assets/img/preview.png" style="width: 400px; height:200px;" class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-3">
                                                <input required class="form-control" type="file" id="foto1" name="foto1" onchange="previewImg()" value="<?= (old('foto1') ? old('foto1') : '') ?>" />
                                                <div class="text-danger">
                                                    <small style="font-size:14px;"><?= $validation->getError('foto1') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h5>Foto Nampak Belakang</h5>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url() ?>/assets/img/preview.png" style="width: 400px; height:200px;" class="img-thumbnail img-preview2">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-3">
                                                <input required class="form-control" type="file" id="foto2" name="foto2" onchange="previewImg2()" value="<?= (old('foto2') ? old('foto2') : '') ?>" />
                                                <div class="text-danger">
                                                    <small style="font-size:14px;"><?= $validation->getError('foto2') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6 col-12">
                                        <h5>Foto Nampak Samping Kiri</h5>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url() ?>/assets/img/preview.png" style="width: 400px; height:200px;" class="img-thumbnail img-preview3">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-3">
                                                <input required class="form-control" type="file" id="foto3" name="foto3" onchange="previewImg3()" value="<?= (old('foto3') ? old('foto3') : '') ?>" />
                                                <div class="text-danger">
                                                    <small style="font-size:14px;"><?= $validation->getError('foto3') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h5>Foto Nampak Nampak Samping Kanan</h5>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url() ?>/assets/img/preview.png" style="width: 400px; height:200px;" class="img-thumbnail img-preview4">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mt-3">
                                                <input required class="form-control" type="file" id="foto4" name="foto4" onchange="previewImg4()" value="<?= (old('foto4') ? old('foto4') : '') ?>" />
                                                <div class="text-danger">
                                                    <small style="font-size:14px;"><?= $validation->getError('foto4') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
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
<script>
    function previewImg() {
        const foto = document.querySelector('#foto1');
        const imgPreview = document.querySelector('.img-preview');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg2() {
        const foto = document.querySelector('#foto2');
        const imgPreview = document.querySelector('.img-preview2');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg3() {
        const foto = document.querySelector('#foto3');
        const imgPreview = document.querySelector('.img-preview3');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg4() {
        const foto = document.querySelector('#foto4');
        const imgPreview = document.querySelector('.img-preview4');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
    $("input#no_kend").on({
        keydown: function(e) {
            if (e.which === 32)
                return false;
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
        }
    });
</script>
<?= $this->endSection() ?>
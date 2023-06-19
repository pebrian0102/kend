<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<style>
    .nm_srv {
        position: relative;
    }

    .suggestion {
        width: inherit;
        height: inherit;
        position: absolute;
        z-index: 2;
        top: 31px;
        left: -5px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0 18px;
        color: #868686;
    }
</style>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Service Kendaraan</h3>
                <p class="text-subtitle text-muted">
                    Data Service Kendaraan
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/data">Data</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Service Kendaraan
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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Data Service Kendaraan</h4>
                        <a href="<?= base_url() ?>/data/add_service" class="btn btn-success">Tambah Data</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-striped" style="width:2000px;">
                                <thead>
                                    <tr>
                                        <th class="bg-primary text-white" style="z-index: 4;">No.</th>
                                        <th>Stock Point</th>
                                        <th>Nomor Service</th>
                                        <th>Nomor Polisi</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Fungsi Kendaraan</th>
                                        <th>Merk/Type</th>
                                        <th>Warna</th>
                                        <th>Pengajuan Biaya</th>
                                        <th>Status Approval</th>
                                        <th class="bg-primary text-white">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>

                                    <?php foreach ($result as $r) : ?>
                                        <tr>
                                            <td class="bg-primary text-white" style="z-index: 4;"><?= $i++ ?></td>
                                            <td><?= sp($r->kdsp) ?></td>
                                            <td><?= $r->nosrv; ?></td>
                                            <td><?= $r->no_kend; ?></td>
                                            <td><?= $r->jenis; ?></td>
                                            <td><?= $r->fungsi; ?></td>
                                            <td><?= $r->merk; ?> / <?= $r->type; ?></td>
                                            <td><?= $r->warna; ?></td>
                                            <td><?= number_format($r->nilai_awal, ((int) $r->nilai_awal == $r->nilai_awal ? 0 : 0), '.', ',')  ?></td>
                                            <td>
                                                <span class="badge bg-<?= ($r->app1 == 1 ?  'success' : ($r->app1 == 2 ? 'danger' : 'secondary')) ?>">SPV</span>
                                                <span class="badge bg-<?= ($r->app2 == 1 ?  'success' : ($r->app2 == 2 ? 'danger' : 'secondary')) ?>">NSM</span>
                                            </td>
                                            <td class="bg-primary text-white d-flex">
                                                <button type="button" onclick="open_service('<?= $r->nosrv ?>')" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Lihat data">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <form action="<?= base_url() ?>/data/edit_service" method="get">
                                                    <?php if ($r->app1 == 0) : ?>
                                                        <input type="hidden" name="nosrv" value="<?= $r->nosrv ?>">
                                                        <button type="submit" class="badge bg-primary block float-right" style="margin-right: 10px;" data-placement="top" title="Edit data">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button type="button" class="badge bg-danger block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#delete<?= $r->nosrv ?>" data-placement="top" title="Hapus data">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </form>
                                                <?php if ($r->app2 == 1) : ?>
                                                    <button type="button" class="badge bg-success block float-right" style="margin-right: 10px;" data-bs-toggle="modal" data-bs-target="#real<?= $r->nosrv ?>" data-placement="top" title="Realisasi Service">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                <?php else : ?>
                                                    <button type="button" class="badge bg-secondary block float-right" style="margin-right: 10px;" data-placement="top" title="Realisasi Service">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Hapus -->
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="delete<?= $r->nosrv ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Hapus Data</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="<?= base_url() ?>/data/service_delete" method="POST">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nosrv">Nomor</label>
                                <input type="text" name="nosrv" id="nosrv" class="form-control" placeholder="Nomor" value="<?= $r->nosrv ?>" readonly>
                            </div>
                            <p>Apakah anda yakin ingin menghapusnya?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Hapus</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($result as $r) : ?>
    <div class="modal fade text-left" id="real<?= $r->nosrv ?>" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Update Data Service</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="<?= base_url() ?>/data/service_real" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="nosrv" value="<?= $r->nosrv ?>">

                        <?php foreach (srv_d($r->nosrv) as $d) : ?>
                            <div class="row p-2 rounded mb-2">
                                <div class="col-md-2">
                                    <h6>Jenis Service</h6>
                                    <p><?= $d->service ?></p>
                                </div>
                                <div class="col-md-3">
                                    <h6>Rincian Masalah</h6>
                                    <p><?= $d->detail ?></p>
                                </div>
                                <div class="col-md-2">
                                    <h6>Nilai yang diajukan</h6>
                                    <p><?= number_format($d->nilai, ((int) $d->nilai == $d->nilai ? 0 : 0), '.', ',')  ?></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="detail2">Rincian Service</label>
                                        <textarea required name="detail2<?= $d->urut ?>" id="detail2" cols="20" rows="4" class="form-control" placeholder="Rincian apa saja yang sudah diperbaiki"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="niai2<?= $d->urut ?>">Nilai Service (Rupiah)</label>
                                        <input type="text" required id="niai2<?= $d->urut ?>" required class="form-control nilai" placeholder="Nilai Service" name="nilai2<?= $d->urut ?>" onchange="cek_nilai(this)" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nota">Nomor Nota</label>
                                            <input type="text" id="nota" required class="form-control" placeholder="Nota" name="nota" value="<?= (old('nota') ? old('nota') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('nota') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="tglsrv">Tanggal Service</label>
                                            <input type="date" id="tglsrv" required class="form-control" name="tglsrv" value="<?= (old('tglsrv') ? old('tglsrv') : '') ?>" />
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('tglsrv') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group nm_srv">
                                            <label for="nm_srv">Nama Tempat Service</label>
                                            <input type="text" class="form-control" id="nm_srv<?= $r->nosrv ?>" name="nm_srv" placeholder="Type something here.." autocomplete="off" oninput="cek_data('<?= $r->nosrv ?>')" onchange="cek_alamat('<?= $r->nosrv ?>')" />
                                            <span id="suggestion<?= $r->nosrv ?>" class="suggestion"></span>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('nm_srv') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="alm_srv">Alamat Service</label>
                                            <textarea name="alm_srv" id="alm_srv<?= $r->nosrv ?>" cols="20" rows="2" class="form-control" placeholder="Contoh : Depan Balai Desa"><?= (old('alm_srv') ? old('alm_srv') : '') ?></textarea>
                                            <div class="text-danger">
                                                <small style="font-size:14px;"><?= $validation->getError('alm_srv') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6 col-12">
                                    <div class="col-md-10">
                                        <label>Bukti Nota</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= base_url() ?>/assets/img/preview.png" style="width: 200px; height:100px;" class="img-thumbnail img-preview">
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <input required class="form-control" type="file" id="foto" name="foto" onchange="previewImg()" value="<?= (old('foto') ? old('foto') : '') ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <small>*opsional</small>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="njasa">Biaya Jasa</label>
                                    <input type="text" id="njasa" class="form-control" placeholder="Biaya Jasa" name="njasa" onchange="cek_nilai(this)" value="0" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('njasa') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="ppn">PPn</label>
                                    <input type="text" id="ppn" class="form-control" placeholder="PPn" name="ppn" onchange="cek_nilai(this)" value="0" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('ppn') ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="pph">PPh</label>
                                    <input type="text" id="pph" class="form-control" placeholder="PPh" name="pph" onchange="cek_nilai(this)" value="0" />
                                    <div class="text-danger">
                                        <small style="font-size:14px;"><?= $validation->getError('pph') ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tutup</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="<?= base_url() ?>/dist/assets/extensions/quill/quill.min.js"></script>
<script>
    function cek_data(e) {
        let words = [<?= get_bengkel() ?>];
        words.sort();
        let input = document.getElementById("nm_srv" + e);
        let suggestion = document.getElementById("suggestion" + e);

        //Enter key code
        const enterKey = 13;

        window.onload = () => {
            input.value = "";
            clearSuggestion();
        };

        const clearSuggestion = () => {
            suggestion.innerHTML = "";
        };

        const caseCheck = (word) => {
            //Array of characters
            word = word.split("");
            let inp = input.value;
            //loop through every character in ino
            for (let i in inp) {
                //if input character matches with character in word no need to change
                if (inp[i] == word[i]) {
                    continue;
                } else if (inp[i].toUpperCase() == word[i]) {
                    //if inp[i] when converted to uppercase matches word[i] it means word[i] needs to be lowercase
                    word.splice(i, 1, word[i].toLowerCase());
                } else {
                    //word[i] needs to be uppercase
                    word.splice(i, 1, word[i].toUpperCase());
                }
            }
            //array to string
            return word.join("");
        };

        clearSuggestion();
        //Convert input value to regex since string.startsWith() is case sensitive
        let regex = new RegExp("^" + input.value, "i");
        //loop through words array
        for (let i in words) {
            //check if input matches with any word in words array
            if (regex.test(words[i]) && input.value != "") {
                //Change case of word in words array according to user input
                words[i] = caseCheck(words[i]);
                //display suggestion
                suggestion.innerHTML = words[i];
                break;
            }
        }
        //Complete predictive text on enter key
        input.addEventListener("keydown", (e) => {
            //When user presses enter and suggestion exists
            if (e.keyCode == enterKey && suggestion.innerText != "") {
                e.preventDefault();
                input.value = suggestion.innerText;
                //clear the suggestion
                clearSuggestion();
            }
        });
    }

    function cek_alamat(e) {
        let input = document.getElementById("nm_srv" + e);
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/data/cek_bengkel",
            data: {
                nama: input.value,
            },
            success: function(res) {
                var json = JSON.parse(res);
                $("#alm_srv" + e).text(json.alamat);
            },
        })
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
        var text = new NumericInput(e);
    }


    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');
        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
        const inputs = document.querySelectorAll('.form-control');

    }

    function open_service(nosrv) {
        window.open('<?= base_url() ?>/data/show_pengajuan/' + nosrv, '_blank');
    }
</script>
<?= $this->endSection() ?>
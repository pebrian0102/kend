<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Realisasi Service Kendaraan</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <?php foreach ($srv_d as $x => $s) : ?>
                                                <a class="list-group-item list-group-item-action <?= ($x == 0) ? 'active' : '' ?>" id="list-item<?= $x ?>-list" data-bs-toggle="list" href="#list-item<?= $x ?>" role="tab" aria-controls="list-item<?= $x ?>"><?= $s->service ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="tab-content" id="nav-tabContent">
                                            <?php foreach ($srv_d as $x => $s) : ?>
                                                <div class="tab-pane fade <?= ($x == 0) ? 'show active' : '' ?>" id="list-item<?= $x ?>" role="tabpanel" aria-labelledby="list-item<?= $x ?>-list">
                                                    <h6><?= $s->service ?></h6>
                                                    <div class="card border">
                                                        <div class="card-body d-flex flex-column justify-content-center align-items-center" style="font-size:12px;">
                                                            <h6>Masalah</h6>
                                                            <?= $s->detail ?>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex">
                                                        <div class="col-md-2">
                                                            <h6>Nota</h6>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="badge bg-success" style="cursor: pointer;" onclick="add_nota('<?= $x ?>')">Tambah</span>
                                                            <span class="badge bg-danger" style="cursor: pointer;" onclick="remove_nota('<?= $x ?>')">Hapus</span>
                                                        </div>
                                                    </div>
                                                    <div id="nota<?= $x ?>">
                                                        <div class="card border mt-2 nota<?= $x ?>0">
                                                            <input type="hidden" name="jml_nota<?= $x ?>" value="1" class="jml_nota<?= $x ?>">
                                                            <input type="hidden" name="jml_part<?= $x ?>0" value="1" class="jml_part<?= $x ?>0">
                                                            <input type="hidden" name="jml_jasa<?= $x ?>0" value="1" class="jml_jasa<?= $x ?>0">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="nomor<?= $x ?>0">Nota</label>
                                                                            <input type="text" name="nomor<?= $x ?>0" placeholder="Nota" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="tgl<?= $x ?>0">Tanggal</label>
                                                                            <input type="date" name="tgl<?= $x ?>0" id="tgl<?= $x ?>0" placeholder="Nota" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="nm_srv<?= $x ?>0">Nama Bengkel</label>
                                                                            <input type="text" name="nm_srv<?= $x ?>0" id="nm_srv<?= $x ?>0" placeholder="Nota" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="alm_srv<?= $x ?>0">Alamat Service</label>
                                                                            <input type="text" name="alm_srv<?= $x ?>0" id="alm_srv<?= $x ?>0" placeholder="Nota" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-12">
                                                                        <label>Bukti Nota</label>
                                                                        <input required class="form-control" type="file" id="foto<?= $x ?>0" name="foto<?= $x ?>0" />
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="detail2<?= $x ?>0">Rincian Service</label>
                                                                        <textarea name="detail2<?= $x ?>0" id="detail2<?= $x ?>0" cols="30" rows="6" class="form-control" placeholder="Rincian Service"></textarea>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row d-flex">
                                                                    <div class="col-md-5">
                                                                        <h6>Sparepart / Suku Cadang</h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span class="badge bg-success" style="cursor: pointer;" onclick="add_part('<?= $x ?>',0)">Tambah</span>
                                                                        <span class="badge bg-danger" style="cursor: pointer;" onclick="remove_part('<?= $x ?>',0)">Hapus</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row d-flex flex-column justify-content-center align-items-center" id="part<?= $x ?>0">
                                                                    <div class="part-item part<?= $x ?>00">
                                                                        <div class="row mt-2 border p-2">
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="nmbar<?= $x ?>00">Nama Barang</label>
                                                                                    <input type="text" name="nmbar<?= $x ?>00" id="nmbar<?= $x ?>00" placeholder="Nama Barang" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="jml<?= $x ?>00">Jumlah</label>
                                                                                    <input type="number" name="jml<?= $x ?>00" id="jml<?= $x ?>00" placeholder="Jumlah" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="nbar<?= $x ?>00">Harga Barang</label>
                                                                                    <input type="text" name="nbar<?= $x ?>00" id="nbar<?= $x ?>00" placeholder="Harga" class="form-control" onchange="cek_nilai(this)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <label for="tbar<?= $x ?>00">Harga Total</label>
                                                                                    <input type="text" name="tbar<?= $x ?>00" id="tbar<?= $x ?>00" placeholder="Total" class="form-control" onchange="cek_nilai(this)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="form-group">
                                                                                    <label for="ket<?= $x ?>00">Keterangan</label>
                                                                                    <textarea name="ket<?= $x ?>00" id="ket<?= $x ?>00" cols="30" rows="2" class="form-control" placeholder="Contoh : Indent / Ready"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr>
                                                                <div class="row d-flex">
                                                                    <div class="col-md-5">
                                                                        <h6>Jasa</h6>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <span class="badge bg-success" style="cursor: pointer;" onclick="add_jasa('<?= $x ?>',0)">Tambah</span>
                                                                        <span class="badge bg-danger" style="cursor: pointer;" onclick="remove_jasa('<?= $x ?>',0)">Hapus</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row d-flex flex-column justify-content-center align-items-center" id="jasa<?= $x ?>">
                                                                    <div class="row mt-2 border p-2 jasa<?= $x ?>">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="nmjasa<?= $x ?>00">Nama Jasa</label>
                                                                                <input type="text" name="nmjasa<?= $x ?>00" id="nmjasa<?= $x ?>00" placeholder="Nama Barang" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="desc<?= $x ?>00">Deskripsi</label>
                                                                                <textarea name="desc<?= $x ?>00" id="desc<?= $x ?>00" cols="30" rows="2" placeholder="Deskripsi" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="njasa<?= $x ?>00">Biaya</label>
                                                                                <input type="text" name="njasa<?= $x ?>00" id="njasa<?= $x ?>00" placeholder="Biaya" class="form-control">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="row d-flex">
                                                                    <div class="col-md-5">
                                                                        <h6>Pajak</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row d-flex flex-column justify-content-center align-items-center" id="pajak<?= $x ?>">
                                                                    <div class="row mt-2 border p-2 pajak<?= $x ?>">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="ppn<?= $x ?>00">PPn</label>
                                                                                <input type="text" name="ppn<?= $x ?>00" id="ppn<?= $x ?>00" placeholder="PPn" class="form-control" onchange="cek_nilai(this)">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="pph<?= $x ?>00">PPh</label>
                                                                                <input type="text" name="pph<?= $x ?>00" id="pph<?= $x ?>00" placeholder="PPh" class="form-control" onchange="cek_nilai(this)">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr style="border: 3px solid black;">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.min.js"></script>
<script src="<?= base_url() ?>/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
<script>
    function add_nota(no) {
        var nota = parseInt($('.jml_nota' + no).val());
        var jasa = document.querySelectorAll('.jasa' + no + nota).length;
        var part = document.querySelectorAll('.part' + no + nota).length;
        $('#nota' + no).append(`<div class="card border mt-2 nota` + no + `` + nota + `">
                                 <input type="hidden" name="jml_nota` + no + `" value="1" class="jml_nota` + no + `">
                                 <input type="hidden" name="jml_part` + no + `` + nota + `" value="1" class="jml_part` + no + `` + nota + `">
                                 <input type="hidden" name="jml_jasa` + no + `` + nota + `" value="1" class="jml_jasa` + no + `` + nota + `">
                                 <div class="card-body">
                                     <div class="row">
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="nomor` + no + `` + nota + `">Nota</label>
                                                 <input type="text" name="nomor` + no + `` + nota + `" placeholder="Nota" class="form-control">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="tgl` + no + `` + nota + `">Tanggal</label>
                                                 <input type="date" name="tgl` + no + `` + nota + `" id="tgl` + no + `` + nota + `" placeholder="Nota" class="form-control">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="nm_srv` + no + `` + nota + `">Nama Bengkel</label>
                                                 <input type="text" name="nm_srv` + no + `` + nota + `" id="nm_srv` + no + `` + nota + `" placeholder="Nota" class="form-control">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="alm_srv` + no + `` + nota + `">Alamat Service</label>
                                                 <input type="text" name="alm_srv` + no + `` + nota + `" id="alm_srv` + no + `` + nota + `" placeholder="Nota" class="form-control">
                                             </div>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-6 col-12">
                                             <label>Bukti Nota</label>
                                             <input required class="form-control" type="file" id="foto` + no + `` + nota + `" name="foto` + no + `` + nota + `" />
                                         </div>
                                         <div class="col-md-6">
                                             <label for="detail2` + no + `` + nota + `">Rincian Service</label>
                                             <textarea name="detail2` + no + `` + nota + `" id="detail2` + no + `` + nota + `" cols="30" rows="6" class="form-control" placeholder="Rincian Service"></textarea>
                                         </div>
                                     </div>
                                     <hr>
                                     <div class="row d-flex">
                                         <div class="col-md-5">
                                             <h6>Sparepart / Suku Cadang</h6>
                                         </div>
                                         <div class="col-md-3">
                                             <span class="badge bg-success" style="cursor: pointer;" onclick="add_part('` + no + `','` + nota + `')">Tambah</span>
                                             <span class="badge bg-danger" style="cursor: pointer;" onclick="remove_part('` + no + `','` + nota + `')">Hapus</span>
                                         </div>
                                     </div>
                                     <div class="row d-flex flex-column justify-content-center align-items-center" id="part` + no + `` + nota + `">
                                     <div class="part-item part` + no + `` + nota + `0">
                                         <div class="row mt-2 border p-2">
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="nmbar` + no + `` + nota + `0">Nama Barang</label>
                                                     <input type="text" name="nmbar` + no + `` + nota + `0" id="nmbar` + no + `` + nota + `0" placeholder="Nama Barang" class="form-control">
                                                 </div>
                                             </div>
                                             <div class="col-md-2">
                                                 <div class="form-group">
                                                     <label for="jml` + no + `` + nota + `0">Jumlah</label>
                                                     <input type="number" name="jml` + no + `` + nota + `0" id="jml` + no + `` + nota + `0" placeholder="Jumlah" class="form-control">
                                                 </div>
                                             </div>
                                             <div class="col-md-2">
                                                 <div class="form-group">
                                                     <label for="nbar` + no + `` + nota + `0">Harga Barang</label>
                                                     <input type="text" name="nbar` + no + `` + nota + `0" id="nbar` + no + `` + nota + `0" placeholder="Harga" class="form-control" onchange="cek_nilai(this)">
                                                 </div>
                                             </div>
                                             <div class="col-md-2">
                                                 <div class="form-group">
                                                     <label for="tbar` + no + `` + nota + `0">Harga Total</label>
                                                     <input type="text" name="tbar` + no + `` + nota + `0" id="tbar` + no + `` + nota + `0" placeholder="Total" class="form-control" onchange="cek_nilai(this)">
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="ket` + no + `` + nota + `0">Keterangan</label>
                                                     <textarea name="` + no + `` + nota + `0" id="` + no + `` + nota + `0" cols="30" rows="2" class="form-control" placeholder="Contoh : Indent / Ready"></textarea>
                                                 </div>
                                             </div>
                                         </div>
                                        </div>
                                     </div>

                                     <hr>
                                     <div class="row d-flex">
                                         <div class="col-md-5">
                                             <h6>Jasa</h6>
                                         </div>
                                         <div class="col-md-3">
                                             <span class="badge bg-success" style="cursor: pointer;" onclick="add_jasa('` + no + `','` + nota + `')">Tambah</span>
                                             <span class="badge bg-danger" style="cursor: pointer;" onclick="remove_jasa('` + no + `','` + nota + `')">Hapus</span>
                                         </div>
                                     </div>
                                     <div class="row d-flex flex-column justify-content-center align-items-center" id="jasa` + no + `` + nota + `">
                                         <div class="row mt-2 border p-2 jasa` + no + `` + nota + `` + jasa + `">
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="nmjasa` + no + `` + nota + `` + jasa + `">Nama Jasa</label>
                                                     <input type="text" name="nmjasa` + no + `` + nota + `` + jasa + `" id="nmjasa` + no + `` + nota + `` + jasa + `" placeholder="Nama Barang" class="form-control">
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label for="desc` + no + `` + nota + `` + jasa + `">Deskripsi</label>
                                                     <textarea name="desc` + no + `` + nota + `` + jasa + `" id="desc` + no + `` + nota + `` + jasa + `" cols="30" rows="2" placeholder="Deskripsi" class="form-control"></textarea>
                                                 </div>
                                             </div>
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="njasa` + no + `` + nota + `` + jasa + `">Biaya</label>
                                                     <input type="text" name="njasa` + no + `` + nota + `` + jasa + `" id="njasa` + no + `` + nota + `` + jasa + `" placeholder="Biaya" class="form-control">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <hr>
                                     <div class="row d-flex">
                                         <div class="col-md-5">
                                             <h6>Pajak</h6>
                                         </div>
                                     </div>
                                     <div class="row d-flex flex-column justify-content-center align-items-center" id="pajak` + no + `` + nota + `">
                                         <div class="row mt-2 border p-2 pajak` + no + `` + nota + `">
                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="ppn` + no + `` + nota + `0">PPn</label>
                                                     <input type="text" name="ppn` + no + `` + nota + `0" id="ppn` + no + `` + nota + `0" placeholder="PPn" class="form-control" onchange="cek_nilai(this)">
                                                 </div>
                                             </div>

                                             <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label for="pph` + no + `` + nota + `0">PPh</label>
                                                     <input type="text" name="pph` + no + `` + nota + `0" id="pph` + no + `` + nota + `0" placeholder="PPh" class="form-control" onchange="cek_nilai(this)">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                            <hr style="border: 3px solid black;">`);
        $('.jml_nota' + no).val(nota + 1);
        Swal.fire({
            icon: "success",
            title: "Berhasil Ditambahkan",
            showConfirmButton: false,
            timer: 1000
        })
    }

    function remove_nota(no) {
        var e = document.querySelectorAll('.nota' + no);
        var nota = parseInt($('.jml_nota' + no).val());

        if (nota != 1) {
            $("#nota" + no).find(".card:last").remove();
            $("#nota" + no).find("hr:last").remove();
            $('.jml_nota' + no).val(nota - 1);
            Swal.fire({
                icon: "success",
                title: "Berhasil Dihapus",
                showConfirmButton: false,
                timer: 1000
            })
        } else {
            Swal.fire({
                icon: "warning",
                title: "Gagal",
                showConfirmButton: false,
                timer: 1000
            })
        }
    }

    function add_part(no, nota) {
        var part = $("#part" + no + nota).children().length;
        $('#part' + no + nota).append(`<div class="part-item part` + no + `` + nota + `` + (parseInt(part) + 1) + `">
                                     <div class="row mt-2 border p-2">
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="nmbar` + no + `` + nota + `` + (parseInt(part) + 1) + `">Nama Barang</label>
                                                 <input type="text" name="nmbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" id="nmbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" placeholder="Nama Barang" class="form-control">
                                             </div>
                                         </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label for="jml` + no + `` + nota + `` + (parseInt(part) + 1) + `">Jumlah</label>
                                                 <input type="number" name="jml` + no + `` + nota + `` + (parseInt(part) + 1) + `" id="jml` + no + `` + nota + `` + (parseInt(part) + 1) + `" placeholder="Jumlah" class="form-control">
                                             </div>
                                         </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label for="nbar` + no + `` + nota + `` + (parseInt(part) + 1) + `">Harga Barang</label>
                                                 <input type="text" name="nbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" id="nbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" placeholder="Harga" class="form-control" onchange="cek_nilai(this)">
                                             </div>
                                         </div>
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label for="tbar` + no + `` + nota + `` + (parseInt(part) + 1) + `">Harga Total</label>
                                                 <input type="text" name="tbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" id="tbar` + no + `` + nota + `` + (parseInt(part) + 1) + `" placeholder="Total" class="form-control" onchange="cek_nilai(this)">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label for="ket` + no + `` + nota + `` + (parseInt(part) + 1) + `">Keterangan</label>
                                                 <textarea name="ket` + no + `` + nota + `` + (parseInt(part) + 1) + `" id="ket` + no + `` + nota + `` + (parseInt(part) + 1) + `" cols="30" rows="2" class="form-control" placeholder="Contoh : Indent / Ready"></textarea>
                                             </div>
                                         </div>
                                     </div>
                                 </div>`);
        $('.jml_part' + no + nota).val(parseInt(part) + 1);
        Swal.fire({
            icon: "success",
            title: "Berhasil Ditambahkan",
            showConfirmButton: false,
            timer: 1000
        })
    }

    function remove_part(no, nota) {
        var e = document.querySelectorAll('.nota' + no);
        var part = parseInt($('.jml_part' + no + nota).val());

        if (part != 1) {
            $("#part" + no + nota).find(".part-item:last").remove();
            $('.jml_part' + no + nota).val(part - 1);
            Swal.fire({
                icon: "success",
                title: "Berhasil Dihapus",
                showConfirmButton: false,
                timer: 1000
            })
        } else {
            Swal.fire({
                icon: "warning",
                title: "Gagal",
                showConfirmButton: false,
                timer: 1000
            })
        }
    }

    function add_jasa(no, nota) {
        var jasa = $("#jasa" + no + nota).children().length;
        $('#jasa' + no + nota).append(``);
        $('.jml_jasa' + no + nota).val(parseInt(jasa) + 1);
        Swal.fire({
            icon: "success",
            title: "Berhasil Ditambahkan",
            showConfirmButton: false,
            timer: 1000
        })
    }

    function remove_jasa(no, nota) {
        var e = document.querySelectorAll('.nota' + no);
        var jasa = parseInt($('.jml_jasa' + no + nota).val());

        if (jasa != 1) {
            $("#jasa" + no + nota).find(".jasa-item:last").remove();
            $('.jml_jasa' + no + nota).val(jasa - 1);
            Swal.fire({
                icon: "success",
                title: "Berhasil Dihapus",
                showConfirmButton: false,
                timer: 1000
            })
        } else {
            Swal.fire({
                icon: "warning",
                title: "Gagal",
                showConfirmButton: false,
                timer: 1000
            })
        }
    }

    var choices = $('.choices2');
    for (let i = 0; i < choices.length; i++) {
        new Choices(choices[i], {
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
</script>
<?= $this->endSection() ?>
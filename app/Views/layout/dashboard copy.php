<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/api_icon.jpg" type="image/x-icon">
  <title><?= $title ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.bootstrap4.min.css">


  <!-- Select2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url() ?>/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
  <style>
    @keyframes pulse {
      0% {
        transform: scale(0.9);
      }

      100% {
        transform: scale(0.5);
      }
    }

    .pulse {
      width: 15px;
      height: 15px;
      background-color: red;
      border-radius: 10px;
      animation: 1s pulse infinite;
    }

    #table1 tr.selected,
    #table2 tr.selected,
    #example tr.selected,
    #example1 tr.selected,
    #example2 tr.selected,
    #example4 tr.selected,
    #table tr.selected {
      /* background-color: blue; */
      color: #fff;
      font-weight: bold;
      background: #007bff;
    }

    table.table-bordered.dataTable th,
    table.table-bordered.dataTable td {
      padding: 5px;
      padding-left: 10px;
      font-size: 20px;
    }

    table.dataTable thead>tr>th.sorting_asc,
    table.dataTable thead>tr>th.sorting_desc,
    table.dataTable thead>tr>th.sorting,
    table.dataTable thead>tr>td.sorting_asc,
    table.dataTable thead>tr>td.sorting_desc,
    table.dataTable thead>tr>td.sorting {
      font-size: 12px;
    }

    table.table-bordered.dataTable th,
    table.table-bordered.dataTable td {
      font-size: 12px;
    }

    .btn,
    .dataTables_info {
      font-size: 14px;
    }

    ::selection {
      background-color: red;
      color: #fff;
    }

    .form-control {
      font-size: 14px;
      /* padding: 3px 10px; */
      /* height: max-content; */
    }

    .select2-selection__rendered,
    div.dataTables_wrapper div.dataTables_filter label {
      font-size: 14px;
    }

    div.dt-button-collection .dt-button {
      min-width: 100px;
      font-size: 14px;
    }

    .form-control .select2 .select2-hidden-accessible option {
      font-size: 14px;
    }

    .custom-control-label:hover {
      cursor: pointer;
    }

    .red {
      color: red;
    }

    .nilai {
      text-align: right;
    }

    .animasi-warning {
      border: 2px solid red;
      border-radius: 10px;
      animation: 0.5s animasi-warning infinite;
    }

    @keyframes animasi-warning {
      0% {
        box-shadow: 0px 0px 2px red;
      }

      100% {
        box-shadow: 0px 0px 20px red;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center bg-white">
    <img class="animation__shake" src="<?= base_url() ?>/assets/img/logo.png" height="100" width="200"> <br>
    <img class="animation__shake" src="<?= base_url() ?>/assets/img/loading.gif" height="100" width="200"> <br>
  </div>
  <input type="hidden" class="sts" value="<?= session()->getFlashdata('sts') ?>">
  <!-- Flashdata -->
  <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
  <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('failed'); ?>"></div>
  <div class="wrapper">
    <?= $this->include('layout/navbar') ?>
    <?= $this->include('layout/sidebar') ?>
    <?= $this->renderSection('content') ?>
    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        EDP
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; <?= gettime()->getYear(); ?></strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <!-- <script src="<?= base_url() ?>/adminlte/plugins/datatables-select/js/select.bootstrap4.min.js"></script> -->
  <script src="<?= base_url() ?>/adminlte/plugins/datatables-select/js/dataTables.select.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url() ?>/adminlte/plugins/select2/js/select2.full.min.js"></script>
  <!-- Summernote -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>/adminlte/plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?= base_url() ?>/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- My script -->
  <script src="<?= base_url() ?>/assets/js/dashboard.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
  <script>
    const showLoading = function() {
      Swal.fire({
        title: 'Loading......',
        showConfirmButton: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        timer: 2000
      })
    };
    const hideLoading = function() {
      Swal.close();
    };

    $('.select2').select2({
      placeholder: "-- Pilih --",
      allowClear: true
    });

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return rupiah;
    }


    function cek() {
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function cek_ket(e) {
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if (e.value == '#proses') {
        $('#nosrt').removeAttr('required');
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
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

    function cek_nilai() {
      var text = new NumericInput(document.getElementById('rp', 'en-CA'));
      var text1 = new NumericInput(document.getElementById('qty1', 'en-CA'));
      var text2 = new NumericInput(document.getElementById('qty2', 'en-CA'));
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function cek_real(e, nilai, sts) {
      var val = parseInt(e.value);
      var nilai_int = parseInt(nilai);
      var real = parseInt($('#real').val());

      if (sts == 0) {
        if (val < nilai_int) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi lebih kecil dari nilai! <br> Apakah anda yakin ingin menyimpannya?</p>
                                                <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="adj" onChange="real_adj(this)">
                                                  <label class="custom-control-label" for="adj"><small><i>(*ceklis : masukan ke Adjustment)</i></small></label>
                                            </div>
                                            <small>(*jika disimpan maka realisasi akan disimpan tanpa adanya adjustment dan bisa input realisasi kembali)</small>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                            </div>`);
        } else if (val > nilai_int) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <p>Realisasi lebih besar dari nilai! <br> Apakah anda yakin ingin menyimpannya? <br><small>(*jika disimpan maka selisih akan dimasukan ke Adjustment)</small></p> 
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                          </div>
                                            <!-- /.modal-content -->
                                          </div>
                                            <!-- /.modal-dialog -->
                                        </div>`);
          $('#sts_real').val(1);
        } else if (val == nilai_int) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek').remove();
          $('.simpan').append(`<button type="submit" class="btn btn-app bg-success btn-simpan">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              `);
          $('#sts_real').val(2);
        }
      } else if (sts == 1) {
        if (val < real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi lebih kecil dari nilai! <br> Apakah anda yakin ingin menyimpannya?</p>
                                                <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="adj" onChange="real_adj(this)">
                                                  <label class="custom-control-label" for="adj"><small><i>(*ceklis : masukan ke Adjustment)</i></small></label>
                                            </div>
                                            <small>(*jika disimpan maka realisasi akan disimpan tanpa adanya adjustment dan bisa input realisasi kembali)</small>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                            </div>`);
        } else if (val > real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi lebih besar dari nilai! <br> Apakah anda yakin ingin menyimpannya? <br><small>(*jika disimpan maka selisih akan dimasukan ke Adjustment)</small></p> 
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                          </div>
                                            <!-- /.modal-content -->
                                          </div>
                                            <!-- /.modal-dialog -->
                                        </div>`);
          $('#sts_real').val(1);
        } else if (val == real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek').remove();
          $('.simpan').append(` <button type="submit" class="btn btn-app bg-success btn-simpan">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              `);
          $('#sts_real').val(2);
        }
      }
      var text = new NumericInput(document.getElementById('jumlah', 'en-CA'));
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function cek_real_qty(nilai1, nilai2, sts) {
      var qty1 = parseInt($('#qty1').val());
      var qty2 = parseInt($('#qty2').val());
      var qty1_real = parseInt($('#qty1_real').val());
      var qty2_real = parseInt($('#qty2_real').val());

      if (sts == 0) {
        if (qty1 < nilai1 || qty2 < nilai2) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi tidak sama dengan nilai klaim! <br> Apakah anda yakin ingin menyimpannya?</p>
                                                <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="adj" onChange="real_adj(this)">
                                                  <label class="custom-control-label" for="adj"><small><i>(*ceklis : masukan ke Adjustment)</i></small></label>
                                            </div>
                                            <small>(*jika disimpan maka realisasi akan disimpan tanpa adanya adjustment dan bisa input realisasi kembali)</small>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                            </div>`);
        } else if (qty1 > nilai1 || qty2 > nilai2) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <p>Realisasi tidak sama dengan nilai klaim! <br> Apakah anda yakin ingin menyimpannya? <br><small>(*jika disimpan maka selisih akan dimasukan ke Adjustment)</small></p> 
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                          </div>
                                            <!-- /.modal-content -->
                                          </div>
                                            <!-- /.modal-dialog -->
                                        </div>`);
          $('#sts_real').val(1);
        } else if (qty1 == nilai1 && qty2 == nilai2) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek').remove();
          alert(3);
          $('.simpan').append(`<button type="submit" class="btn btn-app bg-success btn-simpan">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              `);
          $('#sts_real').val(2);
        }
      } else if (sts == 1) {
        if (qty1 < qty1_real || qty2 < qty2_real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi tidak sama dengan nilai klaim! <br> Apakah anda yakin ingin menyimpannya?</p>
                                                <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="adj" onChange="real_adj(this)">
                                                  <label class="custom-control-label" for="adj"><small><i>(*ceklis : masukan ke Adjustment)</i></small></label>
                                            </div>
                                            <small>(*jika disimpan maka realisasi akan disimpan tanpa adanya adjustment dan bisa input realisasi kembali)</small>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                            </div>
                                            <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                            </div>`);
        } else if (qty1 > qty1_real || qty2 > qty2_real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek-1').remove();
          $('.simpan').append(`<button type="button" class="btn btn-app bg-success btn-simpan" data-toggle="modal" data-target="#modal-cek-1">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              <div class="modal fade" id="modal-cek-1">
                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Simpan Data</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Realisasi tidak sama dengan nilai klaim! <br> Apakah anda yakin ingin menyimpannya? <br><small>(*jika disimpan maka selisih akan dimasukan ke Adjustment)</small></p> 
                                            <div class="modal-footer justify-content-between">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                          </div>
                                            <!-- /.modal-content -->
                                          </div>
                                            <!-- /.modal-dialog -->
                                        </div>`);
          $('#sts_real').val(1);
        } else if (qty1 == qty1_real && qty2 == qty2_real) {
          $('.simpan .btn-simpan').remove();
          $('#modal-cek').remove();
          $('.simpan').append(` <button type="submit" class="btn btn-app bg-success btn-simpan">
                                  <i class="fas fa-file"></i> Simpan
                              </button>
                              `);
          $('#sts_real').val(2);
        }
      }
      var text = new NumericInput(document.getElementById('qty1', 'en-CA'));
      var text = new NumericInput(document.getElementById('qty2', 'en-CA'));
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function real_btn_show() {
      $('#real_result').toggleClass('d-none');
      $('#real_btn_hps').remove();
      $('#real_btn_add').remove();
      $('.btn-simpan').remove();
      $('#jenis_p_inp').prop("required", true);
      $('#tglreal_inp').prop("required", true);
      $('#noreal_inp').prop("required", true);
      $('#jumlah_inp').prop("required", true);
      $('#real_btn_induk').append('<button class="btn btn-success" type="button" onclick="real_btn_hide()" id="real_btn_hps">Hapus Nilai Realisasi</button>');
    }

    function real_btn_hide() {
      $('#real_result').toggleClass('d-none');
      $('#real_btn_hps').remove();
      $('#real_btn_add').remove();
      $('#jns_plnsn_inp').removeAttr('required');
      $('#tglreal_inp').removeAttr('required');
      $('#noreal_inp').removeAttr('required');
      $('#jumlah_inp').removeAttr('required');
      $('#real_btn_induk').append('<button class="btn btn-success" type="button" onclick="real_btn_show()" id="real_btn_add">Tambah Nilai Realisasi</button>');
    }

    function real_adj(e) {
      if (e.checked) {
        $('#sts_real').val(1);
      } else {
        $('#sts_real').val(0);
      }
    }

    function cek_nilai_dpp() {
      var text = new NumericInput(document.getElementById('rp', 'en-CA'));
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }

      $('.incl').removeClass('d-none');
      $('#total').val($('#rp').val())
    }

    function cek_nilai_dpp2() {
      var text = new NumericInput(document.getElementById('rp2', 'en-CA'));
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }

      $('#total2').val($('#rp2').val())
    }

    function cek_ppn(e) {
      if (e.checked) {
        $('#ppn').val(1);
      } else {
        $('#ppn').val(0);
      }
    }


    function cek_nilai2(e) {
      var text = new NumericInput(e);
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function cek_nilai_dpp3(e) {
      $('.incl').removeClass('d-none');
      var dpp = 0;
      $('.rp').each(function() {
        dpp = parseInt(dpp);
        var dpp_val = $(this).val();
        dpp_val = dpp_val.split(',');
        dpp_val = dpp_val.join('');
        dpp_val = parseInt(dpp_val);
        dpp += dpp_val;
      });
      dpp = parseInt(dpp);
      var pph = $('#pph').val();
      pph = pph.split(',');
      pph = pph.join('');
      pph = parseFloat(pph);
      var ppn = 0;
      var sts_ppn = 0;
      if ($('#ppn1').is(':checked')) {
        ppn = dpp * 11 / 100;
        ppn = Math.ceil(ppn);
        sts_ppn = 1;
      } else if ($('#ppn2').is(':checked')) {
        ppn = dpp * 11 / 100;
        ppn = Math.floor(ppn);
        sts_ppn = 2;
      }
      var dpp_ppn = dpp + ppn;
      dpp_ppn = parseInt(dpp_ppn);
      var pph_result = Math.floor(dpp * pph / 100);
      var dpp_ppn_pph = dpp + ppn - pph_result;
      $('#dpp_ppn_result').val(dpp_ppn);
      $('#ppn_result').val(ppn);
      $('#pph_result').val(pph_result);
      $('#sts_ppn').val(sts_ppn);
      $('#total_result').val(dpp_ppn_pph);

      var text = new NumericInput(e);
      const inputs = document.querySelectorAll('.form-control');

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
      if ($('.form-control').find('option:selected').val() != '' && $('.form-control option').attr('disabled') != 'disabled') {
        $('.select2-container--default .select2-selection--single .select2-selection__rendered').css("font-weight", "bolder")
      }
    }

    function cek_asal(e) {
      if (e.value == 'E01') {
        $('.adv').removeClass('d-none');
        $('#tgladv').prop("required", true);
        $('#noadv').prop("required", true);
        $('.sample').addClass('d-none');
        $('#nosample').removeAttr('required');
        $('#tglsample').removeAttr('required');
      } else if (e.value == 'P01') {
        $('.sample').removeClass('d-none');
        $('#nosample').prop("required", true);
        $('#tglsample').prop("required", true);
      } else {
        $('.sample').addClass('d-none');
        $('#nosample').removeAttr('required');
        $('#tglsample').removeAttr('required');
        $('.adv').addClass('d-none');
        $('#tgladv').removeAttr('required');
        $('#noadv').removeAttr('required');
        $('.sample').addClass('d-none');
        $('#tglsample').removeAttr('required');
        $('#nosample').removeAttr('required');
      }
      if ($('.form-control').find('option:selected .tes').val() != '') {
        $('#select2-asal-container').css("font-weight", "bolder")
      }
    }

    function cek_nomor() {
      const inputs = document.querySelectorAll('.form-control');
      for (const input of inputs) {
        if (input.getAttribute('id') == 'nomor') {
          input.classList.remove('is-valid');
          input.classList.remove('is-invalid');
          $('#msg').html('');
          $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/master/cek_nomor',
            data: {
              nomor: input.value,
            },
            success: function(response) {
              if (response == 'null') {
                input.classList.add('is-valid');
              } else {
                input.classList.add('is-invalid');
                $('#msg').html('Nomor sudah ada');
              }
            },
          });
        }
      }
    }

    function cek_nomor2() {
      const inputs = document.querySelectorAll('.form-control');
      for (const input of inputs) {
        if (input.getAttribute('id') == 'noklaim') {
          input.classList.remove('is-valid');
          input.classList.remove('is-invalid');
          $('#msg').html('');
          $.ajax({
            type: "POST",
            url: '<?= base_url() ?>/adminsp/cek_nomor',
            data: {
              nomor: input.value,
            },
            success: function(response) {
              console.log(response);
              if (response == 'null') {
                input.classList.add('is-valid');
              } else {
                input.classList.add('is-invalid');
                $('#msg').html('Nomor sudah ada');
              }
            },
          });
        }
      }
    }

    const sts = document.querySelector('.sts').value;
    if (sts == 1) {
      let audio = new Audio("<?= base_url() ?>/assets/audio/success.mp3");
      audio.play();
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

      for (const input of inputs) {
        if (input.value != '') {
          input.classList.add('is-valid');
        } else {
          input.classList.remove('is-valid');
        }
      }
    }
    $('.check').on('click', function() {
      const pageIdData = $(this).data('page');
      const pagedId = $(this).data('paged');
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/page/ubah_sts',
        data: {
          pageId: pageIdData,
          pagedId: pagedId
        },
        success: function() {
          document.location.href = '<?= base_url() ?>/page/detail/' + pageIdData;
        },
      });
    })

    function krm() {
      var krm_arr = [];
      for (let i = 0; i < $('.krm').length; i++) {
        const e = $('.krm')[i];
        if (e.checked) {
          krm_arr.push(e.getAttribute('no'));
        }
      }
      $('.btn-kirim2').remove();
      if (krm_arr.length > 0) {
        $('.noklaim').val(JSON.stringify(krm_arr))
        $('.btn-kirim').append(`<div class="col d-flex justify-content-end btn-kirim2">
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-save">Kirim Data</a>
                                </div>`);
      } else {
        $('.btn-kirim').append(`<div class="col d-flex justify-content-end btn-kirim2">
                                    <a href="#" class="btn btn-secondary">Kirim Data</a>
                                </div>`);
      }
    }

    function krm3() {
      var krm_arr = [];
      for (let i = 0; i < $('.krm2').length; i++) {
        const e = $('.krm2')[i];
        if (e.checked) {
          krm_arr.push(e.getAttribute('no'));
        }
      }
      $('.btn-kirim4').remove();
      if (krm_arr.length > 0) {
        $('.noklaim2').val(JSON.stringify(krm_arr))
        $('.btn-kirim3').append(`<div class="col d-flex justify-content-end btn-kirim4">
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-save2">Update Data</a>
                                </div>`);
      } else {
        $('.btn-kirim3').append(`<div class="col d-flex justify-content-end btn-kirim4">
                                    <a href="#" class="btn btn-secondary">Update Data</a>
                                </div>`);
      }
    }

    function krm2() {
      var krm_arr = [];
      for (let i = 0; i < $('.krm').length; i++) {
        const e = $('.krm')[i];
        if (e.checked) {
          krm_arr.push(e.getAttribute('no'));
        }
      }
      $('.btn-kirim3').remove();
      if (krm_arr.length > 0) {
        $('.noklaim').val(JSON.stringify(krm_arr))
        $('.btn-kirim').append(`<div class="col d-flex justify-content-end btn-kirim3">
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-save">Update Data</a>
        </div>`);
      } else {
        $('.btn-kirim').append(`<div class="col d-flex justify-content-end btn-kirim3">
                                    <a href="#" class="btn btn-secondary">Update Data</a>
                                    </div>`);
      }
    }
    $('#pajak').on('click', function() {
      if (this.checked) {
        $('.pajak-r').css('display', 'flex');
        $('#noseri').prop("required", true);
        $('#tglfaktur').prop("required", true);
        $('#dpp').prop("required", true);
        $('#ppn').prop("required", true);
        $('#narasi').prop("required", true);
      } else {
        $('.pajak-r').css('display', 'none');
        $('#noseri').prop("required", false);
        $('#tglfaktur').prop("required", false);
        $('#dpp').prop("required", false);
        $('#ppn').prop("required", false);
        $('#narasi').prop("required", false);
      }
    })
    $('#auto2').on('click', function() {
      if (this.checked) {
        $('#eksp').val($('#supp_eksp').val());
        $('#noresi').val($('#supp_noresi').val());
        $('#tglkrm').val($('#supp_tglkrm').val());
        $('#catatan').val($('#supp_catatan').val());
        // $('#eksp').prop("readonly", true);
        // $('#noresi').prop("readonly", true);
        // $('#tglkrm').prop("readonly", true);
        // $('#catatan').prop("readonly", true);
      } else {
        $('#eksp').val('');
        $('#noresi').val('');
        $('#tglkrm').val('');
        $('#catatan').val('');
        // $('#eksp').prop("readonly", false);
        // $('#noresi').prop("readonly", false);
        // $('#tglkrm').prop("readonly", false);
        // $('#catatan').prop("readonly", false);
      }
    })
    $('#auto').on('click', function() {
      if (this.checked) {
        $('#noklaim').val('');
        $('#tglklaim').val('');
        $('#tglklaim').removeClass('is-valid');
        $('#noklaim').removeClass('is-invalid');
        $('#msg').html('');
        $('#noklaim').prop("readonly", true);
      } else {
        $('#noklaim').prop("readonly", false);
      }
    })
    Mousetrap.bind('a u t o', function() {
      $('#auto').click();
    });
    $('#sp').on('change', function() {
      $('#tglklaimbg').removeAttr('disabled');
    })
    $('#jns').on('change', function() {
      $("#nosrt").val('').change();
      $("#nosrt_add").val('').change();
      $('#judul .card').remove();
      if ($('#jns').val() == '01') {
        $('#qty1').val(0);
        $('#qty2').val(0);
        $('#rp').prop("required", true);

        $('#tgladv').prop("required", true);
        $('#noadv').prop("required", true);

        $('#qty1').removeAttr('required');
        $('#qty2').removeAttr('required');
        $('.nilai-b').removeClass('d-none');
        $('.nilai-ba').addClass('d-none');

      } else if ($('#jns').val() == '02') {
        $('.nilai-ba').removeClass('d-none');
        $('.nilai-b').addClass('d-none');
        $('.adv').addClass('d-none');

        $('.incl').addClass('d-none');
        $('#qty1').prop("required", true);
        $('#qty2').prop("required", true);
        $('#rp').val(0);
        $('#rp').removeAttr('required');
        $('#tgladv').removeAttr('required');
        $('#noadv').removeAttr('required');
      }
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/adminsp/asal',
        data: {
          jenis: $("#jns").val(),
        },
        success: function(res) {
          var json = JSON.parse(res);
          $('#asal .set').remove();
          $("#asal").append(`<option value="" disabled selected>-- Pilih --</option>`);
          $('#asal').removeAttr('disabled');
          $.each(json, function(i) {
            $("#asal").append(`<option class='set' value="` + json[i].kdasal + `"><b>` + json[i].asal + `</b></option>`);
          });
        },
      });
      if ($('.form-control').find('option:selected .tes').val() != '') {
        $('#select2-jns-container').css("font-weight", "bolder")
      }
    })
    $('#kdsupp').on('change', function() {
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/adminsp/surat',
        data: {
          kdsupp: $("#kdsupp").val(),
        },
        success: function(res) {
          var json = JSON.parse(res);
          $('#nosrt').removeAttr('disabled');
          $('#nosrt .set').remove();
          $.each(json, function(i) {
            $("#nosrt").append(`<option class='set' value="` + json[i].nomor + `"><b>` + json[i].nomor + `</b></option>`);
          });
        },
      });
      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-kdsupp-container').css("font-weight", "bolder")
      }
    })
    $('#kdsuppbg').on('change', function() {
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/adminjbr/surat',
        data: {
          kdsupp: $("#kdsuppbg").val(),
        },
        success: function(res) {
          var json = JSON.parse(res);
          $('#nosrtbg').removeAttr('disabled');
          $('#nosrtbg .set').remove();
          $.each(json, function(i) {
            $("#nosrtbg").append(`<option class='set' value="` + json[i].nomor + `"><b>` + json[i].nomor + `</b></option>`);
          });
        },
      });
      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-kdsupp-container').css("font-weight", "bolder")
      }
    })
    $('#kdsupp3').on('change', function() {
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/adminsp/surat2',
        data: {
          kdsupp: $("#kdsupp3").val(),
        },
        success: function(res) {
          var json = JSON.parse(res);
          $('#nosrt3').removeAttr('disabled');
          $('#nosrt3 .set').remove();
          $.each(json, function(i) {
            $("#nosrt3").append(`<option class='set' value="` + json[i].nomor + `"><b>` + json[i].nomor + `</b></option>`);
          });
        },
      });
      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-kdsupp-container').css("font-weight", "bolder")
      }
    })
    $('#kdsupp2').on('change', function() {
      $.ajax({
        type: "POST",
        url: '<?= base_url() ?>/adminjbr/surat',
        data: {
          kdsupp: $("#kdsupp2").val(),
        },
        success: function(res) {
          var json = JSON.parse(res);
          $('#nosrt2').removeAttr('disabled');
          $('#nosrt2 .set').remove();
          $.each(json, function(i) {
            $("#nosrt2").append(`<option class='set' value="` + json[i].nomor + `"><b>` + json[i].nomor + `</b></option>`);
          });
        },
      });
      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-kdsupp-container').css("font-weight", "bolder")
      }
    })

    $('#nosrt').on('change', function() {
      var nosrt = $('#nosrt').val();
      var mkns_arr2 = [];
      $('#result tr').remove();
      $('#judul .card').remove();
      $('#judul_l').removeClass('d-none');

      showLoading();
      $.when(
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminsp/mekanisme',
          data: {
            nomor: $("#nosrt").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#result").append(`<tr><td>` + json[i].mkns + `</td><td><input type="checkbox" nomor="` + json[i].kode + `" nosrt="` + json[i].nomor + `" name="mkns" id="mkns" class="mkns" checked onchange="change_mkns()"></td></tr>`);
              mkns_arr2.push({
                kode: json[i].kode,
                nomor: json[i].nomor,
              })
            });
            $('.mkns_in').val(JSON.stringify(mkns_arr2))
          },
        }),
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminsp/judul',
          data: {
            nomor: $("#nosrt").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            var sample = '';
            var sample2 = 'required';
            if ($('#asal').val() != 'P01') {
              sample = 'd-none';
              sample2 = '';
            }
            $.each(json, function(i) {
              if ($('#jns').val() == 02) {
                $("#judul").append(`
                <div class="card">
                        <div class="card-body">
                            <div style="padding:5px;margin-bottom:5px;">
                                <div class="row ml-1">
                                    <h4 id="judul_d">` + json[i].judul + `</h4> &nbsp; <h5>(` + json[i].nomor + `)</h5> <button type="button" class="btn btn-primary ml-2" onclick="show('` + json[i].file + `','` + json[i].tglsrt + `')" data-toggle="modal" data-target="#modal-view">Lihat Surat</button>
                                </div>
                                <small>Periode surat : ` + json[i].tglaw + ` - ` + json[i].tglak + `</small>
                                <h5 class="mb-2 mt-1"><u>Nilai Klaim </u></h5>
                                <a class="btn btn-success" onclick="add('` + i + `')">Tambah</a>
                                <a class="btn btn-danger" onclick="remove('` + i + `')">Hapus</a> <br>
                                <small>(*Jika ada lebih dari 1 barang klik tombol "Tambah")</small>
                                <input type="hidden" name="jml` + i + `" class="jml` + i + `" value="1">
                                <div id="barang` + i + `">
                                    <div class="mt-2 p-1 pl-4 barang` + i + `" style="border:3px solid black; border-radius:20px;box-shadow: 4px 6px 10px rgba(0, 0, 0, 0.25);">
                                        <div class="row">
                                            <div class="form-group" style="width:100px;">
                                                <label for="kdbar` + i + `0">Kode Barang</label>
                                                <input type="text" class="form-control" required name="kdbar` + i + `0" id="kdbar` + i + `0" placeholder="Kode Barang..." onchange="cek_kode(this)">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="nmbar` + i + `0">Nama Barang </label>
                                                <input type="text" class="form-control" name="nmbar` + i + `0" id="nmbar` + i + `0" placeholder="Nama Barang" readonly>
                                            </div>
                                            <div class="form-group col-1">
                                                <label for="isi` + i + `0">Isi </label>
                                                <input type="text" class="form-control" name="isi` + i + `0" id="isi` + i + `0" placeholder="Isi" readonly>
                                            </div>
                                            <div class="form-group  col-1">
                                                <label for="qty1` + i + `0">Ctn</label>
                                                <input type="text" class="form-control " required name="qty1` + i + `0" id="qty1` + i + `0" placeholder="Isi (ctn)..." onchange="cek_nilai2(this)" value="0">
                                            </div>
                                            <div class="form-group col-1">
                                                <label for="qty2` + i + `0">Pcs</label>
                                                <input type="text" class="form-control " required name="qty2` + i + `0" id="qty2` + i + `0" placeholder="Isi (pcs)..." onchange="cek_nilai2(this)" value="0">
                                            </div>
                                            <div class="form-group mr-2 sample ` + sample + `" style="width:130px;">
                                                <label for="nosample` + i + `0">No. Sample</label>
                                                <input type="text" class="form-control " ` + sample2 + ` name="nosample` + i + `0" id="nosample" placeholder="Nomor Sample...">
                                            </div>
                                            <div class="form-group sample ` + sample + `" style="width:140px;">
                                                <label for="tglsample` + i + `0">Tgl. Sample</label>
                                                <input type="date" class="form-control " ` + sample2 + ` name="tglsample` + i + `0" id="tglsample">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-2 mt-3"><u>Periode Klaim </u></h5>
                                <div class="row" id="tglawak">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="tglaw">Tanggal Awal</label>
                                            <input type="date" class="form-control" required name="tglaw` + [i] + `" id="tglaw" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="tglak">Tanggal Akhir</label>
                                            <input type="date" class="form-control" required name="tglak` + [i] + `" id="tglak" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  `);
              } else {
                $("#judul").append(`
              <div class="card">
                  <div class="card-body">
                      <div style="padding:5px; margin-bottom:5px;" id="colom">
                          <div class="row ml-1">
                              <h4 id="judul_d">` + json[i].judul + `</h4> &nbsp; <h5>(` + json[i].nomor + `)</h5> <button type="button" class="btn btn-primary ml-2" onclick="show('` + json[i].file + `','` + json[i].tglsrt + `')" data-toggle="modal" data-target="#modal-view">Lihat Surat</button>
                          </div>
                          <small>Periode surat : ` + json[i].tglaw + ` - ` + json[i].tglak + `</small>
                          <h5 class="mb-2 mt-1"><u>Nilai Klaim </u></h5>
                          <div class="row mt-2 ml-1" id="nilai-klaim">
                              <div class="form-group">
                                  <label for="rp">DPP</label>
                                  <input type="text" class="form-control number-separator rp" required name="rp` + [i] + `" id="rp" placeholder="Nilai..." onchange="cek_nilai_dpp3(this)" value="0">
                              </div>
                          </div>
                          <h5 class="mb-2 mt-1"><u>Periode Klaim</u></h5>
                          <div class="row" id="tglawak">
                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="tglaw">Tanggal Awal</label>
                                      <input type="date" class="form-control" required name="tglaw` + [i] + `" id="tglaw" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                  </div>
                              </div>
                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="tglak">Tanggal Akhir</label>
                                      <input type="date" class="form-control" required name="tglak` + [i] + `" id="tglak" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                  `);
              }

            });
          },
        })
      ).then(function() {
        if ($('#judul #judul_d').length != 0 && $('#result tr').length != 0) {
          hideLoading();
        }
      });


      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-nosrt-container').css("font-weight", "bolder")
      }
    })
    $('#nosrt_add').on('change', function() {
      var nosrt = $('#nosrt_add').val();
      var mkns_arr2 = [];
      $('#result tr').remove();
      $('#judul .card').remove();
      $('#judul_l').removeClass('d-none');
      showLoading();
      $.when(
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminsp/mekanisme',
          data: {
            nomor: $("#nosrt_add").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#result").append(`<tr><td>` + json[i].mkns + `</td><td><input type="checkbox" nomor="` + json[i].kode + `" nosrt="` + json[i].nomor + `" name="mkns" id="mkns" class="mkns" checked onchange="change_mkns()"></td></tr>`);
              mkns_arr2.push({
                kode: json[i].kode,
                nomor: json[i].nomor,
              })
            });
            $('.mkns_in').val(JSON.stringify(mkns_arr2))
          },
        }),
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminsp/judul',
          data: {
            nomor: $("#nosrt_add").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              if ($('#jns').val() == 02) {
                $("#judul").append(`
                <div class="card">
                        <div class="card-body">
                            <div style="padding:5px;margin-bottom:5px;">
                                <div class="row ml-1">
                                    <h4 id="judul_d">` + json[i].judul + `</h4> &nbsp; <h5>(` + json[i].nomor + `)</h5> <button type="button" class="btn btn-primary ml-2" onclick="show('` + json[i].file + `','` + json[i].tglsrt + `')" data-toggle="modal" data-target="#modal-view">Lihat Surat</button>
                                </div>
                                <small>Periode surat : ` + json[i].tglaw + ` - ` + json[i].tglak + `</small>
                                <h5 class="mb-2 mt-1"><u>Nilai Klaim </u></h5>
                                <a class="btn btn-success" onclick="add('` + i + `')">Tambah</a>
                                <a class="btn btn-danger" onclick="remove('` + i + `')">Hapus</a> <br>
                                <small>(*Jika ada lebih dari 1 barang klik tombol "Tambah")</small>
                                <input type="hidden" name="jml` + i + `" class="jml` + i + `" value="1">
                                <div id="barang` + i + `">
                                    <div class="mt-2 p-1 pl-4 barang` + i + `" style="border:3px solid black; border-radius:20px;box-shadow: 4px 6px 10px rgba(0, 0, 0, 0.25);">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="kdbar` + i + `0">Kode Barang</label>
                                                <input type="text" class="form-control" required name="kdbar` + i + `0" id="kdbar` + i + `0" placeholder="Kode Barang..." onchange="cek_kode(this)">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="nmbar` + i + `0">Nama Barang </label>
                                                <input type="text" class="form-control" name="nmbar` + i + `0" id="nmbar` + i + `0" placeholder="Nama Barang" readonly>
                                            </div>
                                            <div class="form-group col-1">
                                                <label for="isi` + i + `0">Isi </label>
                                                <input type="text" class="form-control" name="isi` + i + `0" id="isi` + i + `0" placeholder="Isi" readonly>
                                            </div>
                                            <div class="form-group  mr-2 col-1">
                                                <label for="qty1` + i + `0">Ctn</label>
                                                <input type="text" class="form-control " required name="qty1` + i + `0" id="qty1` + i + `0" placeholder="Isi (ctn)..." onchange="cek_nilai2(this)" value="0">
                                            </div>
                                            <div class="form-group col-1">
                                                <label for="qty2` + i + `0">Pcs</label>
                                                <input type="text" class="form-control " required name="qty2` + i + `0" id="qty2` + i + `0" placeholder="Isi (pcs)..." onchange="cek_nilai2(this)" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mb-2 mt-3"><u>Periode Klaim </u></h5>
                                <div class="row" id="tglawak">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="tglaw">Tanggal Awal</label>
                                            <input type="date" class="form-control" required name="tglaw` + [i] + `" id="tglaw" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="tglak">Tanggal Akhir</label>
                                            <input type="date" class="form-control" required name="tglak` + [i] + `" id="tglak" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  `);
              } else {
                $("#judul").append(`
              <div class="card">
                  <div class="card-body">
                      <div style="padding:5px; margin-bottom:5px;" id="colom">
                          <div class="row ml-1">
                              <h4 id="judul_d">` + json[i].judul + `</h4> &nbsp; <h5>(` + json[i].nomor + `)</h5> <button type="button" class="btn btn-primary ml-2" onclick="show('` + json[i].file + `','` + json[i].tglsrt + `')" data-toggle="modal" data-target="#modal-view">Lihat Surat</button>
                          </div>
                          <small>Periode surat : ` + json[i].tglaw + ` - ` + json[i].tglak + `</small>
                          <h5 class="mb-2 mt-1"><u>Nilai Klaim </u></h5>
                          <div class="row mt-2 ml-1" id="nilai-klaim">
                              <div class="form-group">
                                  <label for="rp">DPP</label>
                                  <input type="text" class="form-control number-separator rp" required name="rp` + [i] + `" id="rp" placeholder="Nilai..." onchange="cek_nilai_dpp3(this)" value="0">
                              </div>
                          </div>
                          <h5 class="mb-2 mt-1"><u>Periode Klaim</u></h5>
                          <div class="row" id="tglawak">
                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="tglaw">Tanggal Awal</label>
                                      <input type="date" class="form-control" required name="tglaw` + [i] + `" id="tglaw" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                  </div>
                              </div>
                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="tglak">Tanggal Akhir</label>
                                      <input type="date" class="form-control" required name="tglak` + [i] + `" id="tglak" min="` + json[i].tglaw + `" max="` + json[i].tglak + `">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                  `);
              }
            });
          },
        })
      ).then(function() {
        if ($('#judul #judul_d').length != 0 && $('#result tr').length != 0) {
          hideLoading();
        }
      });


      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-nosrt-container').css("font-weight", "bolder")
      }
    })
    $('#nosrtbg').on('change', function() {
      var nosrt = $('#nosrtbg').val();
      var mkns_arr2 = [];
      $('#result tr').remove();
      $('#judul').empty();
      $('#judul_l').removeClass('d-none');
      showLoading();
      $.when(
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminjbr/mekanisme',
          data: {
            nomor: $("#nosrtbg").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#result").append(`<tr><td>` + json[i].mkns + `</td><td><input type="checkbox" nomor="` + json[i].kode + `" nosrt="` + json[i].nomor + `" name="mkns" id="mkns" class="mkns" checked onchange="change_mkns()"></td></tr>`);
              mkns_arr2.push({
                kode: json[i].kode,
                nomor: json[i].nomor,
              })
            });
            $('.mkns_in').val(JSON.stringify(mkns_arr2))
          },
        }),
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminjbr/judul',
          data: {
            nomor: $("#nosrtbg").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#judul").append(`<textarea id="judul_d" cols="30" rows="1" readonly class="form-control mb-1">` + json[i].judul + `</textarea><button type="button" class="btn btn-primary" onclick="show('` + json[i].file + `','` + json[i].tglsrt + `')" data-toggle="modal" data-target="#modal-view">Lihat Surat</button>`);
            });
          },
        })
      ).then(function() {
        if ($('#judul #judul_d').length != 0 && $('#result tr').length != 0) {
          hideLoading();
        }
      });


      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-nosrt-container').css("font-weight", "bolder")
      }
    })
    $('#nosrt2').on('change', function() {
      var nosrt = $('#nosrt2').val();
      var mkns_arr2 = [];
      $('#result tr').remove();
      $('#judul #judul_d').remove();
      $('#judul #nilai-klaim').remove();
      $('#judul_l').removeClass('d-none');
      showLoading();
      $.when(
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminjbr/mekanisme',
          data: {
            nomor: $("#nosrt2").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#result").append(`<tr><td>` + json[i].mkns + `</td><td><input type="checkbox" nomor="` + json[i].kode + `" nosrt="` + json[i].nomor + `" name="mkns" id="mkns" class="mkns" checked onchange="change_mkns()"></td></tr>`);
              mkns_arr2.push({
                kode: json[i].kode,
                nomor: json[i].nomor,
              })
            });
            $('.mkns_in').val(JSON.stringify(mkns_arr2))
          },
        }),
        $.ajax({
          type: "POST",
          url: '<?= base_url() ?>/adminjbr/judul',
          data: {
            nomor: $("#nosrt2").val(),
          },
          success: function(res) {
            var json = JSON.parse(res);
            $.each(json, function(i) {
              $("#judul").append(`<textarea id="judul_d" cols="30" rows="1" readonly class="form-control mb-1">` + json[i].judul + `</textarea>
                                      <div class="row mt-2 ml-1" id="nilai-klaim">                      
                                          <div class="form-group">
                                            <label for="rp">DPP</label>
                                            <input type="text" class="form-control number-separator" required name="rp` + [i] + `" id="rp" placeholder="Nilai..." onchange="cek_nilai_dpp()" value="0">
                                          </div>
                                          </div>
                                          <small>*isi 0 jika tidak diperlukan</small>
                                        `);
            });
          },
        })
      ).then(function() {
        if ($('#judul #judul_d').length != 0 && $('#result tr').length != 0) {
          hideLoading();
        }
      });


      if ($('.form-control').find('option:selected .tes').val() != "") {
        $('#select2-nosrt-container').css("font-weight", "bolder")
      }
    })

    function change_mkns() {
      var mkns = $('.mkns');
      var mkns_arr = [];
      for (let i = 0; i < mkns.length; i++) {
        const e = mkns[i];
        if (e.checked) {
          mkns_arr.push({
            kode: e.getAttribute('nomor'),
            nomor: e.getAttribute('nosrt'),
          })
        }
      }
      $('.mkns_in').val(JSON.stringify(mkns_arr))
    }

    function pad(num, size) {
      var s = num + "";
      while (s.length < size) s = "0" + s;
      return s;
    }
  </script>

</body>

</html>
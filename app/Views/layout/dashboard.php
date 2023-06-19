<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>

  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/css/main/app.css">
  <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/api_icon.jpg" type="image/png">

  <link href="https://fonts.googleapis.com/css2?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/css/shared/iconly.css">
  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/extensions/sweetalert2/sweetalert2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.bootstrap4.min.css">
  <!-- Choices -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.css">

  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/extensions/quill/quill.snow.css" />
  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/extensions/quill/quill.bubble.css" />

  <link rel="stylesheet" href="<?= base_url() ?>/dist/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css" />


  <style>
    #table1 tr.selected,
    #table tr.selected {
      color: #fff;
      font-weight: bold;
      background: #007bff;
    }

    #table1 tr.selected td,
    #table tr.selected td {
      color: #fff;
    }

    div.dt-button-collection .dt-button {
      min-width: 100px;
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

    .preloader {
      display: -ms-flexbox;
      display: flex;
      background-color: #f4f6f9;
      height: 100vh;
      width: 100%;
      transition: height .2s linear;
      position: fixed;
      left: 0;
      top: 0;
      z-index: 9999;
    }
  </style>

</head>

<body>
  <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
  <div class="flash-data-warning" data-flashdata="<?= session()->getFlashdata('failed'); ?>"></div>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center bg-white">
    <img class="animation__shake" src="<?= base_url() ?>/assets/img/logo.png" height="100" width="200"> <br>
    <img class="animation__shake" src="<?= base_url() ?>/assets/img/loading.gif" height="100" width="200"> <br>
  </div>
  <input type="hidden" class="sts" value="<?= session()->getFlashdata('sts') ?>">
  <div id="app">
    <div id="main" class="layout-horizontal">
      <header class="mb-5">
        <?= $this->include('layout/header') ?>
        <?= $this->include('layout/navbar') ?>
      </header>

      <div class="content-wrapper container">
        <?= $this->renderSection('content') ?>
      </div>

      <footer>
        <div class="container">
          <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
              <p>2023 &copy; EDP</p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/js/bootstrap.js"></script>
  <script src="<?= base_url() ?>/dist/assets/js/pages/horizontal-layout.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
  <script src="<?= base_url() ?>/dist/assets/datatables-select/js/dataTables.select.min.js"></script>
  <!-- Sweetalert -->
  <script src="<?= base_url() ?>/dist/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
  <!-- Choices -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/choices.js/9.0.1/choices.min.js"></script>
  <!-- AdminLTE App -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>


  <script src="<?= base_url() ?>/assets/js/dashboard.js"></script>

  <script>
    const sts = document.querySelector('.sts').value;
    if (sts == 1) {
      let audio = new Audio("<?= base_url() ?>/assets/audio/success.mp3");
      audio.play();
    }
    var choices = document.querySelectorAll('.choices');
    for (let i = 0; i < choices.length; i++) {
      new Choices(choices[i], {
        shouldSort: false,
      });
    }
  </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kendaraan <?= get_no($kend->no_kend) ?></title>
  <link rel="stylesheet" href="../../assets/css/kend.css" />
</head>

<body>
  <div class="potrait">
    <div class="name">PT. Andalan Prima Indonesia</div>
    <div class="head">
      <h1><?= get_no($kend->no_kend) ?></h1>
      <h5><?= $kend->merk ?> / <?= $kend->type ?></h5>
    </div>
    <div class="divider"></div>
    <div class="detail">
      <h3>DATA STNK</h3>
      <div class="row">
        <div class="group">
          <h4>Stock Point</h4>
          <p><?= sp($kend->kdsp) ?></p>
        </div>
        <div class="group">
          <h4>Nomor STNK</h4>
          <p><?= $kend->no_stnk ?></p>
        </div>
      </div>
      <div class="row">
        <div class="group">
          <h4>Nama Pemilik</h4>
          <p><?= $kend->nm_stnk ?></p>
        </div>
        <div class="group">
          <h4>Masa Berlaku</h4>
          <p><?= $kend->exp_stnk ?></p>
        </div>
      </div>
      <h3>DATA PAJAK</h3>
      <div class="row">
        <div class="group">
          <h4>Nomor Pajak</h4>
          <p><?= ($kend->no_pjk != "" ? $kend->no_pjk : "-") ?></p>
        </div>
        <div class="group">
          <h4>Masa Berlaku Pajak</h4>
          <p><?= ($kend->exp_pjk != "" ? $kend->exp_pjk : "-") ?></p>
        </div>
      </div>
      <h3>DETAIL KENDARAAN</h3>
      <div class="row">
        <div class="group">
          <h4>Fungsi Kendaraan</h4>
          <p><?= $kend->fungsi ?></p>
        </div>
        <div class="group">
          <h4>Jenis Kendaraan</h4>
          <p><?= $kend->jenis ?></p>
        </div>
      </div>
      <div class="row">
        <div class="group">
          <h4>Isi Silinder</h4>
          <p><?= $kend->isi_slndr ?></p>
        </div>
        <div class="group">
          <h4>Warna Kendaraan</h4>
          <p><?= $kend->warna ?></p>
        </div>
      </div>
      <div class="row">
        <div class="group">
          <h4>Tahun Pembuatan</h4>
          <p><?= $kend->thn_buat ?></p>
        </div>
        <div class="group">
          <h4>Tanggal Pembelian</h4>
          <p><?= $kend->tgl_beli ?></p>
        </div>
      </div>
      <div class="row">
        <div class="group">
          <h4>Nomor Rangka</h4>
          <p><?= $kend->no_rangka ?></p>
        </div>
        <div class="group">
          <h4>Nomor Mesin</h4>
          <p><?= $kend->no_mesin ?></p>
        </div>
      </div>
      <div class="row-img">
        <h4>Foto Kendaraan</h4>
        <div class="c-box">
          <div class="box" style="background-image: url(../../assets/img/foto_kendaraan/<?= $kend->foto1 ?>);"></div>
          <div class="box" style="background-image: url(../../assets/img/foto_kendaraan/<?= $kend->foto2 ?>);"></div>
          <div class="box" style="background-image: url(../../assets/img/foto_kendaraan/<?= $kend->foto3 ?>);"></div>
          <div class="box" style="background-image: url(../../assets/img/foto_kendaraan/<?= $kend->foto4 ?>);"></div>
        </div>
      </div>
    </div>
    <p class="date"><?= gettime() ?></p>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
    document.onkeyup = function(e) {
      if (e.which == 49) {
        $('.potrait').prop('style', 'background: #fff');
      } else if (e.which == 50) {
        $('.potrait').prop('style', 'background: #f6fadd');
      } else if (e.which == 51) {
        $('.potrait').prop('style', 'background-image: url(../../assets/img/theme/bg.png)');
      } else if (e.which == 52) {
        $('.potrait').prop('style', 'background-image: url(../../assets/img/theme/bg2.png)');
      } else if (e.which == 53) {
        $('.potrait').prop('style', 'background-image: url(../../assets/img/theme/bg3.png)');
      }
    };
    window.onload = function() {
      document.addEventListener(
        "contextmenu",
        function(e) {
          e.preventDefault();
        },
        false
      );
      document.addEventListener(
        "keydown",
        function(e) {
          // "I" key
          if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
            disabledEvent(e);
          }
          // "J" key
          if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
            disabledEvent(e);
          }
          // "S" key + macOS
          if (
            e.keyCode == 83 &&
            (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)
          ) {
            disabledEvent(e);
          }
          // "U" key
          if (e.ctrlKey && e.keyCode == 85) {
            disabledEvent(e);
          }
          // "F12" key
          if (event.keyCode == 123) {
            disabledEvent(e);
          }
        },
        false
      );

      function disabledEvent(e) {
        if (e.stopPropagation) {
          e.stopPropagation();
        } else if (window.event) {
          window.event.cancelBubble = true;
        }
        e.preventDefault();
        return false;
      }
    };
    alert('Tekan angka 1-5 untuk mengubah tema \nTekan ctrl+p untuk print');
  </script>
</body>


</html>
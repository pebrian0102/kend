<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pengajuan Service <?= $srv->nosrv ?></title>
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/service.css" />
</head>

<body>
  <section class="potrait" style="background: #fff">
    <div class="top">
      <h5>PT. ANDALAN PRIMA INDONESIA</h5>
      <h6>STOCK POINT <?= sp($srv->kdsp) ?></h6>
    </div>
    <div class="top2">
      <h3>No. <?= $srv->nosrv ?></h3>
    </div>
    <div class="bottom">
      <small><i><?= gettime() ?></i></small>
    </div>
    <div class="head">
      <h3>PENGAJUAN</h3>
      <h1 style="color: #000; border-bottom-color: #000">
        SERVICE KENDARAAN
      </h1>
      <h2 style="color: #000"><?= get_no($srv->no_kend) ?></h2>
      <h4 style="color: #000"><?= $srv->merk ?> / <?= $srv->type ?></h4>
    </div>

    <div class="detail">
      <table>
        <thead>
          <tr>
            <th style="width: 25%">Jenis Service</th>
            <th style="width: 50%">Rincian Masalah</th>
            <th style="width: 25%">Biaya</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($srv_d as $s) : ?>
            <tr>
              <td><?= $s->service ?></td>
              <td>
                <?= $s->detail ?>
                <?php if ($s->kdjns == "R06") : ?>
                  <br>
                  Kilometer : <?= $s->km ?>
                <?php endif; ?>
              </td>
              <td class="right"><?= number_format($s->nilai, ((int) $s->nilai == $s->nilai ? 0 : 0), '.', ',')  ?></td>
              
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="2" style="text-align: center;"><b>Jumlah</b></td>
            <td class="right"><b><?= number_format($srv->nilai_awal, ((int) $srv->nilai_awal == $srv->nilai_awal ? 0 : 0), '.', ',')  ?></b></td>
          </tr>
        </tbody>
      </table>
      <div class="row" style="justify-content: center">
        <div class="box2">
          <div class="title">PERSETUJUAN</div>
          <div class="group">
            <div class="g-check">
              <div class="check">
                <?php if ($srv->app1 == 1) : ?>
                  <i class="icon_app"></i>
                <?php elseif ($srv->app1 == 2) : ?>
                  <i class="icon_danied"></i>
                <?php else : ?>
                  <i class="icon_secondary"></i>
                <?php endif; ?>
                SPV <?= sp($srv->kdsp) ?>
              </div>
              <?php if ($srv->app1 != 0) : ?>
                <small><?= $srv->tglapp1 ?></small>
              <?php endif; ?>
            </div>
            <div class="g-check">
              <div class="check">
                <?php if ($srv->app2 == 1) : ?>
                  <i class="icon_app"></i>
                <?php elseif ($srv->app2 == 2) : ?>
                  <i class="icon_danied"></i>
                <?php else : ?>
                  <i class="icon_secondary"></i>
                <?php endif; ?>
                NSM
              </div>
              <?php if ($srv->app2 != 0) : ?>
                <small><?= $srv->tglapp2 ?></small>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
<?= $this->extend('layout/dashboard') ?>
<?= $this->section('content') ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Informasi</h3>
                <p class="text-subtitle text-muted">
                    Data Informasi
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>/master">Master</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Service
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
                        <h4 class="card-title">Informasi</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url() ?>/master/info_action" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="info">Informasi Pengumuman</label>
                                        <div id="snow" style="height: 200px;">
                                            <p><?= $info->info ?></p>
                                        </div>
                                        <textarea name="info" id="info" cols="30" rows="10" class="form-control d-none" placeholder="Informasi Pengumuman"><?= $info->info ?></textarea>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-success" id="btn-submit">Update</button>
                                    </div>
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
<script src="<?= base_url() ?>/dist/assets/extensions/quill/quill.min.js"></script>
<script>
    var quill = new Quill('#snow', {
        placeholder: 'Masalah (Alasan Service)...',
        theme: 'snow'
    });
    quill.on('text-change', function(delta, source) {
        updateHtmlOutput()
    })
    $('#btn-submit').on('click', () => {
        updateHtmlOutput()
    })

    function getQuillHtml() {
        return quill.root.innerHTML;
    }


    function updateHtmlOutput() {
        let html = getQuillHtml();
        console.log(html);
        document.getElementById('info').innerText = html;
    }

    updateHtmlOutput()
</script>
<?= $this->endSection() ?>
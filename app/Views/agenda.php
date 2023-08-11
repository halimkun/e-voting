<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<header class="masthead-75" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.70) 0%, rgba(4, 33, 76, 0.9) 100%), url("/files/agenda/<?= $agenda['foto'] ?>"); ?>; background-position: center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;'>
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-white font-weight-bold m-0 p-0" style="text-transform: capitalize !important;"><?= strtolower($agenda['acara']) ?></h1>
            </div>
            <div class="col-lg-8 align-self-baseline text-white-75">
                dibuat pada : <?= date_format(date_create($agenda['created_at'] ), 'd F Y H:i') ?>
            </div>
        </div>
    </div>
</header>

<section class="page-section">
    <div class="container">
        <div class="isi mt-4">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card card-body mb-3 shadow-sm">
                        <div class="text-center">
                            <a href="/files/agenda/<?= $agenda['foto'] ?>" target="_blank"><img src="/files/agenda/<?= $agenda['foto'] ?>" class="w-50 img-fluid" alt="<?= $agenda['acara'] ?>"></a>
                        </div>
                    </div>
                    <div class="card card-body mb-3 shadow-sm">
                        <table class="table">
                            <tr>
                                <th>Mulai</th>
                                <td>
                                    <?= date_format(date_create($agenda['mulai']), 'd F Y') ?>
                                    <br>
                                    <?= date_format(date_create($agenda['mulai']), 'H:i') ?> WIB
                                </td>
                            </tr>
                            <tr>
                                <th>Selesai</th>
                                <td>
                                    <?= date_format(date_create($agenda['selesai']), 'd F Y') ?>
                                    <br>
                                    <?= date_format(date_create($agenda['selesai']), 'H:i') ?> WIB
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card card-body mb-3 shadow-sm p-4">
                        <div class="mb-3">
                            <h4 class="m-0 p-0 mb-2"><?= $agenda['acara'] ?></h4>
                            <p class="m-0 p-0"><small class="text-secondary">Dibuat : <?= date_format(date_create($agenda['created_at']), "d F Y H:i") ?></small></p>
                        </div>
                        <?= $agenda['keterangan'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>



<?= $this->section('script_js'); ?>
<script>
    $(document).ready(function() {
        $('img').addClass('img-fluid');
    });
</script>
<?= $this->endSection(); ?>
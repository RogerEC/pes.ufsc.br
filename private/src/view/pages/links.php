            <div class="container-fluid max-widht text-center">
                <img src="/assets/img/logo-pes-circular.png" class="mb-4" width="300" alt="Logo Cursinho PES">
<?php if(!empty($parameters) && isset($parameters)) {
    foreach($parameters as $link) {
?>
                <a class="btn btn-verde w-100 mb-2" target="_blank" href="<?= $link->url; ?>"><b><?= $link->name; ?></b></a>
<?php }} ?>
                <a class="btn btn-verde w-100 mb-2" href="/"><b>Voltar ao site</b></a>
            </div>
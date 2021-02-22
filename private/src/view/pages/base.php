<!DOCTYPE html>
<html lang="pt-BR">
    <head>
<?php if(!empty($this->title)) { ?>
        <title><?= $this->title;?></title>
<?php } ?>
<?php if(!empty($this->keywords)) { ?>
        <meta name="keywords" content="<?= $this->keywords;?>">
<?php } ?>
<?php if(!empty($this->description)) { ?>
        <meta name="description" content="<?= $this->description;?>">
<?php } ?>
<?php if(!empty($this->robots)) { ?>
        <meta name="robots" content="<?= $this->robots;?>">
<?php } ?>
        <?php require_once DIR_COMPONENTS . 'head.php' ?>
<?php foreach($this->scriptsCSS as $file) { ?>
        <link rel="stylesheet" type="text/css" href="/assets/css/<?= $file;?>">
<?php } ?>
    </head>
    
    <body <?php if(!empty($this->classBody)) {echo "class=\"$this->classBody\"";}?>>

<?php if($this->includeNavbar) {
        require_once DIR_COMPONENTS . 'navbar.php';
} ?>    
        <main <?php if(!empty($this->classMain)) {echo "class=\"$this->classMain\"";}?>> <!-- Conteúdo da página -->
<?php foreach($this->main as $file) {
        require_once DIR_VIEW . $file; 
} ?>
        </main> <!-- /Conteúdo da página -->

<?php if($this->includeFooter) {
        require_once DIR_COMPONENTS . 'footer.php';
} ?>

        <!-- Javascript -->
<?php foreach($this->scriptsJS as $file) { ?>
        <script src="/assets/js/<?= $file;?>"></script>
<?php } ?>
    </body>
</html>
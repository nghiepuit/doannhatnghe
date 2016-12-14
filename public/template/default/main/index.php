<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->meta; ?>
    <title><?php echo $this->title; ?></title>
    <?php echo $this->css; ?>
    <?php echo $this->js; ?>
</head>
<body>
<?php require_once MODULE_PATH.$this->module.DS."views".DS.$this->fileView.".php"?>
<?php include_once "html/footer.php"?>

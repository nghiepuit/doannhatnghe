<!doctype html>
<html lang="en">
<head>
    <?php echo $this->meta; ?>
    <title><?php echo $this->title; ?></title>
    <?php echo $this->css ?>
    <?php echo $this->js ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include_once "html/header.php"?>
    <?php include_once "html/aside.php"?>
    <?php require_once MODULE_PATH.$this->module.DS."views".DS.$this->fileView.".php"?>
    <?php include_once "html/footer.php"?>
</div>
</body>
</html>
<?php

use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use yii\helpers\Html;
use admin\assets\AdminlteAsset;

AdminlteAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->registerCsrfMetaTags() ?>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
  <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">

<?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- header Navbar -->
            <?php echo $this->render('headernav'); ?>
        <!-- /.Header navbar -->

        <!-- Main Sidebar Container -->
            <?php echo $this->render('sidenav'); ?>
        <!-- Main Sidebar end Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-top: 76px; margin-left: 268px;margin-right: 6px;">

            <?php echo $content; ?>

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
            <?php echo $this->render('footer'); ?>
        <!-- end of Main Footer -->
    </div>
    <!-- ./wrapper -->
    <?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
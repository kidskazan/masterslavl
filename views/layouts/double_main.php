<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\PayAsset;

/* @var $this \yii\web\View */
/* @var $content string */

PayAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html> 
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="assets2/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,700,300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=PT+Serif:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="assets2/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <link href="assets2/css/style.css" rel="stylesheet"/>
        <script src="assets2/js/moment-with-locales.js"></script>
        <script src="assets2/bootstrap-3.3.5-dist/js/collapse.js"></script>
        <script src="assets2/bootstrap-3.3.5-dist/js/transition.js"></script>
        <script src="assets2/bootstrap-3.3.5-dist/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="assets2/bootstrap-3.3.5-dist/css/bootstrap-datetimepicker.min.css" />
         <link rel="stylesheet" href="js/sweetalert-master/dist/sweetalert.css" />
        <script type="text/javascript" src="assets2/js/jquery.maskedinput-1.2.2.js"></script>
        <script type="text/javascript" src="js/sweetalert-master/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="js/sweetalert-master/themes/masterslavl/masterslavl.css"> 
        <script type="text/javascript" src="js/main.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>

<?php $this->beginBody() ?>
    <div id="line_top">
        <div class="logo"> <a href="http://www.masterslavl.ru/" target="_blank"><img src="images/logo.png" height="40px"></a></div>
        <?php if (isset($_GET['type_ticket'])){echo ' <div class="center"> <a href="../index.php?r=online-pay" ><div class="back">ВЕРНУТЬСЯ К ВЫБОРУ ТИПА БИЛЕТОВ</div> </a></div>';}?>

    </div>
    <div class="container">
    <div class="row content">
        <div class="content-inner">
            <div class="clearfix"></div>
            <div style="height:10px;"></div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title"><center>Оформление заказа</center></div>
                <div style="height:10px;"></div>
                <div class="subtitle"><center><?= $this->params["type_ticket"] ?></center></div>
                <div style="height:10px;"></div>
                <div class="smalltitle"><center><?= Html::encode($this->title) ?></center></div>

                <?= $content ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>

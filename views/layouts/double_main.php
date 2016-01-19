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
<meta name="viewport" content="width=720px, initial-scale=1.0">

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
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

</head>

<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter32638055 = new Ya.Metrika({id:32638055,
                    webvisor:true,
                    clickmap:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/32638055" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<body>

<?php $this->beginBody() ?>
    <div id="line_top">
	    <table width="100%">
		<tr>
		<td width="33%">
        <div class="logo"> <a href="http://www.masterslavl.ru/" target="_blank"><img src="images/logo.png" height="40px"></a></div>
		</td>
		<td width="33%">
        <?php if ( Html::encode($this->title) != "Выберите тип посещения"){echo ' <div class="center"> <a href="../index.php?r=online-pay" ><div class="back">ВЕРНУТЬСЯ К ВЫБОРУ ТИПА БИЛЕТОВ</div> </a></div>';}?>
		</td>
		<td width="33%" align="right">
		<?php if ( Html::encode($this->title) == "Мои заказы"){echo '<div class="account-exit"><div class="exit"></div></div><div class="account"><div class="userpick"></div><div class="acc_owner"><span class="acc_name">Александра</span><br><span class="acc_surname">Тухватуллина</span></div><div class="acc_orders"><a href="/index.php?r=online-pay/orders">Мои заказы</a></div></div>';}?>
		</td>
		</tr>
		</table>

    </div>
    <div class="container">
    <div class="row content">
        <div class="content-inner">
            <div class="clearfix"></div>
            <div style="height:10px;"></div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="title"><center><?php if ( Html::encode($this->title) == "Заказ готов"){echo 'Заказ готов';} else {echo 'Оформление заказа';}?></center></div>
                <div style="height:10px;"></div>
                <div class="subtitle"><center><?= $this->params["type_ticket"] ?></center></div>
                <div style="height:10px;"></div>
                <div class="smalltitle"><center><?php if ( Html::encode($this->title) == "Заказ готов"){echo '';} else {echo Html::encode($this->title);}?></center></div>

                <?= $content ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</body>
</html>
<?php $this->endPage() ?>

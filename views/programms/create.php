<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Programms */

$this->title = 'Create Programms';
$this->params['breadcrumbs'][] = ['label' => 'Programms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="programms-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

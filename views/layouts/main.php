<?php

/* @var $this \yii\web\View */
/* @var $content string */

use naffiq\bridge\assets\AdminAsset;
use naffiq\bridge\widgets\SideMenu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii2tech\admin\widgets\ButtonContextMenu;

AdminAsset::register($this);

/** @var $user \Da\User\Model\User */
$user = \Yii::$app->user->identity;
/** @var \naffiq\bridge\BridgeModule $adminModule */
$adminModule = \Yii::$app->getModule('admin');
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
</head>
<body>
<?php $this->beginBody() ?>

<div class="nav-menu">
    <div class="hamburger">
        <i class="fa fa-bars"></i>
    </div>

    <?php if (!\Yii::$app->user->isGuest) : ?>
        <?= SideMenu::widget([
            'items' => $adminModule->getMenuItems()
        ]) ?>

        <?php ActiveForm::begin(['action' => ['/admin/default/logout'], 'options' => [
            'class' => 'form--sign-out'
        ]]) ?>
        <button type="submit" class="btn btn-sign-out" data-toggle="tooltip" data-placement="right"
                title="<?= Yii::t('bridge', 'Sign&nbsp;out') ?>">
            <span class="sign-out--title">
                <?= Yii::t('bridge', 'Logout') ?>
            </span> <i class="fa fa-sign-out"></i>
        </button>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>

<div class="bridge-wrap">

    <div class="container-fluid clearfix">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumb breadcrumb-arrow'],
            'activeItemTemplate' => "<li class=\"active\"><span>{link}</span></li>\n",
            'homeLink' => [
                'label' => \Yii::t('bridge', 'Home'),
                'url' => ['/admin/']
            ]
        ]) ?>

        <h1><?= Html::encode(isset($this->params['header']) ? $this->params['header'] : $this->title) ?></h1>

        <p>
            <?= ButtonContextMenu::widget([
                'items' => isset($this->params['contextMenuItems']) ? $this->params['contextMenuItems'] : []
            ]) ?>
        </p>

        <?= $content ?>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="footer-copyright text-center">
                &beta;ridge © <?= date('Y') ?>
                by <a href="https://github.com/naffiq" target="_blank">naffiq</a>
            </div>
        </div>
    </footer>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

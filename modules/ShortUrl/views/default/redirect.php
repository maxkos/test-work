<?php

/* @var string $code  */
/* @var $this yii\web\View */
/* @var $model app\modules\ShortUrl\models\ShortUrl */

use yii\helpers\Html;
$this->title = Yii::t('modules/shorturl', 'URL by this code is not found');
?>

<div class="short-link-form">
    <div class="alert alert-danger">
        <?php echo Yii::t('modules/shorturl', 'URL by this code "{code}" is not found', ['code' => Html::encode($code)]);?>
    </div>
</div>


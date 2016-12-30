<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\ShortUrl\models\ShortUrl */
/* @var $shortUrl null|app\modules\ShortUrl\models\ShortUrl */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

$this->registerJs(
    '$("document").ready(function(){
        $("#shortUrlForm").on("pjax:end", function() {
            $.pjax.reload({container:"#shortUrls"});
        });
    });'
);
?>

<?php Pjax::begin(['id' => 'shortUrlForm']) ?>
<div class="short-link-form">
    <h2><?php echo Yii::t('modules/shorturl', 'Generate short url');?></h2>
    <?php $form = ActiveForm::begin(['id' => 'generateShortUrlForm', 'enableAjaxValidation' => true]); ?>
    <div class="row">
        <div class="col-md-10">
            <?php echo $form->field($model, 'url')->textInput(['placeholder' => Yii::t('modules/shorturl', 'Enter your URL')])->label(false); ?>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <?php echo Html::submitButton(Yii::t('modules/shorturl', 'Shorten URL'), ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if ($shortUrl):?>
        <div class="alert alert-success"><?php echo Yii::t('modules/shorturl', 'New short url: {url}', ['url' => Url::toRoute(['/ShortUrl/default/redirect', 'code' => $shortUrl->code],true) ]);?> </div>
    <?php endif;?>
</div>
<?php Pjax::end() ?>

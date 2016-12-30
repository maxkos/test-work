<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\ShortUrl\models\ShortUrl */
/* @var $shortUrl null|app\modules\ShortUrl\models\ShortUrl */
/* @var $searchModel app\modules\ShortUrl\models\ShortUrlSearch; */
/* @var $dataProvider yii\data\ActiveDataProvider; */

$this->title = Yii::t('modules/shorturl', 'Generate short link');
?>
<?php echo $this->render('_form',[
    'model' => $model,
    'shortUrl' => $shortUrl
]) ?>

<?php echo $this->render('_grid',[
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel
]) ?>

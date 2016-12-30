<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\ShortUrl\models\ShortUrl */
/* @var $shortUrl null|app\modules\ShortUrl\models\ShortUrl */
/* @var $searchModel app\modules\ShortUrl\models\ShortUrlSearch; */
/* @var $dataProvider yii\data\ActiveDataProvider; */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

Pjax::begin(['id' => 'shortUrls']) ?>
    <div class="short-link-datatable">
        <?php echo \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'url',
                    'content' => function ($data) {
                        return Html::a(
                            urldecode($data->url),
                            $data->url,
                            [
                                'target' => '_blank',
                                'data-pjax' => 0,
                            ]
                        );
                    }
                ],
                [
                    'attribute' => 'code',
                    'content'   => function ($data) {
                        return Html::a(
                            $data->code,
                            Url::toRoute(['/ShortUrl/default/redirect', 'code' => $data->code]),
                            [
                                'target' => '_blank',
                                'data-pjax' => 0,
                            ]
                        );
                    }
                ],
                'created_at',
            ]
        ]);; ?>
    </div>
<?php Pjax::end() ?>
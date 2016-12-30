<?php
namespace app\modules\ShortUrl\controllers;

use app\components\BaseController;
use app\modules\ShortUrl\models\ShortUrlSearch;
use Yii;
use app\modules\ShortUrl\models\ShortUrl;
use yii\bootstrap\ActiveForm;
use yii\web\Response;

/**
 * Class DefaultController
 */
class DefaultController extends BaseController
{

    /**
     * Create page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new ShortUrl();
        $shortUrl = null;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        }
        if ($model->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isAjax)
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else
            {
                $shortUrl = ShortUrl::findShortUrlByCode($model->generateCodeByUrl());
                if (!$shortUrl && $model->save())
                    $shortUrl = $model;
                $model = new ShortUrl();

            }
        }

        $searchModel = new ShortUrlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'shortUrl' => $shortUrl,
        ]);
    }

    /**
     * @param string $code
     * @return string
     */
    public function actionRedirect($code)
    {
        $model = ShortUrl::findShortUrlByCode($code);

        if ($model)
            return $this->redirect($model->url);

        return $this->render('redirect', [
            'model' => $model,
            'code' => $code,
        ]);
    }
}
<?php
namespace app\components;

use yii\web\Controller;

/**
 * Class BaseController
 */
class BaseController extends Controller
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

}
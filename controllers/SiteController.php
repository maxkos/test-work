<?php
namespace app\controllers;

use app\components\BaseController;

/**
 * Class SiteController
 */
class SiteController extends BaseController
{

    /**
     * Displays Startpage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}

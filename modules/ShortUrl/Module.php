<?php
namespace app\modules\ShortUrl;

use Yii;
use yii\base\Module as BaseModule;

/**
 * ShortUrl
 */
class Module extends BaseModule
{
    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\ShortUrl\controllers';

    /**
     * Init Module Short Url
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    /**
     * Init localization module
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/shorturl'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/ShortUrl/messages',
            'fileMap' => [
                'modules/shorturl' => 'shorturl.php',
            ],
        ];
    }

}
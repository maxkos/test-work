<?php
namespace app\modules\ShortUrl\models;

use app\modules\ShortUrl\behaviors\CodeGeneratorBehavior;
use app\modules\ShortUrl\helpers\CodeGenerator;
use GuzzleHttp\Client;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * Class ShortUrl
 * This is the model class for table "{{%short_url}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $code
 * @property string $created_at
 */
class ShortUrl extends ActiveRecord
{

    /**
     * Table name
     * @return  string
     */
    public static function tableName()
    {
        return '{{%short_url}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => TimestampBehavior::class,
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value'      => new Expression('NOW()'),
            ],
            'code'      => [
                'class'     => CodeGeneratorBehavior::class,
                'attribute' => 'code',
                'generator' => function ($model) {
                    /** @var ShortUrl $model */
                    return $model->generateCodeByUrl();
                },
            ],
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['url'], 'trim'],
            [['url'], 'required'],
            [['url'], 'url'],
            ['url', 'checkUrlExist', 'skipOnEmpty' => true, 'skipOnError' => true],
            [['url'], 'string', 'max' => 1024],
            [['code', 'created_at'], 'safe'],
        ];
    }

    /**
     * @return ShortUrlQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShortUrlQuery(get_called_class());
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('modules/shorturl', 'ID'),
            'url'        => Yii::t('modules/shorturl', 'Url'),
            'code'       => Yii::t('modules/shorturl', 'Short Code'),
            'created_at' => Yii::t('modules/shorturl', 'Created At')
        ];
    }

    /**
     * Get ShortUrl by code
     * @param string $code
     * @return ShortUrl
     */
    public static function findShortUrlByCode($code)
    {
        return self::findOne(['code' => $code]);
    }

    /**
     * Check url is  exist
     * @param string $attribute
     * @param mixed $param
     */
    public function checkUrlExist($attribute, $param)
    {
        if ($this->$attribute) {
            $response = $this->getResponseDataByUrl($this->$attribute);

            if ($response->getStatusCode() >= 400) {
                $this->addError($attribute, Yii::t('modules/shorturl', 'Url has wrong status code "{code}".', ['code' => $response->getStatusCode()]));
            }
        }
    }

    /**
     * @param string $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getResponseDataByUrl($url)
    {
        $client = new Client([
            'timeout'     => 5.0,
            'http_errors' => false,
        ]);
        return $client->head($url);
    }

    /**
     * @return string
     */
    public function generateCodeByUrl()
    {
        return CodeGenerator::generate($this->url);
    }
}
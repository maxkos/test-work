<?php
namespace app\modules\ShortUrl\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * Class CodeGeneratorBehavior
 */
class CodeGeneratorBehavior extends AttributeBehavior
{
    /**
     * @var string
     */
    public $attribute = 'code';

    /**
     * @var callable
     */
    public $generator;

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'generate',
        ];
    }

    /**
     * @return string
     */
    public function generate()
    {
        $str = '';
        $owner = $this->owner;
        if (is_callable($this->generator)) {
            $str = call_user_func($this->generator, $this->owner);
        }
        $owner->{$this->attribute} = $str;
    }

}
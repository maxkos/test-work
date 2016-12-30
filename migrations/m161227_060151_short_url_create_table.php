<?php

use yii\db\Migration;

class m161227_060151_short_url_create_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%short_url}}', [
            'id' => $this->primaryKey(),
            'url' => $this->text(),
            'code' => $this->string(50)->notNull()->unique(),
            'created_at' => $this->dateTime(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%short_url}}');
    }
}

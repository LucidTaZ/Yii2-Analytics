<?php

use yii\base\InvalidConfigException;
use yii\db\Migration;

/**
 * Create the tables for the module
 * Usage:
 * php yii migrate --migrationPath=@vendor/lucidtaz/yii2-analytics/src/migrations
 */
class m160913_120000_create_tables extends Migration
{
    public function init()
    {
        $module = Yii::$app->getModule('analytics');
        if ($module === null) {
            throw new InvalidConfigException('The module is not configured / loaded');
        }
        $this->db = $module->db;
        parent::init();
    }

    public function up()
    {
        $this->createTable('{{%context}}', [
            'id' => $this->primaryKey(),
            'values' => $this->text(),
            'created' => $this->dateTime(),
        ]);
        $this->createTable('{{%identity}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull(),
            'traits' => $this->string(),
            'context_id' => $this->integer(),
            'created' => $this->dateTime(),
        ]);
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'properties' => $this->string(),
            'context_id' => $this->integer(),
            'created' => $this->dateTime(),
        ]);
        $this->createTable('{{%page_view}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'properties' => $this->string(),
            'context_id' => $this->integer(),
            'created' => $this->dateTime(),
        ]);
        $this->createTable('{{%association}}', [
            'id' => $this->primaryKey(),
            'user_id1' => $this->string()->notNull(),
            'user_id2' => $this->string()->notNull(),
            'relation' => $this->string()->notNull(),
            'context_id' => $this->integer(),
            'created' => $this->dateTime(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%association}}');
        $this->dropTable('{{%page_view}}');
        $this->dropTable('{{%event}}');
        $this->dropTable('{{%identity}}');
        $this->dropTable('{{%context}}');
    }
}

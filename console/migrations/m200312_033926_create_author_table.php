<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m200312_033926_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Авторы"';
        }

        $this->createTable('author', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->comment('Имя')->notNull(),
            'order' => $this->integer()->comment('Сортировка'),
            'status' => $this->smallInteger()->comment('Статус')->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'order',
            'author',
            'order'
        );

        $this->createIndex(
            'status',
            'author',
            'status'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author');
    }
}

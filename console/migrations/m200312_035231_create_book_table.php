<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m200312_035231_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Книги"';
        }
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->comment('Название')->notNull(),
            'order' => $this->integer()->comment('Сортировка'),
            'status' => $this->smallInteger()->comment('Статус')->notNull()->defaultValue(1),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'order',
            'book',
            'order'
        );

        $this->createIndex(
            'status',
            'book',
            'status'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_book}}`.
 */
class m200312_040003_create_author_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Связь авторов и книг"';
        }
        $this->createTable('author_book', [
            'author_id' => $this->integer()->comment('id автора')->defaultValue(null),
            'book_id' => $this->integer()->comment('id книги')->defaultValue(null),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'FK_author_id',
            'author_book',
            'author_id',
            'author',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'FK_article_id',
            'author_book',
            'book_id',
            'book',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('author_book');
    }
}

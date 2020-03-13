<?php

namespace common\models;

use Yii;
use \common\models\base\Book as BaseBook;

/**
 * This is the model class for table "book".
 */
class Book extends BaseBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['order', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'order' => Yii::t('app', 'Сортировка'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    /**
     * @param $post
     * @return array
     */
    public function getNewAuthorBooks($post)
    {
        $authorBooks = [];

        if (empty($post['AuthorBook'])) {
            return [];
        }

        foreach ($post['AuthorBook'] as $authorBook) {
            $authorBooks[] = $authorBook;
        }

        return $authorBooks;
    }

    /**
     * @param $authorId
     * @return bool
     */
    public function createAuthorBook($authorId)
    {
        if(empty($authorId)) {
            return false;
        }

        return $authorBook = (new AuthorBook([
            'book_id' => $this->id,
            'author_id' => $authorId,
        ]))->save();
    }

    /**
     * delete all AuthorBook
     */
    public function deleteAllAuthorBooks()
    {
        AuthorBook::deleteAll('book_id = ' . $this->id);
    }
}

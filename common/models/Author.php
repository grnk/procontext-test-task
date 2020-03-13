<?php

namespace common\models;

use Yii;
use \common\models\base\Author as BaseAuthor;
use yii\base\InvalidConfigException;

/**
 * This is the model class for table "author".
 */
class Author extends BaseAuthor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя автора'),
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
     * @param $bookId
     * @return bool
     */
    public function createAuthorBook($bookId)
    {
        if(empty($bookId)) {
            return false;
        }

        return $authorBook = (new AuthorBook([
            'author_id' => $this->id,
            'book_id' => $bookId,
        ]))->save();
    }

    /**
     * delete all AuthorBook
     */
    public function deleteAllAuthorBooks()
    {
        AuthorBook::deleteAll('author_id = ' . $this->id);
    }

    /**
     * @return int|string
     * @throws InvalidConfigException
     */
    public function getBooksCount()
    {
        return $this->getBooks()->count();
    }
}

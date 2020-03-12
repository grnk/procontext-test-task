<?php

namespace common\models;

use \common\models\base\AuthorBook as BaseAuthorBook;

/**
 * This is the model class for table "author_book".
 */
class AuthorBook extends BaseAuthorBook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_id', 'book_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }
	
}

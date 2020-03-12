<?php

namespace common\models\base;

use common\models\AuthorBookQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the base model class for table "author_book".
 *
 * @property integer $author_id
 * @property integer $book_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\Book $book
 * @property \common\models\Author $author
 */
class AuthorBook extends ActiveRecord
{

    /**
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'book',
            'author'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author_book';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'author_id' => Yii::t('app', 'id автора'),
            'book_id' => Yii::t('app', 'id книги'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(\common\models\Book::class, ['id' => 'book_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(\common\models\Author::class, ['id' => 'author_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return AuthorBookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorBookQuery(get_called_class());
    }
}

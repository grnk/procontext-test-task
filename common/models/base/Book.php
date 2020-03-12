<?php

namespace common\models\base;

use common\models\BookQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the base model class for table "book".
 *
 * @property integer $id
 * @property string $title
 * @property integer $order
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\AuthorBook[] $authorBooks
 */
class Book extends ActiveRecord
{

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'authorBooks'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Название'),
            'order' => Yii::t('app', 'Сортировка'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }
    
    /**
     * @return ActiveQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(\common\models\AuthorBook::class, ['book_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getAuthors()
    {
        return $this->hasMany(\common\models\Book::class, ['id' => 'author_id'])
            ->viaTable('author_book', ['book_id' => 'id']);
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
     * @return BookQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BookQuery(get_called_class());
    }
}

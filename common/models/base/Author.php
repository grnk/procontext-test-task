<?php

namespace common\models\base;

use common\models\AuthorQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the base model class for table "author".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \common\models\AuthorBook[] $authorBooks
 */
class Author extends ActiveRecord
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
        return 'author';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Имя автора'),
            'order' => Yii::t('app', 'Сортировка'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(\common\models\AuthorBook::class, ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getBooks()
    {
        return $this->hasMany(\common\models\Book::class, ['id' => 'book_id'])
            ->viaTable('author_book', ['author_id' => 'id']);
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
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }
}

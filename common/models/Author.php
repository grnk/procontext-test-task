<?php

namespace common\models;

use Yii;
use \common\models\base\Author as BaseAuthor;

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
}

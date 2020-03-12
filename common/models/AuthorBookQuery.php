<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[AuthorBook]].
 *
 * @see AuthorBook
 */
class AuthorBookQuery extends ActiveQuery
{

    /**
     * @inheritdoc
     * @return AuthorBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AuthorBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

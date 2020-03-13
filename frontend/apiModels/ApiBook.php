<?php

namespace frontend\apiModels;

use common\models\Book;

class ApiBook extends Book
{
    public function fields()
    {
        return [
            'id',
            'title',
            'created_at',
            'updated_at',
            'authors' => function () {
                return $this->getAuthors()->select(['name'])->all();
            },
        ];
    }
}
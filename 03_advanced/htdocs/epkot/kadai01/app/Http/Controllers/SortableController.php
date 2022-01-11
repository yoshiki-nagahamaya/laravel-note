<?php

namespace Epkot\Kadai01\App\Http\Controllers;

class SortableController
{
    /**
     * リストを返す
     *
     * @return array
     */
    public function index(): array
    {
        // TODO: DBから情報取得、sortable・gendersテーブルをJOINして取得すること、以下は例
        return [
            [
                'id' => 1,
                'name' => 'NAME001',
                'left_x' => 901,
                'top_y' => 911,
                'gender' => '男性'
            ],
            [
                'id' => 2,
                'name' => 'NAME002',
                'left_x' => 902,
                'top_y' => 912,
                'gender' => '女性'
            ],
        ];
    }
}

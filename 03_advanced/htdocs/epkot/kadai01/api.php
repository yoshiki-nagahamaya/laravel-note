<?php
require_once('./app/Http/Controllers/SortableController.php');
use Epkot\Kadai01\App\Http\Controllers\SortableController;

try {
    // Controllerから配列を取得
    $controller = new SortableController();
    $arr = $controller->index();

    // 配列をJSON文字列に変換
    $jsonString = json_encode($arr);
    if ($jsonString === false) {
        // エラー
        throw new Exception("サーバーエラーが発生しました。");
    }

    // JSONレスポンス
    header("Content-type: application/json; charset=UTF-8");
    echo $jsonString;
} catch (Throwable $th) {
    // サーバーエラーとする
    http_response_code(500);
    echo $th->getMessage();
}

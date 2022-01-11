# PHP 応用課題1

## 学習目的

主にAPIの学習になります。APIは外部サービスと連携する仕組みです。  
実業務ではAPIを使用して情報を取得することが多いです。  
聞いたことがない用語も多く出てきますが、調べながら進めていきましょう。  

- 実業務で使われるAPI
  - Amazon EC2 API
  - Amazon S3 API
  - Amazon SQS API
  - Twitter API
  - YouTube Data API
  - Google Maps API
  - Bing Maps REST Services
    - JSON Example
      - <https://docs.microsoft.com/en-us/bingmaps/rest-services/locations/location-data#json-example>

## 概要

今回は「Web API」を自作します。  
HTMLで作られたページからJavaScript(jQuery)で、API(api.php)からJSONデータを取得し、画面に反映します。  
表示内容については「sortable」・「genders」テーブル内容になります。

## API

[`api.php`](./api.php) は既に実装済みで、JSONを返す仕様になっています。  
[app/Http/Controllers/SortableController.php](app/Http/Controllers/SortableController.php) にDBからデータを取得し返却する処理を実装してください。

- APIリンク
  - <http://localhost:8001/epkot/kadai01/api.php>

### APIエラーについて

ブラウザのDevToolsを使って、Networkタブから「`api.php`」のリクエスト・レスポンスを確認しましょう。

## JavaScript

JavaScriptは未実装です。  
以下の流れで実装してください。

- HTML読み込み完了後に以下の処理を実装する。
  - API(api.php)リクエスト
  - APIレスポンスデータからtbody(id: `sortable_body`)要素内にHTMLを生成・追加する。
    - 追加するHTMLについては画面内の「sortable表示例」参照

### サニタイジング

「<」等の文字が名称に含まれていると  
うまく表示されないかと思います。  

サニタイジング（エスケープ）を行いましょう。

- サニタイジング対象文字
  - `<`
  - `>`
  - `"`
  - `'`
- 参考
  - <https://pasomaki.com/html-escape/>

## ヒント

以下を使用すると実装が可能です。  
使い方については自身で調べてみましょう。

- JavaScript
  - 「`for...of`」
  - 「`String.prototype.replace()`」
- jQuery
  - 「`$.getJSON`」
  - セレクタ
  - 「`html`」メソッド

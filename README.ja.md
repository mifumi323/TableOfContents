# TableOfContents
目次を取り扱います。
`<hn id="ID">見出し</hn>`の形式の見出しをリストとして表示します。
複数種の見出しを使用した場合、見出しレベルに応じた階層が形成されます。


## インストール方法

```
composer require mifumi323/table-of-contents
```


## 使い方

Composerでインストール後、autoloadを読み込んで利用します。

例:
```php
require_once 'vendor/autoload.php';

use Mifumi323\TableOfContents;

$html = <<<'HTML'
<h1 id="section1">Section 1</h1>
<h2 id="subsection1.1">Subsection 1.1</h2>
<h2 id="subsection1.2">Subsection 1.2</h2>
<h1 id="section2">Section 2</h1>
HTML;
$toc = new TableOfContents();
$toc_html = $toc->generate();
```


## 依存パッケージ・動作環境

- PHP 8.3以上
- Composer


## テスト方法

```
vendor/bin/phpunit tests
```


## ライセンス

このプロジェクトはApache 2.0ライセンスです。


## 作者

松田美文(mifumi323)


## 貢献

IssueやPull Requestは歓迎します。

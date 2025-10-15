# TableOfContents

*日本語のREADMEは[README.ja.md](./README.ja.md)をご覧ください。*
This library handles table of contents generation.
It displays headings in the format `<hn id="ID">Heading</hn>` as a list.
If multiple types of headings are used, a hierarchy is formed according to the heading levels.


## Installation

```
composer require mifumi323/table-of-contents
```


## Usage

After installing with Composer, load the autoloader and use the library as follows:

Example:
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


## Requirements

- PHP 8.3 or higher
- Composer


## Running Tests

```
vendor/bin/phpunit tests
```


## License

This project is licensed under the Apache 2.0 License.


## Author

Mifumi Matsuda (mifumi323)


## Contribution

Issues and Pull Requests are welcome.

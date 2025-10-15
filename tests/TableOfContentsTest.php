<?php

namespace Mifumi323\TableOfContents;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(TableOfContents::class)]
class TableOfContentsTest extends TestCase
{
    #[Test]
    public function testGenerate(): void
    {
        $actual = TableOfContents::generate(<<<'HTML'
        <h1 id="h1-1">大見出し</h1>
            <h2 id="h2-1">中見出し1</h2>
            <h2 id="h2-2">中見出し2</h2>
                <h3 id="h3-1">小見出し1</h3>
                <h3 id="h3-2">小見出し2</h3>
            <h2 id="h2-3">中見出し3</h2>
                <h3 id="h3-3">小見出し3</h3>
                    <h4 id="h4-1">小小見出し1</h4>
                <h3 id="h3-4">小見出し4</h3>
                    <h4 id="h4-2">小小見出し2</h4>
            <h2 id="h2-4">中見出し4</h2>
        HTML);
        $expected = str_replace("\n", '', <<<'HTML'
        <nav id="table-of-contents">
        <ol>
        <li>
        <a href="#h1-1">
        大見出し
        </a>
        <ol>
        <li>
        <a href="#h2-1">
        中見出し1
        </a>
        </li>
        <li>
        <a href="#h2-2">
        中見出し2
        </a>
        <ol>
        <li>
        <a href="#h3-1">
        小見出し1
        </a>
        </li>
        <li>
        <a href="#h3-2">
        小見出し2
        </a>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h2-3">
        中見出し3
        </a>
        <ol>
        <li>
        <a href="#h3-3">
        小見出し3
        </a>
        <ol>
        <li>
        <a href="#h4-1">
        小小見出し1
        </a>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h3-4">
        小見出し4
        </a>
        <ol>
        <li>
        <a href="#h4-2">
        小小見出し2
        </a>
        </li>
        </ol>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h2-4">
        中見出し4
        </a>
        </li>
        </ol>
        </li>
        </ol>
        </nav>
        HTML);
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function testGenerateWithLink(): void
    {
        $actual = TableOfContents::generate(<<<'HTML'
        <h1 id="h1-1">大見出し<a class="hashlink" href="#h1-1">#</a></h1>
            <h2 id="h2-1">中見出し1<a class="hashlink" href="#h2-1">#</a></h2>
            <h2 id="h2-2">中見出し2<a class="hashlink" href="#h2-2">#</a></h2>
                <h3 id="h3-1">小見出し1<a class="hashlink" href="#h3-1">#</a></h3>
                <h3 id="h3-2">小見出し2<a class="hashlink" href="#h3-2">#</a></h3>
            <h2 id="h2-3">中見出し3<a class="hashlink" href="#h2-3">#</a></h2>
                <h3 id="h3-3">小見出し3<a class="hashlink" href="#h3-3">#</a></h3>
                    <h4 id="h4-1">小小見出し1<a class="hashlink" href="#h4-1">#</a></h4>
                <h3 id="h3-4">小見出し4<a class="hashlink" href="#h3-4">#</a></h3>
                    <h4 id="h4-2">小小見出し2<a class="hashlink" href="#h4-2">#</a></h4>
            <h2 id="h2-4">中見出し4<a class="hashlink" href="#h2-4">#</a></h2>
        HTML);
        $expected = str_replace("\n", '', <<<'HTML'
        <nav id="table-of-contents">
        <ol>
        <li>
        <a href="#h1-1">
        大見出し
        </a>
        <ol>
        <li>
        <a href="#h2-1">
        中見出し1
        </a>
        </li>
        <li>
        <a href="#h2-2">
        中見出し2
        </a>
        <ol>
        <li>
        <a href="#h3-1">
        小見出し1
        </a>
        </li>
        <li>
        <a href="#h3-2">
        小見出し2
        </a>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h2-3">
        中見出し3
        </a>
        <ol>
        <li>
        <a href="#h3-3">
        小見出し3
        </a>
        <ol>
        <li>
        <a href="#h4-1">
        小小見出し1
        </a>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h3-4">
        小見出し4
        </a>
        <ol>
        <li>
        <a href="#h4-2">
        小小見出し2
        </a>
        </li>
        </ol>
        </li>
        </ol>
        </li>
        <li>
        <a href="#h2-4">
        中見出し4
        </a>
        </li>
        </ol>
        </li>
        </ol>
        </nav>
        HTML);
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function testGenerateWithoutId(): void
    {
        $actual = TableOfContents::generate(<<<'HTML'
        <h1>大見出し</h1>
            <h2>中見出し1</h2>
            <h2>中見出し2</h2>
                <h3>小見出し1</h3>
                <h3>小見出し2</h3>
            <h2>中見出し3</h2>
                <h3>小見出し3</h3>
                    <h4>小小見出し1</h4>
                <h3>小見出し4</h3>
                    <h4>小小見出し2</h4>
            <h2>中見出し4</h2>
        HTML);
        $expected = '';
        $this->assertSame($expected, $actual);
    }
}

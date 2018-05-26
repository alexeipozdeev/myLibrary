<?php

use Model\Book\Book;
use Model\Disk\Disk;
use PHPUnit\Framework\TestCase;
use Service\DI\DI;
use Service\Library\Library;

require_once dirname(__FILE__) . '/../vendor/autoload.php';

class ScannerTest extends TestCase
{
    private $scanner = null;
    private $library = null;

    public function setUp()
    {
        $this->scanner = DI::Scanner();
        $this->library = new Library();
    }

    public function tearDown()
    {
        $this->scanner = null;
        $this->library = null;
    }

    /* Тест от сканера пришли данные книги */
    public function testBookDataCame() {
        $fields = $this->scanner->dataReception('{"isbn": 123456, "author_full_name": "Sidorov D.F.", "title": "What for goat accordion", "year": 2008}');
        $status = $fields->isbn ?? false;

        $this->assertEquals(true, $status);
    }

    /* Тест от сканера пришли данные диска */
    public function testDiskDataCame() {
        $fields = $this->scanner->dataReception('{"singer": "Nikodimus S.G.", "title": "So we lived in the village", "year": 2010}');
        $status = $fields->isbn ?? false;

        $this->assertEquals(false, $status);
    }

    /* Тест от сканера пришли данные диска */
    public function testAddBook() {
        $fields = $this->scanner->dataReception('{"isbn": 123456, "author_full_name": "Sidorov D.F.", "title": "What for goat accordion", "year": 2008}');
        $model = isset($fields->isbn) ? new Book() : new Disk();
        $status = $this->library->add($fields, $model);

        $this->assertEquals(true, $status);
    }

    /* Тест от сканера пришли данные диска */
    public function testAddDisk() {
        $fields = $this->scanner->dataReception('{"singer": "Nikodimus S.G.", "title": "So we lived in the village", "year": 2010}');
        $model = isset($fields->isbn) ? new Book() : new Disk();
        $status = $this->library->add($fields, $model);

        $this->assertEquals(true, $status);
    }
}
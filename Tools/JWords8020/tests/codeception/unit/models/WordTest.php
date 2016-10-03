<?php
namespace tests\codeception\unit\models;

use app\models\Word;

class WordTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var string
     */
    private $wordText;

    /**
     * @var Word
     */
    private $word;

    protected function _before()
    {
        $this->wordText = "my word";
        $this->word = new Word($this->wordText);
    }

    protected function _after()
    {
    }

    public function testGetWord()
    {
        $this->assertEquals($this->wordText, $this->word->word);
    }

    public function testOccurrenceNumber()
    {
        $this->word->addOccurrence();
        $this->word->addOccurrence();
        $this->assertEquals(2, $this->word->getOccurrenceNumber());
    }
}
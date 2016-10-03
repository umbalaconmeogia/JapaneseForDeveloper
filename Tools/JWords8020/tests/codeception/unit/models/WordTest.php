<?php
namespace tests\codeception\unit\models;

use app\models\Word;

class WordTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testWordProperty()
    {
        $wordText = "my word";
        $word = new Word($wordText);
        $this->assertEquals($wordText, $word->word);
    }
}
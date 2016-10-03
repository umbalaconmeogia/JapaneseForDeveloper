<?php
namespace tests\codeception\unit\models;

use app\models\Word;
use app\models\WordSet;

class WordSetTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var WordSet
     */
    private $wordSet;

    protected function _before()
    {
        $this->wordSet = new WordSet();
    }

    protected function _after()
    {
    }

    public function testAddGetWord()
    {
        $wordSet = new WordSet();
        $wordSet->addWord('AA');
        $wordSet->addWord('BB');

        $word = $wordSet->getWord('AA');
        $this->assertEquals('AA', $word->word);

        $word = $wordSet->getWord('AB');
        $this->assertNull($word);
    }
}
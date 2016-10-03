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

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testAddGetWord()
    {
        $wordSet = new WordSet();
        $wordA = $wordSet->addWord('AA');
        $this->assertEquals('AA', $wordA->word);

        $wordB = $wordSet->addWord('BB');
        $this->assertEquals('BB', $wordB->word);

        $wordAA = $wordSet->getWord('AA');
        $this->assertEquals($wordA, $wordAA);

        $wordNull = $wordSet->getWord('AB');
        $this->assertNull($wordNull);
    }

    public function testGetTopWords()
    {
        // Create WordSet
        $wordSet = new WordSet();
        $this->makeOccurrence($wordSet->addWord('AA'), 1);
        $this->makeOccurrence($wordSet->addWord('CC'), 3);
        $this->makeOccurrence($wordSet->addWord('BB'), 2);
        $this->makeOccurrence($wordSet->addWord('DD'), 4);

        $wordSet->calcOccurrenceRatio();
        $this->assertEquals(0.4, $wordSet->getWord('DD')->occurrenceRatio);

        $wordList = $wordSet->getTopWords(0.4);
        $this->assertEquals(1, count($wordList));
        $this->assertEquals('DD', $wordList[0]->word);

        $wordList = $wordSet->getTopWords(0.5);
        $this->assertEquals(2, count($wordList));
        $this->assertEquals('DD', $wordList[0]->word);
        $this->assertEquals('CC', $wordList[1]->word);

        $wordList = $wordSet->getTopWords(0.7);
        $this->assertEquals(2, count($wordList));
        $this->assertEquals('DD', $wordList[0]->word);
        $this->assertEquals('CC', $wordList[1]->word);

        $wordList = $wordSet->getTopWords(0.8);
        $this->assertEquals(3, count($wordList));
        $this->assertEquals('DD', $wordList[0]->word);
        $this->assertEquals('CC', $wordList[1]->word);
        $this->assertEquals('BB', $wordList[2]->word);

        $wordList = $wordSet->getTopWords();
        $this->assertEquals(4, count($wordList));
        $this->assertEquals('DD', $wordList[0]->word);
        $this->assertEquals('CC', $wordList[1]->word);
        $this->assertEquals('BB', $wordList[2]->word);
        $this->assertEquals('AA', $wordList[3]->word);
    }

    private function makeOccurrence(Word $word, int $times)
    {
        for ($i = $word->occurrenceNumber; $i < $times; $i++) {
            $word->addOccurrence();
        }
        $this->assertEquals($times, $word->occurrenceNumber);
    }
}
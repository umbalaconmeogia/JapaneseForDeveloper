<?php
namespace app\models;

class WordSet extends \yii\base\Object
{
    /**
     * Store all words' occurrences.
     * The array maps between the word (text) and a Word object.
     * @var Word[]
     */
    private $words = [];

    public function __construct()
    {
        $this->words = [];
    }

    /**
     * Add a new word in the word list.
     * @param string $word
     * @return Word
     */
    public function addWord(string $word)
    {
        // Create Word object if not exist.
        if (!isset($this->words[$word])) {
            $this->words[$word] = new Word($word);
        }
        $result = $this->words[$word];
        // Count up the occurrence.
        $result->addOccurrence();
        return $result;
    }

    /**
     * Get a Word object of specified text.
     * @param string $word
     * @return NULL|\app\models\Word A word if exist, NULL otherwise.
     */
    public function getWord(string $word)
    {
        return isset($this->words[$word]) ? $this->words[$word] : NULL;
    }

    /**
     * Calculate occurrence ratio of words.
     */
    public function calcOccurrenceRatio()
    {
        $totalOccurrenceNumber = 0.0;
        foreach ($this->words as $word) {
            $totalOccurrenceNumber += $word->occurrenceNumber;
        }
        foreach ($this->words as $word) {
            $word->occurrenceRatio = $word->occurrenceNumber / $totalOccurrenceNumber;
        }
    }

    /**
     * Get the list of words with highest ratio, sorting by the ratio.
     * @param float $topRatio The total ratio of words to be get.
     *                        Example: 0.5 for 50%, 1 for 100%.
     * @return Word[]
     */
    public function getTopWords(float $topRatio = 1)
    {
        $result = [];

        $this->calcOccurrenceRatio();

        // Sort the words by ratio.
        uasort($this->words, function(Word $a, Word $b) {
            return $a->occurrenceRatio >= $b->occurrenceRatio ? -1 : 1;
        });

        // Get the word list until sum of ratio > $topRatio.
        $totalRatio = 0;
        foreach ($this->words as $text => $word) {
            $result[] = $word;
            $totalRatio += $word->occurrenceRatio;
            if ($totalRatio >= $topRatio) {
                break;
            }
        }

        return $result;
    }
}
<?php
namespace app\models;

class WordSet extends yii\base\Object
{
    /**
     * Store all words' occurrences.
     * The array maps between the word (text) and a Word object.
     * @var Word[];
     */
    private $words = [];

    public function __construct()
    {
        $this->words = [];
    }

    /**
     * Add a new word in the word list.
     * @param string $word
     */
    public function addWord(string $word)
    {
        // Create Word object if not exist.
        if (!isset($this->words[$word])) {
            $this->words[$word] = new Word($word);
        }
        // Count up the occurrence.
        $this->words[$word]->addOccurrence();
    }

    /**
     * Get the list of words with highest ratio, sorting by the ratio.
     * @param float $topRatio The total ratio of words to be get.
     *                        Example: 0.5 for 50%, 1 for 100%.
     * @return Word[]
     */
    public function getTopWord(float $topRatio = 1)
    {
        $result = [];

        // Sort the words by ratio.
        uasort($this->words, ['self', 'compareWordRatio']);
        // Get the word list.
        $totalRatio = 0;
        foreach ($this->words as $text => $word) {
            $result[$text] = $word;
            $totalRatio += $word->occurenceRatio;
            if ($totalRatio >= $topRatio) {
                break;
            }
        }

        return $result;
    }

    /**
     * Compare occurrenceRatio of two Words.
     * @param Word $wordA
     * @param Word $wordB
     * @return number
     */
     static public function compareWordRatio(Word $wordA, Word $wordB)
     {
         $a = $wordA->occurrenceRatio;
         $b = $wordB->occurrenceRatio;
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }
}
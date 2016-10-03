<?php
namespace app\models;

/**
 * Store information about a word.
 * @property string $word
 * @property int $occurrenceNumber
 * @property float $occurrenceRatio
 */
class Word extends \yii\base\Object
{
    /**
     * @var string
     */
    private $word;

    /**
     * @var int
     */
    private $occurrenceNumber;

    /**
     * @var float
     */
    public $occurrenceRatio;

    /**
     * Notice: Create new Word object will NOT set its occurrence number to 1.
     * Occurrence number is set to 0 at first.
     * @param string $word
     */
    public function __construct(string $word)
    {
        $this->word = $word;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * @return number
     */
    public function getOccurrenceNumber()
    {
        return $this->occurrenceNumber;
    }

    public function addOccurrence()
    {
        $this->occurrenceNumber++;
    }
}
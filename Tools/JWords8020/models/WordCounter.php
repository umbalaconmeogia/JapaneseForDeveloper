<?php
namespace app\models;

use yii\base\Model;

class WordCounter extends Model implements PatternCounter
{
    /**
     * @var string
     */
    private $word;
    
    /**
     * @var integer
     */
    private $counter = 0;
    
    public function setPcPattern($pattern)
    {
        $this->word = $pattern;
    }

    public function getPcPattern()
    {
        return $this->word;
    }
    
    public function increasePcCounter($count = 1)
    {
        $this->counter += $count;
    }
    
    public function getPcCounter()
    {
        return $this->counter;
    }
    
}
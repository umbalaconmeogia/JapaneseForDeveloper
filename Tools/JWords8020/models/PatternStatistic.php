<?php
namespace app\models;

use yii\base\Model;

/**
 * Statistic on patterns.
 * 
 * @property integer $totalPcCounter
 * @property PatternCounter[] $sortedPatternCounters
 * @property PatternCounter[] $topPatterns
 * @property PatternCounter[] $topCounters
 */
class PatternStatistic extends Model
{
    /**
     * @var PatternCounter[]
     */
    private $patternCounters = [];

    /**
     * @var integer
     */
    private $totalCounter = 0;
    
    /**
     * Mark if $patternCounters are sorted or not.
     * @var boolean
     */
    private $sorted = FALSE;

    /**
     * @var string
     */
    private $patternCounterClassName;
    
    /**
     * @param string $patternCounterClassName
     * @param array $config
     */
    public function __construct($patternCounterClassName, $config = [])
    {
        $this->patternCounterClassName = $patternCounterClassName;
        
        parent::__construct($config);
    }
    
    /**
     * Count a pattern.
     * 
     * @param string $pattern
     * @param string $patternCounterClass
     */
    public function add($pattern)
    {
        if (!isset($this->patternCounters[$pattern])) {
            $patternCounter = new $this->patternCounterClassName;
            $patternCounter->pcPattern = $pattern;
            $this->patternCounters[$pattern] = $patternCounter;
        }
        $this->patternCounters[$pattern]->increasePcCounter();
        $this->totalCounter+= 1; // Increase total counter.
        
        $this->sorted = FALSE; // Mark unsorted.
        
    }
    
    /**
     * Sort PatternCounter array by pcCounter in descendant order.
     * @return \app\models\PatternCounter[]
     */
    public function getSortedPatternCounters()
    {
        if (!$this->sorted) {
            // Sort by pcCounter descendant.
            usort($this->patternCounters, [$this, 'cmpPatternCouter']);
            $this->sorted = TRUE; // Mark as sorted.
        }
        return $this->patternCounters;
    }
    
    /**
     * Compare two PatternCounter, used in usort() to sort by descendant pcCounter value.
     * @param PatternCounter $a
     * @param PatternCounter $b
     * @return integer
     */
    public function cmpPatternCouter(PatternCounter $a, PatternCounter $b)
    {
        return $a->pcCounter <= $b->pcCounter;
    }
        
    /**
     * Get 20% top pattern.
     * @param real $limit Default to 20%.
     * @return PatternCounter[]
     */
    public function getTopPatterns($limit = 0.2)
    {
        $result = [];
        $totalValue = count($this->sortedPatternCounters);
        $counter = 0.0;
        foreach ($this->sortedPatternCounters as $patternCounter) {
            $result[] = $patternCounter;
            $counter += 1;
            if ($counter / $totalValue >= $limit) {
                break;
            }
        }
        
        return $result;
    }
    
    /**
     * Get top pattern by counter total value.
     * @param real $limit Default to 20%.
     * @return PatternCounter[]
     */
    public function getTopCounters($limit = 0.2)
    {
        $result = [];
        $totalValue = $this->totalPcCounter;
        $counter = 0.0;
        foreach ($this->sortedPatternCounters as $patternCounter) {
            $result[] = $patternCounter;
            $counter += $patternCounter->pcCounter;
            if ($counter / $totalValue >= $limit) {
                break;
            }
        }
        
        return $result;
    }
    
    /**
     * Get all total of counter value.
     * @return number
     */
    public function getTotalPcCounter()
    {
        $result = 0;
        foreach ($this->patternCounters as $patternCounter) {
            $result += $patternCounter->pcCounter;
        }
        return $result;
    }
}
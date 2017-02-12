<?php
namespace app\models;

/**
 * Store a pattern and counting result on it.
 * 
 * @property string $pcPattern
 * @property integer $pcCounter
 */
interface PatternCounter
{
    /**
     * Set pattern
     * @param string $pattern
     */
    public function setPcPattern($pattern);
    
    /**
     * Get pattern.
     * @return string
     */
    public function getPcPattern();

    /**
     * Increase counter of this pattern.
     * @param number $count
     */
    public function increasePcCounter($count = 1);
    
    /**
     * Get counter number.
     * @return integer
     */
    public function getPcCounter();
}
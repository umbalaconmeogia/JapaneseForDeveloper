<?php
namespace app\models;

use app\components\TinySegmenterarray;
use app\models\WordCounter;
use batsg\helpers\HJapanese;
use app\components\Filetotext;

class StatisticText extends PatternStatistic
{
    private static $ignoreCharacterInWords = [
        "　", // full-width space
        " ", // half-width space
        "・",
        "。",
        "。", //
        "、",
        "\r",
        "\n",
    ];
    
    private static $wordSplitter;
    
    public function __construct($patternCounterClassName = NULL, $config = [])
    {
        if ($patternCounterClassName == NULL) {
            $patternCounterClassName = WordCounter::className();
        }
        parent::__construct($patternCounterClassName, $config);
    }
    
    public function addText($text)
    {
        $words = self::getWordSplitter()->segment($text);
        foreach ($words as $word) {
            if ($this->isWord($word)) {
                $this->add($word);
            }
        }
    }

    private function isWord($word)
    {
        $word = str_replace(self::$ignoreCharacterInWords, '', $word);
        return $word && !HJapanese::onlyHiragana($word);
    }
    
    public function addTextFile($file)
    {
        return $this->addText(file_get_contents($file));
    }
    
    public function addDocPdfFile($file)
    {
        $fileToText = new Filetotext($file);
        return $this->addText($fileToText->convertToText());
    }
    
    
    /**
     * @return \app\components\TinySegmenterarray
     */
    private static function getWordSplitter()
    {
        if (!self::$wordSplitter) {
            self::$wordSplitter = new TinySegmenterarray();
        }
        return self::$wordSplitter;
    }
}
<?php
namespace app\models;

use app\components\TinySegmenterarray;
use app\models\WordCounter;
use batsg\helpers\HJapanese;
use app\components\Filetotext;
use batsg\helpers\HFile;

class StatisticText extends PatternStatistic
{
    private static $wordSplitter;

    private static $_ignoreCharacterInWords;

    /**
     * @return string[]
     */
    public static function ignoreCharacterInWords()
    {
        if (!self::$_ignoreCharacterInWords) {
            self::$_ignoreCharacterInWords = array_merge(
                HJapanese::$fullWidthDigits,
                HJapanese::$halfWidthDigits,
                ["　", " ", "\t", "\r", "\n"],
                ['―', '。', '、', '「', '」', '・'], // Don't know why this is not filter by range FF01-FF65
//                 ["・", "。", "、", "「", "」", "【", "】", "（", "）"],
                [] // dummy
            );
            // Add ASCII characters.
            for ($i = 0; $i <= 127; $i++) {
                self::$_ignoreCharacterInWords[] = chr($i);
            }
            for ($i = 0xFF01; $i <= 0xFF65; $i++) {
                self::$_ignoreCharacterInWords[] = mb_chr($i);
            }
        }
        return self::$_ignoreCharacterInWords;
    }

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
        $word = str_replace(self::ignoreCharacterInWords(), '', $word);
        return $word && !HJapanese::onlyHiragana($word);
    }

    /**
     * Add file to statistic.
     * @param string|string[] $files One or more file path.
     */
    public function addFile($files)
    {
        if (!is_array($files)) {
            $files = [$files];
        }
        foreach ($files as $filePath) {
            $text = File::getText($filePath);
            if ($text) {
                $this->addText($text);
            }
        }
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
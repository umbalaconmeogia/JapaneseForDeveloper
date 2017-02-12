<?php
namespace app\controllers;

use app\models\StatisticText;
use app\models\PatternStatistic;
use app\models\WordCounter;
use yii\base\Controller;

class TestStatisticController extends Controller
{

    public function actionTestPatternStatistic()
    {
        $words = [];
        $patternStatistic = new PatternStatistic(WordCounter::className());
        for ($i = 1; $i <= 100; $i++) {
            $word = "Word $i";
            for ($j = 1; $j <= $i; $j++) {
                $patternStatistic->add($word);
            }
        }
    
        return $this->render('testPatternStatistic', ['patternStatistic' => $patternStatistic]);
    }
    
    public function actionStatisticTextFile()
    {
        $file = \Yii::getAlias('@app/tests/_data/LoremIpsumJapanese.txt');
        $statisticText = new StatisticText();
        $statisticText->addTextFile($file);
        
        return $this->render('testPatternStatistic', ['patternStatistic' => $statisticText]);
    }
    
    public function actionStatisticDocxFile()
    {
        $file = \Yii::getAlias('@app/tests/_data/LoremIpsumJapanese.docx');
        $statisticText = new StatisticText();
        $statisticText->addDocPdfFile($file);
        
        return $this->render('testPatternStatistic', ['patternStatistic' => $statisticText]);
    }
    
    public function actionStatisticPdfFile()
    {
        $file = \Yii::getAlias('@app/tests/_data/LoremIpsumJapanese.pdf');
        $statisticText = new StatisticText();
        $statisticText->addDocPdfFile($file);
        
        return $this->render('testPatternStatistic', ['patternStatistic' => $statisticText]);
    }
}
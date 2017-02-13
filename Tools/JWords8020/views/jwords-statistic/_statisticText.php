<?php
/* @var $this yii\web\View */
/* @var $patternStatistic app\models\PatternStatistic */
/* @var $limit float */
?>
<div class="row">
    <div class="col-md-4">
        <?= $this->render('_statisticCounters', ['title' => '全単語', 'patternCounters' => $patternStatistic->sortedPatternCounters]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_statisticCounters', ['title' => 'トップ単語', 'patternCounters' => $patternStatistic->getTopPatterns($limit)]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_statisticCounters', ['title' => 'トップ回数', 'patternCounters' => $patternStatistic->getTopCounters($limit)]) ?>
    </div>
</div>
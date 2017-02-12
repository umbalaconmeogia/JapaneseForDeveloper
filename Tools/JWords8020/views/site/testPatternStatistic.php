<?php
/* @var $this yii\web\View */
/* @var $patternStatistic app\models\PatternStatistic */
?>
<div class="row">
    <div class="col-md-4">
        <?= $this->render('_patternCounterss', ['title' => 'All', 'patternCounters' => $patternStatistic->sortedPatternCounters]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_patternCounterss', ['title' => 'Top patterns', 'patternCounters' => $patternStatistic->topPatterns]) ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_patternCounterss', ['title' => 'Top counters', 'patternCounters' => $patternStatistic->topCounters]) ?>
    </div>
</div>
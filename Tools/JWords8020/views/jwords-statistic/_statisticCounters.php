<?php
/* @var $this yii\web\View */
/* @var $title string */
/* @var $patternCounters app\models\PatternCounter[] */

$counter = 0;
foreach ($patternCounters as $patternCounter) {
    $counter += $patternCounter->pcCounter; 
}
$nWords = count($patternCounters);
$index = 0;
?>
<h2><?= $title ?></h2>
<h3>単語数 = <?= $nWords ?>, 回数合計 = <?= $counter ?></h3>
<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>単語</th>
        <th>回数</th>
    </tr>
    <?php foreach ($patternCounters as $patternCounter) { ?>
        <tr>
             <td><?= ++$index ?></td>
             <td><?= $patternCounter->pcPattern ?></td>
             <td><?= $patternCounter->pcCounter ?></td>
        </tr>
    <?php } ?>
</table>
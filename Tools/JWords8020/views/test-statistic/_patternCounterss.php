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
<h3>Total counter = <?= $counter ?>, Words = <?= $nWords ?></h3>
<table class="table table-bordered">
    <tr>
        <th>No.</th>
        <th>Word</th>
        <th>Counter</th>
    </tr>
    <?php foreach ($patternCounters as $patternCounter) { ?>
        <tr>
             <td><?= ++$index ?></td>
             <td><?= $patternCounter->pcPattern ?></td>
             <td><?= $patternCounter->pcCounter ?></td>
        </tr>
    <?php } ?>
</table>
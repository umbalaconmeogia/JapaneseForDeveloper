<?php
/* @var $this yii\web\View */
/* @var $title string */
/* @var $patternCounters app\models\PatternCounter[] */

$counter = 0;
foreach ($patternCounters as $patternCounter) {
    $counter += $patternCounter->pcCounter; 
}
?>
<h2><?= $title ?></h2>
<h3>Total counter = <?= $counter ?></h3>
<table class="table table-bordered">
    <tr>
        <th>Word</th>
        <th>Counter</th>
    </tr>
    <?php foreach ($patternCounters as $patternCounter) { ?>
        <tr>
             <td><?= $patternCounter->pcPattern ?></td>
             <td><?= $patternCounter->pcCounter ?></td>
        </tr>
    <?php } ?>
</table>
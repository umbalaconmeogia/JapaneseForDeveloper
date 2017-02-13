<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $uploadForm app\models\UploadForm */
/* @var $statisticText app\models\StatisticText */

$limit = $uploadForm->limit / 100.0;
?>
<div>単語を統計したい資料をアップロード又はURLを指定してください。サポートファイルはzip, docx, txtです。</div>
<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($uploadForm, 'uploadFile')->label('資料アップロード')->fileInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($uploadForm, 'url')->label('URL')->textInput() ?>
        </div>
        <div class="col-md-4">
		    <?= $form->field($uploadForm, 'limit')->label('トップ％')->dropDownList([10, 20, 30, 40, 50, 60, 70, 80, 90, 100]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('送信', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php if ($statisticText) { ?>
    <hr />
    <?= $this->render('_statisticText', [
        'patternStatistic' => $statisticText,
        'limit' => $limit,
    ]) ?>
<?php } ?>
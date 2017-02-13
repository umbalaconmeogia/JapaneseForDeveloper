<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FolderUpload */
?>
<h1>ファイルアップロード</h1>
<div>単語を統計したい資料をアップロードしてください。</div>
<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'uploadFile')->label('資料アップロード')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('アップロード', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

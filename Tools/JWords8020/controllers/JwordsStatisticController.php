<?php
namespace app\controllers;

use app\models\FolderUpload;
use yii\base\Controller;
use Yii;
use yii\web\UploadedFile;

class JwordsStatisticController extends Controller
{
    public function actionIndex()
    {
        $model = new FolderUpload();

        if ($model->load(Yii::$app->request->post())) {
            // Upload image.
            $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
            $result = $model->upload();
        }

        return $this->render('index', ['model' => $model]);
    }
}
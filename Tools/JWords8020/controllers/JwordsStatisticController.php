<?php
namespace app\controllers;

use app\models\UploadForm;
use app\models\StatisticText;
use yii\base\Controller;
use Yii;
use yii\web\UploadedFile;

class JwordsStatisticController extends Controller
{
    public function actionIndex()
    {
        $uploadForm = new UploadForm();
        $statisticText = NULL;

        if ($uploadForm->load(Yii::$app->request->post())) {
            $statisticText = new StatisticText();
            
            // Upload image.
            $uploadForm->uploadFile = UploadedFile::getInstance($uploadForm, 'uploadFile');
            if ($uploadForm->uploadFile) {
                $uploadForm->upload();                
                $statisticText->addFile($uploadForm->getFiles());
                $uploadForm->delete();
            }
            
            if ($uploadForm->url) {
                $statisticText->addText(strip_tags(file_get_contents($uploadForm->url)));
            }
        }

        return $this->render('index', [
            'uploadForm' => $uploadForm,
            'statisticText' => $statisticText,
        ]);
    }
}
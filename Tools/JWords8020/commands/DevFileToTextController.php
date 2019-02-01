<?php
namespace app\commands;

use yii\console\Controller;
use app\models\FileDoc;
use app\models\HPhpOffice;

class DevFileToTextController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionGetText($filePath)
    {
        $file = new FileDoc();
        $file->loadFile($filePath);
        $text = $file->getTextUtf8();
        echo $text;
    }

    public function actionGetTextWord2007($filePath)
    {
        echo HPhpOffice::getTextWord2007($filePath);
    }
}

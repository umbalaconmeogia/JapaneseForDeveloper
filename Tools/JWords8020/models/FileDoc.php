<?php
namespace app\models;

use app\components\Filetotext;

/**
 * Manipulate doc, docx, odt file.
 */
class FileDoc extends FileText
{
    /**
     * {@inheritDoc}
     * @see \app\models\FileText::getText()
     */
    protected function getText()
    {
        /*
         $factory = new PHPDocFactory();
         $factory->loadFile($this->filePath);
         $word = $factory->toWord();
         ........

         return $text;
         */
        $fileToText = new Filetotext($this->filePath);
        return $fileToText->convertToText();
    }
}
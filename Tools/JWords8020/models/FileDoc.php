<?php
namespace app\models;

use app\components\Filetotext;
use PhpOffice\PhpWord\IOFactory;

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

    public function readWord2007($file)
    {
        $text = [];
        $phpWord = IOFactory::load($file);
        echo "$phpWord";
    }
}
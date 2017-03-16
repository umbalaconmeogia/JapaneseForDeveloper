<?php
namespace app\models;

use app\components\Filetotext;

/**
 * Manipulate pdf file.
 */
class FilePdf extends FileText
{
    /**
     * {@inheritDoc}
     * @see \app\models\FileText::getText()
     */
    protected function getText()
    {
        $fileToText = new Filetotext($this->filePath);
        return $fileToText->convertToText();
    }
}
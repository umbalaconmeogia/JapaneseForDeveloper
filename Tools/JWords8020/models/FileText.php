<?php
namespace app\models;

class FileText implements FileToTextInterface
{
    /**
     * @var string
     */
    protected $filePath;

    /**
     * {@inheritDoc}
     * @see \app\models\FileToTextInterface::loadFile()
     */
    public function loadFile($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * {@inheritDoc}
     * @see \app\models\FileToTextInterface::getTextUtf8()
     */
    public function getTextUtf8()
    {
        return mb_convert_encoding($this->getText(), 'UTF-8');
    }

    /**
     * {@inheritDoc}
     * @see \app\models\FileToTextInterface::getText()
     */
    protected function getText()
    {
        return file_get_contents($this->filePath);
    }
}
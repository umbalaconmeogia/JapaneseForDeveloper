<?php
namespace app\models;

interface FileToTextInterface
{
    /**
     * Load the file.
     * @param string $filePath
     */
    public function loadFile($filePath);

    /**
     * Get text content in UTF8 encoding.
     * @return string
     */
    public function getTextUtf8();
}
<?php
namespace app\models;

class UploadForm extends FolderUpload
{
    /**
     * @var string
     */
    public $url;
    
    /**
     * @var integer
     */
    public $limit = 20;

    public function rules()
    {
        return [
            [['uploadFile', 'url', 'limit'], 'safe'],
        ];
    }
}
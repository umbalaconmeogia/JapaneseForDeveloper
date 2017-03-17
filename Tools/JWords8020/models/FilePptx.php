<?php


namespace app\models;


class FilePptx extends FileText
{
    /**
     * {@inheritDoc}
     * @see \app\models\FileText::getText()
     */
    protected function getText()
    {
		$zip_handle = new \ZipArchive;
    
	    if(true === $zip_handle->open($this->filePath)){
	        $content = "";
	        $slide_number = 1;
	        while(($xml_index = $zip_handle->locateName("ppt/slides/slide$slide_number.xml")) !== false){
	            $xml_data[$slide_number] = $zip_handle->getFromIndex($xml_index);
	            $xml = str_replace(""," ",$xml_data[$slide_number]);
	            $content .= $xml;
	            $slide_number++;
	        }
	        
	        $zip_handle->close();
	        return strip_tags($content);
		}
	}
}
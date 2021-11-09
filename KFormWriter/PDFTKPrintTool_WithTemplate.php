<?php

namespace kuaminika\FormWriter;

use DateTime;
use Exception;
use mikehaertl\pdftk\Pdf;
class PDFTKPrintTool_WithTemplate implements IPrintTool
{
    private string $templatePath;
    private string $productPath;

    public function __construct($templatePath,$productPath)
    {
        $this->templatePath = $templatePath;
        $this->productPath = $this->confirmUniqueDestinationPath( $productPath,0);
    }

    private function confirmUniqueDestinationPath($path,$count)
    {
        $date = new DateTime();
        $date->setTimezone(new \DateTimeZone('America/New_York'));
        $count++;

        if(!file_exists($path)) return $path;
      
        $path = str_replace(".pdf","_".$date->format("Ymdhisu")."_EASTERN.pdf",$path);
        $path = file_exists($path)? str_replace(".pdf","_".$count.".pdf",$path):$path;
        $path =  $this->confirmUniqueDestinationPath($path,$count);
        return $path;

    }

   function  setOutputDestination(string $newPath)
   {
       $this->productPath = $newPath;
   }
   public function  getOutputDestination():string
   {
       return $this->productPath;
   }


    function  treatModel(Array $arr)
    {
        try
        {


            if(!file_exists($this->templatePath))           
                throw  new Exception("template not found at:{$this->templatePath}");
            

            $pdf = new Pdf($this->templatePath);
            $result = $pdf->fillForm($arr);
            $result = $result->needAppearances();
            $result = $result->flatten();
            $result = $result->saveAs($this->productPath);
        }
        catch(Exception $ex)
        {
          throw $ex;
        }
    }
}
<?php 

namespace kuaminika\FormWriter;

use Exception;

class PrintTool_Blank implements IPrintTool
{
    function  setOutputDestination(string $newPath)
    {
        // todo: put a log here 
        $this->outputPath = $newPath;
    }
    function  getOutputDestination():string
    {
        // todo: put a log here 
        if($this->outputPath == null)
        return "";
         return $this->outputPath;
    }
    function  treatModel(Array $arr)
    {
      // todo: put a log here 
    }
}
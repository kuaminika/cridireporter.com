<?php 
namespace Log_Utilities;

use DateTime;

class EchoLogTool implements ILogTool
{
    public function toggleActivation($isActive)
    {
        $this->isActive = $isActive;
    }
    public function log($str)
    {
        if(!$this->isActive) return;
        $dt = new \DateTime();
        echo $dt.":";
        echo $str;
        echo "<br>";
    }
    public function logWithTab($str)
    {
      $this->log("      ".$str);
    }
    public function showObj($obj)
    {

        $this->log("      ".json_encode($obj));

    }
    public function showVDump($obj)
    {
        $debug_export = var_export($obj, true);
        $this->log($debug_export);

    }
}
<?php 
namespace Log_Utilities;

use DateTime;

class FileWriteLogTool implements ILogTool
{
    private bool $isActive;
    private $filePath;

    public function __construct($filename)
    {   
        $dt = new \DateTime();
        $fileNameDate = $filename."_".date_format($dt, 'Y_m_d');
        $this->filePath =  __DIR__."/logFiles/K_log".$fileNameDate.".txt";
        $this->isActive = false;
    }
    public function toggleActivation( $isActive)
    {
        $this->isActive = $isActive;
    }
    public function log($str)
    {
        if(!$this->isActive) return;

        
        $file =  fopen($this->filePath, "a");
        $dt = new \DateTime();
        $msg= date_format($dt, 'Y-m-d H:i:s').":";
        $msg.= $str."\n";
        
        fwrite($file,$msg);
        fclose($file);
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
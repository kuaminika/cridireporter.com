<?php 

namespace kuaminika\FormWriter;

use DateTime;

class Report_Blank implements IReport
{
    private $model;
    private $time;

    public function __construct()
    {
        $this->model = new \stdClass();
        $this->time = new DateTime();
    }

    function getPayLoad()
    {
        return $this->model;
    }
    function setPayLoad($model)
    {
        $this->model = $model;
    }
    function getReportTime()
    {
        return $this->time;
    }
    function getPrintedTime()
    {        
        return $this->time;
    }
}
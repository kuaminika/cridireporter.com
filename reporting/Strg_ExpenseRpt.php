<?php

namespace crdiReporter\reporting;

use kuaminika\FormWriter\IPrintStrategy;
use kuaminika\FormWriter\IPrintTool;
use kuaminika\FormWriter\IReport;
use kuaminika\FormWriter\PrintTool_Blank;
use kuaminika\FormWriter\Report_Blank;

class Strg_ExpenseRpt implements IPrintStrategy 
{

    
    private IReport $report;
    private IPrintTool $printTool;

    public function __construct( IPrintTool $tool=null,IReport $rpt=null)
    {
        $this->printTool = isset($tool)?$tool :new PrintTool_Blank();
        $this->report =  isset($rpt)?$rpt :new Report_Blank();
    }

    public function getPrintTool(): IPrintTool
    {
        return $this->printTool;
    }
    public function setPrintTool(IPrintTool $printTool)
    {
        $this->printTool = $printTool;
    }

    public function setReport(IReport $report)
    {
        $this->report = $report;
    }
    public function getReport():Ireport
    {
        return $this->report;
    }

    public function execute()
    {
        $payload = $this->report->getPayLoad();
        $expenses = $payload->expenses;
        $arrModel = [];
        $i =0;
        foreach($expenses as $expense)
        {
            $arrModel["expense_date.".$i]=$expense["expense_date"];
            $arrModel["expense_reason.".$i]=$expense["expense_reason"];
            $arrModel["expense_amount.".$i]=$expense["expense_amount"];
            $i++;
        }
        $arrModel["ExpenseTotals"] = $payload->ExpenseTotals;
        $this->printTool->treatModel($arrModel);
    }
}
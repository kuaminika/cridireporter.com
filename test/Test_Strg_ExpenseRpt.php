<?php

use PHPUnit\Framework\TestCase;

require __DIR__."/../vendor/autoload.php";
// require __DIR__."/../KFormWriter/_loadAll.php";
// require __DIR__."/../reporting/_loadAll.php";

use crdiReporter\reporting\Strg_ExpenseRpt;
use kuaminika\FormWriter\IPrintStrategy;
use kuaminika\FormWriter\PDFTKPrintTool_WithTemplate;

class Test_Strg_ExpenseRpt extends TestCase
{
    public function test_InstanciateTool_ExpenseRpt():IPrintStrategy
    {
        $strategy = new Strg_ExpenseRpt();
        $this->assertNotNull($strategy);
        $templatePath = "template/expense_rpt_template.pdf";
        $outputPath = "crdiOutput";
        $strategy->setPrintTool(new PDFTKPrintTool_WithTemplate($templatePath,$outputPath));
        return $strategy;
    }


    public function test_makeReport()
    { $strategy = new Strg_ExpenseRpt();
        $this->assertNotNull($strategy);
        $templatePath = "template/expense_rpt_template.pdf";
        $outputPath = "output/crdiOutput.pdf";
        $strategy->setPrintTool(new PDFTKPrintTool_WithTemplate($templatePath,$outputPath));
       $report =  $strategy->getReport();
        $payLoad = new stdClass();
        $expense = ["expense_date"=>"2021-11-09"];
        $expense["expense_reason"]="test";
        $expense["expense_amount"]=100;
        $payLoad->expenses =[ $expense];
       $report->setPayLoad($payLoad);
        $strategy->execute();
    }

}
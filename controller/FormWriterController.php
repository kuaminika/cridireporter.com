<?php
namespace crdireporter\controller;
use K_Utilities\KException;
use crdiReporter\reporting\Strg_ExpenseRpt;
use kuaminika\FormWriter\IPrintTool;
use oPreJobAssesment\reporting\PreJobAssesmentReportPrinter;
use oPreJobAssesment\JSONToModel\JSONToPreAsessesment;
use kuaminika\FormWriter\PDFTKPrintTool_WithTemplate;
use oPreJobAssesment\models\PreJobAssesmentReport;
class FormWriterController extends AController
{
   public function whatISent($content)
   {

      $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
      $this->response['body'] = json_encode($content["jsonValue"]);
   } 
   public function createForm($content)
   {
     
      try
      {
         $templateName = "expense_rpt_template";
         $log = $this->logTool;
         $log->log($templateName );
         $expensesRaw = $content["jsonValue"];
         $expenses = [];
         $i = 0 ;
         //todo need to handle case when json is invalid
         $expenseTotals = 0;
         $idsDone = [];
         usort($expensesRaw,function( $a, $b ) {
            return -strtotime($a->id)+  strtotime($b->id);
           });
         $log->log("\n\n starting a process \n----------------------------------------------");
         
         foreach($expensesRaw as $exp)
         {            
           // $log->toggleActivation(true);

            $jsonRepresentation = json_encode($exp);
            $jsonRepresentationProcessed = json_encode($idsDone);
            $log->log("processed so far : $jsonRepresentationProcessed ");
            $itsThere=  in_array($exp->id,$idsDone);
            if($itsThere) 
            {
               $log->log("will not proceed. $exp->id is already processed");
               continue;
            }

            $log->log("Continuing  with: $jsonRepresentation  ");

            $idsDone[]=$exp->id;

            $log->log($templateName ."-".$i);
            $f_exp = [];
            list( $f_exp["expense_date"] ) =  explode("T", $exp->expenseDate);
           $log->showVDump($exp->expenseDate);
           $log->showVDump($f_exp["expense_date"]);
          
           //$log->toggleActivation(false);
           // $f_exp["expense_date"]   = $exp->expenseDate;
            $f_exp["expense_reason"] = " $exp->merchantName: $exp->briefDescription - $exp->spentOnName";
            $f_exp["expense_amount"] = $exp->cost;
            $expenseTotals+=$exp->cost;
            $expenses[$i]= $f_exp;
            $i++;
         }
         
         $idsDone = [];
         $templatePath = __DIR__."/../template/".$templateName.".pdf";
         $destination  = __DIR__."/../output/filled.pdf";
        
         $log->log($destination);
         $log->log($templatePath);
         $tool = new PDFTKPrintTool_WithTemplate($templatePath,$destination);
         
         $strategy = new Strg_ExpenseRpt($tool);
         $payLoad = new \stdClass();
         $payLoad->expenses = $expenses;
         $payLoad->ExpenseTotals = $expenseTotals;
         $report =  $strategy->getReport();
         $report->setPayLoad($payLoad);
         $strategy->execute();
        $result = new \stdClass();
        $log->log( $tool->getOutputDestination());
        list(, $result->reportPath) =  explode("../",  $tool->getOutputDestination());
        $this->response['status_code_header'] = 'HTTP/1.1 200 OK';
        $this->response['body'] = json_encode($result);  
        $log->log(" \n---------------------------------------------- \n done with process");
      }
      catch(\Exception $ex)
      {
         $log = $this->logTool;        
         $log->log( $ex->getMessage() );
         throw KException::createWithException($ex,"FormWriterController.createForm");
      }
   }
} 

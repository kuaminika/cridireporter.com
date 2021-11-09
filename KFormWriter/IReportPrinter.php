<?php
namespace  kuaminika\FormWriter;


interface IReportPrinter
{
    function  setPrintStrategey(IPrintStrategy $printStrategy);
    function  print(IReport $rpt);
}
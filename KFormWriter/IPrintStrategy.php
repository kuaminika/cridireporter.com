<?php

namespace  kuaminika\FormWriter;

interface IPrintStrategy
{
    function getReport():IReport;
    function setReport(IReport $report);
    function getPrintTool():IPrintTool;
    function setPrintTool(IPrintTool $printTool);
    function execute();
}
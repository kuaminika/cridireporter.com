<?php 

namespace  kuaminika\FormWriter;

interface IReport
{

   function getPayLoad();
   function setPayLoad($model);
   function getReportTime();
   function getPrintedTime();
}
<?php 

namespace  kuaminika\FormWriter;

interface IPrintTool
{
   function  setOutputDestination(string $newPath);
   function  getOutputDestination():string;
   function  treatModel(Array $arr);
}
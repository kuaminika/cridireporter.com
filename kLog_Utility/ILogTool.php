<?php

namespace Log_Utilities
{
    interface ILogTool{

        public function toggleActivation($isActive);
         public function log($str);
         public function logWithTab($str);
         public function showObj($obj);
         public function showVDump($obj);

    }
}

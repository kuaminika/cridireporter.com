<?php 

require __DIR__."/../vendor/autoload.php";
require __DIR__."/../KFormWriter/_loadAll.php";
//composer.json does not work. have to manually require
use kuaminika\FormWriter\Report_Blank;

use PHPUnit\Framework\TestCase;

class TestFormWriter extends TestCase
{

    public function test_InstanciateBlankPrintForm()
    {
     
        $log = new Monolog\Logger('name');
        $log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));
        $report_blank = new Report_Blank();  
        $this->assertNotNull($report_blank);     
        $log->warning('Foo');
    }

}
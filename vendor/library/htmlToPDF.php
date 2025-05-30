<?php
/*
    Library : Database Lite
    Description	: To work with SQLite Database
    Author		: Shajahan Basha Syed

*/

require_once __DIR__.DIRECTORY_SEPARATOR.'.'.DIRECTORY_SEPARATOR.'dompdf'.DIRECTORY_SEPARATOR.'autoload.inc.php';

use Dompdf\Dompdf;

class htmlToPDF{

    private $dompdf;

    private $orientation = 'portrait';

    private $paperSize = 'A4';

    private $html = '';

    private $pageNumbering = false;

     function __Construct(){
        $this->dompdf = new Dompdf();
     }

     function setOrientation($orientation){

        $this->orientation = $orientation;

     }

     function setPaperSize($paperSize){

        $this->paperSize = $paperSize;

     }

     function pageNumbering($pageNumbering =  false){
        $this->pageNumbering = $pageNumbering;
     }

     function setHTMLContent($html){
        $this->html = $html;
     }

     function save($filename){

        $this->dompdf->loadHtml($this->html);

        $this->dompdf->setPaper($this->paperSize, $this->orientation);

        $this->dompdf->getOptions()->set('enable_html5_parser', true);

        $this->dompdf->render();

        $canvas = $this->dompdf->getCanvas();

        if($this->pageNumbering){
            $font = $this->dompdf->getFontMetrics()->getFont("Helvetica", "bold");
            $canvas->page_text(500, 810, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0, 0, 0));
        }

        $output = $this->dompdf->output();

        file_put_contents($filename, $output);
     }



}

?>
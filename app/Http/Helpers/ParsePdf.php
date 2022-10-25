<?php
namespace App\Http\Helpers;


class ParsePdf
{
    public function parse($pdf)
    {
        $pdf = new \Gufy\PdfToHtml\Pdf(public_path() . "/storage/attachments/test.pdf");


$html = $pdf->html();

dd($html);
        return;
    }


}

<?php

namespace Uccello\DocumentDesigner\Support;

use Illuminate\Support\Facades\Storage;

class DocumentIO
{
    public static function generate($templateFile, $outFile, $data)
    {
        if(static::endsWith($outFile, '.docx'))
        {
            $document = new DocumentProcessor($templateFile);
            $document->processRecursive($data);
            $document->saveAs($outFile);
        }
        else if(static::endsWith($outFile, '.pdf'))
        {
            Storage::makeDirectory('temp');

            $tempFileDocx = storage_path("app/temp/") . basename($outFile, '.pdf') . '.docx';
            $tempFilePdf = storage_path("app/temp/") . basename($outFile);

            $document = new DocumentProcessor($templateFile);
            $document->processRecursive($data);
            $document->saveAs($tempFileDocx);

            static::convertToPdf($tempFileDocx);

            // Storage::disk('local')->move($tempFilePdf, $outFile);
            // Storage::disk('local')->delete($tempFileDocx);
            rename($tempFilePdf, $outFile);
            unlink($tempFileDocx);
        }
        else
        {
            return false;
        }

        return true;
    }

    protected static function endsWith($string, $endString)
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }

    protected static function convertToPdf($inFile)
    {
        $file = basename($inFile);
        $path = dirname($inFile);

        exec("/usr/bin/soffice --headless --convert-to pdf --outdir \"$path\" \"$path/$file\"");
    }
}
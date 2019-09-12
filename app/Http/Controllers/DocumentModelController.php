<?php

namespace Uccello\DocumentDesigner\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Artisan;


class DocumentModelController extends Controller
{
    public function test() 
    {
        // TODO: Debug call...
        // Artisan::call('document:generate');

        return Response::file('storage/Out.pdf');   // Browser
        // return Response::file('storage/app/public/Out.pdf');    // CMD
    }
}

<?php

namespace App\Controllers;

class OPDController extends BaseController
{
    public function index()
    {
        return view('/administrator/portal-opd/dashboard');
    }
}

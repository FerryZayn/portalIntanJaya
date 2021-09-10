<?php

namespace App\Controllers;

class EsakipController extends BaseController
{
    public function index()
    {
        return view('/administrator/e-sakip/dashboard');
    }
}

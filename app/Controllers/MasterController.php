<?php

namespace App\Controllers;

class MasterController extends BaseController
{
    public function index()
    {
        return view('/administrator/master/dashboard');
    }
}

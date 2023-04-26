<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard',
            'uri' => $this->uri,
        ];
        return view('home/index', $data);
    }
}

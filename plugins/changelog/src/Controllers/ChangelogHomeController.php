<?php

namespace Azuriom\Plugin\Changelog\Controllers;

use Azuriom\Http\Controllers\Controller;

class ChangelogHomeController extends Controller
{
    /**
     * Show the home plugin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('changelog::index');
    }
}

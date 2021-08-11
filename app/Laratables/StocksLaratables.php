<?php

namespace App\Laratables;

class StocksLaratables
{
    public static function laratablesCustomAction($stock)
    {
        return view('farmers.index_action', compact('stock'))->render();
    }
}   
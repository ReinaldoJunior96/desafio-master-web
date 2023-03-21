<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface PedidoInterface
{
    public function store(Request $request);
}

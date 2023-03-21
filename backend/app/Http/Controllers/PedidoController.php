<?php

namespace App\Http\Controllers;

use App\Contracts\PedidoInterface;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

    private PedidoInterface $model;

    public function __construct(PedidoInterface $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {

        return $this->model->store($request);

    }

}

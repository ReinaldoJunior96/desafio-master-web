<?php

namespace App\Repositories;

use App\Contracts\PedidoInterface;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PedidoRepository implements PedidoInterface
{

    private Pedido $model;

    public function __construct(Pedido $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
       foreach ($request->data['produtos'] as $key => $p) {
            $this->model->create([
                'user_id' => 1,
                'produto' => $key,
                'quantidade' => $p
            ]);
        }
        return response()->json('Success');
    }
}

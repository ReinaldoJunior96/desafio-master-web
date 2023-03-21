<?php

namespace App\Repositories;

use App\Contracts\ProdutoInterface;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;

class ProdutoRepository implements ProdutoInterface
{
    private Produto $model;

    public function __construct(Produto $model)
    {
        $this->model = $model;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->model->all());
    }
}

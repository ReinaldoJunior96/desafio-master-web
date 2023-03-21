<?php

namespace App\Http\Controllers;

use App\Contracts\ProdutoInterface;

class ProdutoController extends Controller
{
    private ProdutoInterface $model;

    public function __construct(ProdutoInterface $model)
    {
        $this->model = $model;
    }

    public function index()
    {
       return $this->model->index();
    }




}

<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'top-langs' => [
                [
                    'id' => 1,
                    'name' => 'Product 1',
                    'price' => 100.00,
                ],
                [
                    'id' => 2,
                    'name' => 'Product 2',
                    'price' => 150.00,
                ],
                [
                    'id' => 3,
                    'name' => 'Product 3',
                    'price' => 200.00,
                ],
            ]
        ]);
    }
}

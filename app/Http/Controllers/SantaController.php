<?php

namespace App\Http\Controllers;

use App\Http\Resources\SantaResource;
use App\Models\Santa;

class SantaController extends Controller
{
    public function show(Santa $santa)
    {
        return new SantaResource($santa);
    }
}

<?php

namespace App\Http\Controllers;

use App\Washing_machines;
use Illuminate\Http\Request;

class WashingMachineController extends Controller
{
    public function getMachines()
    {
        $machines = Washing_machines::all();
        return response()->json($machines);
    }
}

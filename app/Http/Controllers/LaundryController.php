<?php

use App\Laundries;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LaundryController extends Controller
{
    public function bookLaundry(Request $request)
    {
        $laundry = new Laundries();
        $laundry->machine_number = $request->machine_number;
        $laundry->date = $request->date;
        $laundry->time = $request->time;
        $laundry->save();

        return response()->json(['success' => 'Запись успешно создана']);
    }
}

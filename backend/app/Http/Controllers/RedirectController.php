<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($back_half) {
        $link = Link::where('back_half', $back_half)->first();

        //dd($link->destination);

        return redirect($link->destination);
    }
}

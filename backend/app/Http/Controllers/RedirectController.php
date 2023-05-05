<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($back_half)
    {
        $link = Link::where('back_half', $back_half)->first();

        $link->redirect_count = $link->redirect_count + 1;
        $link->save();

        return redirect($link->destination);
    }
}

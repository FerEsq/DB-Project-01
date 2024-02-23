<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function index(Request $request, $locale)
    {
        if (in_array($locale, config('app.available_locales'))) {
            session(['locale' => $locale]);
            app()->setLocale($locale);

            $user         = auth()->user();
            $user->locale = $locale;
            $user->save();
        }

        return redirect()->back();
    }
}

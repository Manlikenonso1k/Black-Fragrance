<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|in:NGN,USD,EUR',
        ]);

        session(['currency' => $request->currency]);

        // If it's an AJAX request return JSON, otherwise redirect back
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }
}

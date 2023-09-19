<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function discountView()
    {
        $diskon = Discount::all();
        return view('dashboard.diskon.index', compact('diskon'));
    }

    public function addDiscount(Request $request)
    {
        Discount::create([
            'price' => $request->harga,
            'discount' => $request->diskon / 100
        ]);

        return redirect('/dashboard/discount')->with('success', 'Diskon di tambahkan');
    }
}

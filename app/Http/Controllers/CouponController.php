<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        // $coupons = Coupon::all();
        // return view('coupons.index', compact('coupons'));
        return Coupons::orderBy('id', 'DESC')->get();
    }

    public function create()
    {
        // return view('coupons.create');
        $newCoupon = new Coupon;
        $newCoupon->coupon_code = $request->coupon_code;
        $newCoupon->brand_id = $request->brand_id;
        $newCoupon->save();
        return $newCoupon;
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:active,expired,redeemed',
            'redeemed_at' => 'nullable|date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'brand_id' => 'required|exists:brands,id',
            'status' => 'required|in:active,expired,redeemed',
            'redeemed_at' => 'nullable|date',
        ]);

        $coupon->update($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }

    public function redeem(Request $request, Coupon $coupon)
    {
        $request->validate([
            'redeemed_at' => 'required|date',
        ]);

        if ($coupon->status === 'redeemed') {
            return response()->json(['message' => 'Coupon already redeemed.'], 400);
        }

        $coupon->update([
            'status' => 'redeemed',
            'redeemed_at' => $request->redeemed_at,
        ]);

        return response()->json(['message' => 'Coupon redeemed successfully.']);
    }

    public function redeemWebhook(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'redeemed_at' => 'required|date',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found.'], 404);
        }

        if ($coupon->status === 'redeemed') {
            return response()->json(['message' => 'Coupon already redeemed.'], 400);
        }

        $coupon->update([
            'status' => 'redeemed',
            'redeemed_at' => $request->redeemed_at,
        ]);

        return response()->json(['message' => 'Coupon redeemed successfully.']);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_redeem_coupon()
    {
        $coupon = factory(Coupon::class)->create();

        $response = $this->put("/api/coupons/{$coupon->id}/redeem", [
            'redeemed_at' => now()->toDateTimeString(),
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('coupons', [
            'id' => $coupon->id,
            'status' => 'redeemed',
            // Add more assertions as needed
        ]);
    }

    // Implement similar tests for error cases, validation, etc.
}

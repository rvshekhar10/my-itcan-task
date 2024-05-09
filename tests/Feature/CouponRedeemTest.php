<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CouponRedeemTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_redeem_coupon()
    {
        // Create a coupon
        $coupon = factory(Coupon::class)->create();

        // Make a POST request to redeem the coupon
        $response = $this->post('/api/coupons/redeem', [
            'code' => $coupon->code,
            'redeemed_at' => now()->toDateTimeString(),
        ]);

        // Assert response is successful
        $response->assertStatus(200);

        // Assert coupon status is updated to 'redeemed'
        $this->assertDatabaseHas('coupons', [
            'id' => $coupon->id,
            'status' => 'redeemed',
            'redeemed_at' => now()->toDateTimeString(),
        ]);
    }

    public function test_cannot_redeem_invalid_coupon()
    {
        // Make a POST request with an invalid coupon code
        $response = $this->post('/api/coupons/redeem', [
            'code' => 'invalid_code',
            'redeemed_at' => now()->toDateTimeString(),
        ]);

        // Assert response indicates coupon not found
        $response->assertStatus(404);
        $response->assertJson(['message' => 'Coupon not found.']);
    }

    // Add more test cases for other scenarios like already redeemed coupon, invalid parameters, etc.
}

<?php

namespace Tests\Feature;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_coupon()
    {
        $response = $this->postJson('/api/coupons', [
            'code' => 'TESTCODE',
            'brand_id' => 1,
            'status' => 'active',
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Coupon created successfully.']);

        $this->assertDatabaseHas('coupons', ['code' => 'TESTCODE']);
    }

    public function test_can_redeem_coupon()
    {
        $coupon = Coupon::factory()->create(['status' => 'active']);

        $response = $this->putJson("/api/coupons/{$coupon->id}/redeem", [
            'redeemed_at' => now(),
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Coupon redeemed successfully.']);

        $this->assertDatabaseHas('coupons', ['id' => $coupon->id, 'status' => 'redeemed']);
    }

    public function test_cannot_redeem_already_redeemed_coupon()
    {
        $coupon = Coupon::factory()->create(['status' => 'redeemed']);

        $response = $this->putJson("/api/coupons/{$coupon->id}/redeem", [
            'redeemed_at' => now(),
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Coupon already redeemed.']);
    }
}

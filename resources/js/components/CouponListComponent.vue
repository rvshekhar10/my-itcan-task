<template>
    <div>
      <h1 class="text-3xl font-bold mb-4">Coupons List</h1>
      <div v-if="loading" class="text-gray-600">Loading...</div>
      <div v-else>
        <div v-if="coupons.length === 0" class="text-gray-600">No coupons found.</div>
        <div v-else>
          <div v-for="coupon in coupons" :key="coupon.id" class="bg-gray-100 p-4 mb-4 rounded-md">
            <h2 class="text-xl font-bold">{{ coupon.code }}</h2>
            <p>Status: <span class="font-semibold">{{ coupon.status }}</span></p>
            <p v-if="coupon.redeemed_at">Redeemed at: <span class="font-semibold">{{ coupon.redeemed_at }}</span></p>
            <!-- Add more coupon details as needed -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loading: true,
        coupons: [],
      };
    },
    created() {
      // Simulate fetching coupons data from an API
      setTimeout(() => {
        this.coupons = [
          { id: 1, code: 'COUPON1', status: 'active', redeemed_at: null },
          { id: 2, code: 'COUPON2', status: 'redeemed', redeemed_at: '2024-05-10 08:00:00' },
          // Add more coupon data as needed
        ];
        this.loading = false;
      }, 1000); // Simulated delay of 1 second
    },
  };
  </script>
  
  <style>
  /* Add any custom styles here */
  </style>
  
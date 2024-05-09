<template>
    <nav class="bg-purple-800">
      <div class="w-4/5 mx-auto px-4 py-12">
        <div class="flex items-center justify-center">
          <div class="justify-center">
            <div class="ml-10 flex items-baseline space-x-4">
              <a href="#" class="text-gray-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Coupons</a>
              <a href="#" class="text-gray-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Users</a>
              <a href="#" class="text-gray-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
              <!-- Add more navbar items as needed -->
            </div>
          </div>
        </div>
      </div>
  
    </nav>
  </template>
  
  <script>
  export default {
    data() {
    },
  };
  </script>
  
  <style>
    nav.bg-purple-800 {
    background: purple;
    padding: 10px; 
    }
    nav a:hover {
    color: #ffffff;
    }
  </style>
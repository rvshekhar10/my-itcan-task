<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function fetchUsers()
    {
        $response = Http::withHeaders([
            'app-id' => '663ccc5c6cc65461a23e3fcd', // Replace with your actual app ID
        ])->get('https://dummyapi.io/data/api/user');

        $users = $response->json();

        return $users['data'];
    }
}

<?php

namespace App\Http\Controllers;

use App\Facades\ApiService;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $token = session('token');
        $response = ApiService::getProfile($token);
        return view('profile', [
            'profile' => $response->json('data'),
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $validated = $request->validated();
        $token = session('token');
        $response = ApiService::updateProfile($validated, $token);
        if ($response->successful()) {
            return redirect()->back();
        }
        return redirect()->back()->with([
            'isEditing' => true
        ]);
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:100',
        ]);

//        dd($request->file('image'));
        $token = session('token');
        $response = ApiService::uploadImage($request->file('image'), $token);
        // handle response as needed
    }
}

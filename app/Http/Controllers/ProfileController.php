<?php

namespace App\Http\Controllers;

use App\Facades\ApiService;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $token = session('token');
        $response = ApiService::getProfile($token);
        return view('profile', [
            'profile' => $response['data'],
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $token = session('token');
        $response = ApiService::updateProfile($validated, $token);
        if ($response['status']) {
            return redirect()->back();
        }
        return redirect()->back()->with([
            'isEditing' => true
        ]);
    }

    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:100',
        ]);

        $token = session('token');
        ApiService::uploadImage($request->file('image'), $token);
        return redirect()->back();
    }
}

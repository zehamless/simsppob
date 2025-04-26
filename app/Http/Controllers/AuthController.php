<?php

namespace App\Http\Controllers;

use App\Facades\ApiService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function newSession(LoginRequest $request)
    {
        $res = ApiService::login($request);
        if ($res->status() === 200) {
            return $this->storeSession($request, $res)->with('message', 'Login successful');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);

    }

    public function destroySession()
    {
        session()?->flush();
        session()?->regenerate();
        return redirect()->route('login');
    }

    public function registerUser(RegisterRequest $request)
    {
        $validated = $request->validated();
        $res = ApiService::registration($validated);
        if ($res->status() === 200) {
            return $this->storeSession($request, $res)->with('message', 'Registration successful, please login');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function storeSession(LoginRequest|RegisterRequest $request, \GuzzleHttp\Promise\PromiseInterface|array|\Illuminate\Http\Client\Response $res): \Illuminate\Http\RedirectResponse
    {
        $request->session()->regenerate();
        $request->session()->put('token', $res->json('data.token'));
        return redirect()->intended(default: route('home'));
    }
}

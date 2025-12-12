<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\UserStatus; // If using Enum (adjust namespace as needed)
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Login'
        ];
        return view('back.pages.auth.login', $data);
    }

    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Forgot Password'
        ];

        return view('back.pages.auth.forgot', $data);
    }

    public function loginHandler(Request $request)
    {
        // Determine email or username
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validation
        if ($fieldType === 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Enter your email or username',
                'login_id.email'    => 'Invalid email address',
                'login_id.exists'   => 'No account found for this email',
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5',
            ], [
                'login_id.required' => 'Enter your username or email',
                'login_id.exists'   => 'No account found for this username',
            ]);
        }

        // Login Credentials
        $creds = [
            $fieldType => $request->login_id,
            'password' => $request->password,
        ];

        // Attempt Login
        if (Auth::attempt($creds)) {

            // Account inactive
            if (auth()->user()->status == UserStatus::Inactive) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('admin.login')
                    ->with('fail', 'Your account is inactive. Contact support at support@larablog.test.');
            }

            // Account pending
            if (auth()->user()->status == UserStatus::Pending) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('admin.login')
                    ->with('fail', 'Your account is pending approval. Check your email or contact support.');
            }

            // Redirect to dashboard
            return redirect()->route('admin.dashboard');
        }

        // Wrong Password
        return redirect()
            ->route('admin.login')
            ->withInput()
            ->with('fail', 'Incorrect password');
    }
}

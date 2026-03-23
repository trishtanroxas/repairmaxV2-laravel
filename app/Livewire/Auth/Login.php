<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.auth')]
#[Title('Log In | Repairmax')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        // Attempt to log the user in
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // Check if the account is active before letting them in
            if (Auth::user()->is_active == 0) {
                Auth::logout();
                $this->addError('email', 'This account has been deactivated.');
                return;
            }

            // Route based on the role enum from your database
            if (Auth::user()->role === 'admin') {
                return $this->redirect('/admin/dashboard', navigate: true);
            }

            return $this->redirect('/user/dashboard', navigate: true);
        }

        // If auth fails, throw an error
        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        // Variables passed here are automatically shared with your layout file!
        return view('auth.login', [
            'heading' => 'Welcome back.',
            'subheading' => 'Log in to your account to book appointments and track your device repairs.'
        ]);
    }
}

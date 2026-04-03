<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

#[Layout('components.layouts.admin')]
#[Title('Admin Profile | Repairmax')]
class Profile extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $department;
    public $job_title;
    public $bio;

    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    public $isEditing = false;

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:15',
        'department' => 'nullable|string|max:255',
        'job_title' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->bio = $user->profile?->bio ?? '';
        
        if($user->adminProfile) {
            $this->department = $user->adminProfile->department;
            $this->job_title = $user->adminProfile->job_title;
        }
    }

    public function saveChanges()
    {
        $rules = $this->rules;
        $rules['email'] = 'required|email|unique:users,email,' . auth()->id();

        $validated = $this->validate($rules);

        $user = auth()->user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        // Update profile if exists
        if($user->profile) {
            $user->profile->update(['bio' => $this->bio]);
        } else {
            $user->profile()->create(['bio' => $this->bio]);
        }

        // Update admin profile
        if($user->adminProfile) {
            $user->adminProfile->update([
                'department' => $this->department,
                'job_title' => $this->job_title,
            ]);
        }

        session()->flash('success', 'Profile updated successfully!');
        $this->isEditing = false;
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|confirmed',
            'confirmPassword' => 'required',
        ], [
            'newPassword.confirmed' => 'New password and confirm password do not match.',
        ]);

        $user = auth()->user();

        if(!Hash::check($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');
            return;
        }

        $user->update(['password' => Hash::make($this->newPassword)]);

        session()->flash('success', 'Password updated successfully!');
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}

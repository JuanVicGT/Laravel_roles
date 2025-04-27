<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    #[Validate('required|string|max:30')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username) . '|' . request()->ip());
    }
}; ?>

<!-- Login Form -->
<div :tab_title="__('Login')"
    class="flex h-screen items-center justify-center bg-[linear-gradient(135deg,rgba(22,52,95,1)0%,rgba(36,100,146,1)100%)]">
    <div>
        <!-- Logo -->
        <div class="mb-4 flex justify-center">
            <x-application-logo class="w-20 h-20 fill-current text-red-500" />
        </div>
        <x-mary-card shadow class="min-w-[400px]">
            <!-- Login Form -->
            <h2 class="text-2xl font-bold text-base-content mb-6 text-center">{{ __('Welcome') }}</h2>

            <x-mary-form wire:submit="login">
                <x-mary-input label="{{ __('Username') }}" wire:model="username" />
                <x-mary-password label="{{ __('Password') }}" wire:model="password" right />

                <div class="flex items-center justify-between">
                    <x-mary-checkbox label="{{ __('Remember me') }}" wire:model="remember" />

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-500 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-mary-button label="{{ __('Sign In') }}" class="btn-primary w-full mt-4" type="submit" spinner="login" />

            </x-mary-form>
        </x-mary-card>
    </div>
</div>

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Izinkan semua pengguna guest untuk login.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validasi input login + honeypot
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:100'],
            'hp_field' => ['prohibited'], // Honeypot anti bot
        ];
    }

    /**
     * Proses autentikasi user
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Cegah file upload (meskipun jarang terjadi di login)
        if ($this->hasFile(null) || $this->files->count() > 0) {
            abort(400, 'File upload tidak diperbolehkan.');
        }

        // Coba login
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Batasi login rate berdasarkan IP + email
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Buat key rate limit per email dan IP
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}

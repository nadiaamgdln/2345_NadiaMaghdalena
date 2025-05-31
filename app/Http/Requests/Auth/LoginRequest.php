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
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'npm' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Coba otentikasi menggunakan 'npm' dan 'password'
        if (! Auth::attempt(['npm' => $this->input('npm'), 'password' => $this->input('password')], $this->boolean('remember'))) {
        // Alternatif: if (! Auth::attempt($this->only('npm', 'password'), $this->boolean('remember'))) {

            RateLimiter::hit($this->throttleKey());

            // Jika gagal, lempar ValidationException dengan pesan error untuk field 'npm'
            throw ValidationException::withMessages([
                'npm' => trans('auth.failed'), // Pesan error 'auth.failed' akan ditampilkan untuk field 'npm'
            ]);
        }

        // Jika berhasil, bersihkan rate limiter
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) { // 5 percobaan maksimal per menit (default)
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            // Pesan error throttle juga diarahkan ke field 'npm'
            'npm' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        // Buat throttle key berdasarkan NPM yang diinput (lower case) dan IP address
        return Str::transliterate(Str::lower($this->input('npm')).'|'.$this->ip());
    }
}

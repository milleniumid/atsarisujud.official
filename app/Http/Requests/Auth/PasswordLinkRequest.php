<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class PasswordLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // return rules is required, email
        return [
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Check is email exists in database and set rate limit
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function IsEmailValid()
    {
        // check if email exists in database
        $isExist = DB::table('users')->where('email', $this->only('email'))->first();

        // if email not exists in database
        if (!$isExist) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('We were unable to find a registered user with this email address.'),
            ]);
        }

        // If email exists in database and clear rate limit
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Send email with link to reset password
     * 
     * @return void
     * 
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Illuminate\Validation\ValidationException
     * 
     */
    public function init()
    {
        // Check does request are spammer
        $this->ensureIsNotRateLimited();

        // Check is email exists in database and set rate limit
        $this->IsEmailValid();

        $status = Password::sendResetLink(
            $this->only('email')
        );

        // Return check the token is valid and return the view.
        return $status == Password::RESET_LINK_SENT 
        ? response()->json([
            'success' => __($status),
        ])
        : response()->json([
            'error' => __($status),
        ]);
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        // If the user has reached their maximum number of attempts
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 2)) {
            return;
        }

        // If the throttler has reached the maximum number of attempts
        event(new Lockout($this));

        // Throw a custom user exception
        $seconds = RateLimiter::availableIn($this->throttleKey());
        
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return $this->ip();
    }
}

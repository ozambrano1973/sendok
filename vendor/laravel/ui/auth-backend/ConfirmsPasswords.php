<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ConfirmsPasswords
{
    use RedirectsUsers;

    /**
     * showConfirmForm
     * Display the password confirmation view.
     * @group ConfirmsPasswords
     * @return \Illuminate\View\View
     */
    public function showConfirmForm()
    {
        return view('auth.passwords.confirm');
    }

    /**
     * confirm
     * Confirm the given user's password.
     * @group ConfirmsPasswords
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    /**
     * resetPasswordConfirmationTimeout
     * Reset the password confirmation timeout.
     * @group ConfirmsPasswords
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function resetPasswordConfirmationTimeout(Request $request)
    {
        $request->session()->put('auth.password_confirmed_at', time());
    }

    /**
     * rules
     * Get the password confirmation validation rules.
     * @group ConfirmsPasswords
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => 'required|password',
        ];
    }

    /**
     * validationErrorMessages
     * Get the password confirmation validation error messages.
     * @group ConfirmsPasswords
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
}

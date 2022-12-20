<?php

namespace App\Http\Controllers\Auth;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'rfc' => 'required|min:12|max:13',
        ]);

        $rfc = $request->input('rfc');
        $email = Persona::where('rfc', $rfc)->value('email');        

        if ($email) {
            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.
            $status = Password::sendResetLink(['rfc' => $rfc]);

            if ($status == Password::RESET_LINK_SENT) {
                return back()->with('status', __($status));
            }
        } else {
            return redirect()->back()->with('error', 'No se encontró el R.F.C. especificado: ' . $rfc);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}

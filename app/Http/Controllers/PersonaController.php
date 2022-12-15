<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Repositories\PersonaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PersonaController extends Controller
{
    public function storeContactos(Request $request, Persona $persona, PersonaRepository $personaRepository)
    {
        try {
            $this->validate($request, [
                'contactos_lista' => 'required|json',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()->all()], 401);
        }

        try {
            if ($persona->id === Auth::user()->persona->id) {
                $personaRepository->updateContactos($persona, $request->input('contactos_lista'));
            } else {
                return response()->json(['error' => 'Usuario no autorizado'], 401);
            }
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 505);
        }

        return response()->json(['Contactos guardados'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Matrix\Exception;

class UsuariosMensajesController extends Controller
{
    public function send(Request $request)
    {
        try {
            $this->validate($request, [
                'user_from' => 'int',
                'user_to' => 'int',
                'asunto' => 'int',
                'mensaje' => 'string',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(true);
    }
}

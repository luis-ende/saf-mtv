<?php

namespace App\Repositories;

use App\Models\Contacto;
use App\Models\Persona;

class PersonaRepository
{
    public function updateContactos(Persona $persona, string $contactosJson): void
    {
        // TODO: Implementar guardado de campo 'orden_matriz_escalamiento'
        $contactos = json_decode($contactosJson, true);

        Contacto::where('id_persona', $persona->id)->delete();

        foreach ($contactos as $contacto) {
            Contacto::create([
                'id_persona' => $persona->id,
                'nombre' => $contacto['nombre'],
                'primer_ap' => $contacto['primer_ap'],
                'segundo_ap' => $contacto['segundo_ap'],
                'cargo' => $contacto['cargo'],
                'telefono_oficina' => $contacto['telefono_oficina'],
                'extension' => $contacto['extension'],
                'telefono_movil' => $contacto['telefono_movil'],
                'email' => $contacto['email'],
            ]);
        }
    }
}

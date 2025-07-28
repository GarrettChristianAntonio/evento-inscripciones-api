<?php

namespace App\Http\Controllers\Api;

use App\Events\ParticipanteRegistrado;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarParticipanteRequest;
use Illuminate\Http\Request;
use App\Models\Participante;
use Illuminate\Support\Facades\Redis;

class ParticipanteController extends Controller
{
    public function store(RegistrarParticipanteRequest $request)
    {
        
        // 1) Crear participante con datos validados
        $participante = Participante::create($request->validated());

        // 2) Disparar evento para acciones desacopladas (correo + contador)
        event(new ParticipanteRegistrado($participante));

        // 3) Responder a la API
        return response()->json([
            'mensaje' => 'Participante creado exitosamente.',
            'data'    => $participante,
        ], 201);
    }

    public function show(string $id)
    {
        // Intentar recuperar datos del participante desde caché
        $cacheKey = "participante:{$id}";

        // Intentar obtener desde Redis
        $cached = Redis::get($cacheKey);

        if ($cached) {
            return response()->json([
                'data' => json_decode($cached, true),
                'mensaje' => 'Participante recuperado desde caché',
                'cached' => true,
            ]);
        }

        // Si no está en caché, consultar la base de datos
        $participante = Participante::find($id);

        if (!$participante) {
            return response()->json([
                'mensaje' => 'Participante no encontrado.',
            ], 404);
        }

        // Guardar en caché por 1 hora (3600 segundos)
        Redis::setex($cacheKey, 3600, $participante->toJson());

        return response()->json([
            'data' => $participante,
            'mensaje' => 'Participante recuperado desde base de datos',
            'cached' => false,
        ]);
    }
}

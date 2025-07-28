<?php

namespace App\Http\Controllers\Api;

use App\Events\ParticipanteRegistrado;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrarParticipanteRequest;
use Illuminate\Http\Request;
use App\Models\Participante;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrarParticipanteRequest $request)
    {
        //
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

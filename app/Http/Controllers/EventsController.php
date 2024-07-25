<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    
    /**
     * @OA\Get(
     *      path="/api/events",
     *      summary="Busca todos os eventos",
     *      @OA\Response(response=200, description="Lista eventos")
     * )
     */
    public function index()
    {
        //$user = Auth::id();
        $eventos = EventsModel::select('events.*')        
            ->get();

        foreach ( $eventos as $ev )
        {
            $ev->cor = 'vermelho';
        }

        return response()->json($eventos);
    }

    /**
     * @OA\Get(
     *      path="/api/events/{id}",
     *      summary="Busca todos os participantes de um evento",
     *      @OA\Response(response=200, description="Lista participantes")
     * )
     */
    public function searchEventParticipants(Request $request, $args)
    {
        $eventId = $args;
        $participantes = EventsModel::select('users.name')
            ->join('subscriptions', 'subscriptions.eventos_id', '=', 'events.id')
            ->join('users', 'subscriptions.users_id', '=', 'users.id')
            ->where('events.id', '=', $eventId)    
            ->get();

        return response()->json($participantes, 200);
    }
}
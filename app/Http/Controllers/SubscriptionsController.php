<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\SubscriptionModel;
use Illuminate\Http\Request;
use App\Mail\MailSender;
use Illuminate\Support\Facades\Mail;
use App\Models\User;


class SubscriptionsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/subscriptions/{id}",
     *      summary="Busca inscrição",
     *      @OA\Response(response=200, description="Inscrição")
     * )
     */
    public function searchSubscription($args)
    {
        //$user = Auth::user();
        $subscriptionId = $args;
        $subscription = SubscriptionModel::select('subscriptions.*')
            ->where('subscriptions.id', $subscriptionId)
            ->get();

        return response()->json($subscription);
    }

    /**
     * @OA\Post(
     *      path="/api/subscriptions",
     *      summary="Realiza inscrição e envia email",
     *      @OA\Response(response=200, description="Inscrição realizada")
     * )
     */
    public function register(Request $request)
    {
        $data = $request->all();
        $users_id = $data['users_id'];
        $eventos_id = $data['eventos_id'];

        $event = EventsModel::find($eventos_id);
        $user = User::find($users_id);

        if (!$user)
        {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        if (!$event) {
            return response()->json(['error' => 'Evento não encontrado'], 404);
        }

        if (SubscriptionModel::where('eventos_id', $eventos_id)->where('users_id', $users_id)->exists()) {
            return response()->json(['error' => 'O usuário não pode se inscrever mais de uma vez no evento'], 409);
        }

        SubscriptionModel::create([
            'users_id' => $users_id,
            'eventos_id' => $eventos_id
        ]);

        $evento = EventsModel::find($eventos_id);

        $details = [
            'title' => 'Inscrição efetuada com sucesso!',
            'body' => "Você realizou a inscrição no seguinte evento:<br><h3>$evento->name</h3>."
        ];

        // Envia e-mail
        //$this->sendMail($details);
        
        return response()->json([
            "message" => "Inscrição realizada!",
            200
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/subscriptions/cancel/{id}",
     *      summary="Cancela uma inscrição e envia um email",
     *      @OA\Response(response=200, description="Inscrição cancelada")
     * )
     */
    public function cancelSubscription(Request $request, $args)
    {
        $subscription = SubscriptionModel::find($args);

        if (!$subscription) {
            return response()->json(['error' => 'Inscrição não encontrada'], 404);
        }

        $subscription->active = false;
        $subscription->save();

        $event = EventsModel::find($subscription->eventos_id);
        
        $details = [
            'title' => 'Inscrição cancelada!',
            'body' => "Você cancelou sua inscrição no seguinte evento:<br><h3>$event->name</h3><br>."
        ];

        // Envia e-mail
        //$this->sendMail($details);

        return response()->json([
            'success' => true,
            'message' => 'Inscrição cancelada!',
            'evento' => $event->name
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/checkin/{id}",
     *      summary="Realiza a presença no evento e envia um email",
     *      @OA\Response(response=200, description="Presença confirmada")
     * )
     */
    public function checkin(Request $request, $args)
    {
        $subscription = SubscriptionModel::find($args);
        $subscription->checkin = true;
        $subscription->save();

        $event = EventsModel::find($subscription->eventos_id);

        $details = [
            'title' => 'Checkin realizado com sucesso!',
            'body' => "Você realizou o checkin no seguinte evento:<br><h3>$event->name</h3>"
        ];

        // Envia e-mail
        //$this->sendMail($details);

        return response()->json([
            'success' => true,
            'message' => 'Checkin realizado com sucesso!',
            'evento' => $event->name
        ]);
    }

    private function sendMail(Array $details)
    {
        Mail::to('user_receiver_email@gmail.com')->send(new MailSender($details));
    }
}
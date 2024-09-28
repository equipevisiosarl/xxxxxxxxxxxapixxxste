<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function all($id_user)
    {
        return Notification::select('id as id_notification', 'notification')
            ->where('id_user', $id_user)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function new($id_user)
    {
        return Notification::select('id as id_notification', 'notification')
            ->where('vue', 'non')
            ->where('id_user', $id_user)
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function vue($id_notification)
    {
        if (Notification::where('id', $id_notification)->update(['vue' => 'oui'])) {
            return ['success' => true];
        }
        return ['success' => false];
    }

    public static function ajout($id_user, $notification){
        $id_gestionnaire = 0 ;
        $notification = Notification::create(compact('id_user', 'notification', 'id_gestionnaire'));
    }
}

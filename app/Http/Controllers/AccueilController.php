<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function index()  
    {  
        $user = Auth::user();
        // $notifications = Auth::check() ? Auth::user()->notifications : collect(); // Vérifie si l'utilisateur est authentifié  
        // return view('welcome', compact('notifications')); // Passez les notifications à la vue welcome  
        $notifications = Notification::all(); // Récupère toutes les notifications de la base de données  
        return view('welcome', compact('notifications')); // Passez les notifications à la vue welcome  
    } 
}

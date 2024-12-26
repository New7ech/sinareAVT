<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use App\Models\Cacircuits;
use App\Models\Compagnie;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function index()  
    {  
        $activite = Activite::all();
        $cacircuit = Cacircuits::all();
        // Compter le nombre total d'utilisateurs  
        $totalUtilisateurs = User::count(); // Assurez-vous que le modèle User est importé
        $totalcompagnies = Compagnie::count(); // Assurez-vous que le modèle User est importé
        $user = Auth::user();
        // $notifications = Auth::check() ? Auth::user()->notifications : collect(); // Vérifie si l'utilisateur est authentifié  
        // return view('welcome', compact('notifications')); // Passez les notifications à la vue welcome  
        $notifications = Notification::all(); // Récupère toutes les notifications de la base de données  
        return view('welcome', compact('notifications', 'totalUtilisateurs', 'totalcompagnies', 'cacircuit', 'activite')); // Passez les notifications à la vue welcome  
    } 
}

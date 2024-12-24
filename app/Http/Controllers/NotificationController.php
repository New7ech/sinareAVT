<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Compagnie;
use App\Models\Formulaire; // Assurez-vous d'importer le modèle Formulaire
use App\Models\Formulairebar;
use App\Models\Mensuel;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::all(); 
        return view('notifications.index', compact('notifications'));
    }

    public function create()
    {
        //
    }

    public function store(StoreNotificationRequest $request)
    {
        Notification::create([
            'user_id' => Auth::id(),
            'compagnie_id' => Auth::user()->compagne_id,
            'data' => json_encode([
                'message' => $request->input('message de la notification'),
            ]),
            'read_at' => null,
        ]);

        return redirect()->back()->with('success', 'Notification envoyée avec succès.');
    }

    public function show($id)
    {
        // Récupérer la notification par ID
        $notification = Notification::find($id);

        // Vérifiez si la notification existe
        if (!$notification) {
            return redirect()->back()->with('error', 'Notification non trouvée.');
        }

        // Passer la notification à la vue
        return view('notifications.show', compact('notification'));

    }

    public function edit(Notification $notification)
    {
        //
    }

    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        //
    }

    public function destroy(Notification $notification)
    {
        //
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        // Vérifiez si la notification existe
        if ($notification) {
            $notification->update(['read_at' => true]);
            return redirect()->back()->with('success', 'Notification marquée comme lue.');
        }

        return redirect()->back()->with('error', 'Notification non trouvée.');
    }

    // public function validateFormAndNotify($formulaireId)
    // {
    //     // dd("Method reached with ID: " . $formulaireId);
    //     $formulaire = Mensuel::findOrFail($formulaireId);
    //     // dd($formulaire->estRenseigne);
    
    //     if ($formulaire->estRenseigne) {
    //         Notification::create([
    //             'user_id' => Auth::id(),
    //             'compagnie_id' => Auth::user()->compagnie_id,
    //             'data' => json_encode([
    //                 'message' => 'Le formulaire pour le mois ' . $formulaire->mois . ' a été validé.',
    //             ]),
    //             'read_at' => false,
    //         ]);

    //         return redirect()->route('notifications.index')->with('success', 'Formulaire validé et notification envoyée avec succès.');
    //     }

    //     return redirect()->route('notifications.index')->with('error', 'Le formulaire n\'est pas renseigné.');
    // }

    public function validateFormAndNotify($formulaireId)
    {
        $formulaire = Mensuel::findOrFail($formulaireId);

        // Vérifier si le formulaire est renseigné
        if ($formulaire->estRenseigne) {
            // Vérifier si une notification existe déjà pour ce mensuel et cet utilisateur
            $existingNotification = Notification::where('mensuels_id', $formulaire->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingNotification) {
                return redirect()->back()->with('error', 'Notification déjà envoyée pour ce formulaire.');
            }

            // Récupérer la compagnie de l'utilisateur  
            $user = Auth::user();  
            $compagnie = $user->compagnie; // Assurez-vous que le modèle User a la relation définie 


            // Créer la notification car elle n'existe pas
            Notification::create([
                'user_id' => Auth::id(),
                'compagnie_id' => Auth::user()->compagnie_id,
                'mensuels_id' => $formulaire->id, // Remplir la colonne mensuels_id
                'data' => json_encode([
                    'message' => 'Les informations du mois ' . $formulaire->mois . ' pour la compagnie ' . $compagnie->denomination . ' on été renseigner avec succes.',
                ]),
                'read_at' => null, // Utiliser null pour indiquer qu'elle n'est pas lue
            ]);

            return redirect()->back()->with('success', 'Formulaire validé et notification envoyée avec succès.');
        }

        return redirect()->route('notifications.index')->with('error', 'Le formulaire n\'est pas renseigné.');
    }

    public function validateFormAndNotifyb($formulaireId)
    {
        // Récupérer toutes les compagnies  
        $compagnies = Compagnie::all();  
        $formulaire = Formulairebar::findOrFail($formulaireId);

        // Vérifier si le formulaire est renseigné
        if ($formulaire->estRenseigne) {
            // Vérifier si une notification existe déjà pour ce mensuel et cet utilisateur
            $existingNotification = Notification::where('mensuels_id', $formulaire->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingNotification) {
                return redirect()->route('notifications.index')->with('error', 'Notification déjà envoyée pour ce formulaire.');
            }

            // Récupérer la compagnie de l'utilisateur  
            $user = Auth::user();  
            $compagnie = $user->compagnie; // Assurez-vous que le modèle User a la relation définie 

            // Créer la notification car elle n'existe pas
            Notification::create([
                'user_id' => Auth::id(),
                'compagnie_id' => Auth::user()->compagnie_id,
                'formulairebars_id' => $formulaire->id, // Remplir la colonne mensuels_id
                'data' => json_encode([
                    'message' => 'Les informations du trimestre ' . $formulaire->trimestre . ' pour la compagnie ' . $compagnie->denomination . ' ont été renseignées avec succès.', 
                ]),
                'read_at' => null, // Utiliser null pour indiquer qu'elle n'est pas lue
            ]);

            return redirect()->route('notifications.index')->with('success', 'Formulaire validé et notification envoyée avec succès.');
        }

        return redirect()->route('notifications.index')->with('error', 'Le formulaire n\'est pas renseigné.');
    }
}
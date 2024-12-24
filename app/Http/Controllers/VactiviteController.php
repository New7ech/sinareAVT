<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVactiviteRequest;
use App\Http\Requests\UpdateVactiviteRequest;
use App\Models\Formulaire;
use App\Models\Mensuel;
use App\Models\Vactivite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VactiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vactivite.index', [
            'vactivite' => Vactivite::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vactivite.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVactiviteRequest $request)  
    {   
        // Valider les données du formulaire  
        $validatedData = $request->validated();  
        $userId = Auth::id();  
        $userCompa = Auth::user()->compagnie_id;   
        
        // Récupérer le mensuel à partir de l'identifiant fourni  
        $mensuel = Mensuel::findOrFail($request->mensuels_id);   

        // Récupérer le mois correspondant à l'ID mensuel
        $mois = $mensuel->mois; // Assurez-vous que 'mois' est une propriété de l'objet Mensuel
        $trimestre = $mensuel->trimestre;

        // Ajouter l'ID utilisateur, compagnie et mois aux données validées  
        $validatedData['users_id'] = $userId;   
        $validatedData['compagnie_id'] = $userCompa;   
        $validatedData['mois'] = $mois;  // Ajoutez le mois aux données
        $validatedData['trimestre'] = $trimestre;  // Ajoutez le mois aux données

        // Vérifiez si l'objet vactivite existe pour cette compagnie  
        try {  
            if ($mensuel->vactivite()->where('compagnie_id', $userCompa)->exists()) {  
                // Mise à jour de vactivite si elle existe  
                $mensuel->vactivite()->where('compagnie_id', $userCompa)->first()->update($validatedData);  
            } else {  
                // Création de vactivite si elle n'existe pas  
                $mensuel->vactivite()->create($validatedData);  
            }  
        } catch (\Throwable $th) {  
            // Afficher l'erreur pour le débogage  
            dd($th);  
        }   
        
        return redirect()->back()->withSuccess('Activité enregistrée avec succès.');  
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Vactivite $vactivite)
    {
        return view('vactivite.show', compact('vactivite'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vactivite $vactivite)
    {
        return view('vactivite.edit', compact('vactivite'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVactiviteRequest $request, Vactivite $vactivite)
    {
        $vactivite->update($request->validated());

        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vactivite $vactivite)
    {
        $vactivite->delete();
        return redirect()->route('vactivite.index')
                ->withSuccess('Product is deleted successfully.');
    }
}

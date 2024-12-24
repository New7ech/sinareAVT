<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Formulaire;
use App\Models\Mensuel;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('zone.index', [
            'zone' => Zone::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('zone.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZoneRequest $request)  
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
        
        // Vérifiez si l'objet zone existe ou non pour cette compagnie  
        try {  
            if ($mensuel->zone()->where('compagnie_id', $userCompa)->exists()) {  
                // Mise à jour de zone si elle existe  
                $mensuel->zone()->where('compagnie_id', $userCompa)->first()->update($validatedData);  
            } else {  
                // Création de zone si elle n'existe pas  
                $mensuel->zone()->create($validatedData);  
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
    public function show(Zone $zone)
    {
        return view('zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
        return view('zone.edit', compact('zone'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZoneRequest $request, Zone $zone)
    {
        $zone->update($request->validated());

        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zone.index')
                ->withSuccess('Product is deleted successfully.');
    }
}

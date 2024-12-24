<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCabilletteriesRequest;
use App\Http\Requests\UpdateCabilletteriesRequest;
use App\Models\Cabilletteries;
use App\Models\Formulaire;
use App\Models\Mensuel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Ajout de l'espace de noms pour Auth  

class CabilletteriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cabilletteries.index', [
            'cabillettery' => Cabilletteries::latest()->paginate(10)
        ]);
    }

    /**
     * Show all records without pagination.
     */
    public function liste()
    {
        return view('cabilletteries.index', [
            'cabillettery' => Cabilletteries::latest()->paginate(10)
        ]);
        // return view('cabilletteries.list', [
        //     'cabillettery' => Cabilletteries::latest()->paginate(10)
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cabilletteries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreCabilletteriesRequest $request)
    // {
    //     // Valider les données du formulaire
    //     $validatedData = $request->validated();
    //     // Calculer le trimestre actuel
    //     $trimestre = Carbon::now()->quarter;
    //     // Ajouter le trimestre aux données validées
    //     $validatedData['trimestre'] = $trimestre;

    //     // Récupérer l'identifiant de la compagnie de l'utilisateur authentifié
    //     $validatedData['compagnie_id'] = Auth()->user()->compagnie_id;

    //     // Récupérer l'identifiant de l'utilisateur authentifié
    //     $validatedData['users_id'] = Auth()->user()->id;


    //     // Enregistrer la nouvelle entité avec les données validées
    //     $cabillettery = Cabilletteries::create($validatedData);

    //     return redirect()->route('activite.create')
    //             ->withSuccess('New is added successfully.');
    // }

    public function store(StoreCabilletteriesRequest $request)  
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
        
        // Vérifiez si l'objet cabillettery existe ou non pour cette compagnie  
        try {  
            if ($mensuel->cabilletteries()->where('compagnie_id', $userCompa)->exists()) {  
                // Mise à jour de cabillettery si elle existe  
                $mensuel->cabilletteries()->where('compagnie_id', $userCompa)->first()->update($validatedData);  
            } else {  
                // Création de cabillettery si elle n'existe pas  
                $mensuel->cabilletteries()->create($validatedData);  
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
    public function show(Cabilletteries $cabillettery)
    {
        return view('cabilletteries.show', compact('cabillettery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cabilletteries $cabillettery)
    {
        return view('cabilletteries.edit', compact('cabillettery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCabilletteriesRequest $request, Cabilletteries $cabillettery)
    {
        $cabillettery->update($request->validated());

        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabilletteries $cabillettery)
    {
        $cabillettery->delete();
        return redirect()->route('cabilletteries.index')
                ->withSuccess('Product is deleted successfully.');
    }
}

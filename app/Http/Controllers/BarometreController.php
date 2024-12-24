<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barometre;
use App\Models\Compagnie;
use App\Models\Formulairebar;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBarometreRequest;
use App\Http\Requests\UpdateBarometreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use PDF;

class BarometreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)  
    {  
        $query = Barometre::query();  

        // Filtrer par année  
        if ($request->has('annee') && $request->annee) {  
            $query->whereYear('created_at', $request->annee);  
        }  

        // Filtrer par compagnie  
        if ($request->has('compagnie_id') && $request->compagnie_id) {  
            $query->where('compagnie_id', $request->compagnie_id);  
        }  

        $barometres = $query->paginate(10); // Pagination ou autre méthode de récupération  

        $compagnies = Compagnie::all(); // Récupérez toutes les compagnies pour le dropdown  

        return view('barometres.index', compact('barometres', 'compagnies'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Formulairebar $formulairebar)
    {
        // Vérifiez si l'objet est bien chargé
        if (!$formulairebar) {
            abort(404);
        }
        // Récupérer les compagnies pour le select
        $compagnies = Compagnie::all();
        return view('barometres.create', compact('formulairebar','compagnies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarometreRequest $request)  
    {  
        // Valider les données du formulaire  
       $validatedData = $request->validated();  
       $userId = Auth::id();  
       $userCompa = Auth::user()->compagnie_id;  
       
       // Récupérer le mensuel à partir de l'identifiant fourni  
       $mensuel = Formulairebar::findOrFail($request->formulairebars_id);  
       
       // Récupérer le mois correspondant à l'ID mensuel
       $trimestre = $mensuel->trimestre;

       // Ajouter l'ID utilisateur, compagnie et mois aux données validées  
       $validatedData['users_id'] = $userId;   
       $validatedData['compagnie_id'] = $userCompa;   
       $validatedData['trimestre'] = $trimestre;  // Ajoutez le mois aux données 
       
       // Vérifiez si l'objet nbbilletcompa existe ou non pour cette compagnie  
       try {  
           if ($mensuel->barometres()->where('compagnie_id', $userCompa)->exists()) {  
               // Mise à jour de nbbilletcompa si elle existe  
               $mensuel->barometres()->where('compagnie_id', $userCompa)->first()->update($validatedData);  
           } else {  
               // Création de nbbilletcompa si elle n'existe pas  
               $mensuel->barometres()->create($validatedData);  
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
    public function show(Barometre $barometre)
    {
        return view('barometres.show', compact('barometre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barometre $barometre)
    {
        // Récupérer les compagnies pour le select lors de l'édition
        $compagnies = Compagnie::all();
        return view('barometres.edit', compact('barometre', 'compagnies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarometreRequest $request, Barometre $barometre)
    {
        $barometre->update($request->validated());

        return redirect()->back()
                ->withSuccess('Product is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barometre $barometre)
    {
        $barometre->delete();
        return redirect()->route('barometres.index')
                ->withSuccess('Product is deleted successfully.');
    }
    public function generatePDF($id)  
    {  
        // Récupérer les données du baromètre  
        $barometre = Barometre::findOrFail($id);  

        // Générer le PDF  
        $pdf = PDF::loadView('barometres.pdf', compact('barometre')); // Utilisation correcte de la façade  

        // Retourner le PDF dans le navigateur au lieu de le forcer à télécharger  
        return $pdf->stream('barometre_' . $barometre->id . '.pdf');  
    } 
}

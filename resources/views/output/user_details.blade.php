@extends('layouts.app')  

@section('contenus')  
<div class="container">  
    <h2 class="text-center">Enregistrements de la compagnie <strong>{{ $compagnie->denomination }}</strong></h2>  
    
    <!-- Formulaire de filtrage -->  
    <form method="GET" action="{{ route('user.records.show', $compagnie->id) }}">  
        <div class="row mb-3">  
            <div class="col-md-4">  
                <label for="annee" class="form-label">Sélectionner une Année</label>  
                <select name="annee" id="annee" class="form-select">  
                    <option value="">Choisissez une année</option>  
                    @for ($i = 2020; $i <= date('Y'); $i++)  
                        <option value="{{ $i }}" {{ request('annee') == $i ? 'selected' : '' }}>  
                            {{ $i }}  
                        </option>  
                    @endfor  
                </select> 
            </div>  
            <div class="col-md-4">  
                <label for="mois" class="form-label">Sélectionner un Mois</label>  
                <select name="mois" id="mois" class="form-select">  
                    <option value="">Tous</option>  
                    @for ($i = 1; $i <= 12; $i++)  
                        <option value="{{ $i }}" {{ request('mois') == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>  
                    @endfor  
                </select>  
            </div>  
            <div class="col-md-4 d-flex align-items-end">  
                <button type="submit" class="btn btn-primary">Filtrer</button>  
            </div>  
        </div>  
    </form>  
    
    <div class="card-body">  
        @if ($vactivite->count() > 0)  
            <div class="card">  
                <div class="card-body">  
                    <h4><strong>Volume de l'activité</strong></h4>  
                    <table class="table table-bordered table-bordered-bd-warning mt-4">  
                        <thead>  
                            <tr>  
                                <th scope="col">Mois</th>  
                                <th scope="col">Nombre de circuits inter-états</th>  
                                <th scope="col">Nombre de circuits internes</th>  
                                <th scope="col">Nombre d'excursions</th>  
                            </tr>  
                        </thead>  
                        <tbody>  
                            @foreach($vactivite as $item)  
                            <tr>  
                                <th scope="row">{{ $item->mois }}</th>  
                                <td>{{ $item->nbcir_int_etat }}</td>  
                                <td>{{ $item->nbcir_intrn }}</td>  
                                <td>{{ $item->nbexcs_exc }}</td>  
                            </tr>  
                            @endforeach  
                        </tbody>  
                    </table>  
                </div>  
            </div>  
        @else  
            <p class="text-danger text-center">Aucun enregistrement de volume d'activité trouvé.</p>  
        @endif   

        @if ($cacircuits->count() > 0)  
            <div class="card">  
                <div class="card-body">  
                    <h4><strong>Chiffre d'affaires des circuits réalisés</strong></h4>  
                    <table class="table table-bordered table-bordered-bd-warning mt-4">  
                        <thead>  
                            <tr>  
                                <th scope="col">Mois</th>  
                                <th scope="col">Chiffre d'affaires circuits inter-états</th>  
                                <th scope="col">Chiffre d'affaires circuits internes</th>  
                                <th scope="col">Chiffre d'affaires excursions</th>  
                                <th scope="col">Total</th>  
                            </tr>  
                        </thead>  
                        <tbody>  
                            @foreach($cacircuits as $cacircuit)  
                            <tr>  
                                <th scope="row">{{ $cacircuit->mois }}</th>  
                                <td>{{ $cacircuit->ca_cur_int_etat }}</td>  
                                <td>{{ $cacircuit->ca_cur_int }}</td>  
                                <td>{{ $cacircuit->ca_cur_excu }}</td>  
                                <td>{{ ($cacircuit->ca_cur_int_etat + $cacircuit->ca_cur_int + $cacircuit->ca_cur_excu) }}</td>  
                            </tr>  
                            @endforeach  
                        </tbody>  
                    </table>  
                </div>  
            </div>  
        @else  
            <p class="text-danger text-center">Aucun enregistrement de Cacircuits trouvé.</p>  
        @endif  
    </div>  
</div>  
@endsection
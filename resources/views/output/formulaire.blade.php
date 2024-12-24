@extends('layouts.app')  
@section('contenus')  
<div class="container">  
    <h1>Statistiques des enregistrements par compagnie</h1>  
    <form method="GET" action="{{ route('output.formulaire') }}" class="mb-4">  
        <div class="row">  
            <div class="col-md-4">  
                <label for="annee" class="form-label">Année</label>  
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
                <label for="compagnie" class="form-label">Compagnie</label>  
                <select name="compagnie_id" id="compagnie" class="form-select">  
                    <option value="">Choisissez une compagnie</option>  
                    @foreach ($compagnies as $compagnie)  
                        <option value="{{ $compagnie->id }}" {{ request('compagnie_id') == $compagnie->id ? 'selected' : '' }}>  
                            {{ $compagnie->denomination }}  
                        </option>  
                    @endforeach  
                </select>  
            </div>  
            <div class="col-md-4 align-self-end">  
                <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>  
            </div>  
        </div>  
    </form>  
    
    @if(count($companiesWithRecords) > 0)  
        @foreach($companiesWithRecords as $item)  
            <h3>{{ $item['compagnie']->denomination }}</h3> <!-- Affichage du nom de la compagnie -->  
            
            @if($item['grouped_vactivites']->isNotEmpty() || $item['grouped_cacircuits']->isNotEmpty())  
                @if($item['grouped_vactivites']->isNotEmpty())  
                    <h4>Activités par mois</h4>  
                    @foreach($item['grouped_vactivites'] as $month => $vactivites)  
                        <h5>Month: {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h5>  
                        <table class="table">  
                            <thead>  
                                <tr>  
                                    <th>ID</th>  
                                    <th>Mois</th>  
                                    <th>Action</th>  
                                </tr>  
                            </thead>  
                            <tbody>  
                                @foreach($vactivites as $vactivite)  
                                    <tr>  
                                        <td>{{ $vactivite->id }}</td>  
                                        <td>mois {{ $vactivite->mensuels_id }}</td>  
                                        <td><a href="{{ route('user.records.show', $vactivite->users_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Voir</a></td>  
                                    </tr>  
                                @endforeach  
                            </tbody>  
                        </table>  
                    @endforeach  
                @endif  

                @if($item['grouped_cacircuits']->isNotEmpty())  
                    <h4>Cacircuits par mois</h4>  
                    @foreach($item['grouped_cacircuits'] as $month => $cacircuits)  
                        <h5>Month: {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h5>  
                        <table class="table">  
                            <thead>  
                                <tr>  
                                    <th>ID</th>  
                                    <th>Mois</th>  
                                    <th>Action</th>  
                                </tr>  
                            </thead>  
                            <tbody>  
                                @foreach($cacircuits as $cacircuit)  
                                    <tr>  
                                        <td>{{ $cacircuit->id }}</td>  
                                        <td>mois {{ $cacircuit->mensuels_id }}</td>  
                                        <td><a href="{{ route('user.records.show', $cacircuit->users_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> Voir</a></td>  
                                    </tr>  
                                @endforeach  
                            </tbody>  
                        </table>  
                    @endforeach  
                @endif  
            @endif  
        @endforeach  
    @else  
        <p class="text-danger">Aucune compagnie avec enregistrement trouvé.</p>  
    @endif  
</div>  
@endsection
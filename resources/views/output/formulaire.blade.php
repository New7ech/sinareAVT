@extends('layouts.app')  

@section('contenus')  
<div class="container">  
    <form method="GET" action="{{ route('output.formulaire') }}">  
        <div class="row mb-3">  
            <div class="col-md-4">  
                <label for="compagnie_id" class="form-label">Sélectionner une Compagnie</label>  
                <select name="compagnie_id" id="compagnie_id" class="form-select">  
                    <option value="">Tous</option>  
                    @foreach ($compagnies as $compagnie)  
                        <option value="{{ $compagnie->id }}" {{ request('compagnie_id') == $compagnie->id ? 'selected' : '' }}>{{ $compagnie->denomination }}</option>  
                    @endforeach  
                </select>  
            </div>  
            
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

            <div class="col-md-4 d-flex align-items-end">  
                <button type="submit" class="btn btn-primary">Filtrer</button>  
            </div>  
        </div>  
    </form>  

    <table class="table">  
        <thead>  
            <tr>  
                <th>Compagnie</th>  
                <th>Actions</th>  
            </tr>  
        </thead>  
        <tbody>  
            @foreach ($companiesWithRecords as $companyRecords)  
                <tr>  
                    <td>{{ $companyRecords['compagnie']->denomination }}</td>  
                    <td>  
                        <a href="{{ route('user.records.show', $companyRecords['compagnie']->id) }}" class="btn btn-primary">  
                            Voir  
                        </a>  
                    </td>  
                </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>  
@endsection
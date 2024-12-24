@extends('layouts.app')  

@section('contenus')  
<div class="container">  
    <h1>Rapport mensuel de l'Année {{ \Carbon\Carbon::now()->year }}</h1>  
    <table class="table">  
        <thead>  
            <tr>  
                <th>Mois</th>  
                <th>Trimestre</th>  
                <th>Action</th>  
            </tr>  
        </thead>  
        <tbody>  
            @php  
                $currentMonth = \Carbon\Carbon::now()->format('n'); // 1-12  
                $monthsToDisplay = [(($currentMonth - 1 + 12) % 12) ?: 12, (($currentMonth - 2 + 12) % 12) ?: 12, (($currentMonth - 3 + 12) % 12) ?: 12];  
                $filteredMensuels = Auth::user()->compagnie->mensuels->whereIn('mois', $monthsToDisplay);  
            @endphp  

            @foreach ($filteredMensuels as $f)  
            <tr>  
                <td>{{ $f->mois }} éme mois</td>  
                <td>Trimestre {{ $f->trimestre }}</td>  
                <td>  
                    @if ($f->notification && $f->notification->is_read) <!-- Utilisation de la méthode is_read -->
                        <span class="btn btn-secondary disabled">Transmis</span>  
                    @elseif ($f->estRenseigne)
                        <a href="{{ route('notification.validate', $f->id) }}" class="btn btn-success"><span class="btn-label"><i class="fa fa-check"></i></span>Valider</a>  
                    @elseif($f->edition)
                        <a href="{{ route('formulaire.create', $f) }}" class="btn btn-warning"><span class="btn-label"><i class="fa fa-exclamation-circle"></i></span>Editer</a>  
                    @else
                        <a href="{{ route('formulaire.create', $f) }}" class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Créer</a>  
                    @endif
                </td>  
            </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>  
@endsection
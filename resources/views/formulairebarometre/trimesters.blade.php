@extends('layouts.app')  

@section('contenus')  
<div class="container">  
    <h1>Barometre trimestriel de l'Année {{ \Carbon\Carbon::now()->year }}</h1>  
    <table class="table">  
        <thead>  
            <tr>  
                {{-- <th>Mois</th>   --}}
                <th>Trimestre</th>  
                <th>Action</th>  
            </tr>  
        </thead>  
        <tbody>  
            @php  
                // Obtenir le trimestre courant  
                $currentMonth = \Carbon\Carbon::now()->quarter; // 1-4  
                // Obtenir les 3 derniers mois en excluant le mois courant  
                $monthsToDisplay = [(($currentMonth - 1) + 4) % 4, ($currentMonth - 2 + 4) % 4, ($currentMonth - 3 + 4) % 4];  
                // Filtrer les trimestres  
                $filteredMensuels = Auth::user()->compagnie->formilairebar->whereIn('trimestre', $monthsToDisplay);  
                // $filteredMensuels = Auth::user()->compagnie->mensuels->whereIn('mois', $monthsToDisplay);  
                // dd($filteredMensuels);
            @endphp  

            {{-- {{ dd($filteredMensuels) }}; --}}

            @foreach ($filteredMensuels as $f)  
            <tr>  
                {{-- <td>{{ $f->mois }} éme mois</td>   --}}
                <td>Trimestre {{ $f->trimestre }}</td>  
                <td> 
                    @if ($f->notification && $f->notification->is_read) <!-- Utilisation de la méthode is_read -->
                        <span class="btn btn-secondary disabled">Transmis</span>
                        @elseif ($f->estRenseigne)
                        <a href="{{ route('notification.validateb', $f->id) }}" class="btn btn-warning"><span class="btn-label"><i class="fa fa-exclamation-circle"></i></span>Editer</a>  
                            @else
                            <a href="{{ route('barometres.create',$f) }}" class="btn btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span> Créer</a>  
                    @endif
                </td>  
            </tr>  
            @endforeach  
        </tbody>  
    </table>  
</div>  
@endsection
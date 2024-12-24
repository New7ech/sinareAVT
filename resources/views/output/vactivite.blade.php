@extends('layouts.app')  
@section('contenus')  
<div class="container">  
    <div class="page-inner">  
        <div class="row justify-content-center mt-3">  
            <div class="col-md-12">  
                <div class="card">  
                    <div class="card-header">  
                        <div class="float-start">  
                            <h4><strong>Information sur les enregistrements</strong></h4>  
                        </div>  
                    </div>  
                    <div class="card-body">  
                        <div class="card">  
                            <div class="card-body">  
                                <h4><strong>Information sur les enregistrements du volume d'activité</strong></h4>  
                                <table class="table table-bordered table-bordered-bd-warning mt-4">  
                                    <thead>  
                                        <tr>  
                                            <th scope="col">Mois</th>  
                                            <th scope="col" colspan="2">Circuits inter-états</th>  
                                            <th scope="col" colspan="2">Circuits internes</th>  
                                            <th scope="col" colspan="2">Excursions</th>  
                                            <th scope="col">#</th>  
                                        </tr>  
                                        <tr>  
                                            <th scope="col">#</th>  
                                            <th scope="col">Nombre de circuits</th>  
                                            <th scope="col">Nombre de touristes</th>  
                                            <th scope="col">Nombre de circuits</th>  
                                            <th scope="col">Nombre de touristes</th>  
                                            <th scope="col">Nombre d'Excursions</th>  
                                            <th scope="col">Nombre d'Excursionniste</th>  
                                            <th scope="col">#</th>  
                                        </tr>  
                                    </thead>  
                                    <tbody>  
                                        @foreach($vactivite as $vactivite)  
                                        <tr>  
                                            <th scope="row">{{ $vactivite->mois }}</th>  
                                            <td>{{ $vactivite->total_circuits_etats }}</td>  
                                            <td>{{ $vactivite->total_touristes_etats }}</td>  
                                            <td>{{ $vactivite->total_circuits_internes }}</td>  
                                            <td>{{ $vactivite->total_touristes_internes }}</td>  
                                            <td>{{ $vactivite->total_excursions }}</td>  
                                            <td>{{ $vactivite->total_excursionnistes }}</td>  
                                            <td>{{ $vactivite->mois }}</td>  
                                        </tr>  
                                        @endforeach  
                                    </tbody>  
                                </table>   
                                {{-- {{ $vactivite->links() }} --}}  
                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
@endsection
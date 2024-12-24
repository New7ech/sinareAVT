@extends('layouts.app')
@section('contenus')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">  

    <style>  
        body {  
            /(*) Uncomment the background image if necessary (*)/  
            /(*) background-image: url('{{ asset('assets/img/fleuve.jpg')}}'); (*)/  
            background-size: cover;  
            background-position: center;  
            color: #fff;  
        }  
        button{
            border: none;
            background-color: #ffffff00
        }
        .dashboard {  
            padding: 20px;  
            backdrop-filter: blur(10px);  
        }  
        .card {  
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);  
            transition: transform 0.3s ease, box-shadow 0.3s ease;  
            border-radius: 15px;  
            overflow: hidden;  
        }  
        .card:hover {  
            transform: translateY(-5px);  
            box-shadow: 0 12px 24px rgba(0,0,0,0.8);  
        }  
        .card-img-top {  
            height: 200px;  
            object-fit: cover;  
            border-top-left-radius: 15px;  
            border-top-right-radius: 15px;  
        }  
        .card-body {  
            background: rgba(0, 0, 0, 0.5);  
            border-radius: 0 0 15px 15px;  
            padding: 15px;  
        }  
        .btn-custom {  
            font-weight: bold;  
            border-radius: 25px;  
            padding: 10px 20px;  
            transition: background-color 0.3s;  
        }  
        .btn-custom:hover {  
            background-color: rgba(255, 255, 255, 0.2); /(*) Lightening effect (*)/  
        }  
        h2 {  
            font-size: 1.5rem;  
            margin-top: 15px;  
        }  
        .modal-header {  
            background-color: #fdfdfd2e;  
            color: #ff0000;  
            border-top-left-radius: 15px;  
            border-top-right-radius: 15px;  
        }  
    </style> 
    <div class="container dashboard">
        
        <div class="row">
            <div class="col-md-6">
                {{-- {{ $formulairebar->barometres}} --}}
                <button data-bs-toggle="modal" data-bs-target="#barometre">
                    <div class="card animate__animated animate__fadeInUp">
                        <img class="card-img-top" src="{{ asset('assets/img/barometre.jpg')}}" alt="barometres">
                        <div class="status-icon">  
                            <i class="fas {{ $formulairebar->barometres != null ? 'fa-check-circle' : 'fa-times-circle' }}" style="color: {{ $formulairebar->barometres != null ? 'green' : 'red' }}; font-size: 24px;"></i>  
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Barometre trimestriel</h5>
                        </div>
                    </div>
                </button>
            </div>
           
        </div>
        
    </div>

    <div class="modal fade" id="barometre" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">  
        <div class="modal-dialog modal-lg" role="document">  
            <div class="modal-content">  
                <div class="modal-header">  
                    <h5 class="modal-title" style="color: rgb(0, 0, 0);">Ajouter un Nouveau Circuit</h5>  
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">  
                        <span aria-hidden="true">&times;</span>  
                    </button>  
                </div>  
                <div class="modal-body">  
                    <form class="modal-form row g-3 needs-validation" action="{{ route('barometres.store') }}" method="post" novalidate>  
                        @csrf
                        <input type="hidden" name="formulairebars_id" value="{{ $formulairebar->id }}">  
                        <h2 style="color: rgb(0, 0, 0);">RESULTAT D’EXPLOITATION</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <br/>
                                <h4 class="text-center" style="color: rgb(0, 0, 0);">Billetterie <span class="text-danger">(*)</span></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="form-group form-group-default">
                                        <label>Nombre</label>
                                        <input id="billetterie_nombre" name="billetterie_nombre" type="text" class="form-control" placeholder="Nombre" value="{{ $formulairebar->barometres?->billetterie_nombre }}" required />
                                        <div class="invalid-feedback">{{ $errors->first('billetterie_nombre') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="form-group form-group-default">
                                        <label>Chiffre d'affaires</label>
                                        <input id="billetterie_ca" name="billetterie_ca" type="text" class="form-control" placeholder="Chiffre d'affaires" value="{{ $formulairebar->barometres?->billetterie_ca }}" required />
                                        <div class="invalid-feedback">{{ $errors->first('billetterie_ca') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <br/>
                                <h4 class="text-center" style="color: rgb(0, 0, 0);">Circuits <span class="text-danger">(*)</span></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="form-group form-group-default">
                                        <label>Nombre</label>
                                        <input id="circuit_nombre" name="circuit_nombre" type="text" class="form-control" placeholder="Nombre" value="{{ $formulairebar->barometres?->circuit_nombre }}" required />
                                        <div class="invalid-feedback">{{ $errors->first('circuit_nombre') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <div class="form-group form-group-default">
                                        <label>Chiffre d'affaires</label>
                                        <input id="circuit_ca" name="circuit_ca" type="text" class="form-control" placeholder="Chiffre d'affaires" value="{{ $formulairebar->barometres?->circuit_ca }}" required />
                                        <div class="invalid-feedback">{{ $errors->first('circuit_ca') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <br/>
                                <h4 class="text-center" style="color: rgb(0, 0, 0);">Activités connexes <span class="text-danger">(*)</span></h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="form-group form-group-default">
                                        <label>Chiffre d'affaires</label>
                                        <input id="activites_connexes_ca" name="activites_connexes_ca" type="text" class="form-control" placeholder="Chiffre d'affaires" value="{{ $formulairebar->barometres?->activites_connexes_ca }}" required />
                                        <div class="invalid-feedback">{{ $errors->first('activites_connexes_ca') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <h4 class="card-title"  style="color: rgb(0, 0, 0);">PREVISIONS POUR LE 1er TRIMESTRE SUIVANTE</h4>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label">Le climat des affaires <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="prevision_climat_affaires"
                                        id="prevision_climat_affaires"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->prevision_climat_affaires }}" disabled selected hidden>{{ $formulairebar->barometres?->prevision_climat_affaires ?: 'Sélectionnez'}}</option>
                                            <option value="Amélioration" {{ old('prevision_climat_affaires') == 'Amélioration' ? 'selected' : '' }}>Amélioration</option>
                                            <option value="Stabilité" {{ old('prevision_climat_affaires') == 'Stabilité' ? 'selected' : '' }}>Stabilité</option>
                                            <option value="Dégradation" {{ old('prevision_climat_affaires') == 'Dégradation' ? 'selected' : '' }}>Dégradation</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('prevision_climat_affaires') }}</div>
                                    </div>
                                    <label class="col-sm-5 col-form-label">Le chiffre d’affaires global <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="prevision_ca_global"
                                        id="prevision_ca_global"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->prevision_ca_global }}" disabled selected hidden>{{ $formulairebar->barometres?->prevision_ca_global ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('prevision_ca_global') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('prevision_ca_global') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('prevision_ca_global') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('prevision_ca_global') }}</div>
                                    </div>
                                    <label class="col-sm-5 col-form-label">Le nombre des emplois <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="prevision_emplois"
                                        id="prevision_emplois"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->prevision_emplois }}" disabled selected hidden>{{ $formulairebar->barometres?->prevision_emplois ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('prevision_emplois') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('prevision_emplois') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('prevision_emplois') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('prevision_emplois') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 grid-margin stretch-card">
                                <h4 class="card-title" style="color: rgb(0, 0, 0);">SONDAGE D’OPINIONS SUR LE RESULTAT </h4>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label">Climat des affaires <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="sondage_climat_affaires"
                                        id="sondage_climat_affaires"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_climat_affaires }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_climat_affaires ?: 'Sélectionnez'}}</option>
                                            <option value="Très bon" {{ old('sondage_climat_affaires') == 'Très bon' ? 'selected' : '' }}>Très bon</option>
                                            <option value="Bon" {{ old('sondage_climat_affaires') == 'Bon' ? 'selected' : '' }}>Bon</option>
                                            <option value="Passable" {{ old('sondage_climat_affaires') == 'Passable' ? 'selected' : '' }}>Passable</option>
                                            <option value="Mauvais" {{ old('sondage_climat_affaires') == 'Mauvais' ? 'selected' : '' }}>Mauvais</option>
                                            <option value="Très mauvais" {{ old('sondage_climat_affaires') == 'Très mauvais' ? 'selected' : '' }}>Très mauvais</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_climat_affaires') }}</div>
                                    </div>
                                    <label class="col-sm-5 col-form-label">Nombre de billets vendus <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="sondage_nombre_billets"
                                        id="sondage_nombre_billets"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_nombre_billets }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_nombre_billets ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('sondage_nombre_billets') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('sondage_nombre_billets') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('sondage_nombre_billets') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_nombre_billets') }}</div>
                                    </div>
                                    <label class="col-sm-5 col-form-label">Chiffre d’aff billetterie <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                        name="sondage_ca_billetterie"
                                        id="sondage_ca_billetterie"
                                        class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_ca_billetterie }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_ca_billetterie ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('sondage_ca_billetterie') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('sondage_ca_billetterie') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('sondage_ca_billetterie') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_ca_billetterie') }}</div>
                                    </div>

                                    <label class="col-sm-5 col-form-label">Nombre de circuits réalisés <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                            name="sondage_nombre_circuits"
                                            id="sondage_nombre_circuits"
                                            class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_nombre_circuits }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_nombre_circuits ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('sondage_nombre_circuits') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('sondage_nombre_circuits') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('sondage_nombre_circuits') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_nombre_circuits') }}</div>
                                    </div>

                                    <label class="col-sm-5 col-form-label">Chiffres d’aff des circuits <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                            name="sondage_ca_circuits"
                                            id="sondage_ca_circuits"
                                            class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_ca_circuits }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_ca_circuits ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('sondage_ca_circuits') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('sondage_ca_circuits') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('sondage_ca_circuits') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_ca_circuits') }}</div>
                                    </div>

                                    <label class="col-sm-5 col-form-label">Nombre d’emplois <span class="text-danger">(*)</span></label>
                                    <div class="col-sm-7">
                                        <select
                                            name="sondage_nombre_emplois"
                                            id="sondage_nombre_emplois"
                                            class="form-select" required>
                                            <option value="{{ $formulairebar->barometres?->sondage_nombre_emplois }}" disabled selected hidden>{{ $formulairebar->barometres?->sondage_nombre_emplois ?: 'Sélectionnez'}}</option>
                                            <option value="Hausse" {{ old('sondage_nombre_emplois') == 'Hausse' ? 'selected' : '' }}>Hausse</option>
                                            <option value="Stable" {{ old('sondage_nombre_emplois') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                            <option value="Baisse" {{ old('sondage_nombre_emplois') == 'Baisse' ? 'selected' : '' }}>Baisse</option>
                                        </select>
                                        <div class="invalid-feedback">{{ $errors->first('sondage_nombre_emplois') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card-title" style="color: rgb(0, 0, 0);">FACTEURS DETERMINANTS DU MARCHE</div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="facteurs_positifs">Eléments qui ont influencés positivement le marché <span class="text-danger">(*)</span></label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    id="facteurs_positifs"
                                    name="facteurs_positifs"
                                    value="{{ $formulairebar->barometres?->facteurs_positifs }}"
                                    placeholder="influencés positivement"
                                    required
                                />
                                <div class="invalid-feedback">{{ $errors->first('facteurs_positifs') }}</div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="facteurs_negatifs">Eléments qui ont influencés négativement le marché <span class="text-danger">(*)</span></label>
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    id="facteurs_negatifs"
                                    name="facteurs_negatifs"
                                    value="{{ $formulairebar->barometres?->facteurs_negatifs }}"
                                    placeholder="influencés négativement"
                                    required
                                />
                                <div class="invalid-feedback">{{ $errors->first('facteurs_negatifs') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">  
                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Enregistrer</button>  
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>  
                        </div>  
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  
    <script>
        document.addEventListener("DOMContentLoaded", function() {  
            // Sélectionnez tous les formulaires dans les modales  
            const forms = document.querySelectorAll(".modal-form");  
        
            forms.forEach(form => {  
                const modalElementId = form.closest('.modal').id;  
                const modal = new bootstrap.Modal(document.getElementById(modalElementId));  
        
                form.addEventListener('submit', function(event) {  
                    // Effacez toutes les erreurs de validation affichées  
                    const inputs = form.querySelectorAll('input, textarea, select');  
                    let hasErrors = false;  
        
                    inputs.forEach(input => {  
                        // Vérifiez si l'input est requis et si le champ est vide  
                        if (input.required && !input.value) {  
                            input.classList.add('is-invalid'); // Ajoute la classe d'erreur  
                            hasErrors = true;  
                        } else {  
                            input.classList.remove('is-invalid'); // Enlève la classe d'erreur si valide  
                        }  
                    });  
        
                    // Si des erreurs sont présentes, empêchez la soumission du formulaire  
                    if (hasErrors) {  
                        event.preventDefault();  
                        modal.show(); // Montre la modale si elle a des erreurs  
                        alert("Veuillez corriger les erreurs avant de soumettre le formulaire."); // Message d'alerte  
                        return false;  
                    }  
                });  
            });  
        });
    </script> 
@endsection

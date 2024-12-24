@extends('layouts.app')  

@section('contenus')  

    <style>  
        body {  
            background-color: #f8f9fa;  
        }  
    </style>  

    <div class="container mt-5">  
        <h1 class="mb-4">Créer un Utilisateur</h1>  

        <form action="{{ route('users.store') }}" method="POST">  
            @csrf  

            <div class="form-group">  
                <label for="name">Nom</label>  
                <input type="text" name="name" id="name" class="form-control" required autofocus>  
            </div>  

            <div class="form-group">  
                <label for="email">Email</label>  
                <input type="email" name="email" id="email" class="form-control" required>  
            </div>  

            <div class="form-group">  
                <label for="password">Mot de passe</label>  
                <input type="password" name="password" id="password" class="form-control" required>  
            </div>  

            <div class="form-group">  
                <label for="password_confirmation">Confirmer le Mot de passe</label>  
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>  
            </div>  

            <div class="form-group">  
                <label for="compagnie_id">Compagnie:</label>  
                <select id="compagnie_id" name="compagnie_id" class="form-control" required>  
                    <option value="">Sélectionnez une compagnie</option>  
                    @foreach ($compagnies as $compagnie)  
                        <option value="{{ $compagnie->id }}">{{ $compagnie->denomination }}</option>  
                    @endforeach  
                </select>  
            </div>  

            <div class="form-group">  
                <label>Assignation des Rôles</label>  
                <div class="d-flex flex-wrap">  
                    @foreach ($roles as $role)  
                        <div class="form-check me-3 mb-2">  
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->name }}" class="form-check-input">  
                            <label for="role-{{ $role->name }}" class="form-check-label">{{ $role->name }}</label>  
                        </div>  
                    @endforeach  
                </div>  
            </div>  

            <button type="submit" class="btn btn-primary">Enregistrer</button>  
        </form>  

    </div>  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>  

@endsection
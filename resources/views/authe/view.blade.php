@extends('layouts.app')

@section('contenus')

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obstour</title>
    <!-- Inclusion de Bootstrap CSS via CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1>Détails</h1>

        <div class="card mb-4">
            <div class="card-body">
                {{-- <p><strong>ID:</strong> {{ $user->id }}</p> --}}
                <p><strong>Nom:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Compagnie:</strong> {{ $user->compagnie->denomination ?? 'Aucune' }}</p>
            </div>
        </div>
    </div>

    <!-- Inclusion de Bootstrap JS via CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
@endsection

<!DOCTYPE html>  
<html>  
<head>  
    <title>Baromètre PDF</title>  
</head>  
<body>  
    <h1>Baromètre pour la Compagnie: {{ $barometre->compagnie->denomination }}</h1>  
    <p>Trimestre: {{ $barometre->formulairebars_id }}</p>  
    <p>Billetterie Nombre: {{ $barometre->billetterie_nombre }}</p>  
    <p>Billetterie CA: {{ $barometre->billetterie_ca }}</p>  
    <p>Circuit Nombre: {{ $barometre->circuit_nombre }}</p>  
    <p>Circuit CA: {{ $barometre->circuit_ca }}</p>  
</body>  
</html>
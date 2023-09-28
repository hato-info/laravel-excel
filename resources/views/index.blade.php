<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
@if(session('success'))
<p class="alert alert-success">{{session('success')}}</p>
@endif

<h3>Importer</h3>

<p>Sélectionnez un fichier Excel (.xlsx) pour importer les données dans la table "clients".<br><strong>Les colonnes : </strong>name, email, phone, address</p>

<form method="POST" action="{{ route('excel.import') }}" enctype="multipart/form-data" >

    <!-- CSRF Token -->
    @csrf

    <input type="file" name="fichier" >

    <button type="submit" >Importer</button>

</form>
</body>
</html>
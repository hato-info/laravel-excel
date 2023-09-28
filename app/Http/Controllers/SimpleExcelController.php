<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\SimpleExcel\SimpleExcelReader;
use Illuminate\Support\Facades\File;

class SimpleExcelController extends Controller
{

    public function index()
    {
        return view('index');
    }
    
 // Importer les données
 public function import (Request $request) {

    // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
    $this->validate($request, [
        'fichier' => 'bail|required|file|mimes:xlsx'
    ]);

    // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
    $fichier = $request->fichier->move(public_path('Excel'), $request->fichier->hashName());

    // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
    $reader = SimpleExcelReader::create($fichier);

    // On récupère le contenu (les lignes) du fichier
    $rows = $reader->getRows();

    // $rows est une Illuminate\Support\LazyCollection

    // 4. On insère toutes les lignes dans la base de données
    $status = Client::insert($rows->toArray());


    // Si toutes les lignes sont insérées
    if ($status) {
           
        // 5. On supprime le fichier uploadé
        $reader->close(); // On ferme le $reader

        $dossier = public_path().'/Excel/';
        File::deleteDirectory($dossier);
        
    //     File::delete($fichier);
    //     dd($fichier);
    //    // unlink($fichier);

        // 6. Retour vers le formulaire avec un message $msg
        return back()->with('success', 'Importation réussie !');

    } else { abort(500); }
}
}

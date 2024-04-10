<?php

// app/Http/Controllers/RendezvousController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RendezvousController extends Controller
{
    public function envoyerRendezvous(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'naissance' => 'required|date',
        ]);

        // Enregistrez les données dans la base de données
        DB::table('rdv')->insert([
            'Nom' => $request->nom,
            'Prenom' => $request->prenom,
            'email' => $request->email,
            'Message' => $request->message,
            'Naissance' => $request->naissance,
        ]);

        // Introduire un délai (par exemple, 3 secondes)
        sleep(3);

        // Envoyer un e-mail via Formspree
        $this->envoyerMailFormspree($request->nom, $request->prenom, $request->email, $request->message, $request->naissance);

        // Répondre avec une réponse JSON (peut être étendu selon les besoins)
        return response()->json(['message' => 'Rendez-vous enregistré avec succès']);
    }

    private function envoyerMailFormspree($nom, $email, $message)
    {
        $response = Http::post('https://formspree.io/f/xaygrgnp', [
            'Nom' => $nom,
            'Prenom' => $prenom,
            'email' => $email,
            'naissance' => $naissance,
            'Message' => $message,
        ]);

        // Vérifiez la réponse si nécessaire
        // $response->status(); 

        // Vous pouvez également ajouter des vérifications supplémentaires ici si nécessaire
    }
}
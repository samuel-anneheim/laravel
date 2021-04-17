<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Afficher la liste des annonces
     */
    public function index()
    {
        // ATTENTION use Illuminate\Support\Facades\DB;
        // $properties = DB::select('select * from properties where sold = :sold', [
        //     'sold' => 0,
        // ]);

        // Si on ne veut plus écrire de SQL...
        $properties = DB::table('properties')
            ->where('sold', 0)->where('sold', '=', 1, 'or')->get();
        // WHERE sold = 0 OR sold = 1

        return view('properties/index', [
            'properties' => $properties,
        ]);
    }

    /**
     * Affiche une annonce
     */
    public function show($id)
    {
        $property = DB::table('properties')->where('id', $id)->first();
        //  DB::table('properties)->find($id)

        if (!$property) {
            abort(404); // on renvoie une page 404
        }

        return view('properties/show', [
            'properties' => $property,
        ]);
    }

    /**
     * Forumulaire pour créer une annonce
     */
    public function create()
    {
        return view('properties/create');
    }

    /**
     * Enregistre l'annonce dans la BDD
     */
    public function store(Request $request)
    {
        // traitement du formulaire
        $request->validate([
            'title' => 'required|string|unique:properties|min:2|max:255',
            'description' => 'required|string|min:15',
            'price' => 'required|integer|gt:0'
        ]);

        DB::table('properties')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->filled('sold'),
            'created_at' =>  now(),
            'updated_at' =>  now(),
        ]);

        // Upload...
        $request->image->storeAs(
            'public/annonces',DB::getPdo()->lastInsertId() . '.' . $request->image->extension()
        );

        // DB::table('properties')->insert(
        //     $request->all('title', 'description', 'price') + ['sold' => $request->filled('sold)]
        // );

        return redirect('/nos-annonces')->withInput();
    }

    /**
     * Formulaire pour éditer une annonce
     */
    public function edit($id)
    {
        $property = DB::table('properties')->find($id);

        if (!$property) {
            abort(404); // on renvoie une page 404
        }

        return view('properties/edit', ['property' => $property]);
    }

    /**
     * Modifier une annonce dans la BDD
     */
    public function update(Request $request, $id)
    {
        // Dans la règle de validation unique, on précise que le title dans properties
        // doit être unique et on exclut l'id de l'annonce actuelle pour éviter que Laravel
        // pense que le titre est un doublon.
        $request->validate([
            'title' => 'required|string|unique:properties,title,' . $id . '|min:2',
            'description' => 'required|string|min:15',
            'price' => 'required|integer|gt:0',
        ]);

        DB::table('properties')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'sold' => $request->filled('sold'),
            'updated_at' => now(),
        ]);

        return redirect('/nos-annonces')
            ->with('message', 'Annonce mise à jour.');
    }

    /**
     * Supprimer l'annonce dans la BDD
     */
    public function destroy($id)
    {
        DB::table('properties')->delete($id);

        return redirect('/nos-annonces')
            ->with('message', 'Annonce supprimée.');
    }
}

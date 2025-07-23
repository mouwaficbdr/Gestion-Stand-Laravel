<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Afficher le formulaire d'inscription entrepreneur
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Traiter l'inscription entrepreneur
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'nom_entreprise' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nom_stand' => 'required|string|max:255',
            'description' => 'required|string',
        ], [
            'nom.required' => 'Le nom est obligatoire.',
            'nom_entreprise.required' => 'Le nom de l\'entreprise est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'nom_stand.required' => 'Le nom du stand est obligatoire.',
            'description.required' => 'La description est obligatoire.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Créer l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'nom_entreprise' => $request->nom_entreprise,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'entrepreneur_en_attente',
        ]);

        // Créer le stand associé
        Stand::create([
            'nom_stand' => $request->nom_stand,
            'description' => $request->description,
            'utilisateur_id' => $user->id,
        ]);

        return redirect()->route('login')
            ->with('success', 'Votre demande a été soumise avec succès. Vous recevrez une confirmation par email une fois votre demande approuvée.');
    }
}

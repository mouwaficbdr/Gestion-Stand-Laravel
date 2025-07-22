<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware ApprovedEntrepreneurMiddleware
 *
 * Permet de restreindre l'accès aux routes réservées aux entrepreneurs approuvés.
 */
class ApprovedEntrepreneurMiddleware
{
    /**
     * Intercepte la requête et vérifie si l'utilisateur est un entrepreneur approuvé.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie que l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Si l'utilisateur est en attente, redirige vers la page d'attente
        if ($user->isPending()) {
            return redirect()->route('entrepreneur.pending');
        }

        // Si l'utilisateur n'est pas approuvé, accès refusé
        if (!$user->isApprovedEntrepreneur()) {
            return redirect()->route('login')->with('error', 'Accès non autorisé.');
        }

        return $next($request);
    }
}

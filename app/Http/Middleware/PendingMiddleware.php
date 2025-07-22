<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware PendingMiddleware
 *
 * Permet de restreindre l'accès aux routes réservées aux entrepreneurs en attente d'approbation.
 */
class PendingMiddleware
{
    /**
     * Intercepte la requête et vérifie si l'utilisateur est en attente.
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

        // Si l'utilisateur n'est pas en attente, redirige selon son rôle
        if (!$user->isPending()) {
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isApprovedEntrepreneur()) {
                return redirect()->route('entrepreneur.dashboard');
            }
        }

        return $next($request);
    }
}

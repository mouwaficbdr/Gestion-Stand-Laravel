<!-- Footer -->
<footer class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold text-orange-400 mb-4">
                    Eat&Drink</h3>
                <p class="text-gray-300 mb-4">
                    La plateforme de référence pour découvrir les meilleurs stands culinaires et rencontrer des
                    entrepreneurs passionnés.
                </p>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-orange-400">Accueil</a>
                    </li>
                    <li><a href="{{ route('stands.index') }}"
                            class="text-gray-300 hover:text-orange-400">Stands</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-orange-400">À propos</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-gray-300">
                    <li>Email: contact@eatdrink.com</li>
                    <li>Tél: +33 1 23 45 67 89</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Eat&Drink. Tous droits réservés.</p>
        </div>
    </div>
</footer>
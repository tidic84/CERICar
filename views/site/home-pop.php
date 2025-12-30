<?php
/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "VoyaGo! - Covoiturage Nouvelle Génération";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen font-sans text-black bg-white selection:bg-purple-300 selection:text-purple-900">

<?= $this->render("/layouts/_navbar") ?>

<!-- Hero Section -->
<div class="pt-32 pb-20 bg-yellow-50 min-h-screen flex flex-col items-center relative overflow-hidden">
    <!-- Background patterns -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-purple-400 rounded-full border-2 border-black opacity-50 blur-sm"></div>
    <div class="absolute bottom-40 right-10 w-32 h-32 bg-green-400 rounded-full border-2 border-black opacity-50 blur-sm"></div>
    <div class="absolute top-40 right-1/4 w-12 h-12 bg-blue-400 rotate-45 border-2 border-black opacity-60"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="text-center max-w-4xl mx-auto mb-12">
            <div class="inline-block mb-6 transform rotate-2">
                <span class="bg-orange-400 text-white px-3 py-1 rounded-full border-2 border-black text-xs font-black uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    Nouveau !
                </span>
            </div>
            <h1 class="text-6xl md:text-8xl font-black leading-[0.9] mb-8 tracking-tight">
                VOYAGEZ<br/>
                <span class="text-purple-600 bg-white px-4 border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 inline-block mx-2">MIEUX</span>
                ET<br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-500 to-orange-600">ENSEMBLE.</span>
            </h1>
            <p class="text-xl font-bold text-gray-700 max-w-2xl mx-auto">
                Le covoiturage qui a du peps. Économisez de l'argent, rencontrez des gens sympas et sauvez la planète, le tout avec le sourire.
            </p>
        </div>

        <!-- Search Box "Ticket" -->
        <div class="bg-white border-2 border-black rounded-3xl p-6 md:p-8 max-w-5xl mx-auto shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] transform hover:-translate-y-1 transition-transform duration-300">
            <?= Html::beginForm(["/site/recherche"], "get", [
                "class" => "grid md:grid-cols-4 gap-6",
            ]) ?>
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Départ
                    </label>
                    <?= Html::textInput("depart", "", [
                        "placeholder" => "Ex: Paris",
                        "class" =>
                            "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors",
                    ]) ?>
                </div>

                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Arrivée
                    </label>
                    <?= Html::textInput("arrivee", "", [
                        "placeholder" => "Ex: Toulouse",
                        "class" =>
                            "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors",
                    ]) ?>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date
                        </label>
                        <?= Html::input("date", "date", "", [
                            "class" =>
                                "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-2 py-3 font-bold outline-none text-sm",
                        ]) ?>
                    </div>
                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Pers.
                        </label>
                        <?= Html::dropDownList(
                            "personnes",
                            1,
                            [1 => "1", 2 => "2", 3 => "3", 4 => "4"],
                            [
                                "class" =>
                                    "w-full bg-gray-100 border-2 border-transparent focus:border-black focus:bg-white rounded-xl px-2 py-3 font-bold outline-none",
                            ],
                        ) ?>
                    </div>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full font-bold border-2 border-black rounded-xl px-6 py-3 bg-yellow-400 text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-yellow-300 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all flex items-center justify-center gap-2 h-[52px] text-lg">
                        <svg class="w-6 h-6 border-2 border-black rounded-full bg-white p-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        C'est parti !
                    </button>
                </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<!-- Popular Trips Section -->
<section class="py-20 bg-white border-t-2 border-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <h2 class="text-4xl font-black uppercase italic">
                Top des trajets <span class="text-purple-600 bg-yellow-300 px-2">du moment</span>
            </h2>
            <button class="font-bold border-2 border-black rounded-xl px-6 py-3 bg-white text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-50 active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                Voir tout
            </button>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Trip Card 1 -->
            <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group">
                <div class="h-24 rounded-xl border-2 border-black bg-blue-300 mb-4 relative overflow-hidden flex items-center justify-center">
                    <div class="opacity-20 font-black text-6xl text-black transform -rotate-12 absolute scale-150 select-none">GO!</div>
                </div>

                <div class="flex justify-between items-start mb-4">
                    <div>
                        <div class="font-bold text-lg flex items-center gap-2">
                            Paris
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Lille
                        </div>
                        <div class="text-sm font-medium text-gray-500">Aujourd'hui, 14h30</div>
                    </div>
                    <div class="bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2 group-hover:rotate-6 transition-transform">
                        18€
                    </div>
                </div>

                <div class="flex items-center gap-3 border-t-2 border-gray-100 pt-3">
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026024d" alt="Sophie" class="w-10 h-10 rounded-full border-2 border-black bg-gray-200" />
                    <div class="text-sm">
                        <div class="font-bold">Sophie</div>
                        <div class="flex items-center text-xs font-bold text-yellow-500">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            5.0
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trip Card 2 -->
            <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group">
                <div class="h-24 rounded-xl border-2 border-black bg-pink-300 mb-4 relative overflow-hidden flex items-center justify-center">
                    <div class="opacity-20 font-black text-6xl text-black transform -rotate-12 absolute scale-150 select-none">GO!</div>
                </div>

                <div class="flex justify-between items-start mb-4">
                    <div>
                        <div class="font-bold text-lg flex items-center gap-2">
                            Lyon
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Marseille
                        </div>
                        <div class="text-sm font-medium text-gray-500">Demain, 09h00</div>
                    </div>
                    <div class="bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2 group-hover:rotate-6 transition-transform">
                        24€
                    </div>
                </div>

                <div class="flex items-center gap-3 border-t-2 border-gray-100 pt-3">
                    <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="Karim" class="w-10 h-10 rounded-full border-2 border-black bg-gray-200" />
                    <div class="text-sm">
                        <div class="font-bold">Karim</div>
                        <div class="flex items-center text-xs font-bold text-yellow-500">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            5.0
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trip Card 3 -->
            <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group">
                <div class="h-24 rounded-xl border-2 border-black bg-green-300 mb-4 relative overflow-hidden flex items-center justify-center">
                    <div class="opacity-20 font-black text-6xl text-black transform -rotate-12 absolute scale-150 select-none">GO!</div>
                </div>

                <div class="flex justify-between items-start mb-4">
                    <div>
                        <div class="font-bold text-lg flex items-center gap-2">
                            Nantes
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            Rennes
                        </div>
                        <div class="text-sm font-medium text-gray-500">Aujourd'hui, 18h00</div>
                    </div>
                    <div class="bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2 group-hover:rotate-6 transition-transform">
                        12€
                    </div>
                </div>

                <div class="flex items-center gap-3 border-t-2 border-gray-100 pt-3">
                    <img src="https://i.pravatar.cc/150?u=a04258114e29026302d" alt="Julie" class="w-10 h-10 rounded-full border-2 border-black bg-gray-200" />
                    <div class="text-sm">
                        <div class="font-bold">Julie</div>
                        <div class="flex items-center text-xs font-bold text-yellow-500">
                            <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            5.0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vibe Section -->
<section class="py-20 bg-purple-600 border-y-2 border-black">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div class="text-white space-y-6">
            <span class="bg-yellow-400 text-black px-3 py-1 rounded-full border-2 border-black text-xs font-black uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] inline-block">
                Vibe Check
            </span>
            <h2 class="text-5xl font-black leading-tight">
                PAS JUSTE UN TRAJET,<br/>UNE EXPERIENCE.
            </h2>
            <p class="text-xl font-medium opacity-90">
                Choisissez votre ambiance. Plutôt discussion animée, playlist karaoké ou silence zen ? Avec VoyaGo, vous savez à quoi vous attendre avant de monter.
            </p>
            <div class="flex flex-wrap gap-4 mt-8">
                <div class="bg-black/20 border-2 border-white/30 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-8 h-8 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-bold">Super Sympa</span>
                </div>
                <div class="bg-black/20 border-2 border-white/30 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-8 h-8 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                    <span class="font-bold">DJs amateurs</span>
                </div>
                <div class="bg-black/20 border-2 border-white/30 rounded-xl p-4 flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="font-bold">Rapide</span>
                </div>
            </div>
        </div>

        <div class="relative">
            <!-- Illustration Abstract Card -->
            <div class="bg-white border-2 border-black rounded-[2.5rem] p-8 shadow-[16px_16px_0px_0px_rgba(0,0,0,1)] rotate-2 hover:rotate-0 transition-transform duration-500">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-full bg-gray-200 border-2 border-black overflow-hidden">
                        <img src="https://i.pravatar.cc/150?u=a042581f4e29026024d" alt="User" />
                    </div>
                    <div>
                        <div class="font-black text-xl">Léa D.</div>
                        <div class="text-purple-600 font-bold">Conductrice Gold</div>
                    </div>
                    <svg class="ml-auto w-8 h-8 text-red-500 fill-current animate-pulse" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <p class="text-2xl font-bold leading-relaxed">
                    "J'adore prendre des passagers pour aller en festival ! La route passe super vite et on partage nos meilleures playlists."
                </p>
                <div class="mt-6 flex justify-between items-end">
                    <div class="text-sm font-bold text-gray-400">Il y a 2 heures</div>
                    <div class="flex text-yellow-500">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-black text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2">
                <h2 class="text-4xl font-black italic mb-6">VoyaGo!</h2>
                <p class="text-gray-400 text-lg max-w-sm">
                    Fait avec ❤️, ☕ et beaucoup de code. Rejoignez le mouvement et arrêtez de rouler seul (c'est triste).
                </p>
            </div>

            <div>
                <h4 class="font-black uppercase text-yellow-400 mb-6 tracking-wider">Explorer</h4>
                <ul class="space-y-4 font-bold text-gray-300">
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Trajets</li>
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Assurance</li>
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Événements</li>
                </ul>
            </div>

            <div>
                <h4 class="font-black uppercase text-purple-400 mb-6 tracking-wider">Légal</h4>
                <ul class="space-y-4 font-bold text-gray-300">
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Confidentialité</li>
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Conditions</li>
                    <li class="hover:text-white cursor-pointer hover:translate-x-2 transition-transform">Support</li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 text-center text-gray-500 font-bold">
            © 2024 VoyaGo Inc. - Tous droits réservés.
        </div>
    </div>
</footer>

<script>
// Menu mobile toggle
document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
});
</script>

</body>
</html>

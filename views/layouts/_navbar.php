<?php
/** @var app\models\Internaute|null $currentUser */
/** @var bool $isLoggedIn */
?>
<!-- Navbar -->
<nav class="absolute w-full z-50 border-black py-4">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center grow">
            <!-- Logo -->
            <a class="grow" href="<?= \yii\helpers\Url::to(["/site/index"]) ?>">
                <div class="flex items-center gap-2 ">
                        <div class="bg-purple-600 w-10 h-10 border-2 border-black flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                            <span class="text-4xl text-white font-black">C</span>
                        </div>
                        <span class="text-2xl font-black tracking-tighter -ml-1">ERICar</span>
                </div>
            </a>
            <div class="grow">
            </div>
            <div class="flex gap-4 ml-4">
                <?php if (!$isLoggedIn): ?>
                <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="font-bold border-b-2 border-transparent hover:border-black transition-all duration-300 ease-in my-auto">Connexion</a>
                <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-2 bg-black text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] hover:shadow-[2px_2px_0px_0px_rgba(100,100,100,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150 inline-block">
                    S'inscrire
                </a>
                <?php else: ?>
                    <?php if ($currentUser->permis): ?>
                        <a href="<?= \yii\helpers\Url::to(['/site/proposer-voyage']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-2 bg-green-400 text-black shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] hover:shadow-[2px_2px_0px_0px_rgba(100,100,100,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150 inline-flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            Proposer un voyage
                        </a>
                    <?php endif; ?>
                    <a href="<?= \yii\helpers\Url::to(['/site/mapage']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-2 bg-purple-600 text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] hover:shadow-[2px_2px_0px_0px_rgba(100,100,100,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150 inline-flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        Mon Profil
                    </a>
                    <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post', ['id' => 'logout-form', 'class' => 'inline', 'data-ajax-url' => \yii\helpers\Url::to(['/site/logout-ajax'])]) ?>
                        <button type="submit" class="font-bold border-2 border-black rounded-xl px-6 py-2 bg-red-600 text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] hover:shadow-[2px_2px_0px_0px_rgba(100,100,100,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150">
                            Déconnexion
                        </button>
                    <?= \yii\helpers\Html::endForm() ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Toggle -->
        <button id="mobile-menu-toggle" class="md:hidden">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-yellow-400 border-b-2 border-black p-6 md:hidden flex-col gap-4 shadow-xl">
        <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="text-xl font-black block">Rechercher</a>
        <?php if (!$isLoggedIn): ?>
            <a href="<?= \yii\helpers\Url::to(['/site/login']) ?>" class="text-xl font-black block">Connexion</a>
            <a href="<?= \yii\helpers\Url::to(['/site/register']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-3 bg-black text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] w-full block text-center">
                S'inscrire
            </a>
        <?php else: ?>
            <span class="text-xl font-black block">Bienvenue <?= \yii\helpers\Html::encode($currentUser->prenom) ?></span>
            <?php if ($currentUser->permis): ?>
                <a href="<?= \yii\helpers\Url::to(['/site/proposer-voyage']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-3 bg-green-400 text-black shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] w-full block text-center">
                    + Proposer un voyage
                </a>
            <?php endif; ?>
            <a href="<?= \yii\helpers\Url::to(['/site/mapage']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-3 bg-purple-600 text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] w-full block text-center">
                Mon Profil
            </a>
            <?= \yii\helpers\Html::beginForm(['/site/logout'], 'post', ['id' => 'logout-form-mobile', 'class' => 'w-full', 'data-ajax-url' => \yii\helpers\Url::to(['/site/logout-ajax'])]) ?>
                <button type="submit" class="font-bold border-2 border-black rounded-xl px-6 py-3 bg-red-600 text-white shadow-[4px_4px_0px_0px_rgba(100,100,100,1)] w-full block text-center">
                    Déconnexion
                </button>
            <?= \yii\helpers\Html::endForm() ?>
        <?php endif; ?>
    </div>
</nav>

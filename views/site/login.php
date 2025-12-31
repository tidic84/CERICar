<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "CERICar - Connexion";
?>

<div class="site-login min-h-screen flex items-center justify-center py-20 px-6">
    <!-- Background patterns -->
    <img class="absolute top-20 left-1/4 w-40 rotate-45 opacity-30" src="<?= Url::to('@web/images/polygon-3d.svg') ?>"></img>
    <img class="absolute top-80 right-40 w-60 opacity-20" src="<?= Url::to('@web/images/circle-shadow.svg') ?>"></img>
    <img class="absolute bottom-40 right-10 opacity-30" src="<?= Url::to('@web/images/circle-3d.svg') ?>"></img>
    <img class="absolute bottom-20 left-1/4 opacity-20" src="<?= Url::to('@web/images/cube-3d.svg') ?>"></img>

    <div class="relative z-10 w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block mb-4 transform rotate-2">
                <span class="bg-yellow-400 text-black px-4 py-2 rounded-full border-2 border-black text-sm font-black uppercase tracking-wider shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    Bon retour !
                </span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4">
                <span class="text-purple-600 bg-white px-4 border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform -rotate-2 inline-block mx-2 pb-2">CONNEXION</span>
            </h1>
            <p class="text-lg font-bold text-gray-700 max-w-xl mx-auto">
                Connectez-vous pour accéder à votre espace personnel
            </p>
        </div>

        <!-- Formulaire de connexion -->
        <div class="bg-white border-2 border-black rounded-3xl p-8 md:p-10 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            <?= Html::beginForm(['site/login-submit'], 'get', [
                'id' => 'login-form',
                'class' => 'space-y-6',
                'data-ajax-url' => Url::to(['site/login-submit'])
            ]) ?>

                <!-- Email ou Pseudo -->
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        Email ou Pseudo
                    </label>
                    <?= Html::textInput('identifiant', '', [
                        'placeholder' => 'votre@email.com ou pseudo',
                        'required' => true,
                        'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                    ]) ?>
                </div>

                <!-- Mot de passe -->
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                        Mot de passe
                    </label>
                    <?= Html::input('password', 'password', '', [
                        'placeholder' => '••••••••',
                        'required' => true,
                        'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                    ]) ?>
                </div>

                <!-- Se souvenir de moi -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <?= Html::checkbox('remember', false, [
                            'class' => 'w-5 h-5 border-2 border-black rounded accent-purple-600 cursor-pointer',
                            'id' => 'remember'
                        ]) ?>
                        <span class="font-bold text-sm group-hover:text-purple-600 transition-colors">
                            Se souvenir de moi
                        </span>
                    </label>

                    <a href="<?= Url::to(['/site/forgot-password']) ?>" class="text-sm font-bold text-purple-600 hover:underline">
                        Mot de passe oublié ?
                    </a>
                </div>

                <!-- Bouton Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full font-bold border-2 border-black rounded-xl px-6 py-4 bg-yellow-400 text-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-yellow-300 hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150 flex items-center justify-center gap-2 text-lg">
                        <i data-lucide="log-in"></i>
                        Se connecter
                    </button>
                </div>

            <?= Html::endForm() ?>

            <!-- Lien inscription -->
            <div class="mt-6 text-center border-t-2 border-gray-200 pt-6">
                <p class="font-bold text-gray-600">
                    Pas encore membre ?
                    <a href="<?= Url::to(['/site/register']) ?>" class="text-purple-600 hover:underline decoration-2 underline-offset-2">
                        Inscrivez-vous ici
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer message -->
        <div class="mt-8 text-center">
            <div class="inline-block bg-white border-2 border-black rounded-2xl px-6 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform rotate-1">
                <p class="font-bold text-sm flex items-center gap-2">
                    <i data-lucide="zap" class="w-5 h-5 text-yellow-500"></i>
                    Connexion rapide et sécurisée
                </p>
            </div>
        </div>
    </div>
</div>

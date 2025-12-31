<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "CERICar - Inscription";
?>

<div class="site-register min-h-screen flex items-center justify-center py-20 px-6">
    <!-- Background patterns -->
    <img class="absolute top-20 left-1/4 w-40 rotate-45 opacity-30" src="<?= Url::to('@web/images/polygon-3d.svg') ?>"></img>
    <img class="absolute top-80 right-40 w-60 opacity-20" src="<?= Url::to('@web/images/circle-shadow.svg') ?>"></img>
    <img class="absolute bottom-40 right-10 opacity-30" src="<?= Url::to('@web/images/circle-3d.svg') ?>"></img>
    <img class="absolute bottom-20 left-1/4 opacity-20" src="<?= Url::to('@web/images/cube-3d.svg') ?>"></img>

    <div class="relative z-10 w-full max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block mb-4 transform -rotate-2">
                <span class="bg-purple-600 text-white px-4 py-2 rounded-full border-2 border-black text-sm font-black uppercase tracking-wider shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                    Nouveau membre
                </span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black leading-tight mb-4">
                REJOIGNEZ<br/>
                <span class="text-purple-600 bg-white px-4 border-2 border-black shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transform rotate-2 inline-block mx-2 pb-2">L'AVENTURE</span>
            </h1>
            <p class="text-lg font-bold text-gray-700 max-w-xl mx-auto">
                Créez votre compte en quelques secondes et commencez à voyager autrement !
            </p>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="bg-white border-2 border-black rounded-3xl p-8 md:p-10 shadow-[12px_12px_0px_0px_rgba(0,0,0,1)]">
            <?= Html::beginForm(['site/register-submit'], 'get', [
                'id' => 'register-form',
                'class' => 'space-y-6',
                'data-ajax-url' => \yii\helpers\Url::to(['site/register-submit'])
            ]) ?>

                <!-- Prénom et Nom -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            Prénom
                        </label>
                        <?= Html::textInput('prenom', '', [
                            'placeholder' => 'Marie',
                            'required' => true,
                            'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                        ]) ?>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            Nom
                        </label>
                        <?= Html::textInput('nom', '', [
                            'placeholder' => 'Dupont',
                            'required' => true,
                            'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                        ]) ?>
                    </div>
                </div>

                <!-- Pseudo -->
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <i data-lucide="at-sign" class="w-4 h-4"></i>
                        Pseudo
                    </label>
                    <?= Html::textInput('pseudo', '', [
                        'placeholder' => 'marieDu84',
                        'required' => true,
                        'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                    ]) ?>
                </div>

                <!-- Photo -->
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <i data-lucide="camera" class="w-4 h-4"></i>
                        Photo
                    </label>
                    <?= Html::input('photo', 'photo', '', [
                        'placeholder' => 'https://photodeprofile.com/monimage.jpg',
                        'required' => false,
                        'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                    ]) ?>
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="font-black text-sm uppercase flex items-center gap-2">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        Email
                    </label>
                    <?= Html::input('email', 'email', '', [
                        'placeholder' => 'marie.dupont@example.com',
                        'required' => true,
                        'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                    ]) ?>
                </div>

                <!-- Mot de passe -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            Mot de passe
                        </label>
                        <?= Html::input('password', 'password', '', [
                            'placeholder' => '********',
                            'required' => true,
                            'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                        ]) ?>
                    </div>

                    <div class="space-y-2">
                        <label class="font-black text-sm uppercase flex items-center gap-2">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            Confirmer
                        </label>
                        <?= Html::input('password', 'passwordConfirm', '', [
                            'placeholder' => '********',
                            'required' => true,
                            'class' => 'w-full bg-gray-100 border-2 border-transparent focus:border-purple-600 focus:bg-white rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                        ]) ?>
                    </div>
                </div>

                <!-- Permis de conduire -->
                <div class="bg-yellow-50 border-2 border-yellow-400 rounded-2xl p-4">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <?= Html::checkbox('permis', false, [
                            'class' => 'w-6 h-6 border-2 border-black rounded accent-purple-600 cursor-pointer',
                            'id' => 'permisCheckbox'
                        ]) ?>
                        <span class="font-bold text-sm group-hover:text-purple-600 transition-colors">
                            <i data-lucide="car" class="w-4 h-4 inline mr-1"></i>
                            Je possède le permis de conduire et je souhaite proposer des trajets
                        </span>
                    </label>

                    <!-- Numéro de permis (caché par défaut) -->
                    <div id="permis-numero-container" class="hidden mt-4 pt-4 border-t-2 border-yellow-300">
                        <label class="font-black text-sm uppercase flex items-center gap-2 mb-2">
                            <i data-lucide="credit-card" class="w-4 h-4"></i>
                            Numéro de permis
                        </label>
                        <?= Html::input('number', 'numeroPermis', '', [
                            'placeholder' => '123456789012',
                            'id' => 'numeroPermis',
                            'class' => 'w-full bg-white border-2 border-yellow-400 focus:border-purple-600 rounded-xl px-4 py-3 font-bold outline-none transition-colors'
                        ]) ?>
                    </div>
                </div>

                <!-- CGU -->
                <div class="bg-gray-50 border-2 border-gray-300 rounded-2xl p-4">
                    <label class="flex items-start gap-3 cursor-pointer group">
                        <?= Html::checkbox('cgu', false, [
                            'required' => true,
                            'class' => 'w-6 h-6 mt-0.5 border-2 border-black rounded accent-purple-600 cursor-pointer',
                            'id' => 'cgu'
                        ]) ?>
                        <span class="font-bold text-sm group-hover:text-purple-600 transition-colors">
                            J'accepte les <a href="<?= Url::to(['/site/index']) ?>" class="text-purple-600 underline">conditions générales d'utilisation</a> et la <a href="<?= Url::to(['/site/index']) ?>" class="text-purple-600 underline">politique de confidentialité</a>
                        </span>
                    </label>
                </div>

                <!-- Bouton Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full font-bold border-2 border-black rounded-xl px-6 py-4 bg-purple-600 text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:bg-purple-500 hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 active:shadow-none active:translate-x-1 active:translate-y-1 transition-all duration-150 flex items-center justify-center gap-2 text-lg">
                        <i data-lucide="user-plus"></i>
                        Créer mon compte
                    </button>
                </div>

            <?= Html::endForm() ?>

            <!-- Lien connexion -->
            <div class="mt-6 text-center border-t-2 border-gray-200 pt-6">
                <p class="font-bold text-gray-600">
                    Déjà membre ?
                    <a href="<?= Url::to(['/site/login']) ?>" class="text-purple-600 hover:underline decoration-2 underline-offset-2">
                        Connectez-vous ici
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer message -->
        <div class="mt-8 text-center">
            <div class="inline-block bg-white border-2 border-black rounded-2xl px-6 py-3 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transform -rotate-1">
                <p title="*sauf a l'intégralité de la promo de L3 informatique du CERI" class="font-bold text-sm flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-5 h-5 text-green-600"></i>
                    Vos données sont sécurisées et ne seront jamais partagées*
                </p>
            </div>
        </div>
    </div>
</div>

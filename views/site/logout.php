<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = "CERICar - Déconnexion";
?>

<div class="min-h-screen flex items-center justify-center px-6">
    <div class="max-w-md w-full bg-white border-4 border-black p-8 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
        <h1 class="text-3xl font-black mb-6">Déconnexion réussie</h1>
        <p class="mb-6">Vous avez été déconnecté avec succès.</p>
        <a href="<?= Url::to(['/site/index']) ?>" class="font-bold border-2 border-black rounded-xl px-6 py-2 bg-purple-600 text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-150 inline-block">
            Retour à l'accueil
        </a>
    </div>
</div>

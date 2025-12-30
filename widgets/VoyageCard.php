<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

class VoyageCard extends Widget
{
    public $voyage;
    public $nbpersonnes;

    public function run()
    {
        return $this->renderCard($this->voyage, $this->nbpersonnes);
    }
    protected function renderCard($voyage, $nbpersonnes)
    {
        $bgColor = ($voyage->nbplacedispo - $voyage->getPlacesResa()) <= 1 ? "bg-red-300" : "bg-green-300";

        return <<<HTML
        <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 transition-all cursor-pointer group">
            <div class="h-40 rounded-xl border-2 border-black bg-pink-300 mb-4 relative overflow-hidden flex items-center justify-center">
                <img src="{$voyage->trajetObj->arriveeImg()}"></img>
            </div>

            <div class="flex justify-between items-start mb-4">
                <div>
                    <div class="font-bold text-lg flex items-center gap-2">
                        {$voyage->trajetObj->depart}
                        <i data-lucide="arrow-right"></i>
                        {$voyage->trajetObj->arrivee}
                    </div>
                    <div class="text-sm font-medium text-gray-500">Demain, {$voyage->getFormatHeureDeDepart()}</div>
                </div>
                <div class="bg-black text-white px-3 py-1 rounded-lg font-black text-lg transform rotate-2">
                    {$voyage->getPrix($nbpersonnes)}€
                </div>
            </div>
            <div class="mt-auto flex items-center justify-between border-t-2 border-gray-100 pt-3">
                <div class="flex items-center gap-3">
                    <img src="{$voyage->conducteurObj->photo}" alt="Karim" class="w-10 h-10 rounded-full border-2 border-black bg-gray-200">
                    <div class="text-sm">
                        <div class="font-bold">{$voyage->conducteurObj}</div>
                        <div class="flex items-center text-xs font-bold text-yellow-500">
                            <i class="w-3 h-3 fill-current" data-lucide="star"></i>
                            5.0
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 {$bgColor} border-2 border-black px-2 py-1 rounded-lg text-xs font-black uppercase tracking-wide transform -rotate-2">
                    <i class="w-3 h-3 fill-current" data-lucide="user"></i>
                    <span>{$voyage->getPlacesResa()}/{$voyage->nbplacedispo} Places</span>
                </div>
            </div>
        </div>
        HTML;
    }
}

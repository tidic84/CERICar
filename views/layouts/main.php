<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;

AppAsset::register($this);

$this->title = "CERICar!";
$this->registerCsrfMetaTags();
$this->registerMetaTag(["charset" => Yii::$app->charset], "charset");
$this->registerMetaTag([
    "name" => "viewport",
    "content" => "width=device-width, initial-scale=1, shrink-to-fit=no",
]);
$this->registerMetaTag([
    "name" => "description",
    "content" => $this->params["meta_description"] ?? "",
]);
$this->registerMetaTag([
    "name" => "keywords",
    "content" => $this->params["meta_keywords"] ?? "",
]);
$this->registerLinkTag([
    "rel" => "icon",
    "type" => "image/x-icon",
    "href" => Yii::getAlias("@web/favicon.ico"),
]);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-full">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <?php $this->head(); ?>
</head>

<body class="min-h-screen font-sans text-black bg-white selection:bg-purple-300 selection:text-purple-900">
<?php $this->beginBody(); ?>

<?= $this->render("/layouts/_navbar") ?>

<main id="main" class="flex-1 pt-16 bg-yellow-50 " role="main">
    <div class="mx-auto min-h-screen items-center relative overflow-hidden">
        <?= $content ?>
    </div>
</main>

<?= $this->render("/layouts/_footer") ?>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();
</script>


<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

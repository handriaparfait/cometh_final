<h1>Liste des articles </h1>
<?php foreach($articles as $article) : ?>
<h2><?= $article['id'] ?></h2>
<p><?= $article['nom'] ?></h2>
<?php endforeach; ?>
<!DOCTYPE html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>

<header class="en_tete">

<a href="http://planty.local/home/"><img class="logo" src="<?= get_stylesheet_directory_uri() ?>/image/Logo_source.png"></a>

<?php wp_nav_menu([
'theme_location' => 'header',
'container' => false,
'menu_class' => 'navbar-nav mr-auto'
])?>
</header>
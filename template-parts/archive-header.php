<?php
/**
 * Archive page header.
 *
 * @package Becoming_Bipedal_Theme
 */
?>

<header class="page-header">
	<?php
	the_archive_title( '<h1 class="page-header__title">', '</h1>' );
	the_archive_description( '<div class="page-header__description">', '</div>' );
	?>
</header>

<?php require_once('includes/checksession.php');?>
<!-- login form -->
<?php require_once('includes/header.php');?>
<?php require_once('includes/navigation.php');?>
<?php require_once('includes/sidebar.php');?>
<div class="content">
	WELCOME <?php print_r($_SESSION); ?>
	WELCOME <?php print_r($_SESSION['user']['username']); ?>
	USERNAME <?php print_r($_SESSION['username']); ?>
</div>
    <?php require_once('includes/sidebar2.php');?>

	
<?php require_once('includes/footer.php');?>
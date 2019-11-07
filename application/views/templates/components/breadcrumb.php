<?php
defined('BASEPATH') or exit('No direct script access allowed!');
$total_uri = count($uris);
$page = $this->uri->segment($total_uri);
$title = $page == 'administrator' || empty($page) ? 'Home' : $page ;
?>

<h1>
	<?php echo 'Halaman ' . ucwords(str_replace('_', ' ', $title)); ?>
</h1>
<ol class="breadcrumb">
	<li><a href="<?php echo base_url('administrator/home'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
	<?php
	$url = 'administrator';
	foreach ($uris as $key => $uri) {
		if ($uri != 'administrator' && $uri != 'home') {
			$is_active = $key == $total_uri ? '' : '/#' ;
			$url .= '/' . $uri;
			echo '<li><a href=\'' . base_url($url . $is_active) . '\'>' . ucwords(str_replace('_', ' ', $uri)) . '</a></li>';
		}
	}
	?>
</ol>

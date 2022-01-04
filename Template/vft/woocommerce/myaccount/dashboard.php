<?
$uiddash = get_current_user_id();
$userdatadash = get_userdata($uiddash);
$firstnamedash = $userdatadash->first_name;
?>
<div class="desktop-dashboard">
	<h2 class="desktop-dashboard__title">
		Dashboard
	</h2>
	<div class="desktop-dashboard__content">
		<p class="desktop-dashboard__welcome">
			Welcome back, <span class="desktop-dashboard__username"><? echo $firstnamedash ?></span>!
		</p>
	</div>
</div>
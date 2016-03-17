<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>/"><div>
	<input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" size="15" /><br />
	<input type="submit" id="searchsubmit" value="Search" />
</div>
</form>
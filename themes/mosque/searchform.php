<form method="get" id="searchform" action="<?php  echo esc_url(home_url('/')); ?>/">
	<div id="search-text">
		<input type="text" placeholder="Search" value="<?php the_search_query(); ?>" name="s"  autocomplete="off" />
	</div>
	<input type="submit" id="searchsubmit" value="submit" />
    <span class="overflow"></span>
	<br class="clear">
</form>

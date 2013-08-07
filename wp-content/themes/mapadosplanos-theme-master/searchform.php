<form action="<?php bloginfo('url'); ?>/" method="get" accept-charset="utf-8" id="searchform" role="search">
  <div>
    <input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="Procurar no site"/>
    <input type="submit" id="searchsubmit" value="Buscar" />
  </div>
</form>

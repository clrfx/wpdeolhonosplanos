<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
    <div>
        <input type="text" value="<?php the_search_query(); ?>" name="s" id="s-munic" autocomplete="off" placeholder="Procure pelo seu município" />
        <input type="hidden" name="search-type" value="munic" />
        <input type="submit" id="searchsubmit" value="Buscar" class="button" />
    </div>
    <div id="autocomplete"></div>
</form>

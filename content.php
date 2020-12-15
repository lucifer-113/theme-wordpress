<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php thuanvo_thumbnail('thumbnail'); ?> 
    </div> 
    <div class="entry-header">
        <?php thuanvo_entry_header();?>
        <?php thuanvo_entry_meta();?>
    </div> 
    <div class="entry-content">
        <?php thuanvo_entry_content(); ?>
        <?php (is_single()) ? thuanvo_entry_tag() : '' ?>
    </div>
</article> 
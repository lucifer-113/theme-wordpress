<?php 
/**
 * @khai bao hang gia tri
 *   @THEME_URL= lay duong dan cua thu muc /core
 **/
define('THEME_URL',get_stylesheet_directory());
define('CORE',THEME_URL ."/core");

/**
 * Nhung file /core/init.php
 */
 require_once(CORE."/init.php");
/** 
 * thiet lap chieu rong noi dung
 */
if(! isset($content_with)){
    $content_width=620;
}
/**
 * @khai bao chuc nang cua theme
 */
if(! function_exists('thuanvo_setup')){
    function thuanvo_setup(){

        /*thiet lap domain*/ 
          $language_folder=THEME_URL .'/languages';
         load_theme_textdomain('thuanvo',$language_folder);

         /* Tu dong them link RSS len <head> **/
        add_theme_support('automatic-feed-links');

        /* Them post thumbnail */
         add_theme_support('post-thumbnails');

        /* Post format */
        add_theme_support('post-formats',array(
            'image',
            'video',
            'gallery',
            'quote',
            'link'

        ));

        /*theme title tag*/
        add_theme_support('title-tag');
        
        /* theme custom background */
        $default_background=array(
            'default-color'=>'e8e8e8'
        );
        add_theme_support('custom-background',$default_background);

        /*Theme menu */
        register_nav_menu('primary-menu',__('primary Menu','thuanvo'));

        /* Tao sidebar */
        $sidebar=array(
            'name' =>__('Main_sidebar','thachpham'),
            'id'=>'main-sidebar',
            'description'=>__('Default sidebar'),
            'class'=> 'main_sidebar',
            'before_title'=> '<h3 class="thuanvotitle">',
            'after_title'=>'</h3>'

        );
        register_sidebar($sidebar);
    }
    add_action('init','thuanvo_setup'); //thuc thi tu dong 
}

/*-----
TEMPLATE FUNCTIONS */
if(!function_exists('thuanvo_header')){
    function thuanvo_header(){?>
    <div class="site-name">
     <?php 
            if(!is_home() ){
                printf('<h1><a href="%1$s title="%2$s">%3$s</a></h1>',
                get_bloginfo('url'),
                get_bloginfo('description'),
                get_bloginfo('sitename')
            );
                        }
            else{
                printf('<p><a href="%1$s title="%2$s">%3$s</a></p>',
                get_bloginfo('url'),
                get_bloginfo('description'),
                get_bloginfo('sitename'));
                        }
            ?>
     </div>
     <div class="site-description"><?php bloginfo('description')?></div><?php
    }
}

/**
 * thieest lap menu
 */
if(!function_exists('thuanvo_menu')){
    function thuanvo_menu ($menu){
            $menu=array(
                'theme_location'=> $menu,
                'container'=>$nav,
                'container_class'=> $menu
            );
            wp_nav_menu($menu);
    }
}

/** Hàm tạo phân trang */
if(! function_exists('thuanvo_pagination')){
    function thuanvo_pagination(){
        if($GLOBALS['wp_query']->max_num_pages < 2){
            return '';
        }?>
        <nav class="pagination" role="navigation">
              <?php if(get_next_posts_link()):?>
                <div class="prev"><?php next_posts_link(__('Older Posts','thuanvo')); ?></div>
              <?php endif ?>
              <?php if(get_previous_posts_link()):?>
                <div class="next"><?php previous_posts_link(__('Newest Post','thuanvo')); ?></div>
              <?php endif ?>
        </nav>
    <?php  }
}

/**
 * Hàm hiển thị thumbnail 
 */
if(!function_exists('thuanvo_thumbnail')){
    function thuanvo_thumbnail($size){
        if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')):?>
          <figure class="post-thumbnail"><?php the_post_thumbnail($size); ?> </figure>
        <?php endif; ?>
    <?php }
}

/**
 * Hàm hiển thị tieu de post
 */

 if(!function_exists('thuanvo_entry_header')){
     function thuanvo_entry_header(){?>
        <?php if (is_single()): ?>
                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
        <?php else: ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <?php endif; ?>
     <?php }
 }

 /**
  * thuanvo_entry_meta=lay du lieu post
  */
  if(!function_exists('thuanvo_entry_meta')){
        function thuanvo_entry_meta(){?>
            <?php if ( !is_page()) : ?>
                <div class="entry-meta">
                    <?php 
                        printf(__('<span class="author">Posted by %1$s','thuanvo'),
                        get_the_author());

                        printf(__('<span class="date-published"> at %1$s','thuanvo'),
                        get_the_date());

                        printf(__('<span class="category"> in %1$s ','thuanvo'),
                        get_the_category_list(' , '));

                        if( comments_open() ) :
                             echo '<span class="meta-reply">';
                                 comments_popup_link(
                                     __('Leave a comment','thuanvo'),
                                     __('One comment','thuanvo'),
                                     __('% comments','thuanvo'),
                                     __('Read all comment','thuanvo')
                                 );
                            echo '</span>';
                        endif;
                    ?>
                </div>
            <?php endif; ?>
        <?php }
  }

  /**
   * thuanvo_entry_content = ham hien thi noi dung post/page
   */

if(!function_exists('thuanvo_entry_content')){
    function thuanvo_entry_content(){
        if( !is_single() ){
            the_excerpt();
        } else{
            the_content();

            /*phan trang trong single*/
            $link_pages=array(
                'before'=>__('<p>Page:','thuanvo'),
                'after' =>'</p>',
                'nextpagelink'=>__('Next Page','thuanvo'),
                'previouspagelink' =>__('Previous Page','thuanvo')
            );
            wp_link_pages($link_pages);
        }
    }
}

function thuanvo_readmore(){
    return '<a class="read-more" href="'.get_permalink( get_the_ID()) .'">'.__('...[Read more]','thuanvo').'</a>';
}
add_filter('excerpt_more','thuanvo_readmore');


/**
 * thuanvo_entry_tag =hien thi tag
 */

 if(!function_exists('thuanvo_entry_tag')){
     function thuanvo_entry_tag(){
         if( has_tag()) :
            echo '<div class="entry-tag">';
            printf(__('Tagged in %1$s','thuanvo'),get_the_tag_list('',','));
            echo '</div>';
         endif;
     }
 }
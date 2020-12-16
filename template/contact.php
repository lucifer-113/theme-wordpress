<?php 
/*
Template Name: Contact
*/
?>
<?php get_header();?>
<div class="content">
    <div id="main-content">
        <div class="contact-info">
            <h4>Địa chỉ liên hệ </h4>
            <p>14 Voz Trac, Hue</p>
            <p>0366179912</p>
        </div>
        <div class="contact-info">
            <?php echo do_shortcode('[contact-form-7 id="1488" title="Contact form 1"]'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
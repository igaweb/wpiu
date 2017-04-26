<?php
/**
 * Blank content partial template.
 *
 * @package understrap
 */
?>

<div class="page-wrap">
<a class="anchor" name="<?php echo get_post_custom_values('homepage_anchor')[0]; ?>"></a>
  <?php  
  
the_content();

?>
</div>
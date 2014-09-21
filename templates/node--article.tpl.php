<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<article class="node-<?php print $node->nid; ?> <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php
    hide($content['comments']);
    hide($content['links']);
    hide($content['field_tags']);
    hide($content['print_links']);
  ?>
  <div class="col-left">
    <header>
      <?php if ($title): ?>
        <h1<?php print $title_attributes; ?> id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php if ($unpublished): ?>
        <mark class="unpublished"><?php print t('Unpublished'); ?></mark>
      <?php endif; ?>
    </header>
    <?php print render($content); ?>
  </div>
  <div class="col-right">
    <?php if ($display_submitted): ?>
      <span class="submitted">
        <h4><?php print (t('Author')); ?></h4>
        <?php print $user_picture; ?>
        <?php print $submitted; ?>
      </span>
    <?php 
      endif;
      print render($content['field_tags']);
      print ('<h4>' . t('Share') . '</h4>');
      print render($content['print_links']);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</article>

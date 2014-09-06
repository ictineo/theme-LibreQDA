<?php
/**
 * @file
 * Implements hook_form_system_theme_settings_alter().
 */

/**
 * Implements hook_form_system_theme_settings_alter().
 *
 *   Nested array of form elements that comprise the form.
 *   A keyed array containing the current state of the form.
 */
function lqda_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL) {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }
  $form['lqda'] = array(
    '#type' => 'fieldset',
    '#title' => t('LibreQDA configuration'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  for ($i = 1; $i <= 6; $i++) {
    $form['lqda']['home_block' . $i] = array(
      '#type' => 'fieldset',
      '#title' => 'Home block #' . $i,
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['lqda']['home_block' . $i]['home_block_lqda_title_' . $i] = array(
      '#type' => 'textfield',
      '#title' => 'Title for home block ' . $i,
      '#default_value' => theme_get_setting('home_block_lqda_title_' . $i),
    );
    $form['lqda']['home_block' . $i]['home_block_lqda_desc_' . $i] = array(
      '#type' => 'textfield',
      '#title' => 'Description text for home block ' . $i,
      '#default_value' => theme_get_setting('home_block_lqda_desc_' . $i),
    );
    $form['lqda']['home_block' . $i]['home_block_lqda_link_' . $i] = array(
      '#type' => 'textfield',
      '#title' => 'Link text for home block ' . $i,
      '#default_value' => theme_get_setting('home_block_lqda_link_' . $i),
    );
    $form['lqda']['home_block' . $i]['home_block_lqda_img_' . $i] = array(
      '#type' => 'managed_file',
      '#title' => 'Image text for home block ' . $i,
      '#default_value' => theme_get_setting('home_block_lqda_img_' . $i),
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg svg'),
      ),
    );
  }
}

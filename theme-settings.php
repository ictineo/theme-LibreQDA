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
  $theme_settings_path = drupal_get_path('theme', 'lqda') . '/theme-settings.php';
  if (file_exists($theme_settings_path) && !in_array($theme_settings_path, $form_state['build_info']['files'])) {
    $form_state['build_info']['files'][] = $theme_settings_path;
  }
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
  $form['lqda']['lqda_home_pc_img'] = array(
    '#type' => 'managed_file',
    '#title' => 'Home PC image',
    '#default_value' => theme_get_setting('lqda_home_pc_img'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('gif png jpg jpeg svg'),
    ),
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
  $form['#submit'] = array('lqda_system_theme_settings_submit');
}

function lqda_system_theme_settings_submit (&$form, &$form_state) {
  for ($i = 1; $i <= 6; $i++) {
    if( file_load($form_state['values']['home_block_lqda_img_' . $i]) != 0 ) {
      $file = file_load($form_state['values']['home_block_lqda_img_' . $i]);
      $file->status = FILE_STATUS_PERMANENT;
      file_save($file);
      file_usage_add($file, 'lqda_theme', 'layout', $i);  
    }
  }
  if( file_load($form_state['values']['lqda_home_pc_img']) != 0 ) {
    $file = file_load($form_state['values']['lqda_home_pc_img']);
    $file->status = FILE_STATUS_PERMANENT;
    file_save($file);
    file_usage_add($file, 'lqda_theme', 'layout', '8');  
  }
}

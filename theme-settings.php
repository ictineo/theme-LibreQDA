<?php
/**
 * Implements hook_form_system_theme_settings_alter().
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function lqda_form_system_theme_settings_alter(&$form, &$form_state, $form_id = NULL)  {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  // Create the form using Forms API: http://api.drupal.org/api/7

  /* -- Delete this line if you want to use this setting
  $form['lqda_example'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('lqda sample setting'),
    '#default_value' => theme_get_setting('lqda_example'),
    '#description'   => t("This option doesn't do anything; it's just an example."),
  );
  // */

  // Remove some of the base theme's settings.
  /* -- Delete this line if you want to turn off this setting.
  unset($form['themedev']['zen_wireframes']); // We don't need to toggle wireframes on this site.
  // */

  // We are editing the $form in place, so we don't need to return anything.
  $form['lqda'] = array (
    '#type' => 'fieldset',
    '#title' => t('LibreQDA configuration'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  for($i=1; $i<=6; $i++) {
    $form['lqda']['home_block'.$i] = array (
      '#type' => 'fieldset',
      '#title' => t('Home block #'.$i),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    );
    $form['lqda']['home_block'.$i]['lqda_title_'.$i] = array (
      '#type' => 'textfield',
      '#title' => t('Title for home block '.$i),
      '#default_value' => variable_get('lqda_title_'.$i, ''),
    );
    $form['lqda']['home_block'.$i]['lqda_desc_'.$i] = array (
      '#type' => 'textfield',
      '#title' => t('Description text for home block '.$i),
      '#default_value' => variable_get('lqda_desc_'.$i, ''),
    );
    $form['lqda']['home_block'.$i]['lqda_link_'.$i] = array (
      '#type' => 'textfield',
      '#title' => t('Link text for home block '.$i),
      '#default_value' => variable_get('lqda_link_'.$i, ''),
    );
    $form['lqda']['home_block'.$i]['lqda_img_'.$i] = array (
      '#type' => 'managed_file',
      '#title' => t('Image text for home block '.$i),
      '#default_value' => variable_get('lqda_img_'.$i, ''),
    );
  }
}

<?php
/**
 * @file
 * Contains \Drupal\first_module\Form\ContributeForm.
 */

namespace Drupal\first_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\node\Entity\Node;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Contribute form.
 */
class ContributeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'amazing_forms_contribute_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#required' => TRUE,
    );
    $form['video'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube video'),
    );
    $form['video'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube video'),
    );
    $form['develop'] = array(
      '#type' => 'checkbox',
      '#title' => t('I would like to be involved in developing this material'),
    );
    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;

  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    // Validate video URL.
    if (!UrlHelper::isValid($form_state->getValue('video'), TRUE)) {
      $form_state->setErrorByName('video', $this->t("The video url '%url' is invalid.", array('%url' => $form_state->getValue('video'))));
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
  // Load the current user.
  $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  $uid= $user->get('uid')->value;
  /*var_dump($uid);
  die;*/

    // Display result.
    $values = $form_state->getValues();
    /*var_dump($values['title']);
    die;*/

    // Create node object with attached file.
    $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $node = Node::create([
      'type'        => 'contribute',
      'title'       => $values['title'],
      'status'      => $uid,
      'body'        => array($values['description']),
      'field_youtube_video_link'         => array($values['video']),
      'field_involvement_in_development' => array($values['develop']),

    ]);
    $success = $node->save();

    if($success)
      drupal_set_message('Your contribution details have been save successfully..');

    $node_id = $node->nid;

    return $this->redirect('user.page');
    /*foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }*/
    
  }
}
?>

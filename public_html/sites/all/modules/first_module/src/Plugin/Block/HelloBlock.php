<?php
  /**
  * @file
  * Contains \Drupal\first_module\Plugin\Block\HelloBlock.
  */

  namespace Drupal\first_module\Plugin\Block;
  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Form\FormStateInterface;

  /**
  * Provides a 'Hello' Block
  *
  * @Block(
  *   id = "hello_block",
  *   admin_label = @Translation("Hello block"),
  * )
  */
  class HelloBlock extends BlockBase {
  /**
  * {@inheritdoc}
  */
  public function build() {
     $config = $this->getConfiguration();
     
    return array(
      '#type'=>'markup',
      '#markup'=>$config['demo_block_settings'] . t(' <a href="contribute">Click Here</a>'),
      '#title'=>t('Customer Form'),
    );
    
  }
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    
    $form = parent::blockForm($form, $form_state);
    
    $config = $this->getConfiguration();

    $form['demo_block_settings'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => isset($config['demo_block_settings']) ? $config['demo_block_settings'] : '',
    );
    
    return $form;
  }

  /**
* {@inheritdoc}
  */
  public function blockSubmit($form, FormStateInterface $form_state) {
   
   $this->setConfigurationValue('demo_block_settings', $form_state->getValue('demo_block_settings'));
   
  }

}
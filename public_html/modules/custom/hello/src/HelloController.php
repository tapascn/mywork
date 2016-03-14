<?php
/**
 * @file
 * Contains \Drupal\hello\HelloController.
 */

namespace Drupal\hello;



use Drupal\Core\Controller\ControllerBase;



class HelloController extends ControllerBase {
  public function content() {
    return array(
        '#markup' => '' . t('Hello there!') . '',
    );
  }
}
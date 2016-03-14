<?php
    /**
    @file
    Contains \Drupal\first_module\FirstController.
     */
     
    namespace Drupal\first_module;
     
    use Drupal\Core\Controller\ControllerBase;
     
    class FirstController extends ControllerBase {
      public function content() {
      return array(
          '#type' => 'markup',
          '#markup' => t('Hello world'),
        );
      }
    }
?>
<?php

namespace Drupal\slogan_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class HelloController extends ControllerBase {

    public function showContent() {
        return [
            '#type' => 'markup',
            '#markup' => \Drupal::config('system.site')->get('slogan'),
        ];
    }
}
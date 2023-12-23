<?php

namespace Drupal\slogan_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MyConfigForm extends ConfigFormBase
{

    public function getFormId()
    {
        return 'slogan_module_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'slogan_module.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['slogan'] = [
            #'#type' => 'textarea',
            '#type' => 'textfield',
            '#title' => 'Слоган',
            #'#default_value' => $config->get('terms_and_conditions'),
            '#default_value' => \Drupal::config('system.site')->get('slogan')

        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit form',
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $config = \Drupal::service('config.factory')->getEditable('system.site');
        $config->set('slogan', $form_state->getValue('slogan'));
        $config->save();

        return parent::submitForm($form, $form_state);
    }
}
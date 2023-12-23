<?php

namespace Drupal\my_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MyConfigForm extends ConfigFormBase
{

    public function getFormId()
    {
        return 'my_module_config_form';
    }

    protected function getEditableConfigNames()
    {
        return [
            'my_module.settings'
        ];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('my_module.settings');

        $form['todo_list_name'] = [
            '#type' => 'textfield',
            '#title' => 'Название ToDo листа',
            '#default_value' =>'Список покупок',
            '#required' => TRUE,
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => 'Submit form',
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $databases['default']['default'] = array(
            'driver' => 'mysql',
            'database' => 'drupaldb',
            'username' => 'username',
            'password' => 'secret',
            'host' => 'localhost',
          );

        \Drupal::database()->query('Create table ' . $form_state->getValue('todo_list_name') . '
            (
                id int primary key,
                text varchar(255) not null,
                completed tinyint default 0
            );
        ');


        return parent::submitForm($form, $form_state);
    }
}

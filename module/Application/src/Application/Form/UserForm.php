<?php
namespace Application\Form;

use Zend\Form\Form;

class UserForm extends Form {
    public function __construct($name = null) {
        parent::__construct('user');
        $this->setAttribute('method', 'post');
        $this->add(['name' => 'id', 'attributes' => ['type' => 'hidden']]);
        $this->add([
            'name'       => 'name',
            'attributes' => ['type' => 'text', 'class' => 'form-control'],
            'options'    => ['label' => '名前'],
        ]);
        $this->add([
            'name'       => 'email',
            'attributes' => ['type' => 'email', 'class' => 'form-control'],
            'options'    => ['label' => 'メールアドレス'],
        ]);
        $this->add([
            'name'       => 'password',
            'attributes' => ['type' => 'password', 'class' => 'form-control'],
            'options'    => array('label' => 'パスワード'),
        ]);
        $this->add([
            'name' => 'comment',
            'attributes' => [
                'type' => 'textarea',
                'rows' => 5,
                'cols' => 5,
                'class' => 'form-control'
            ],
            'options' => ['label' => '自己紹介'],
        ]);
        $this->add([
            'name' => 'url',
            'attributes' => ['type' => 'url', 'class' => 'form-control'],
            'options' => ['label' => 'URL'],
        ]);
        $this->add([
            'name' => 'submit',
            'attributes' => [
                'type' => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ]
        ]);
    }
}


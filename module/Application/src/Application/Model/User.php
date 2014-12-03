<?php
namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface {
    public $id;
    public $name;
    public $email;

    protected $inputFilter; // フィルタを保存する

    public function exchangeArray($data) {
        $this->id    = (isset($data['id'])) ? $data['id'] : 0;
        $this->name  = (isset($data['name'])) ? $data['name']  : '';
        $this->email = (isset($data['email'])) ? $data['email'] : '';
    }

    // フィルタの実装
    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    // フィルタの設定情報を返却する
    public function getInputFilter() {
        if (!$this->inputFilter) {
            // フィルタオブジェクトを作成
            $inputFilter = new InputFilter();

            // フィルタ項目設定
            $inputFilter->add([
                'name'     => 'id',
                'required' => true,
                'filters'  => [['name' => 'Int']]
            ]);

            $inputFilter->add([
                'name'       => 'name',
                'required'   => false,
                'filters'    => [
                    ['name' => 'StripTags'], ['name' => 'StringTrim']
                ],
                'validators' => [[
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8', 'min' => 0, 'max' => 32,
                    ]
                ]]
            ]);

            $inputFilter->add([
                'name'       => 'email',
                'required'   => true,
                'filters'    => [
                    ['name' => 'StripTags'], ['name' => 'StringTrim']
                ],
                'validators' => [[
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8', 'min' => 1, 'max' => 64
                    ],
                ]]
            ]);

            $inputFilter->add([
                'name'       => 'password',
                'required'   => true,
                'filters'    => [
                    ['name' => 'StripTags'], ['name' => 'StringTrim']
                ],
                'validators' => [[
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8', 'min' => 1, 'max' => 16
                    ],
                ]]
            ]);

            $inputFilter->add([
                'name'       => 'comment',
                'required'   => false,
                'filters'    => [
                    ['name' => 'StripTags'], ['name' => 'StringTrim']
                ],
                'validators' => [[
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8', 'min' => 0, 'max' => 5000
                    ],
                ]]
            ]);

            $inputFilter->add([
                'name'       => 'url',
                'required'   => false,
                'filters'    => [
                    ['name' => 'StripTags'], ['name' => 'StringTrim']
                ],
                'validators' => [[
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8', 'min' => 0, 'max' => 64
                    ]
                ]]
            ]);

            $this->InputFilter = $inputFilter;
        }

        return $this->InputFilter;
    }
}

<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User;

class UserController extends AbstractActionController {
    protected $userTable;

    public function addAction() {
        // 新規ユーザの追加
        $user = new User();
        $user->name = "testName";
        $user->email = "testEmail";
        $this->getUserTable()->saveUser($user);

        // ビューへ渡す値を配列にて定義
        $values = array('key1' => 'value1', 'key2' => 'value2');

        // 使用するビューを指定
        $view = new ViewModel($values);

        return $view;
    }

    // ユーザテーブルを取得
    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }
        return $this->userTable;
    }
}

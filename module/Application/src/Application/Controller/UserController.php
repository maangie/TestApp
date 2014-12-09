<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\User;

use Zend\I18n\Translator\Translator;

use Application\Form\UserForm;

class UserController extends AbstractActionController {
    protected $userTable;

    protected $translator; // トランスレータ

    // ユーザ情報一覧画面
    public function indexAction() {
        // ここに処理を記述
    }

    // ユーザ情報詳細画面
    public function detailAction() {
        // ここに処理を記述
    }

    // ユーザ情報追加画面
    public function addAction() {
        $form = new UserForm(); // フォームオブジェクトのインスタンスを生成

        // サブミットボタンに「新規登録」と表示
        $form->get('submit')->setValue('新規登録');

        $request = $this->getRequest(); // ブラウザから送信されたリクエストを取得
        if ($request->isPost()) {
            // ユーザ情報追加
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                // データベースへの登録
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);

                // 一覧画面へリダイレクト
                return $this->redirect()->toRoute(
                    'application', ['controller' => 'user', 'action' => 'index']
                );
            }
        }

        $values = ['form' => $form];      // ビューへ渡す値を配列にて指定
        $view   = new ViewModel($values); // ビューを作成し、値をセット
        return $view;                     // ビューを返却
    }

    // ユーザ情報編集画面
    public function editAction() {
        // ここに処理を記述
    }

    public function deleteAction() {
        // ここに処理を記述
    }

    // ユーザテーブルを取得
    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Application\Model\UserTable');
        }
        return $this->userTable;
    }

    public function getTranslator() {
        if (!$this->translator) {
            $sm = $this->getServiceLocator();
            $this->translator = $sm->get('translator');
        }
        return $this->translator;
    }
}

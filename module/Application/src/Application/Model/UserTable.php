<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

// ユーザ情報テーブル管理クラス
class UserTable {
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    // レコードの全件取得
    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    // 特定レコードの取得
    public function getUser($id) {
        $id     = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row    = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    // レコードのインサートとアップデート
    public function saveUser(User $user) {
        $data = array(
            'name'  => $user->name,
            'email' => $user->email,
        );
        $id = (int)$user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    // レコードの削除
    public function deleteUser($id) {
        $this->tableGateway->delete(array('id' => $id));
    }
}

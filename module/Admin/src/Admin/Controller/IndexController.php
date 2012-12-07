<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;

class IndexController extends AbstractActionController {

    public $data = array(array('id' =>
            '505985e50ffb91e303000001',
            'name' =>
            'key1',
            'comment' => 'commnent1',
            'active' => true,
            'expire' =>
            '2012 09 19',
            'apiKey' =>
            '7DEE80B04A2CAD24B60E218A34882',
            'secretKey' =>
            '2F61C239E9654F3DF03FAB95A',
            'createdAt' =>
            '2012-09-19'), array('id' =>
            '505985e50ffb91e103000002',
            'name' =>
            'key2',
            'comment' => 'commnent2',
            'active' => false,
            'expire' =>
            '2012-09-19',
            'apiKey' =>
            '7DEE80B04A2CAD24B8A34882',
            'secretKey' =>
            '1C239E965833B38F3DF03FAB95A',
            'createdAt' =>
            '2012-09-19'));

    public function indexAction() {

//        $data = new \SpiffyDataTables\Source\Source($this->data);
        //new \Zend\Db\Adapter\Driver\Pdo\Pdo(new \Zend\Db\Adapter\Driver\Pdo\Connection($p))
        /*$sql = new \Zend\Db\Adapter\Adapter((array(
                    'driver' => 'Pdo_Mysql',
                    //'database' => 'test',
                    'username' => 'root',
                    'dsn' => 'mysql:dbname=test;host=localhost;charset=cp1251',
                    'password' => 'cawa123azs'
                        )));
        $stmt = $sql->createStatement('SELECT * FROM test');
        //$stmt->prepare($parameters);
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            $resultSet = new ResultSet;
            $resultSet->initialize($result);

            foreach ($resultSet as $row) {
                echo $row->var . PHP_EOL;
            }
        }
        die();*/
//        $col = new \SpiffyDataTables\Column\Text('id');
     //   $c = \SpiffyDataTables\Column\AbstractColumn::factory(array('name'=>'id'));
        //$c->setAttributes(array('mData'=>'id'));
   //     $data->addColumn($c);
        //var_dump($data);die();
    //    return array('data' => $data);
    }

}

<?php

use PHPUnit\Framework\TestCase;


// Parametres
require '../param/param_engine.php';
require '../param/param.php';


//CLASSES
require('../class/data.class.php');

class dataTest extends TestCase
{
    public function testGetInstance()
    {
        //On vérifie qu'on peut recup l'instance (faites avec Design Pattern singleton)
        $data = data::getInstance();
        $this->assertEquals(true, $data instanceof data);
    }

    public function testSimpleInsert()
    {
        $data = data::getInstance();

        $table = 'my_table';
        $record = [
            'name' => 'thomas',
            'age' => 25,
            'email' => 'thomas@example.com'
        ];

        $result = $data->simple_insert($table, $record, TRUE);

        $expected = "INSERT INTO my_table (`name`, `age`, `email`) VALUES ('thomas', '25', 'thomas@example.com');";
        $this->assertEquals($expected, $result);
    }


    public function testGetDataWithError()
    {
        //on récupère des infos qui n'existent pas
        $data = data::getInstance();
        $this->assertEquals(
            false,
            $data->getData('SELECT * FROM t_exist_pas WHERE id=1')
        );
    }
}

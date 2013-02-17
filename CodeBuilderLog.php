<?php
/**
 * Comment pending.
 * User: Alf Magne Kalleland
 * Date: 17.02.13
 * Time: 01:08
 */
class CodeBuilderLog extends LudoDBModel
{
    protected $config = array(
        "table" => "code_builder",
        "columns" => array(
            "id" => "int auto_increment not null primary key",
            "log_date" => "datetime",
            "file_name" => "varchar(64)",
            "size" => "int"
        )
    );

    public function setSize($size)
    {
        $this->setValue('size', $size);
    }

    public function setFileName($name)
    {
        $this->setValue('file_name', $name);
    }

    public function beforeInsert()
    {
        if (!$this->exists()) {
            $this->createTable();
        }
        $this->setValue('log_date', date("Y-m-d H:i:s"));
    }
}

<?php

    namespace insolita\migrik\db;
use yii\base\InvalidConfigException;
use yii\db\ColumnSchemaBuilder;

/**
 * Base migration with implemented safeDown and dropTable
 * @package platx\db
 */
class Migration extends \yii\db\Migration
{
    /**
     * @var string Table name for migrate
     */
    protected $_tableName;

    /**
     * @var string Table options for migrate
     */
    protected $_tableOptions;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        if (is_null($this->_tableName)) {
            throw new InvalidConfigException('$_tableName must be set!');
        }

        if ($this->db->driverName === 'mysql' && $this->_tableOptions !== false) {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $this->_tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        parent::init();
    }

    /**
     * Migration down
     */
    public function safeDown() {
        $this->dropTable($this->_tableName);
    }

    /**
     * Creates an tinyint column.
     * @param integer $length column size or precision definition.
     * This parameter will be ignored if not supported by the DBMS.
     * @return ColumnSchemaBuilder the column instance which can be further customized.
     * @since 2.0.6
     */
    public function tinyint($length = null) {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder(Schema::TYPE_TINYINT, $length);
    }

}

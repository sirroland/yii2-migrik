<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/** @var $migrationName string the new migration class name
 *  @var $tableAlias string table_name
 *  @var $tableName string table_name
 *  @var $tableSchema yii\db\TableSchema
 *  @var array $tableColumns
 *  @var array $tableIndexes
 *  @var array $tablePk
 *  @var insolita\migrik\gii\Generator $generator
 */

echo "<?php\n";
?>

use yii\db\Schema;
use insolita\migrik\db\Migration;

class <?= $migrationName ?> extends Migration
{
    protected $_tableName = '<?= ($generator->usePrefix)?$tableAlias:$tableName ?>';

    public function safeUp()
    {
        $tableOptions = '<?=$generator->tableOptions?>';

        $this->createTable(
            $this->_tableName,
            [
                <?php foreach($tableColumns as $name=>$data):?>'<?=$name?>'=> <?=$data;?>,
                <?php endforeach;?>
],
            $tableOptions
        );
<?php if(!empty($tableIndexes) && is_array($tableIndexes)):?><?php foreach($tableIndexes as $name=>$data):?><?php if($name!='PRIMARY'):?>

        $this->createIndex('<?=$name?>', '<?=$tableAlias?>','<?=implode(",",array_values($data['cols']))?>',<?=$data['isuniq']?>);<?php endif;?>
<?php endforeach;?>
<?php endif?>
    }

    public function safeDown()
    {
<?php if(!empty($tableIndexes) && is_array($tableIndexes)):?><?php foreach($tableIndexes as $name=>$data):?><?php if($name!='PRIMARY'):?>
        $this->dropIndex('<?=$name?>', '<?=$tableAlias?>');
<?php endif;?><?php endforeach;?><?php endif?>
        $this->dropTable('<?= ($generator->usePrefix)?$tableAlias:$tableName ?>');
    }
}

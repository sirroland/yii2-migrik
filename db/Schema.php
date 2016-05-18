<?php

    namespace insolita\migrik\db;


    /**
     * Class Schema
     * @package common\db
     */
    class Schema extends \yii\db\mysql\Schema {
        const TYPE_CHAR     = 'char';
        const TYPE_TINYINT  = 'tinyint';

        const CASCADE  = 'cascade';
        const RESTRICT = 'restrict';

    }
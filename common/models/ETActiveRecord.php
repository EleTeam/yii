<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;

/**
 * 基类模型
 */
class ETActiveRecord extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    const STATUS_DELETED  = 2;
}

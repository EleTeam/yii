<?php

namespace common\models;

use Yii;

use yii\db\ActiveRecord;

/**
 * 基类模型
 */
class BaseModel extends ActiveRecord
{
    const STATUS_DELETED  = 0;
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE   = 2;
}

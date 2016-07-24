<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * 基类模型
 *  打印sql: echo $query->createCommand()->getRawSql();
 */
class ETActiveRecord extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    const STATUS_DELETED  = 2;

    const NO = 0;
    const YES = 1;

    /**
     * 自动设置模型字段 created_at, updated_at
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * 转换模型的错误信息数组为字符串
     * @return string
     */
    public function errorsToString()
    {
        $errors = [];
        foreach($this->errors as $attribute => $msgs){
            $msg = '';
            foreach($msgs as $msg){
                $msg .= ',';
            }
            $errors[] = $attribute . ': ' . trim($msg, ',');
        }
        return implode('; ', $errors);
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\components\BaseController;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\web\Response;

/**
 * 文件(图片)上传控制器, 文件保存在 data/uploads/public/product|category/$id
 */
class UploaderController extends BaseController
{
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $modelName = $this->_getModelName();
        $imageFile = UploadedFile::getInstanceByName($modelName.'[image]');
        $dbImagePath = '/uploads/public/' . strtolower($modelName) . '/' . Yii::$app->user->id . '/';
        $directory = Yii::getAlias('@data') . $dbImagePath;

        if (!is_dir($directory)) {
            mkdir($directory);
        }

        if ($imageFile) {
            $uid = uniqid();
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = $dbImagePath . $fileName;
                return Json::encode([
                    'files' => [[
                        'name' => $fileName,
                        'size' => $imageFile->size,
                        "url" => $path,
                        "thumbnailUrl" => $path,
                        "deleteUrl" => 'delete?name=' . $fileName,
                        "deleteType" => "POST"
                    ]]
                ]);
            }
        }
        return '';
    }

    public function actionDelete($name)
    {
        $modelName = $this->_getModelName();
        $dbImagePath = '/uploads/public/' . strtolower($modelName) . '/' . Yii::$app->user->id . '/';
        $filepath = Yii::getAlias('@data') . $dbImagePath . $dbImagePath . $name;

        $directory = \Yii::getAlias('@frontend/web/img/temp') . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if (is_file($filepath)) {
            unlink($filepath);
        }

        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file){
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . basename($file);
            $output['files'][] = [
                'name' => $file,
                'size' => filesize($file),
                "url" => $path,
                "thumbnailUrl" => $path,
                "deleteUrl" => 'delete?name=' . $file,
                "deleteType" => "POST"
            ];
        }
        return Json::encode($output);
    }

    private function _getModelName()
    {
        $modelName = '';
        if(isset($_POST['Product'])){ //产品图片
            $modelName = 'Product';
        }
        else if(isset($_POST['Category'])){ //分类图片
            $modelName = 'Category';
        }
        return $modelName;
    }
}

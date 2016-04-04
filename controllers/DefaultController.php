<?php

namespace yeesoft\trip\controllers;

use yeesoft\controllers\admin\BaseController;
use Yii;

/**
 * DefaultController implements the CRUD actions for yeesoft\trip\models\Trip model.
 */
class DefaultController extends BaseController
{
    public $modelClass = 'yeesoft\trip\models\Trip';
    public $modelSearchClass = 'yeesoft\trip\models\TripSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}
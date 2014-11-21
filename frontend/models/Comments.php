<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $model_id
 * @property integer $author_id
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Comments extends \common\models\Comments
{
}

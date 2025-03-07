<?php
/*
 *   Jamshidbek Akhlidinov
 *   7 - 3 2025 14:2:41
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\forms;

use app\modules\admin\modules\content\models\Post;
use yii\base\Model;

class PostForm extends Model
{
    public Post $post;
    public $title;
    public $image;
    public $sub_text;
    public $description;

    public function __construct(Post $post, $config = [])
    {
        $this->post = $post;
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['title', 'image', 'sub_text', 'description'], 'required'],
            [['title', 'image', 'sub_text', 'description'], 'string'],
        ];
    }

    public function save()
    {
        $model = $this->post;
        $model->title = $this->title;
        $model->image = $this->image;
        $model->sub_text = $this->sub_text;
        $model->description = $this->description;

        return $model->save();
    }
}
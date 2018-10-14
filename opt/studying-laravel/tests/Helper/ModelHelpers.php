<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/13
 * Time: 23:36
 */

namespace Tests\Helper;

use App\Eloquent\BaseModel;

trait ModelHelpers
{
    public function assertValidModel(BaseModel $model)
    {
        $this->assertTrue(
            $model->validate(),
            'バリデーション成功を期待したが失敗'
        );
    }

    public function assertInvalidModel(BaseModel $model)
    {
        $this->assertFalse(
            $model->validate(),
            'バリデーション失敗を期待したが成功'
        );
    }
}

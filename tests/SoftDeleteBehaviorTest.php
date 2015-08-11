<?php

namespace yii2tech\tests\unit\ar\softdelete;

use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii2tech\tests\unit\ar\softdelete\data\Item;

class SoftDeleteBehaviorTest extends TestCase
{
    public function testSoftDelete()
    {
        /* @var $item Item|SoftDeleteBehavior */
        $item = Item::findOne(2);

        $result = $item->softDelete();

        $this->assertEquals(1, $result);
        $this->assertEquals(true, $item->isDeleted);
    }

    public function testReplaceDelete()
    {
        Item::$softDeleteBehaviorConfig = [
            'replaceRegularDelete' => true
        ];

        /* @var $item Item|SoftDeleteBehavior */
        $item = Item::findOne(2);
        $item->delete();

        $this->assertEquals(true, $item->isDeleted);
        $this->assertEquals(2, Item::find()->count());
    }
}
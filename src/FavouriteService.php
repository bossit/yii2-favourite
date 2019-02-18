<?php

namespace bossit\favourite;

use yii\base\Component;

class FavouriteService extends Component implements FavouriteInterface
{
    /** @var int */
    public $lifetime = 31536000; // 1 year

    public function init()
    {
        parent::init();

        if (!$this->hasCookie()) {
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'   => static::COOKIE_NAME,
                'value'  => json_encode([]),
                'expire' => time() + $this->lifetime
            ]));
        }
    }
    
    /**
     * @return bool
     */
    protected function hasCookie() : bool
    {
        return \Yii::$app->request->cookies->has(static::COOKIE_NAME);
    }
}
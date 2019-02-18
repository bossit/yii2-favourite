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
     * Add item to favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function add(int $itemId) : bool
    {
        if (!$this->hasCookie()) {
            return false;
        }

        $items = $this->getItems();
        if (in_array($itemId, $items, true)) {
            return true;
        }

        $items[] = $itemId;

        \Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name'   => static::COOKIE_NAME,
            'value'  => json_encode($items),
            'expire' => time() + $this->lifetime
        ]));

        return true;
    }


    /**
     * Get favourite items.
     *
     * @return array|null
     */
    public function getItems() : ?array
    {
        if (!$this->hasCookie()) {
            return null;
        }

        return json_decode(\Yii::$app->request->cookies->getValue(static::COOKIE_NAME));
    }

    /**
     * @return bool
     */
    protected function hasCookie() : bool
    {
        return \Yii::$app->request->cookies->has(static::COOKIE_NAME);
    }
}
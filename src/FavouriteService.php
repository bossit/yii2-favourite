<?php

namespace bossit\favourite;

use yii\base\Component;

class FavouriteService extends Component implements FavouriteInterface
{
    /** @var int Cookie lifetime (1 year by default) */
    public $lifetime = 31536000;

    /** @var string Cookie name */
    public $cookieName = 'yii2-favourite';

    /** @var array */
    private $_items = [];

    public function init()
    {
        parent::init();

        if (!$this->hasCookie()) {
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'   => $this->cookieName,
                'value'  => json_encode($this->_items),
                'expire' => time() + $this->lifetime
            ]));
        } else {
            $this->_items = json_decode(\Yii::$app->request->cookies->getValue($this->cookieName), true);
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
        if ($this->hasItem($itemId)) {
            return true;
        }

        $this->_items[] = $itemId;
        \Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name'   => $this->cookieName,
            'value'  => json_encode($this->_items),
            'expire' => time() + $this->lifetime
        ]));

        return true;
    }

    /**
     * Remove item from favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function remove(int $itemId) : bool
    {
        if ($this->hasItem($itemId) && ($key = array_search($itemId, $this->_items, true)) !== false) {
            unset($this->_items[$key]);

            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name'   => $this->cookieName,
                'value'  => json_encode($this->_items),
                'expire' => time() + $this->lifetime
            ]));
        }

        return true;
    }

    /**
     * Get favourite items.
     *
     * @return array
     */
    public function getItems() : array
    {
        return $this->_items;
    }

    /**
     * Return true if item has in favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function hasItem(int $itemId) : bool
    {
        return !empty($this->hasCookie()) && in_array($itemId, $this->_items, true);
    }

    /**
     * @return bool
     */
    protected function hasCookie() : bool
    {
        return \Yii::$app->request->cookies->has($this->cookieName);
    }
}
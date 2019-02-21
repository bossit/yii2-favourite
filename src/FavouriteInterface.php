<?php

namespace bossit\favourite;

/**
 * Interface FavouriteInterface
 *
 * @package bossit\favourite
 */
interface FavouriteInterface
{
    /**
     * Add item to favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function add(int $itemId) : bool;

    /**
     * Remove item from favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function remove(int $itemId) : bool;

    /**
     * Get favourite items.
     *
     * @return array
     */
    public function getItems() : array;

    /**
     * Return true if item has in favourite.
     *
     * @param int $itemId
     *
     * @return bool
     */
    public function hasItem(int $itemId) : bool;
}
<?php

namespace App\Services\Interfaces;

interface SiblingsInterface
{
    /**
     * Get previous sibling.
     * @return mixed
     */
    public function previous();

    /**
     * Get next sibling.
     * @return mixed
     */
    public function next();

    /**
     * Get URL for show resource.
     * This function used in pagination.
     * @return string
     */
    public function getShowUrl();
}

<?php

namespace App\Services;

class MenuService
{
    private $menuList = [];

    public function addElement(string $name, string $url) {
        $this->menuList[] = [
            'name' => $name,
            'url' => $url
        ];
    }

    public function getMenu() {
        return $this->menuList;
    }

}

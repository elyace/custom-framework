<?php

namespace CFM\Shared\Vite;

interface AssetManagerInterface
{
    public function getDevAssets(): string;

    public function getProdAssets(): string;
}
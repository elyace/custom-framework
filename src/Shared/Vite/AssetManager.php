<?php

namespace CFM\Shared\Vite;

final class AssetManager implements AssetManagerInterface
{

    public function getDevAssets(): string
    {
        $host = env('VITE_HOST_DEV');

        return <<<ASSETS
        <link rel="stylesheet" type="text/css" href="http://{$host}/src/web/main.css"/>
        <script type="module" src="http://{$host}/@vite/client"></script>
        <script type="module" src="http://{$host}/src/main.jsx"></script>
ASSETS;

    }

    public function getProdAssets(): string
    {

        if (!file_exists(ROOT_PATH . '/public/manifest.json')) {

            return '';
        }

        $content = file_get_contents(ROOT_PATH . '/public/manifest.json');
        $manifest = json_decode($content, true);
        $assets = array_column($manifest, 'file');
        $styles = [];
        $scripts = [];
        foreach ($assets as $asset) {
            if( str_contains($asset, '.css') ) {
                $styles[] = <<<CSS
                    <link rel="stylesheet" type="text/css" href="{$asset}">
CSS;
            }
            if( str_contains($asset, '.js') ) {
                $scripts[] = <<<JS
                    <script type="module" crossorigin src="{$asset}"></script>
JS;
            }
        }

        return implode('', $scripts) . implode('', $styles);
    }
}
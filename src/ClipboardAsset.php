<?php

namespace Eddmash\Clipboard;


use yii\web\AssetBundle;

/**
 * Asset bundle for Clipboard js.
 *
 * @package Eddmash\Clipboard
 */
class ClipboardAsset extends AssetBundle
{
    public $sourcePath = '@bower/clipboard/dist';
    public $js = [
        'clipboard.min.js',
    ];
}
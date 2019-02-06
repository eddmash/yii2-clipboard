<?php

namespace Eddmash\Clipboard;

use yii\bootstrap\BootstrapAsset;

/**
 * Asset bundle for Clipboard js.
 */
class ClipboardAsset extends BootstrapAsset
{
    public $sourcePath = '@bower/clipboard/dist';
    public $js = [
        'clipboardJS.min.js',
    ];
}

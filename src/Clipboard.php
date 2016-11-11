<?php
/**
 * Created by PhpStorm.
 * User: edd
 * Date: 11/11/16
 * Time: 3:18 PM.
 */

namespace Eddmash\Clipboard;

use yii\bootstrap\Html;
use yii\bootstrap\InputWidget;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * Clipboard widget is a Yii2 wrapper for the clipboard.js (https://clipboardjs.com/).
 *
 * It contains a ClipboardWidget which creates an input element style with bootstrap.
 * The widget outputs an input element with a copy option.

 * Usage example:
 *
 * ```php
 *
 * echo \Eddmash\Clipboard\Clipboard::widget([
 *      'model' => $model,
 *      'attribute' => 'email',
 *      'options'=>['readonly'=>""]
 * ]);
 *
 * ```
 */
class Clipboard extends InputWidget
{
    /**
     * The Type of input to use.
     *
     * @var
     */
    public $type;

    /**
     * Executes the widget.
     *
     * @return string the result of widget execution to be outputted
     */
    public function run()
    {
        return self::input(
            $this->getView(),
            $this->type,
            $this->attribute,
            Html::getAttributeValue($this->model, $this->attribute),
            $this->options
        );
    }

    /**
     * Output the input type.
     *
     * @param View $view
     * @param $type
     * @param null  $name
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    public static function input(View $view, $type, $name = null, $value = null, $options = [])
    {
        return self::asHtml($view, $type, $name, $value, $options);
    }

    /**
     * Creates the actual html.
     *
     * @param View $view
     * @param $type
     * @param null  $name
     * @param null  $value
     * @param array $options
     *
     * @return string
     */
    private static function asHtml(View $view, $type, $name = null, $value = null, $options = [])
    {
        if (!isset($options['type'])) {
            $options['type'] = $type;
        }
        $options['name'] = $name;
        $options['value'] = $value === null ? null : (string) $value;

        $id = ArrayHelper::getValue($options, 'id', false);
        if ($id === false):
            $id = $name;
        endif;

        Html::addCssClass($options, 'form-control');
        Html::addCssClass($options, $name);

        $content = Html::tag('div',
            Html::tag('div',
                Html::tag('input', '', $options).
                Html::tag('span', 'Copy', [
                        'data-clipboard-target' => '#'.$id,
                        'data-clipboard-action' => 'copy',
                        'class' => 'input-group-addon btn-'.$id,
                        'style' => 'cursor:pointer;',
                    ]
                ),
                ['class' => 'input-group']),
            ['class' => 'clearfix']
        );

        $view->registerJs("new Clipboard('.btn-".$id."')");

        return $content;
    }
}

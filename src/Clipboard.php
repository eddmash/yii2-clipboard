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
     * Which action to perfom, either a cut or a simple copy.
     * @var
     */
    public $action=1;


    const CUT=2;
    const COPY=1;

    /**
     * Executes the widget.
     *
     * @return string the result of widget execution to be outputted
     */
    public function run()
    {
        return self::asHtml(
            $this->getView(),
            $this->type,
            $this->action,
            $this->attribute,
            Html::getAttributeValue($this->model, $this->attribute),
            $this->options
        );
    }

    /**
     * Output the input type.
     *
     * @param View $view the view we are creating the output.
     * @param string $type the input type.
     * @param null $name name of the input element.
     * @param null $value the value for the input.
     * @param null $value the value for the input.
     * @param array $options any other attribute options to pass to the input.
     *
     * @return string
     */
    public static function input(View $view, $type, $name = null, $value = null, $options = [], $action=null)
    {
        if ($action===null):
            $action = self::COPY;
        endif;
        return self::asHtml($view, $type, $action, $name, $value, $options);
    }

    /**
     * Creates the actual html.
     *
     * @param View $view the view we are creating the output.
     * @param string $type the input type.
     * @param int $action the action to perform either cut or copy
     * @param null $name name of the input element.
     * @param null $value the value for the input.
     * @param array $options any other attribute options to pass to the input.
     * @return mixed
     */
    private static function asHtml(View $view, $type, $action, $name = null, $value = null, $options = [])
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
                        'data-clipboard-action' => $action,
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

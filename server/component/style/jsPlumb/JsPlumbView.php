<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleView.php";

/**
 * The view class of the JsPlumb style component.
 * This style component is a visual container that allows to element connections
 */
class JsPlumbView extends StyleView
{
    /* Private Properties******************************************************/

    /**
     * DB field 'config' (empty string)
     * The configuration definition of the graph.
     */
    private $config;

    /* Constructors ***********************************************************/

    /**
     * The constructor.
     *
     * @param object $model
     *  The model instance of the footer component.
     * @param string $code
     * value from the url
     */
    public function __construct($model)
    {
        parent::__construct($model);
        $this->config = $this->model->get_db_field("config");
    }

    /* Private  Methods *******************************************************/


    /* Protected  Methods *****************************************************/


    public function output_content()
    {
        require __DIR__ . "/tpl_JsPlumb.php";
    }

    /**
     * Get js include files required for this component. This overrides the
     * parent implementation.
     *
     * @retval array
     *  An array of js include files the component requires.
     */
    public function get_js_includes($local = array())
    {
        if (empty($local)) {
            if (DEBUG) {
                $local = array(__DIR__ . "/js/jsPlumb.js", __DIR__ . "/js/jsplumb.bundle.js");
            } else {
                $local = array(
                    __DIR__ . "/../../../../js/ext/jsPlumb.min.js?v=" . rtrim(shell_exec("git describe --tags"))
                );
            }
        }
        return parent::get_js_includes($local);
    }

    /**
     * Get js include files required for this component. This overrides the
     * parent implementation.
     *
     * @retval array
     *  An array of js include files the component requires.
     */
    public function get_css_includes($local = array())
    {
        if (empty($local)) {
            if (DEBUG) {
                $local = array(__DIR__ . "/css/jsplumbtoolkit-defaults.min.css");
            } else {
                $local = array(__DIR__ . "/../../../../css/ext/jsPlumb.min.css?v=" . rtrim(shell_exec("git describe --tags")));
            }
        }
        return parent::get_css_includes($local);
    }
}
?>

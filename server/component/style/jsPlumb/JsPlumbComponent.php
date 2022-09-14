<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../graph/GraphBaseComponent.php";
require_once __DIR__ . "/GraphView.php";
require_once __DIR__ . "/GraphModel.php";

/**
 * A component class for a emailForm style component. This style is
 * intended to collect email addresses of interested users and send automated
 * emails to them.
 */
class GraphComponent extends GraphBaseComponent
{
    /* Constructors ***********************************************************/

    /**
     * The constructor creates an instance of the Model class and the View
     * class and passes the view instance to the constructor of the parent
     * class.
     *
     * @param array $services
     *  An associative array holding the different available services. See the
     *  class definition basepage for a list of all services.
     * @param int $id
     *  The section id of this component.
     * @param array $params
     *  The list of get parameters to propagate.
     * @param number $id_page
     *  The id of the parent page
     * @param array $entry_record
     *  An array that contains the entry record information.
     */
    public function __construct($services, $id, $params, $id_page, $entry_record)
    {
        $model = new GraphModel($services, $id, $params, $id_page, $entry_record);
        $code = isset($params['code']) ? $params['code'] : null;
        $view = new GraphView($model, $code);
        parent::__construct($model, $view, $id_page);
    }
}
?>

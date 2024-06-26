<?php
/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/. */
?>
<?php
require_once __DIR__ . "/../../../../../../component/style/StyleModel.php";

/**
 * This class is used to prepare all data related to the grap style components
 * such that the data can easily be displayed in the view of the component.
 */
class GraphModel extends StyleModel
{
    /* Private Properties *****************************************************/

    /**
     * DB field 'data-source' (empty string).
     * The data source to be used to draw the graph. This can either be a
     * dynamic or a static data source.
     */
    private $data_source;

    /**
     * DB field 'single-user' (true).
     * If set to true, only use the data set of the currently logged in user.
     * If set to false, use the data set of all users.
     */
    private $single_user;

    /* Constructors ***********************************************************/

    /**
     * The constructor fetches all session related fields from the database.
     *
     * @param array $services
     *  An associative array holding the different available services. See the
     *  class definition basepage for a list of all services.
     * @param int $id
     *  The section id of the navigation wrapper.
     * @param array $params
     *  The list of get parameters to propagate.
     * @param number $id_page
     *  The id of the parent page
     * @param array $entry_record
     *  An array that contains the entry record information.
     */
    public function __construct($services, $id, $params, $id_page, $entry_record)
    {
        parent::__construct($services, $id, $params, $id_page, $entry_record);
        $this->data_source = $this->get_db_field("data-source");
        $this->single_user = $this->get_db_field("single_user");
    }

    /* Private Methods ********************************************************/

    /* Protected Methods ******************************************************/

    /**
     * Read the source data from the database. This can either be static or
     * dynamic data depending on what was selected.
     *
     * @retval array
     *  A list of data items fetched from the DB. Refer to
     *  GraphModel::read_data_source_static() and
     *  GraphModel::read_data_source_dynmaic() for more information.
     *  If an error occurred, false is returned.
     */
    protected function read_data_source()
    {
        $sql = "SELECT * FROM view_dataTables WHERE table_name = :name";
        $source = $this->db->query_db_first($sql,
            array("name" => $this->data_source));
        return $this->user_input->get_data($source['id'], '', $this->single_user);
    }

    /* Public Methods *********************************************************/

    /**
     * Getter function of GraphModel::data_source
     */
    public function get_data_source()
    {
        return $this->data_source;
    }

    /**
     * Getter function of GraphModel::single_user
     */
    public function get_single_user()
    {
        return $this->single_user == 0 ? false : true;
    }

    /**
     * Checks wether the types array provided through the CMS contains all
     * required fields.
     *
     * @param array $value_types
     *  The array to be checked.
     * @retval boolean
     *  True on success, false on failure.
     */
    public function check_value_types($value_types) {
        if(!is_array($value_types) || count($value_types) === 0)
            return false;
        foreach($value_types as $idx => $item)
        {
            if(!isset($item["key"]))
                return false;
            if(!isset($item["label"]))
                return false;
        }
        return true;
    }

    /**
     * Extracts all labels from a list of associative arrays where each item as
     * the key `label`.
     *
     * @param array $value_types
     *  A list of items where each item is expected to have a key `label`.
     * @retval array
     *  A list of labels.
     */
    public function extract_labels($value_types) {
        $labels = array();
        foreach($value_types as $type) {
            $labels[$type['key']] = $type['label'];
        }
        return $labels;
    }

    /**
     * Extracts all colors from a list of associative arrays where each item as
     * the key `color`.
     *
     * @param array $value_types
     *  A list of items where each item is expected to have a key `color`.
     * @retval array
     *  A list of colors.
     */
    public function extract_colors($value_types) {
        $colors = array();
        foreach($value_types as $type) {
            if(isset($type['color']))
                $colors[$type['key']] = $type['color'];
        }
        return $colors;
    }

    /**
     * Extracts all keys from a list of associative arrays where each item as
     * the key `key`.
     *
     * @param array $value_types
     *  A list of items where each item is expected to have a key `key`.
     * @retval array
     *  A list of keys.
     */
    public function extract_keys($value_types) {
        $keys = array();
        foreach($value_types as $type) {
            if(isset($type['key']))
                array_push($keys, $type['key']);
        }
        return $keys;
    }
}
?>

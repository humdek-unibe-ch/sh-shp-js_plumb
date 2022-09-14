-- add plugin entry in the plugin table
INSERT IGNORE INTO plugins (name, version) 
VALUES ('jsPlumb', 'v1.0.0');

-- add style JsPlumb and all its fields
INSERT IGNORE INTO `styles` (`id`, `name`, `id_type`, `id_group`, `description`) VALUES (NULL, 'jsPlumb', '0000000001', (SELECT id FROM styleGroup WHERE `name` = 'Wrapper' LIMIT 1), 'JS Plumb style that allow us to draw connections between elements. The style is based in [jsPlumb](https://github.com/jsplumb/jsplumb)');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('config'), NULL, 'Define the configuration of the connections. Refer to the documentation of [jsPlumb](https://docs.jsplumbtoolkit.com/community/) for more information');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('children'), 0, 'Children that can be added to the style. Each child will be loaded as a page');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('css'), NULL, 'Allows to assign CSS classes to the root item of the style.');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('css_mobile'), NULL, 'Allows to assign CSS classes to the root item of the style for the mobile version.');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('condition'), NULL, 'The field `condition` allows to specify a condition. Note that the field `condition` is of type `json` and requires\n1. valid json syntax (see https://www.json.org/)\n2. a valid condition structure (see https://github.com/jwadhams/json-logic-php/)\n\nOnly if a condition resolves to true the sections added to the field `children` will be rendered.\n\nIn order to refer to a form-field use the syntax `"@__form_name__#__from_field_name__"` (the quotes are necessary to make it valid json syntax) where `__form_name__` is the value of the field `name` of the style `formUserInput` and `__form_field_name__` is the value of the field `name` of any form-field style.');
INSERT IGNORE INTO `styles_fields` (`id_styles`, `id_fields`, `default_value`, `help`) VALUES (get_style_id('jsPlumb'), get_field_id('data_config'), '', 
'In this ***JSON*** field we can configure a data retrieve params from the DB, either `static` or `dynamic` data. Example: 
 ```
 [
	{
		"type": "static|dynamic",
		"table": "table_name | #url_param1",
        "retrieve": "first | last | all",
		"fields": [
			{
				"field_name": "name | #url_param2",
				"field_holder": "@field_1",
				"not_found_text": "my field was not found"				
			}
		]
	}
]
```
If the page supports parameters, then the parameter can be accessed with `#` and the name of the paramer. Example `#url_param_name`. 

In order to inlcude the retrieved data in the input `value`, include the `field_holder` that wa defined in the markdown text.

We can access multiple tables by adding another element to the array. The retrieve data from the column can be: `first` entry, `last` entry or `all` entries (concatenated with ;);

`It is used for prefil of the default value`');
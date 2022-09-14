# SelfHelp plugin - jsPlumb

This is a SelfhelpPlugin that is used for drawing connections between elements

 - The plugin is based on [`jsPlumb.js`](https://github.com/jsplumb/jsplumb) library

# Installation

 - Download the code into the `plugin` folder
 - Checkout the latest version 
 - Execute all `.sql` script in the DB folder in their version order

# How to use

 - example JSON 
 `{
	"classes": {
		".class1": {
			"anchors": [
				"Center",
				"Center"
			],
			"connector": "Straight",
			"endpoint": {
				"type": "Dot",
				"options": {
					"radius": 12
				}
			},
			"paintStyle": {
				"stroke": "#fee6c5",
				"strokeWidth": 3
			},
			"endpointStyle": {
				"fill": "#e37165"
			}
		},
		".class2": {
			"anchors": [
				"Center",
				"Center"
			],
			"connector": "Straight",
			"endpoint": {
				"type": "Dot",
				"options": {
					"radius": 8
				}
			},
			"paintStyle": {
				"stroke": "blue",
				"strokeWidth": 2
			},
			"endpointStyle": {
				"fill": "yellow"
			}
		}
	},
	"config": {
		"connectionsDetachable": false,
		"reattachConnections": true,
		"maxConnections": 1
	}
}`

# Requirements

 - SelfHelp v5.2.5+

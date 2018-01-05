/**
 * TinyMCE buttons for custom shortcodes
 */
'use strict';
(function() {
	tinymce.PluginManager.add('epic_spinners_add_mce_button', function(editor, url) {
		editor.addButton('epic_spinners_add_mce_button', {
			title: 'Insert Epic Spinners Icons',
			type: 'menubutton',
			icon: 'icon epic-spinners-mce-icon',
			menu: [{
					text: 'Orbit Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Orbit Spinner Icon',
							body: [{
									type: 'colorpicker',
									name: 'color',
									label: 'Orbit Spinner Icon Color'
								},
								{
									type: 'listbox',
									name: 'pixel_size',
									label: 'Size',
									'values': [{
											text: '55px',
											value: '55px'
										},
										{
											text: '25px',
											value: '25px'
										},
										{
											text: '100px',
											value: '100px'
										},
										{
											text: '150px',
											value: '150px'
										},
										{
											text: '200px',
											value: '200px'
										},
									]
								},
							],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="orbit-spinner" color="' + e.data.color + '" size="' + e.data.pixel_size + '"]');
							}
						});
					}
				},
				{
					text: 'Atom Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Atom Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Atom Spinner Icon Color'
							},
							{
								type: 'listbox',
								name: 'pixel_size',
								label: 'Size',
								'values': [{
										text: '55px',
										value: '55px'
									},
									{
										text: '25px',
										value: '25px'
									},
									{
										text: '100px',
										value: '100px'
									},
									{
										text: '150px',
										value: '150px'
									},
									{
										text: '200px',
										value: '200px'
									},
								]
							},
						 ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="atom-spinner" color="' + e.data.color + '" size="' + e.data.pixel_size + '"]');
							}
						});
					}
				},
				{
					text: 'Flower Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Atom Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Flower Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="flower-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Pixel Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Pixel Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Pixel Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="pixel-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Hollow Dots Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Pixel Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Hollow Dots Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="hollow-dots-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Intersecting Circles Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Intersecting Circles Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Intersecting Circles Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="intersecting-circles-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Radar Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Radar Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Radar Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="radar-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Scaling Squares Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Scaling Squares Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Scaling Squares Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="scaling-squares-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Half Circle Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Half Circle Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Half Circle Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="half-circle-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Trinity Rings Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Trinity Rings Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Trinity Rings Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="trinity-rings-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Fulfilling Square Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Fulfilling Square Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Fulfilling Square Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="fulfilling-square-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Circles To Rhombuses Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Circles To Rhombuses Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Circles To Rhombuses Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('[epicspin type="circles-to-rhombuses-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Semipolar Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Semipolar Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Semipolar Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('[epicspin type="semipolar-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Self Building Square Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Self Building Square Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Self Building Square Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="self-building-square-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Swapping Squares Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Swapping Squares Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Swapping Squares Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="swapping-squares-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Fulfilling Bouncing Circle Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Fulfilling Bouncing Circle Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Fulfilling Bouncing Circle Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="fulfilling-bouncing-circle-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Fingerprint Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Fingerprint Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Fingerprint Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="fingerprint-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Spring Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Spring Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Spring Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="spring-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Looping Rhombuses Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Looping Rhombuses Spinner Icon',
							body: [{
								type: 'colorpicker',
								name: 'color',
								label: 'Looping Rhombuses Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="looping-rhombuses-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
				{
					text: 'Breeding Rhombus Spinner',
					onclick: function() {
						editor.windowManager.open({
							title: 'Insert Breeding Rhombus Spinner Icon',
							body: [{

								type: 'colorpicker',
								name: 'color',
								label: 'Breeding Rhombus Spinner Icon Color'
							}, ],
							onsubmit: function(e) {
								editor.insertContent('[epicspin type="breeding-rhombus-spinner" color="' + e.data.color + '"]');
							}
						});
					}
				},
			]
		});
	});
})();

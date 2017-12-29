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
							}, ],
							onsubmit: function(e) {
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="orbit-spinner orbit-spinner-' + random_string_thingy + '"><div class="orbit"></div><div class="orbit"></div><div class="orbit"></div></div><style>.orbit-spinner-' + random_string_thingy + ' .orbit:nth-child(-n+3){border-color:' + e.data.color + '!important;}</style>');
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
							}, ],
							onsubmit: function(e) {
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="atom-spinner atom-spinner-' + random_string_thingy + '"><div class="spinner-inner"><div class="spinner-line"></div><div class="spinner-line"></div><div class="spinner-line"></div><div class="spinner-circle">&#9679;</div></div></div><style>.atom-spinner-' + random_string_thingy + ' .spinner-line{border-left-color:' + e.data.color + '!important;} .atom-spinner-' + random_string_thingy + ' .spinner-circle {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="flower-spinner flower-spinner-' + random_string_thingy + '"><div class="dots-container"><div class="bigger-dot"><div class="smaller-dot"></div></div></div></div><style>.flower-spinner{color:' + e.data.color + '!important;},.flower-spinner-' + random_string_thingy + ' .bigger-dot {color:' + e.data.color + '!important;background:' + e.data.color + '!important;} .flower-spinner-' + random_string_thingy + ' .smaller-dot {color:' + e.data.color + '!important; background:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="pixel-spinner pixel-spinner-' + random_string_thingy + '"><div class="pixel-spinner-inner pixel-spinner-inner"></div></div><style>.pixel-spinner-' + random_string_thingy + ' .pixel-spinner-inner{color:' + e.data.color + '!important;background:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="hollow-dots-spinner hollow-dots-spinner-' + random_string_thingy + '" :style="spinnerStyle"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div><style>.hollow-dots-spinner-' + random_string_thingy + ' .dot{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="intersecting-circles-spinner intersecting-circles-spinner-' + random_string_thingy + '"><div class="spinnerBlock"><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span><span class="circle"></span></div></div><style>.intersecting-circles-spinner-' + random_string_thingy + '  .circle{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="radar-spinner radar-spinner-' + random_string_thingy + '" :style="spinnerStyle"><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div><div class="circle"><div class="circle-inner-container"><div class="circle-inner"></div></div></div></div><style>.radar-spinner-' + random_string_thingy + '  .circle-inner{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="scaling-squares-spinner scaling-squares-spinner-' + random_string_thingy + '" :style="spinnerStyle"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square"></div></div><style>.scaling-squares-spinner-' + random_string_thingy + ' .square{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="half-circle-spinner half-circle-spinner-' + random_string_thingy + '"><div class="circle circle-1"></div><div class="circle circle-2"></div></div><style>.half-circle-spinner-' + random_string_thingy + ' .circle.circle-1{color:' + e.data.color + '!important;}.circle.circle-2{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="trinity-rings-spinner trinity-rings-spinner-' + random_string_thingy + '"><div class="circle"></div><div class="circle"></div><div class="circle"></div></div><style>.trinity-rings-spinner-' + random_string_thingy + ' .circle{color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="fulfilling-square-spinner fulfilling-square-spinner-' + random_string_thingy + '"><div class="spinner-inner"></div></div><style>.fulfilling-square-spinner-' + random_string_thingy + ' {color:' + e.data.color + '!important;}.fulfilling-square-spinner-' + random_string_thingy + ' .spinner-inner {background-color:' + e.data.color + '!important;}</style>');
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
								editor.insertContent('<div class="circles-to-rhombuses-spinner circles-to-rhombuses-spinner-' + random_string_thingy + '"><div class="circle"></div><div class="circle"></div><div class="circle"></div></div><style>.circles-to-rhombuses-spinner-' + random_string_thingy + ' .circle {color:' + e.data.color + '!important;}</style>');
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
								editor.insertContent('<div class="semipolar-spinner semipolar-spinner-' + random_string_thingy + '" :style="spinnerStyle"><div class="ring"></div><div class="ring"></div><div class="ring"></div><div class="ring"></div><div class="ring"></div></div><style>.semipolar-spinner-' + random_string_thingy + ' .ring {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="self-building-square-spinner self-building-square-spinner-' + random_string_thingy + '"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square clear"></div><div class="square"></div><div class="square"></div><div class="square clear"></div><div class="square"></div><div class="square"></div></div><style>.self-building-square-spinner-' + random_string_thingy + ' .square {background:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="swapping-squares-spinner swapping-squares-spinner-' + random_string_thingy + '" :style="spinnerStyle"><div class="square"></div><div class="square"></div><div class="square"></div><div class="square"></div></div><style>.swapping-squares-spinner-' + random_string_thingy + ' .square {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="fulfilling-bouncing-circle-spinner fulfilling-bouncing-circle-spinner-' + random_string_thingy + '"><div class="circle"></div><div class="orbit"></div></div><style>.fulfilling-bouncing-circle-spinner-' + random_string_thingy + ' .orbit {color:' + e.data.color + '!important;}.fulfilling-bouncing-circle-spinner-' + random_string_thingy + ' .circle {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="fingerprint-spinner fingerprint-spinner-' + random_string_thingy + '"><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div><div class="spinner-ring"></div></div><style>.fingerprint-spinner-' + random_string_thingy + ' .spinner-ring {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="spring-spinner spring-spinner-' + random_string_thingy + '"><div class="spring-spinner-part top"><div class="spring-spinner-rotator"></div></div><div class="spring-spinner-part bottom"><div class="spring-spinner-rotator"></div></div></div><style>.spring-spinner-' + random_string_thingy + ' .spring-spinner-rotator {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="looping-rhombuses-spinner looping-rhombuses-spinner-' + random_string_thingy + '"><div class="rhombus"></div><div class="rhombus"></div><div class="rhombus"></div></div><style>.looping-rhombuses-spinner-' + random_string_thingy + ' .rhombus {color:' + e.data.color + '!important;}</style>');
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
								var random_string_thingy;
								random_string_thingy = Math.random().toString(36).substring(7);
								editor.insertContent('<div class="breeding-rhombus-spinner breeding-rhombus-spinner-' + random_string_thingy + '"><div class="rhombus child-1"></div><div class="rhombus child-2"></div><div class="rhombus child-3"></div><div class="rhombus child-4"></div><div class="rhombus child-5"></div><div class="rhombus child-6"></div><div class="rhombus child-7"></div><div class="rhombus child-8"></div><div class="rhombus big"></div></div><style>.breeding-rhombus-spinner-' + random_string_thingy + ' .rhombus {color:' + e.data.color + '!important;}</style>');
							}
						});
					}
				},
			]
		});
	});
})();

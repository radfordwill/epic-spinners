"use strict";
jQuery(document).ready(function () {
	var editor = CodeMirror.fromTextArea(newcontent, {
		value: "function ES_ShortcodeScript(){return 100;}\n",
		lineNumbers: true,
		minHeight: '600px',
		width: '100%',
		height: 'dynamic',
		mode: 'javascript',
		readOnly: true,
		theme: 'default',
		styleActiveLine: true
	});


});

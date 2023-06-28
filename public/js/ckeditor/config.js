/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.width = 810;
};
CKEDITOR.on( 'instanceReady', function( ev ) {

var blockTags = ['div','h1','h2','h3','h4','h5','h6','p','pre'];

var rules = {
indent : false,
breakBeforeOpen : false,
breakAfterOpen : false,
breakBeforeClose : false,
breakAfterClose : true
};

for (var i=0; i<blockTags.length; i++) {
ev.editor.dataProcessor.writer.setRules( blockTags[i], rules );
}

});


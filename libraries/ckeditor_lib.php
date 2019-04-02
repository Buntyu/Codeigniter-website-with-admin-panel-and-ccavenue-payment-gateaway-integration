<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ckeditor_lib 
{
    function __construct()
    {		
		require_once("extras/ckeditor/ckeditor.php");		
    }
	function createTextBox($fieldname, $value = "",$height = 400,$width=975) 
	{
	   $CKEditor = new CKEditor();
	   $config['toolbar'] = array(
		array("Source","NewPage","DocProps","Preview","Print","Templates","document"),//,"Save"
		array("Cut","Copy","Paste","PasteText","PasteFromWord","Undo","Redo"),
		array("Find","Replace","SelectAll","Scayt"),
		array("Form","Checkbox","Radio","TextField","Textarea","Select","Button","ImageButton","HiddenField"),
		array("Bold","Italic","Underline","Strike","Subscript","Superscript","RemoveFormat"),
		array("NumberedList","BulletedList","Outdent","Indent","Blockquote","CreateDiv","JustifyLeft","JustifyCenter","JustifyRight","JustifyBlock","BidiLtr","BidiRtl"),
		array("Link","Unlink","Anchor"),
		array("CreatePlaceholder","Image","Flash","Table","HorizontalRule","Smiley","SpecialChar","PageBreak","Iframe","InsertPre"),
		array("Styles","Format","Font","FontSize"),
		array("TextColor","BGColor"),
		array("UIColor","Maximize","ShowBlocks"),
		array("button1","button2","button3","oembed","MediaEmbed")
	   );	   
	   $CKEditor->basePath = '../extras/ckeditor/';
	   $CKEditor->config['width'] = $width;
	   $CKEditor->config['height'] = $height;
	   $CKEditor->editor($fieldname, $value, $config);
	}	
}
?>
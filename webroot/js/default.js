//FLASH MESSAGE DISSAPEAR
jQuery(function(){
    setTimeout(function() {
        $('.message.error').hide();}, 6000);
});

jQuery(function(){
    setTimeout(function() {
        $('.message.success').hide();}, 6000);
});

//prettyPhoto
$(document).ready(function(){
$("a[rel^='prettyPhoto']").prettyPhoto({deeplinking: false, theme: 'glidecam', overlay_gallery: false});
});

//TINYMCE
tinymce.init({
  mode: "textareas",
  
  editor_deselector: "mceNoEditor",
  
  // ===========================================
  // INCLUDE THE PLUGIN
  // ===========================================
	
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table contextmenu paste"
  ],
	
  // ===========================================
  // PUT PLUGIN'S BUTTON on the toolbar
  // ===========================================
	
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	
  // ===========================================
  // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
  // ===========================================
	
  relative_urls: false,
  file_browser_callback: RoxyFileBrowser
});
function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = 'http://'+window.location.hostname+'/cakeblog/app/webroot/js/tinymce/plugins/fileman/index.html';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'Roxy Fileman',
     width: 850, 
     height: 650,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
}
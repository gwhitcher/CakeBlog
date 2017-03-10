//Upload manager page loader by George Whitcher 9/22/15
tinymce.PluginManager.add('uploadmanager', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('uploadmanager', {
        text: 'Upload Manager',
        icon: false,
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'Upload Manager',
                body: [
                    {type: 'textbox', name: 'title', label: 'Title'}
                ],
                onsubmit: function(e) {
                    // Insert content when the window form is submitted
                    editor.insertContent('Title: ' + e.data.title);
                }
            });
        }
    });

    // Adds a menu item to the tools menu
    editor.addMenuItem('uploadmanager', {
        text: 'Upload Manager',
        context: 'tools',
        onclick: function() {
            // Open window with a specific url
            editor.windowManager.open({
                title: 'Upload Manager',
                url: ''+window.location.origin+'/admin/uploads/',
                width: 800,
                height: 600,
                buttons: [{
                    text: 'Close',
                    onclick: 'close'
                }]
            });
        }
    });
});
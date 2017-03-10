/* Custom JS */

//Flash message disappear
jQuery(document).ready(function($){
    if('.fadeout-message'){
        setTimeout(function() {
            $('.alert').slideUp(1200);
        }, 5000);
    }
});

/* Delete Confirm */
$(document).ready(function(){
    $(".delete, .confirm").on("click", null, function(){
        return confirm("Are you sure?");
    });
})

/* Popup on hover */
$(document).ready(function(){
    $('#popup').popover({ trigger: "hover" });
})

//TINYMCE
tinymce.init({
    selector : "textarea:not(.mceNoEditor)",
    plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools uploadmanager'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons',
    image_advtab: true,
    //Image add full url
    relative_urls : false,
    remove_script_host : false,
    convert_urls : true
});
// Prevent bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".mce-window").length) {
        e.stopImmediatePropagation();
    }
});

//Add and remove TinyMCE
unloadTiny = function(){
    tinymce.remove('textarea');
    alert('TinyMCE was removed.')
}
loadTiny = function(){
    if (confirm('Adding TinyMCE will break PHP tags.  Are you sure you want to add TinyMCE?')) {
        tinymce.EditorManager.execCommand('mceAddEditor', true, "body");
        alert('TinyMCE was added.')
    } else {
        alert('TinyMCE was not added.')
    }
}

$(document).ready(function () {
    $('#menu > ul.nav li a').click(function(e) {
        var $this = $(this);
        $this.parent().siblings().removeClass('active').end().addClass('active');
        e.preventDefault();

        // Load the page content in to element
        // with id #content using ajax (There are other ways)
        $('#content').load($this.href());
    });
});
function tinyfy(el_id) {

    tinyMCE.init({selector:'textarea.vizivig'});

    settings = {
        mode :    "none",
        theme :   "advanced",
        plugins : "spellchecker,preview",
        theme_advanced_buttons1 : "bold,italic,underline,|,sub,sup,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,|,image,link,unlink,|,code,preview,removeformat,visualaid,charmap,spellchecker",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_toolbar_location :   "top",
        theme_advanced_toolbar_align :      "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing :           false
    };

    tinyMCE.settings = settings;
    tinyMCE.execCommand('mceAddControl', false, el_id);
};


$(document).ready( function(){

    /**
     * Create new content block
     */
    $('.add-content-block').on("click", function(){

        divContentBlock = $('.page-contents');

        if (divContentBlock.length >0 ){

            countBlocks = $('.add-content-block').attr('attr-blocks-count');

            $.post("/pages/pages/create_content_block",{ blocks_count: countBlocks}, function(data){

                if (data.content_block) {
                        contentsHtml = divContentBlock.html();
                        contentsHtml = contentsHtml + data.content_block;
                        divContentBlock.html(contentsHtml);

                        new jscolor.color(document.getElementById('PagePages_contentBlocks_background_color_' + countBlocks), {});

                        tinyfy('PagePages_contentBlocks_content_' + countBlocks);

                        countBlocks++;

                        $('.add-content-block').attr('attr-blocks-count', countBlocks);
                }
            }, "json");
        }
    });
});
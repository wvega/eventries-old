if (jQuery !== undefined) {

(function($, undefined) {
    $(function() {
        // console.log($('#primary article.hentry'));
        $('#primary .article-wrapper').wookmark({
            container: $('#primary-inner'),
            autoResize: true
        });
    });
}(jQuery));

}
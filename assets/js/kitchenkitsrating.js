$(function() {
    function ratingEnable() {
        $('#example-fontawesome').barrating({
            theme: 'fontawesome-stars'
        });

        $('select#example-fontawesome').barrating('set', 5);

        var currentRating = $('#example-fontawesome-o').data('current-rating');

        $('.stars-example-fontawesome-o .current-rating')
            .find('span')
            .html(currentRating);

        $('#example-fontawesome-o').barrating({
            theme: 'fontawesome-stars-o',
            initialRating: currentRating,
            readonly: true
        });
    }

    ratingEnable();
});

$(function() {
    function ratingEnable() {
        $('.recipe_rating').each(function() {
            var review_id = $(this).attr('review-id');
            var currentRating = $(this).attr('data-rating');
            $('#rating'+review_id).barrating({
                theme: 'fontawesome-stars-o',
                initialRating: currentRating,
                readonly: true
            });
        });

        $('.top_recipe_rating').each(function() {
            var review_id = $(this).attr('topreview-id');
            var currentRating = $(this).attr('data-top-rating');
            $('#toprating'+review_id).barrating({
                theme: 'fontawesome-stars-o',
                initialRating: currentRating,
                readonly: true
            });
        });

        $('.browse_recipe_rating').each(function() {
            var review_id = $(this).attr('browsereview-id');
            var currentRating = $(this).attr('data-browse-rating');
            $('#browserating'+review_id).barrating({
                theme: 'fontawesome-stars-o',
                initialRating: currentRating,
                readonly: true
            });
        });

        $('.recipe_rating').each(function() {
            var review_id = $(this).attr('recipereview-id');
            var currentRating = $(this).attr('data-recipe-rating');
            $('#reciperating'+review_id).barrating({
                theme: 'fontawesome-stars-o',
                initialRating: currentRating,
                readonly: true
            });
        });

        $('#example-fontawesome').barrating({
            theme: 'fontawesome-stars'
        });

        $('select#example-fontawesome').barrating('set', 5);

    }

    ratingEnable();
});

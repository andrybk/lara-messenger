var disabled = false;

$(document).ready(function () {


    $(document).on('click', '.pagination a', function (event) {

        disabled = true;
        $('a').css('opacity', '0.4');
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var page = $(this).attr('href').split('page=')[1];

        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html",
                success: function(e) {
                    //Re-enable other links once ajax is complete
                    disabled = false;
                    //$('a').css('opacity','1');
                }

            }).done(function (data) {
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    });

});

$('.pagination').click(function (event) {
    if (disabled)
        return false;
});
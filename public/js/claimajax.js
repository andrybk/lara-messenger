
$('body').on('click', '.list-group-item-action', function (event) {

    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        id = me.attr('href').split('claims/')[1];

    var links = $('a');
    links.css('opacity', '0.4');
    links.removeClass('active');
    $(this).addClass('active');

    $.ajax({
        url: url,
        datatype: "html",
        success: function (e) {
            links.css('opacity','1');
            $("#tag_container").empty().html(e);
            location.hash = id;
        },
    }).done(function (data) {

    }).fail(function (jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
        links.css('opacity','1');
    });

});
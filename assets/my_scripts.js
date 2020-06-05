$(document).ready(function () {
    console.log('Hello World');
    $('#theme_btn').click(function () {
        var urlGet = $(this).data('url');

        $.ajax({
            method: 'POST',
            dataType: 'JSON',
            url: urlGet,
            success: function (response) {
                if (response['signal'] === 'red') {

                    $('body').removeClass('bg-dark');
                    $('.navbar').removeClass('navbar-dark');
                    $('.navbar').removeClass('bg-dark');
                    $('.table').removeClass('table-dark');
                    $('.breadcrumb').removeClass('bg-dark');
                    $('footer').removeClass('bg-dark');
                    $('#theme_btn').html("Dark Mode");
                    $('.cal-list').removeClass('bg-dark');
                    $('.list-group .list-group-item').removeClass('bg-dark');
                } else {
                    $('#theme_btn').html("Light Mode");
                    $('.navbar').addClass('navbar-dark bg-dark');
                    $('body').addClass('bg-dark');
                    $('footer').addClass('bg-dark');
                    $('.table').addClass('table-dark');
                    $('.breadcrumb').addClass('bg-dark');
                    $('.cal-list').addClass('bg-dark');

                    $('.list-group .list-group-item').addClass('bg-dark');
                }
            }, error: function (error) {
                console.log(error);
            }
        });
    })

})
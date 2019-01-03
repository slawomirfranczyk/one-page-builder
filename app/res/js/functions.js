$(window).on('load', function () {

    $('.loader').fadeOut("slow");

});

$(document).ready(function () {

    //ModalBox inicjalizacja 
    var modal = new Custombox.modal({
        content: {
            effect: 'fadein',
            target: '#modal',
            fullscreen: 'true',
            delay: 250,
            onComplete: function () {

                //edycja treści

                //console.log(content);

            },

            onClose: function () {


            }
        }
    });

    //SimpleMDE inicjalizacja
    var simplemde = new SimpleMDE({

        autoDownloadFontAwesome: false,
        spellChecker: false,

        shortcuts: {
            "toggleBlockquote": null,
            "toggleBold": null,
            "cleanBlock": null,
            "toggleHeadingSmaller": null,
            "toggleItalic": null,
            "drawLink": null,
            "toggleUnorderedList": null,
            "togglePreview": null,
            "toggleCodeBlock": null,
            "toggleOrderedList": null,
            "toggleHeadingBigger": null
        }

    });



    //dodanie elementu 
    $('.add').click(function () {

        var add = new Custombox.modal({
            content: {
                effect: 'fadein',
                target: '#add_options'
            }
        });

        add.open();

    });

    $('.add-elem').click(function () {

        var elem_name = $(this).attr('id');
        var dataString = 'newElem=' + elem_name;

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function () {
                location.reload();
            }
        });

    });

    //Usuwanie elementu 
    $('.del-btn').click(function () {

        var currentId = parseInt($(this).parents('section').attr('id').substr(1, 3));
        var dataString = 'elemId=' + currentId + '&del=true';

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function (result) {
                //console.log(result);
                location.reload();
            }
        });


    })


    //Modal otwarcie

    var content = '';
    var editId = ''
    $('.edit-btn').click(function () {

        editId = $(this).closest('section').attr('id').substr(1, 3);
        var dataString = 'edit=' + parseInt(editId);

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function (result) {

                content = result;
				simplemde.value(content);

            }
        });


        modal.open();

    });

    //zapisanie zmian po edycji
    $('.save-btn').click(function () {

        var fcontent = simplemde.value();
        console.log(editId);
        var dataString = 'saveChanges=' + parseInt(editId) + '&fcontent=' + fcontent;

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function (result) {
                history.go(0);
            }
        });

    });

    //anulowanie zapisu
    $(".exit-btn").click(function () {

        simplemde.value('');
        Custombox.modal.close();


    });








    //Styl sekcji podczas edycji
    if ($('#top-tool-bar').attr('id') != null) {
        $('section').css('border-top', '4px solid #3f3c3f');
        $('section').css('min-height', '400px');
        $('footer').css('border-top', '4px solid #3f3c3f');
    }


    //Usuwanie niedozwlonych przycisków z menu admina
    var first = $("[id*=e01]");
    var second = $("[id*=e02]");
    var footer = $("footer");
    first.find('.up').remove();
    first.find('.down').remove();
    first.find('.del-btn').remove();
    second.find('.up').remove();
    footer.prev('section').find('.down').remove();
    footer.find('.tool-bar').remove();


    //Przyciski do zmiany kolejnosci elementów strony	
    $(".down").click(function () {

        var currentId = parseInt($(this).parents('section').attr('id').substr(1, 3));
        var dataString = 'currentId=' + currentId + '&go=down';

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function (result) {
                location.reload();
                //console.log(result);
            }
        });

    });

    $(".up").click(function () {

        var currentId = parseInt($(this).parents('section').attr('id').substr(1, 3));
        var dataString = 'currentId=' + currentId + '&go=up';

        $.ajax({
            type: "POST",
            url: "app/core/admin-functions.php",
            data: dataString,
            cache: false,
            success: function (result) {
                location.reload();
                //console.log(result);
            }
        });

    });


});
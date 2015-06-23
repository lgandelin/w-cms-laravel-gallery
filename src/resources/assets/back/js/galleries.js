$(document).ready(function() {

    //Close gallery item form
    $('.gallery-item-form .btn-close').click(function() {
        $('.gallery-item-form').hide();
    });

    //Create gallery item
    $('body').on('click', '.btn-create-gallery-item', function() {
        $('.gallery-item-form .btn-valid').attr('data-action', 'create');
        $('.gallery-item-form').show();
    });

    //Update gallery item
    $('body').on('click', '.gallery-item-update', function() {

        var gallery_item_id = $(this).attr('data-id');
        $('.gallery-item-form .btn-valid').attr('data-id', gallery_item_id).attr('data-action', 'update');

        $.ajax({
            type: "GET",
            url: route_gallery_items_get_infos + '/' + gallery_item_id,
            success: function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    $('.gallery-item-form .title').val(data.gallery_item.title);
                    $('.gallery-item-form .text').val(data.gallery_item.text);
                    if (!CKEDITOR.instances["text"]) {
                        CKEDITOR.replace('text');
                    }
                    CKEDITOR.instances["text"].setData(data.gallery_item.text);
                    $('.gallery-item-form .class').val(data.gallery_item.class);
                    $('.gallery-item-form .media_id').val(data.gallery_item.media_id);
                    $('.gallery-item-form .link').val(data.gallery_item.link);
                    $('.gallery-item-form #gallery-item-media-id .thumbnail img').attr('src', data.gallery_item.media_src);
                    $('.gallery-item-form #gallery-item-media-id .media-name').text(data.gallery_item.media_name);
                    $('.gallery-item-form #gallery-item-media-id input[name="mediaID"]').val(data.gallery_item.media_id);

                    $('.gallery-item-form').show();
                } else
                    display_error(data.error);
            }
        });
    });

    //Valid gallery item
    $('body').on('click', '.gallery-item-form .btn-valid', function() {
        if ($(this).attr('data-action') == 'create') {
            var input_data = {
                'title': $('.gallery-item-form .title').val(),
                'text': CKEDITOR.instances["text"].getData(),
                'order': 999,
                'link': $('.gallery-item-form .link').val(),
                'class': $('.gallery-item-form .class').val(),
                'media_id': $('.gallery-item-form .media_id').val(),
                'gallery_id': $('.gallery-id').val(),
                'display': 1,
                '_token': $('input[name="_token"]').val()
            };

            var button = $(this);
            button.val('Saving ...');

            $.ajax({
                type: "POST",
                url: route_gallery_items_create,
                data: input_data,
                success: function(data) {
                    data = JSON.parse(data);

                    if (data.success) {
                        button.val('Submit');

                        $('.gallery-item-form').hide();
                        $('.gallery-item-form .title').val('');
                        $('.gallery-item-form .text').val('');
                        $('.gallery-item-form .media_id').val('');
                        $('.gallery-item-form .link').val('');
                        $('.gallery-item-form .class').val('');

                        //Create gallery item
                        var gallery_item_content = '<div id="mi-' + data.gallery_item.ID + '" class="gallery_item" data-display="1"><span class="title"><span class="gallery_item_title">' + data.gallery_item.title + '</span><span data-id="' + data.gallery_item.ID + '" class="gallery-item-delete glyphicon glyphicon-remove"></span><span data-id="' + data.gallery_item.ID + '" class="gallery-item-move glyphicon glyphicon-move"></span><span data-id="' + data.gallery_item.ID + '" class="gallery-item-display glyphicon glyphicon-eye-open"></span><span data-id="' + data.gallery_item.ID + '" class="gallery-item-update glyphicon glyphicon-pencil"></span></span></div>';
                        $('.gallery-items-wrapper').append(gallery_item_content);
                    } else
                        display_error(data.error);
                }
            });
        } else if ($(this).attr('data-action') == 'update') {
            var input_data = {
                'ID': $(this).attr('data-id'),
                'title': $('.gallery-item-form .title').val(),
                'text': CKEDITOR.instances["text"].getData(),
                'link': $('.gallery-item-form .link').val(),
                'class': $('.gallery-item-form .class').val(),
                'media_id': $('.gallery-item-form .media_id').val(),
                'gallery_id': $('.gallery-id').val(),
                '_token': $('input[name="_token"]').val()
            };

            var button = $(this);
            button.val('Saving ...');

            $.ajax({
                type: "POST",
                url: route_gallery_items_update_infos,
                data: input_data,
                success: function(data) {
                    data = JSON.parse(data);

                    if (data.success) {
                        button.val('Submit');

                        $('.gallery-item-form').hide();
                        $('.gallery-item-form .title').val('');
                        $('.gallery-item-form .text').val('');
                        $('.gallery-item-form .class').val('');
                        $('.gallery-item-form .media_id').val('');
                        $('.gallery-item-form .link').val('');

                        $('#mi-' + input_data.ID + ' .gallery_item_title').text(input_data.title);
                    } else
                        display_error(data.error);
                }
            });
        }
    });

    //Display gallery_item
    $('body').on('click', '.gallery-item-display', function() {
        var gallery_item_id = $(this).attr('data-id');
        var gallery_item = $('.gallery_item[id="mi-' + gallery_item_id + '"]');

        var data = {
            'ID': gallery_item_id,
            'display': ((1 + parseInt(gallery_item.attr('data-display'))) % 2),
            '_token': $('input[name="_token"]').val()
        };

        $.ajax({
            type: "POST",
            url: route_gallery_items_display,
            data: data,
            success: function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    var gallery_item = $('.gallery_item[id="mi-' + gallery_item_id + '"]');
                    if (parseInt(gallery_item.attr('data-display')) == 0) {
                        gallery_item.find('.gallery-item-display').removeClass('gallery-item-hidden');
                        gallery_item.attr('data-display', 1);
                    } else {
                        gallery_item.find('.gallery-item-display').addClass('gallery-item-hidden');
                        gallery_item.attr('data-display', 0);
                    }
                } else
                    display_error(data.error);
            }
        });
    });

    //Delete gallery item
    $('body').on('click', '.gallery-item-delete', function() {

        if (confirm('Are you sure that you want to delete this item ?')) {
            var gallery_item_id = $(this).attr('data-id');

            var data = {
                'ID': gallery_item_id,
                '_token': $('input[name="_token"]').val()
            };

            $.ajax({
                type: "POST",
                url: route_gallery_items_delete,
                data: data,
                success: function(data) {
                    data = JSON.parse(data);

                    if (data.success)
                        $('.gallery_item[id="mi-' + gallery_item_id + '"]').remove();
                    else
                        display_error(data.error);
                }
            });
        }
    });

    init_gallery_items_sortable();
});

function init_gallery_items_sortable() {
    $( ".gallery-items-wrapper" ).sortable({
        placeholder: 'sortable-placeholder gallery_item',
        items: '.gallery_item',
        handle: '.gallery-item-move, .title',
        update: function (event, ui) {
            var data = $(this).sortable('toArray');

            var data = {
                'gallery_items': JSON.stringify($(this).sortable('toArray')),
                '_token': $('input[name="_token"]').val()
            }

            $.ajax({
                data: data,
                type: 'POST',
                url: route_gallery_items_update_order
            });
        },
        tolerance: 'pointer'
    });
}

function display_error(error) {
    var label_error = $('<p class="alert alert-danger">' + error + '</p>');
    $('.gallery-items-wrapper').after(label_error);
    label_error.fadeIn().delay(2000).fadeOut();
}
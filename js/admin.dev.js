// Place administration-specific minified JavaScript here
jQuery(document).ready(function($) {

    function imageSelect( ) {
        $(this).find('img').addClass('selected');
        $(this).siblings().find('img').removeClass('selected');
        if ($(this).find('input').hasClass('remove-image')) {
            $(this).parent().next('.img-settings').addClass('remove');
        }
        else {
            if ($(this).parent().next('.img-settings').hasClass('remove')) {
                $(this).parent().next('.img-settings').removeClass('remove');
            }
        }
    }

    $('.blurb-layouts label').click(imageSelect);
    $('.image-placement label').click(imageSelect);
    $('.padding-options label').click(imageSelect);

    $('.bg-col .color, .txt-col .color').wpColorPicker();

    $(document).on('ajaxSuccess ajaxComplete', function() {
        
        $('.bg-col .color, .txt-col .color').wpColorPicker();
        $('.blurb-layouts label').click(imageSelect);
        $('.image-placement label').click(imageSelect);
        $('.padding-options label').click(imageSelect);
    });
}); 
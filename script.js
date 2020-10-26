(function($)
{
    $(document).ready(function()
    {   
    	$("audio").on("play", function() {
            $("audio").not(this).each(function(index, audio) {
                audio.pause();
            });
        });

        $('#image-modal').on('shown.bs.modal', function (e) {   
            var imgUrl = $(e.relatedTarget).data('image');
            var dataTitle = $(e.relatedTarget).data('title');
            $(this).find('.modal-img').attr("src",imgUrl);
            $(this).find('.modal-title').text(dataTitle)
        })

        $("#experiment-form").on("submit", function(e){
            e.preventDefault();
            var dataString = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "submit.php",
                data: dataString,
                success: function () {
                    $('#complete').removeClass('d-none');
                    $('#experiment-form').addClass('d-none');
                    $('audio').each(function(){
                        this.pause();
                    });
                }
            });
         
            e.preventDefault();
        });
        
    });
})(jQuery);
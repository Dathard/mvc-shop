$(window).on('load', function () {
    $("select#sorting").change(function() {
        var option = $(this).find('option:selected');
        window.location.href = option.data("url");
    });

    $("form").on("submit",(function(e) {
        e.preventDefault();

        let formId = $(this).attr("id");

        let action = $("#"+formId).attr("action");
        let formData = new FormData(this);

        $.ajax({
            type:"POST",
            url: action,
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                if ( data != true ){
                    alert(data);
                }else{
                    
                    alert("Дані успішно збережено!");

                    if ( formId == "new-product" || formId == "edit-product" ) {
                        location.reload();
                    }else{
                        $(".new-product-wrapper").removeClass("active");
                    }

                }
            }
        });

    }));
});
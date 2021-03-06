$(async function () {
    $('.btn-del-cate').click(function (e) {
        let idDel = $(this).val();

        let sure = confirm('Bạn có chắc muốn xóa Category Id: ' + idDel);

        if (sure) {
            $.post(
                '/public/category/destroy/'+idDel,
                {'_token': $('meta[name="csrf-token"]').attr('content')},
                function(data) {
                    location.reload();
                }
            );
        }
    });

    $('.btn-del-pro').click(function (e) {
        let idDel = $(this).val();

        let sure = confirm('Bạn có chắc muốn xóa Product Id: ' + idDel);

        if (sure) {
            $.post(
                '/public/product/destroy/' + idDel,
                {'_token': $('meta[name="csrf-token"]').attr('content')},
                function(data) {
                    location.reload();
                }
            );
        }
    });
    
    uploadAvatar();

    function uploadAvatar() {

        $('.avatar-upload-select').on('click', function() {
    
            console.log($(this).children());
        
            $(this).children()[2].click();
    
        });
        
        $('.input-avatar').on('change', function() {
    
            let filename = $(this)[0].files[0].name;
    
            $(this).prev().text(filename);

            let reader = new FileReader()
            reader.onload = function(event) {

                $('#avatar-show').css('background-image', "url('" + event.target.result + "')");

            }

            reader.readAsDataURL($(this)[0].files[0]);
    
        });

    }

    // Upload multiple file of product
    uploadImages();

    function uploadImages() {
        
        $('.images .pic').on('click', function () {
            
            let uploader = $('<input type="file" name="images[]" class="input-image" accept="image/*">');

            uploader.click();
            
            uploader.on('change', function() {
                $('.images').prepend('<div class="img"><span>remove</span></div>');
    
                $('.img').first().append(uploader);
                
                let reader = new FileReader()
                reader.onload = function(event) {
    
                    $('.img').first().css('background-image', "url('" + event.target.result + "')");
    
                }
    
                reader.readAsDataURL($(this)[0].files[0]);
                
                $('.img').on('click', function () {
                    $(this).remove();
                })

            })
            
        }) 

    }

    removeImage();

    function removeImage() {

        $('.imageAdded .added').on('click', function () {
    
            let id = $(this).attr('rel');
    
            if (confirm('Bạn có chắc muốn xóa ảnh ' + id + ' không?')) {
                
                    $(this).remove();

                    $.post('/public/product/deleteImage/' + id,
                        {
                            '_token':$('meta[name="csrf-token"]').attr('content')
                        },
                        function (data) {

                        }
                    )
    
            }
    
        })
    }

    
    
});
$(document).ready(function () {
    $('.btn-del-cate').click(function (e) {
        let idDel = $(this).val();

        let sure = confirm('Bạn có chắc muốn xóa Category Id: ' + idDel);

        if (sure) {
            $.post(
                '/category/destroy/'+idDel,
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
                '/product/destroy/'+idDel,
                {'_token': $('meta[name="csrf-token"]').attr('content')},
                function(data) {
                    location.reload();
                }
            );
        }
    });

    let fileInput = $('#avatar');

    $('.file-upload-select').on('click', function() {
        fileInput[0].click();
    });
    
    fileInput.on('change', function() {
        let filename = fileInput[0].files[0].name;
        let selectName = $('.file-select-name')[0];
        selectName.innerText = filename;
    });

});

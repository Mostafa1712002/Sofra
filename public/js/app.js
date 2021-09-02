$(function () {

    $(document).on('click', '#destroy', function () {
        var id = $(this).data("id");
        var route = $(this).data('route');
        var token = $(this).data('token');

        $.confirm({
            title: 'تأكيد عملية الحذف',
            icon: 'fa fa-spinner fa-spin',
            content: ` انت منأكد انك تريد الحذف !! `,
            type: 'red',
            closeAnimation: 'rotateXR',
            buttons: {
                yes: {
                    text: 'نعم',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            url: route,
                            type: 'post',
                            data: {
                                _method: 'delete',
                                _token: token
                            },
                            dataType: 'json',
                            success: function (data) {
                                if (data.status === 1) {

                                    $("#form" + id).remove();
                                    Swal.fire({
                                        text: `تم الحذف`,
                                        icon: 'success',
                                        confirmButtonText: 'حسنا'
                                    })
                                } else {
                                    Swal.fire({
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonText: 'حسنا'
                                    })
                                }

                            },
                            error: function () {
                                Swal.fire({
                                    text: 'حدث خطأ الرجاء المحاوله مره اخري',
                                    icon: 'error',
                                    confirmButtonText: 'حسنا'
                                })
                            }
                        });
                    }
                },
                no: {
                    text: 'لا',
                    btnClass: 'btn-blue'
                },
            },
        });
    });
    //  Buttons Themes
    $(".buttons-copy").text("نسخه")
    $(".buttons-excel").text("تصدير إكسل")
    $(".buttons-pdf").text("تصدير PDF")
    $(".buttons-collection span").text("ظهور الأعمدة")
})

$(function () {

    $(document).on('click', '#destroy', function () {
        var id = $(this).data("id");
        var route = $(this).data('route');
        var token = $(this).data('token');

        $.confirm({
            title: 'تأكيد عملية الحذف',
            icon: 'fa fa-spinner fa-spin',
            content: ` هل انت منأكد انك تريد الحذف !! `,
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
                                if (data.status == 1) {

                                    $("#form" + id).remove();
                                    Swal.fire({
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'حسنا'
                                    })
                                }
                                if (data.status == 0) {
                                    let $message = "";
                                    if (data.message == undefined) {
                                        $message = "حدث خطأ الرجاء المحاوله مره اخري";
                                    } else {
                                        $message = data.message;
                                    }

                                    Swal.fire({
                                        text: $message,
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
    $(".dataTables_filter label input ").attr("placeholder", "بحث ....");

    //  Select
    $('#formSelect').select2();



    //  Active and DaActive
    // toggle  icons
    function shap($id) {
        var $div = $(`#active-div${$id}`);
        var $select = $div.children().children();
        var $p = $div.children();
        var $class = $select.attr("class");
        console.log($class)
        if ($class == "fas fa-check") {
            $select.removeClass("fas fa-check").addClass("fas fa-times");
            $p.removeClass("text-info").addClass("text-danger");
        } else {
            $select.removeClass("fas fa-times").addClass("fas fa-check");
            $p.removeClass("text-danger").addClass("text-info");
        }

    }

    //  active and de active restaurants
    $(".active-").each(function () {
        $(this).click(function (e) {
            var $route = $(this).data("route");
            var $message = "تم إلغاء التنشيط ";
            var $state = false;
            var $active = $(this).data("active");
            var $id = $(this).data("id");
            var $token = $(this).data("token");
            e.preventDefault();
            if ($active == "active") {
                $(this).data("active", "de-active");

            } else {
                $(this).data("active", "active");
                $message = "تم  التنشيط ";
                $state = true;
            }
            $.ajax({
                type: "post",
                url: $route,
                data: {
                    id: $id,
                    state: $state,
                    _token: $token
                },
                success: function (data) {
                    shap($id);
                    Swal.fire({
                        position: 'top-start',
                        icon: 'success',
                        title: $message,
                        showConfirmButton: false,
                        timer: 2000,
                        showClass: {
                            popup: 'animate__animated animate__pulse'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                },
                error: function () {
                    Swal.fire({
                        position: 'top-start',
                        icon: 'error',
                        title: 'حدث خطأ غير متوقع الرجاء المحاوله مره آخري',
                        showConfirmButton: false,
                        timer: 2000,
                        showClass: {
                            popup: 'animate__animated animate__pulse'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        }
                    })
                }
            });
        });
    });




    //  Print the order
    $("#printButton").click(function (e) {
        window.print();
    });

})


//登录验证码
function changeCode($this) {
    $($this).attr('src', $($this).attr('src') + '?rand=' + Math.random());
}

/**
 * 打开添加表单
 */
function openAddFormData(id) {
    console.log(11)
    layer.open({
        type: 1,
        skin: 'layui-layer-rim',
        content: $('#' + id),
        area: ['80%', '80%'], //宽高
        success: function () {
            $('.layui-layer-shade').css('display', 'none');
        }
    })
}

$(function () {
    //执行登录
    $("#cms-login").click(function () {
        var formData = new FormData($('#cms-login-form')[0]);
        console.log(11);
        //登录地址
        console.log(ajax);
        ajax.post('login', formData, function ($res) {
            //登录成功处理
        }, function ($error) {
            //出错处理
            console.log($error);
            layer.msg()
        })
    })

    layui.use('form', function () {
        var form = layui.form; //只有执行了这一步，部分表单元素才会自动修饰成功
        form.render();
    });
})




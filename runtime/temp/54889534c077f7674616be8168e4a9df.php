<?php /*a:2:{s:43:"D:\www\cms\application\admin\view\menu.html";i:1551717448;s:48:"D:\www\cms\application\admin\view\base\base.html";i:1551608917;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 控制台主页一</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/layuiadmin/style/admin.css" media="all">

    <script src="/static/js/jquery-3.3.1.min.js"></script>
    <script src="/static/js/ajax.js"></script>
    <script src="/static/admin/layuiadmin/layui/layui.js"></script>
    <script src="/static/js/function.js"></script>

</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<link rel="stylesheet" href="/static/zTreeStyle/zTreeStyle.css">
<style>
    .ztree *{
        font-family: "微软雅黑","宋体",Arial, "Times New Roman", Times, serif;
    }
    .ztree {
        padding: 0;
        border-left: 1px solid #E3E3E3;
        border-right: 1px solid #E3E3E3;
        border-bottom: 1px solid #E3E3E3;
    }
    .ztree li a {
        vertical-align: middle;
        height: 32px !important;
        padding: 0px;
    }
    .ztree li > a {
        width: 100%;
    }
    .ztree li a.curSelectedNode {
        padding-top: 0px;
        background-color: #FFE6B0;
        border: 1px #FFB951 solid;
        opacity: 1;
        height: 32px;
    }
    .ztree li ul {
        padding-left: 0px
    }
    .ztree div.divTd span {
        line-height: 30px;
        vertical-align: middle;
    }
    .ztree div.divTd {
        height: 100%;
        line-height: 30px;
        border-top: 1px solid #E3E3E3;
        border-left: 1px solid #E3E3E3;
        text-align: center;
        display: inline-block;
        color: #6c6c6c;
        overflow: hidden;
    }
    .ztree div.divTd:first-child {
        text-align: left;
        text-indent: 10px;
        border-left: none;
    }
    .ztree .head {
        background: #E8EFF5;
    }
    .ztree .head div.divTd {
        color: #393939;
        font-weight: bold;
    }
    .ztree .ck{
        padding: 0 5px;
        margin: 2px 3px 7px 3px;
    }
    li:nth-child(odd){
        background-color:#F5FAFA;
    }
    li:nth-child(even){
        background-color:#FFFFFF;
    }
</style>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">

                <div class="layui-card-body" pad15>
                    <button type="button" class="layui-btn" onclick="fengAddMenu()">添加菜单</button>
                    <ul id='treeDemo2' class="ztree" style="width:100%;height:100%;"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/static/js/jquery.ztree.core.min.js"></script>
<!--<script src="/static/js/tree.js"></script>-->

<script>
    var newOpen =null;

    var setting = {
        view: {
            showLine: false,
            addDiyDom: addDiyDom,
        },
        data: {
            simpleData: {
                enable: true, //使用简单数据模式
                idKey: "id", //节点数据中保存唯一标识的属性名称
                pIdKey: "pid",//节点数据中保存其父节点唯一标识的属性名称
//                        rootPId: "" //用于修正根节点父节点数据 默认值：null
            }
        }
    };

    $(function () {
        //初始化数据
        var data = <?php echo $data; ?>;

        queryHandler(data);
    });
    /**
     * 自定义DOM节点
     */
    function addDiyDom(treeId, treeNode) {
        var spaceWidth = 15;
        var liObj = $("#" + treeNode.tId);
        var aObj = $("#" + treeNode.tId + "_a");
        var switchObj = $("#" + treeNode.tId + "_switch");
        var icoObj = $("#" + treeNode.tId + "_ico");
        var spanObj = $("#" + treeNode.tId + "_span");
        aObj.attr('title', '');
        aObj.append('<div class="divTd swich fnt" style="width:60%"></div>');
        var div = $(liObj).find('div').eq(0);
        //从默认的位置移除
        switchObj.remove();
        spanObj.remove();
        icoObj.remove();
        //在指定的div中添加
        div.append(switchObj);
        div.append(spanObj);
        //隐藏了层次的span
        var spaceStr = "<span style='height:1px;display: inline-block;width:" + (spaceWidth * treeNode.level) + "px'></span>";
        switchObj.before(spaceStr);
        //图标垂直居中
        icoObj.css("margin-top","9px");
        switchObj.after(icoObj);
        var editStr = '';
        //宽度需要和表头保持一致
        editStr += '<div class="divTd" style="width:20%">' + (treeNode.typecode == null ? '' : treeNode.typecode ) + '</div>';
        editStr += '<div class="divTd" style="width:10%">' + (treeNode.status == '1' ? '有效' : '无效' ) + '</div>';
        editStr += '<div class="divTd" style="width:10%">' + opt(treeNode) + '</div>';
        aObj.append(editStr);
    }
    //初始化列表
    function queryHandler(zTreeNodes){
        //初始化树
        $.fn.zTree.init($("#treeDemo2"), setting, zTreeNodes);
        //添加表头
        var li_head = ' <li class="head"><a><div class="divTd" style="width:60%">类型名称</div><div class="divTd" style="width:20%">类型编码</div>' +
            '<div class="divTd" style="width:10%">是否有效</div><div class="divTd" style="width:10%">操作</div></a></li>';
        var rows = $("#treeDemo2").find('li');
        if (rows.length > 0) {
            rows.eq(0).before(li_head)
        } else {
            $("#treeDemo2").append(li_head);
            $("#treeDemo2").append('<li ><div style="text-align: center;line-height: 30px;" >无符合条件数据</div></li>')
        }
    }
    function opt(treeNode) {
        var htmlStr = '';
        htmlStr += '<input type="button" class="ck" onclick="doEdit(\'' + treeNode.tId + '\',\'' + treeNode.id + '\')" value="编辑"/>';
        htmlStr += '<input type="button" class="ck" onclick="doDelete(\'' + treeNode.tId + '\',\'' + treeNode.id + '\', \'' + treeNode.name + '\')" value="删除"/>';
        return htmlStr;
    }

</script>

<script>

    layui.use('table', function () {
        var table = layui.table
            , form = layui.form,
            layer = layui.layer;
    })
    function fengEditMenu(id){
        var data =returnAjax('__ROOT__/menu/menuDetail',JSON.stringify({'id':id}),'application/json');
        if(data){
            $('#feng-name').val(data.res.name)
            $('#feng-url').val(data.res.url);
            $('#feng-icon').val(data.res.icon);
            $('#feng-order').val(data.res.sort);
            $("#editId").val(data.res.id);
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['65%', '80%'], //宽高
                content: $('#feng-edit'),
                success:function () {
                    $(".layui-layer-shade").css("display","none");
                }
            });
        }
    }

    function fengAddMenu(){
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['65%', '80%'], //宽高
            content: $('#feng-open'),
            success:function () {
                $(".layui-layer-shade").css("display","none");
            }
        });
    }
    function fengDeleteMenu(id,name){
        layer.confirm("您确定删除:" + name + '?', {
            btn: ['确认', '取消'] //按钮
        }, function () {
            console.log(name);
            refreshAjax('__ROOT__/menu/deleteMenu', JSON.stringify({ 'id':id }),'application/json');
        }, function () {
            return;
        });
    }

    function fengSubmit() {
        var formData = new FormData($('#formData')[0]);
        layer.closeAll();
        refreshAjax("__ROOT__/menu/addMenu", formData);
    }

    function fengSubmit2(){

        var formData = new FormData($('#editFormData')[0]);
        layer.closeAll();
        refreshAjax("__ROOT__/menu/editMenu", formData);
    }
</script>


<div style="display: none" id="feng-open">
    <form class="layui-form" id="formData">

        <div class="layui-form-item" style="margin-top: 20px;">
            <label class="layui-form-label">上级菜单</label>
            <div class="layui-input-block">
                <select name="pid">
                    <option>顶级菜单</option>
                    <?php foreach($menu as $k=>$v): if($v['pid'] == 0): ?>
                    <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input name="name" autocomplete="off" class="layui-input" type="text">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">访问链接</label>
            <div class="layui-input-inline">
                <input name="url" autocomplete="off" class="layui-input" type="text">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-inline">
                <input name="icon" autocomplete="off" class="layui-input" type="text" >
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input name="sort" autocomplete="off" class="layui-input" type="text" >
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="button" id="feng-btn" onclick="fengSubmit()">立即提交</button>
            </div>
        </div>

    </form>
</div>


<div style="display: none" id="feng-edit">
    <form class="layui-form" id="editFormData">
        <input type="hidden" name="id" id ='editId' >

        <div class="layui-form-item" style="margin-top: 20px">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input name="name" autocomplete="off" class="layui-input" type="text" id="feng-name">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">访问链接</label>
            <div class="layui-input-inline">
                <input name="url" autocomplete="off" class="layui-input" type="text" id="feng-url">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">图标</label>
            <div class="layui-input-inline">
                <input name="icon" autocomplete="off" class="layui-input" type="text" id="feng-icon">
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input name="sort" autocomplete="off" class="layui-input" type="text" id="feng-order">
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" type="button" id="feng-submit" onclick="fengSubmit2()">立即提交</button>
            </div>
        </div>

    </form>
</div>

    </div>
</div>



</body>
</html>


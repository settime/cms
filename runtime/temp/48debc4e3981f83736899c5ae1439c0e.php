<?php /*a:2:{s:47:"D:\www\cms\application\admin\view\category.html";i:1551716315;s:48:"D:\www\cms\application\admin\view\base\base.html";i:1551608917;}*/ ?>
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
<link rel="stylesheet" href="/static/zTreeStyle/zTreeStyle.css">

<div class="layui-fluid">

    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <div class="layui-card">

                    <div class="layui-card-body" pad15>
                        <button type="button" class="layui-btn" onclick="openAddFormData('cms-addForm')">添加菜单</button>
                        <ul id="dataTree" class="ztree">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(function () {
        layui.use('table', function () {
            table = layui.table
                , form = layui.form,
                layer = layui.layer;

            table.render({
                elem: '#data'
                , url: '/admin/variable/index'
                , method: "post"
                , where: {}
                , cellMinWidth: 80
                , cols: [[
                    {field: 'id', width: '10%', title: 'ID', sort: true}
                    // , {field: 'cat_id', title: '类别', sort: true}
                    , {field: 'name', title: '名称'}
                    , {field: 'key', title: '标识'}
                    , {field: 'value', title: '值'}
                    , {field: 'is_enable', title: '是否启用', templet: '#switchTpl',}
                    , {field: '', title: '操作', templet: '#btn1'}
                ]]
                , page: true
            });
        });
    })

</script>


<form id="addFormData" style="display: none">

    <div class="layui-form-item"  style="margin-top: 20px ">
        <label class="layui-form-label">标识名称</label>
        <div class="layui-input-block">
            <input name="idName" autocomplete="off" class="layui-input" type="text" >
        </div>
    </div>


    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" type="button" id="feng-btn" onclick="submitInsert()">立即提交</button>
        </div>
    </div>

</form>
<script src="/static/js/jquery.ztree.core.min.js"></script>
<script>
    var newOpen =null;
    $(function () {
        //初始化数据
        var data = [
            {"id":"20170525091439001010","name":"企业注册","pId":null,"status":"1","typecode":"02"},
            {"id":"20170724174119005610","name":"部门沟通演练","pId":"20170525091439001010","status":"1","typecode":"2"},
            {"id":"20170725085455000110","name":"测试12","pId":null,"status":"1","typecode":"11"},
            {"id":"20170731171011000410","name":"审批流程","pId":null,"status":"1","typecode":"222"},
            {"id":"20170803133941018010","name":"单位登记","pId":null,"status":"1","typecode":"188"},
            {"id":"20170804085419000110","name":"模拟","pId":null,"status":"1","typecode":"122"},
            {"id":"20170809090321000110","name":"审批模拟（新）测试测试测试测试测试","pId":"20170525091439001010","status":"1","typecode":"110"},
            {"id":"20170809105407009210","name":"测测测测测测测测测测测测测测测测测测","pId":"20170809090321000110","status":"1","typecode":"123"},
            {"id":"20170814183837000210","name":"企业登记","pId":null,"status":"1","typecode":"111"},
            {"id":"20170822183437000710","name":"单事项-部门沟通","pId":"20170814183837000210","status":"1","typecode":"822"},
            {"id":"20170922112245000510","name":"23","pId":null,"status":"1","typecode":"03"},
            {"id":"20170922143810000010","name":"sdfa","pId":null,"status":"1","typecode":"04"},
            {"id":"20170922145203000110","name":"64526","pId":null,"status":"1","typecode":"34262"},
            {"id":"20170922155403001610","name":"333","pId":null,"status":"1","typecode":"33354"},
            {"id":"20170922171750000210","name":"4441234","pId":null,"status":"1","typecode":"44444"},
            {"id":"20170925160636007410","name":"测试数据","pId":"20170731171011000410","status":"1","typecode":"231"},
            {"id":"20170925163306007510","name":"23462111","pId":null,"status":"1","typecode":"2345"},
            {"id":"20170925163959007610","name":"242345","pId":"20170922112245000510","status":"1","typecode":"3625346"}];
        queryHandler(data);
    });
    var setting = {
        view: {
            showLine: false,
            addDiyDom: addDiyDom,
        },
        data: {
            simpleData: {
                enable: true
            }
        }
    };
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
        $.fn.zTree.init($("#dataTree"), setting, zTreeNodes);
        //添加表头
        var li_head = ' <li class="head"><a><div class="divTd" style="width:60%">类型名称</div><div class="divTd" style="width:20%">类型编码</div>' +
            '<div class="divTd" style="width:10%">是否有效</div><div class="divTd" style="width:10%">操作</div></a></li>';
        var rows = $("#dataTree").find('li');
        if (rows.length > 0) {
            rows.eq(0).before(li_head)
        } else {
            $("#dataTree").append(li_head);
            $("#dataTree").append('<li ><div style="text-align: center;line-height: 30px;" >无符合条件数据</div></li>')
        }
    }
    function opt(treeNode) {
        var htmlStr = '';
        htmlStr += '<input type="button" class="ck" onclick="doEdit(\'' + treeNode.tId + '\',\'' + treeNode.id + '\')" value="编辑"/>';
        htmlStr += '<input type="button" class="ck" onclick="doDelete(\'' + treeNode.tId + '\',\'' + treeNode.id + '\', \'' + treeNode.name + '\')" value="删除"/>';
        return htmlStr;
    }
</script>



<form id="cms-addForm" style="display: none;margin-top: 10px" class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">名称</label>
        <div class="layui-input-inline">
            <input type="text" name="name"  placeholder="请输入类别名称" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">分组选择框</label>
            <div class="layui-input-inline">
                <select name="quiz">
                    <option value="">请选择问题</option>
                    <optgroup label="城市记忆">
                        <option value="你工作的第一个城市">你工作的第一个城市</option>
                    </optgroup>
                    <optgroup label="学生时代">
                        <option value="你的工号">你的工号</option>
                        <option value="你最喜欢的老师">你最喜欢的老师</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">sort</label>
        <div class="layui-input-inline">
            <input type="text" name="sort"  placeholder="请输入类别排序" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">是否启用</label>
        <div class="layui-input-block">
            <input type="radio" name="is_enable" value="启用" title="启用" checked="">
            <input type="radio" name="is_enable" value="不启用" title="不启用">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" type="button"   onclick="submitAddForm('/admin/category/create')">立即提交</button>
        </div>
    </div>
</form>

<script>

    function submitAddForm(address) {
        var formData = new FormData($('#cms-addForm')[0]);
        ajax.post(address, formData, function (res) {
            layer.msg(res.msg, {time: 1000}, function () {
                if (res.status == 200) {
                    window.location.reload();
                }
            });
        })
    }

</script>


    </div>
</div>



</body>
</html>


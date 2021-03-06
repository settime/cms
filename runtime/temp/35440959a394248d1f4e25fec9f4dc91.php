<?php /*a:2:{s:50:"D:\www\cms\application\admin\view\variableSet.html";i:1551584203;s:48:"D:\www\cms\application\admin\view\base\base.html";i:1551547664;}*/ ?>
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
    <script src="/static/admin/layuiadmin/layui/layui.js"></script>
    <script src="/static/js/function.js"></script>

</head>
<body>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        
<div class="layui-fluid">
    <form class='layui-form' id="formData">
        <div class="demoTable">

            <div class="layui-inline">
                <label class="layui-form-label">id</label>
                <div class="layui-input-inline">
                    <input type="text" name="id" autocomplete="off" class="layui-input"
                           value="<?php echo htmlentities($id); ?>">
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">名称:</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" id="searchUid" autocomplete="off" class="layui-input"
                           value="<?php echo htmlentities($name); ?>">
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">key:</label>
                <div class="layui-input-inline">
                    <input type="text" name="key" id="searchUsername" autocomplete="off" class="layui-input"
                           value="<?php echo htmlentities($key); ?>">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">value:</label>
                <div class="layui-input-inline">
                    <input type="text" name="value" id="searchTruename" autocomplete="off" class="layui-input"
                           value="<?php echo htmlentities($value); ?>">
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">开始时间:</label>
                <div class="layui-input-inline">
                    <input type="text" name="startDate" autocomplete="off" class="layui-input" id="startDate"
                           placeholder="" value="<?php echo htmlentities($startDate); ?>">
                </div>
            </div>
            <div class="layui-inline">
                <label class="layui-form-label">结束时间:</label>
                <div class="layui-input-inline">
                    <input type="text" name="overDate" autocomplete="off" class="layui-input" id="overDate"
                           placeholder="" value="<?php echo htmlentities($overDate); ?>">
                </div>
            </div>
            <div class="layui-form-item layui-inline" style="margin-top: 10px">
                <label class="layui-form-label">类型:</label>
                <div class="layui-input-inline">
                    <select name="type" lay-filter="type">
                        <option value="1" selected="selected">全部</option>
                        <option value="2">1</option>
                        <option value="3">2</option>
                    </select>
                </div>
            </div>

        </div>

        <button class="layui-btn" data-type="reload">搜索</button>
        <button class="layui-btn" data-type="reload" type="button" id='remove'>清除筛选</button>
        <button class="layui-btn" onclick="openAddFormData(id)">添加配置</button>
    </form>


    <table class="layui-hide" id="data" lay-filter="dataEvent">

    </table>
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

    <div class="layui-form-item" style="margin-top: 20px ">
        <label class="layui-form-label">类别</label>
        <div class="layui-input-inline">
            <select name="id" >
                <option value=""></option>
                <?php foreach($investSet as $v): ?>
                <option value="<?php echo htmlentities($v['id']); ?>"><?php echo htmlentities($v['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
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

    </div>
</div>



</body>
</html>



<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="http://tools.zhi20.com/layui/css/layui.css" rel="stylesheet" type="text/css" />
    <link href="http://tools.zhi20.com/layui/css/layui.mobile.css" rel="stylesheet" type="text/css" />
    <title>互联乐头像制作
    </title>
    <style>
        #thum{
            display:inline-block;
            position:relative;
            width:100px;
            height:100px;
            overflow:hidden;
            border-radius:50%;
        }
        #thum img{
            width:100px;
        }
    </style>
</head>
<body>
<div class="layui-container">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>{{ $username }} 的头像</legend>
    </fieldset>

   <div class="layui-form-item" style="width: 100%; text-align: center;">
                <img src="http://ifcocn.ifcocn.com/i.png" width="80%">
            </div>

    <div class="layui-form-item">
        @foreach ($files as $file)
            <div class="layui-form-item" style="width: 100%; text-align: center;">
                <img src="{{ $file }}" width="60%">
            </div>

            <div class="layui-form-item" style="width: 100%; text-align: center; margin-top: 20px;">
                <button class="layui-btn layui-btn-normal" lay-submit="" style="width: 80%;" >长按上图头像保存</button>
            </div>
        @endforeach
    </div>
</div>

<script src="http://tools.zhi20.com/layui/layui.all.js"></script>
<script>
    //var flow = layui.flow;
    var $ = layui.jquery;
    var layer = layui.layer;
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用按鈕控制路由回應</title>
</head>
<body>
    <pre>
        <button onclick=' alert( " {{route("start1")}} "); '>按鈕 1</button>  按下 1 次觸發 JS 動作
    
        <a href=" {{route('start1')}} "> 跳轉到 {{ route('start1') }} 網頁 </a>
    
        <button ondblclick=" alert(' {{route('start2')}}  ') ">按鈕 2</button> 連按 2 次觸發 JS 動作

        <a href=" {{route('start2')}} "> 跳轉到 {{ route('start2') }} 網頁 </a>

    </pre>

</body>
</html>
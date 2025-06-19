<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>檔案列表</title>
</head>
<body>
    <h1>C:/PIC/ 中的檔案</h1>
    <ul>
        @foreach($files as $file)
            <li>{{ $file->getFilename() }}</li> <!-- 顯示檔案名稱 -->
        @endforeach
    </ul>

    <!-- 顯示圖片 -->
    @foreach($files as $file)
        <img    src="{{ route( 'images.showCPIC' , $file->getFilename() ) }}" 
                style="width:100px;height:100px;"
        alt="">
    @endforeach
</body>
</html>
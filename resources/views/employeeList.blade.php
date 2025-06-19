<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  @yield( 'title' , '員工清單' )</title>
</head>

<body>

    <table>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
        </tr>
        @foreach ( $employees as $employee )
        <tr>
            <td>    {{ $employee->emp_code }} </td>
            <td>    {{ $employee->emp_name }} </td>
            <td>    {{ $employee->emp_pwd }} </td>
            <td>    {{ $employee->emp_lv }} </td>
            <td>    {{ $employee->emp_tel }} </td>
        </tr>            
        @endforeach

    </table>


</body>
</html>
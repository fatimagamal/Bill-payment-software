<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Email</title>
</head>
<body>

<h1>hello</h1>
<h2>{{$data['subject']}}</h2>
<p>{{$data['body']}}</p>

<a  class="btn btn-danger"  href="{{$data['action']}}" >عرض الفاتوره</a>
<span>{{$data['line']}}</span>

</body>
</html>
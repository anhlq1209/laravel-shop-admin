<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/public/test/style.css">
</head>
<body>
    {{-- <div class="wrapper">
                 
        <div class="images">
            <div class="pic">
                add
            </div>
        </div>
        
        <footer>
            <ul>
                <li><span id="send">send</span></li>
            </ul>
        </footer> 
        
    </div> --}}


    <form action="/public/test1" method="post">
        @csrf
        <input type="submit" value="Submit">
    </form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/public/test/script.js"></script>
</body>
</html>
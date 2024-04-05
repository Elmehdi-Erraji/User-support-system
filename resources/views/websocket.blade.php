<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <title>Document</title>
</head>
<body>
    
    <h1>good to go</h1>



    <script>
        {!! Vite::content('resources/js/app.js') !!}
    </script>

   <script >
    Echo.channel(`public-channel-1`)
    .listen('MessageSent', (e) => {
        console.log(e);
    });

    Echo.channel(`my-channel`)
    .listen('UserRegestratoin', (e) => {
        console.log(e);
    });
   </script>
</body>
</html>
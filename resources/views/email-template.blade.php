<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

    
    <div class="container">
        <div class="col">

            <div class="text-center">
                <img src="https://img.icons8.com/dotty/80/000000/new-post.png"/>
                <h3>Hello, {{ $name }}!</h3>
            <h6 class="text-primary">{{ $email }}</h6 class="text-primary">

            <h3>Hello {{ $name }},{{ $subyek }}</h3>

            <p>{!! $body !!}</p>

            </div>
        </div>
    </div>

 </body>
 
 <footer class="text-center text-lg-start bg-light text-muted mt-7">
   
  
    <!-- Copyright -->
    <div class="text-center p-4 " style="background-color: rgba(0, 0, 0, 0.05);">
      © Copyright:
      <a class="text-reset fw-bold" href="https://the-devcode.com/">the-devcode.com</a>
    </div>
    <!-- Copyright -->
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</html>
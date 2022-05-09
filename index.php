<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simple link shortner</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yanchokraev/grayshift@1.0.2/dist/css/grayshift.min.css" integrity="sha384-BEz3swSE9zJc0Sejcc2Hzrbjq8/0rFfS2ASsVlVM1F3cdbXW2VYMlhod3OZr1k3M" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap">
</head>
<body>

    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <h1>Simple link shortner</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/" method="post">
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" class="form-control" id="url" name="url" placeholder="Enter URL">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <br>
                <?php
                    if(isset($_POST['url'])){
                        $url = $_POST['url'];
                        $url = trim($url);
                        $old_url = $url;

                        $rand = rand(1, 9999);
                        
                        $myfile = fopen("".$rand.".php", "w");
                        $txt = "<script>window.location.replace('".$old_url."');</script><a href='".$old_url."'>Press here to redirect now!</a>";
                        fwrite($myfile, $txt);

                        echo '<a href="https://short.benji.link/'.$rand.'" target="_blank">https://short.benji.link/'.$rand.'</a>';
                    }
                ?>
            </div>
        </div>
    </div>

</body>
</html>

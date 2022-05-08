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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Simple link shortner</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                    if(isset($_POST['url'])){
                        $url = $_POST['url'];
                        $url = trim($url);
                        $old_url = $url;
                        $url = filter_var($url, FILTER_SANITIZE_URL);
                        if(filter_var($url, FILTER_VALIDATE_URL)){
                            $url = str_replace('http://', '', $url);
                            $url = str_replace('https://', '', $url);
                            $url = str_replace('www.', '', $url);
                            $url = str_replace('/', '', $url);
                            $url = str_replace('.', '', $url);
                            $url = str_replace('-', '', $url);
                            $url = str_replace('_', '', $url);
                            $url = str_replace('+', '', $url);
                            $url = str_replace('=', '', $url);
                            $url = str_replace('%', '', $url);
                            $url = str_replace('&', '', $url);
                            $url = str_replace('?', '', $url);
                            $url = str_replace('#', '', $url);
                            $url = str_replace('!', '', $url);
                            $url = str_replace('@', '', $url);
                            $url = str_replace('$', '', $url);
                            $url = str_replace('^', '', $url);
                            $url = str_replace('*', '', $url);
                            $url = str_replace('(', '', $url);
                            $url = str_replace(')', '', $url);
                        }else{
                            $url = 'Invalid URL';
                        }

                        $rand = rand(1, 9999);
                        
                        $myfile = fopen("".$rand.".php", "w");
                        $txt = "<?php header('Location: ".$old_url."');?>";
                        fwrite($myfile, $txt);

                        echo '<a href="https://short.benji.link/'.$rand.'" target="_blank">https://short.benji.link/'.$rand.'</a>';
                    }
                ?>
            </div>
        </div>
    </div>




  <script src="https://cdn.jsdelivr.net/gh/yanchokraev/grayshift@1.0.2/dist/js/grayshift.min.js" integrity="sha384-8jCLciEK/63juoJgc5SxCqHbZwhVfEQb7TUYSdbDrZV97ozI9/UBWCvr9O8r8JJT" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta name="theme-color" content="#000000" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.js"></script>
  <title>Mobile Reverse Image Search</title>
  <style>
        body {
          background-color: #000;
        }
        .video-background {
            position: fixed;

            min-width: 100%;
            min-height: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

        
        }
        .button {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
        input[type="image"] {
            border:0;
            border-color:transparent;
            background:transparent;
            outline:none;
            border-style: none;
        }
        input[type="file"] {
          position:absolute; top:-100px;
        }
    </style>
</head>
<body>
<video preload="auto" autoplay id="myVideo" class="video-background" onclick="this.paused ? this.play() : this.pause();" loop muted playsinline>
        <source src="bg.mp4" type="video/mp4" autoplay>
        </video>  

  <form id="photo_upload_form" enctype="multipart/form-data" action="upload.php" method="POST">
  <div class="button"><input type="image" src="icon.png" name="icon" id="icon"></div>
    <input type="file" name="uploaded_file"></input><br />
  </form>
  <script type="text/javascript">
$('#icon').click(function (e) {
    $('input[type="file"]').trigger('click');
    e.preventDefault();
    myVideo.play();
});

$('input[type="file"]').change(function () {
    $('#photo_upload_form')[0].submit();
});
</script>
</body>
</html>
<?PHP
  if(!empty($_FILES['uploaded_file']))
  {
    $path = "uploads/";
    $path = $path . basename( $_FILES['uploaded_file']['name']);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      $path = "http://rundellmusic.com/imgsearch/" . $path;
      echo '<script>window.location = "https://www.google.com/searchbyimage?image_url=' . $path . '" </script>';
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>
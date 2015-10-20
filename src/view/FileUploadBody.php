<div class="container">

    <div class="starter-template">
        <h1>Upload a photo and set it as your homepage</h1>
        <br><br>
        <p class="lead">Only GIF, JPG, and PNG files are allowed.</p>
        <br>

        <form class="navbar-form " action="src/controller/upload.php" method="post" enctype="multipart/form-data" role="search">
            <div class="form-group">
                <input type="file" class="btn btn-default" name="myFile" required autofocus placeholder="15">
            </div>
            <button type="submit" class="btn btn-default" value="Upload">Submit</button>
        </form>
        <br><br>

        <p class="lead">
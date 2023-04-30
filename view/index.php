<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="file">Email</label> 
                            <input type="file" name="file" id="file" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center mb-3">
                            <button type="submit" class="btn btn-outline-info rounded-pill py-1 px-4">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="se"></section>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $(document).ready(()=>{
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

        $("form").submit((e)=>{
            e.preventDefault();

            let name = $("#name").val();
            let email = $("#email").val();
            let file = $("#file")[0].files[0];
            console.log(file);

            let formData = new FormData();
            formData.append('name',name);
            formData.append('email',email);
            formData.append('file',file);

            $.ajax({
                url:'../controller/sendMail.php?status=sendEmail',
                method:'post',
                data:formData,
                dataType:'text',
                processData:false,
                cache:false,
                contentType:false,
                beforeSend:(data,status)=>{
                    console.log(status);
                },
                success:(data,status)=>{
                    console.log(data);
                    $("#se").html(data);
                    $("form").trigger("reset");
                },
                error:(data,status)=>{
                    console.log(status);
                }
            })
        })
    })
</script>

</html>
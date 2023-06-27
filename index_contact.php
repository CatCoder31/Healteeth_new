<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Home</title>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/indexnav.css">
   </head>
   <body>
      <?php include'index_nav.php'; ?>

      <div class="container-fluid">
         <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3">
               <div class="well well-sm">
                  <form class="form-horizontal" action="" method="post">
                     <fieldset>
                        <h2 class="text-center">Contact us</h2>
                        <!-- Name input-->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="name">Name</label>
                           <div class="col-md-12">
                              <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                           </div>
                        </div>
                        <!-- Email input-->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="email">Your E-mail</label>
                           <div class="col-md-12">
                              <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                           </div>
                        </div>
                        <!-- Message body -->
                        <div class="form-group">
                           <label class="col-md-4 control-label" for="message">Your message</label>
                           <div class="col-md-12">
                              <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
                           </div>
                        </div>
                        <br>
                        <div class="form-group">
                           <div class="col-md-12 text-center">
                              <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                           </div>
                        </div>
                        <br>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>

         </div>
      </div>
   </body>
</html>
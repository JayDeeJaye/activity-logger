<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Track</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container-fluid">
           <nav role="navigation" class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Activity Log <i class="fa fa-clock-o"></i></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
              <div id="navbarCollapse" class="collapse navbar-collapse navbar-right">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Activity</a></li>
                    <li><a href="#">Tracking</a></li>
                    <li><a href="#">Share/Report</a></li>
                  </ul> 
                </div>
              </nav> 

         
               <div class="row">
                  <div class="col-md-12">
                    <div class= "form">
                      <label>Operational Research</label>
                       <div class="progress">
                       <div class="progress-bar progress-bar-striped active" role="progressbar"aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">40%</div>
                       </div>
                     <form>
                      <div class = "btn-group">
                       <input type ="submit" value = "Start" class = "btn btn-primary" name="submit">
                      </div>
                       <div class = "btn-group">
                       <input type ="submit" value = "Stop" class = "btn btn-danger" name="submit2">
                       </div>
                       <div class = "btn-group pull-right">
                       <input type ="submit" value = "Cancel" class = "btn btn-danger" name="submit2">
                       </div>
                      </form>

                     </div>
                  </div>
               </div>

            </div>
        
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Activity</title>
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
                     <form>
                      <div class="form-group">
                        <label for="Activity">Search activity</label>
                        <input type="text" class="form-control input-lg" placeholder="Search activity">
                      </div>

                      <div class="form-group">
                        <label for="Activity">Activity</label>
                        <input type="text" class="form-control input-lg" placeholder="Add new Activity">
                      </div>
                      <div class="form-group">
                        <label for="finish time">Estimated finish time</label>
                        <input type="text" class="form-control input-lg" placeholder="Estimated Finish Time">
                      </div>
                      
                      <div class="btn-group">
        <a class="btn btn-success btn-m dropdown-toggle" data-toggle="dropdown" href="#">Priority<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">High</a></li>
          <li><a href="#">Medium</a></li>
          <li><a href="#">low</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <a class="btn btn-success btn-m dropdown-toggle" data-toggle="dropdown" href="#">Status<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Complete</a></li>
          <li><a href="#">In Progress</a></li>
          <li><a href="#">Not Started</a></li>
        </ul>
      </div>

                      <!--<div class = "form-group">
                        <label for="cart"><i class="fa fa-cart-plus"></i></label>
                        <div class="cart"></div>
                        <button type="submit" class="btn btn-danger pull-right">Remove</button>
                      </div>
                      <button type="submit" class="btn btn-success">Submit</button> -->

                      </form>
                     </div>
                  </div>
               </div>

            </div>
    	
    </body>
</html>
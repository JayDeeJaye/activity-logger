
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
            <li <?php if ($page_name == "Home") echo 'class="active"'; ?> ><a href="index.php">Home</a></li>
            <li <?php if ($page_name == "Activity") echo 'class="active"'; ?> ><a href="activity.php">Activity</a></li>
            <li <?php if ($page_name == "Tracking") echo 'class="active"'; ?>><a href="tracking.php">Tracking</a></li>
            <li <?php if ($page_name == "Report") echo 'class="active"'; ?>><a href="report.php">Share/Report</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul> 
    </div>
</nav> 


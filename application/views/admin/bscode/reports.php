<div class="container-fluid">

    <!-- #END# Widgets -->
    <!-- CPU Usage -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    
                </div>
                <div class="body">
                    <div id="real_time_chart" class="dashboard-flot-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# CPU Usage -->
    <div class="row clearfix">
        <!-- Visitors -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-pink">
                    <div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff"
                    data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)"
                    data-offset="90" data-width="100%" data-height="92px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)"
                    data-fill-Color="rgba(0, 188, 212, 0)">
                    12,10,9,6,5,6,10,5,7,5,12,13,7,12,11
                </div>
                <ul class="dashboard-stat-list">
                    <li>
                        TODAY
                        <span class="pull-right"><b>1 200</b> <small>USERS</small></span>
                    </li>
                    <li>
                        YESTERDAY
                        <span class="pull-right"><b>3 872</b> <small>USERS</small></span>
                    </li>
                    <li>
                        LAST WEEK
                        <span class="pull-right"><b>26 582</b> <small>USERS</small></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #END# Visitors -->
    <!-- Latest Social Trends -->
    
    <!-- #END# Latest Social Trends -->
    <!-- Answered Tickets -->
    
    <!-- #END# Answered Tickets -->
</div>

<div class="row clearfix">
    <!-- Task Info -->
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="header">
                <h2>TASK INFOS</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover dashboard-task-infos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Manager</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Task A</td>
                                <td><span class="label bg-green">Doing</span></td>
                                <td>John Doe</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Task B</td>
                                <td><span class="label bg-blue">To Do</span></td>
                                <td>John Doe</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Task C</td>
                                <td><span class="label bg-light-blue">On Hold</span></td>
                                <td>John Doe</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-light-blue" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Task D</td>
                                <td><span class="label bg-orange">Wait Approvel</span></td>
                                <td>John Doe</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Task E</td>
                                <td>
                                    <span class="label bg-red">Suspended</span>
                                </td>
                                <td>John Doe</td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-red" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 87%"></div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Task Info -->
    <!-- Browser Usage -->
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="card">
            <div class="header">
                <h2>BROWSER USAGE</h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another action</a></li>
                            <li><a href="javascript:void(0);">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div id="donut_chart" class="dashboard-donut-chart"></div>
            </div>
        </div>
    </div>
    <!-- #END# Browser Usage -->
</div>
</div>

<!-- ======================= Scripts for this page ============================== -->
<!-- Jquery CountTo Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
<script src="<?= base_url()?>public/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url()?>public/plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="<?= base_url()?>public/plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="<?= base_url()?>public/plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Custom Js -->
<script src="<?= base_url()?>public/js/pages/index.js"></script>

    <script>
        $("#bs_code").addClass('active');
        $("#bs_reports").addClass('active');
    </script>
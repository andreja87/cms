<?php include 'includes/admin_header.php'; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/admin_nav.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!--                    page header  -->
                <?php

                if (isset($_GET['source'])){
                    issetGetSource($_GET['source']);

                }

                ?>

<!--                Refactoring is when we take the long parts of code and make it function and divide php from html -->

                <!-- admin widgets -->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class='huge'><?php echo recordCount('posts'); ?></div>

                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                       <div class='huge'><?php echo recordCount('comments'); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class='huge'><?php echo recordCount('users'); ?></div>

                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <div class='huge'><?php echo recordCount('categories'); ?></div>

                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
<!--                --><?php
//                echo var_dump($_SESSION);
//                ?>

                <!-- column chart -->
                <div class="row">

                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],

                                <?php
                                    $activePosts = checkStatus('posts', 'post_status', 'active');
                                    $draftsPosts = checkStatus('posts', 'post_status', 'draft');
                                    $unapprovedComm = checkStatus('comments', 'comment_status', 'undo_approve');
                                    $approvedComm = checkStatus('comments', 'comment_status', 'approve');
                                    $subscribedUsers = checkStatus('users', 'role', 'subscriber');

                                    //dynamic content for the chart:
                                    //we need two arrays, we need to hold static text and values
                                    $elementsText = array('All Posts', 'Active Posts','Draft Posts', 'Comments', 'Undo App Comm', ' Users', 'Subscribed Users', 'Categories');
                                    $elementCount = array(recordCount('posts'), $activePosts, $draftsPosts, recordCount('comments'), $unapprovedComm, recordCount('users'), subscribedUsers(), recordCount('categories'));

                                    $numTextElem = count($elementsText);

                                    //loop for displaying values from arrays cool :)
                                    for ($i = 0; $i < $numTextElem; $i++ ){

                                        echo "['{$elementsText[$i]}'" . ", " . "{$elementCount[$i]}],";
//                                      result of the above ['Posts', 1000],

                                    }
                                ?>

                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, options);
                        }
                    </script>

                    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include 'includes/admin_footer.php'; ?>


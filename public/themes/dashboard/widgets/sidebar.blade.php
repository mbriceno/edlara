                <div class="well nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Dashboard</li>
                        <li class="">
                            <a href="/">
                                <i class="icon-home"></i>
                                <span class="hidden-tablet">  Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="/tutorials">
                                <i class="icon-edit"></i>
                                <span class="hidden-tablet">  Tutorials</span>
                            </a>
                        </li>      
                        <li class="">
                            <a href="/assessments">
                                <i class="icon-edit"></i>
                                <span class="hidden-tablet">  Assessments</span>
                            </a>
                        </li> 
                        <li class="">
                            <a class="" href="/exams">
                                <i class="icon-list-alt"></i>
                                <span class="hidden-tablet">  Exams</span>
                            </a>
                        </li>                       
                        <li class="">
                            <a class="" href="/students">
                                <i class="icon-user"></i>
                                <span class="hidden-tablet"> Students</span>
                            </a>
                        </li>

                        <?php
                        $user = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if($user->ingroup($admingroup)){
                        ?>
                        <li class="nav-header hidden-tablet"> Administration</li>
                        
                        <li class="">
                            <a class="" href="/settings">
                                <i class="icon-cog"></i>
                                <span class="hidden-tablet"> Settings</span>
                            </a>
                        </li>                        
                        <li class="">
                            <a class="" href="/teachers">
                                <i class="icon-user"></i>
                                <span class="hidden-tablet"> Teachers</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="/users">
                                <i class="icon-user"></i>
                                <span class="hidden-tablet"> Users</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="/subjects">
                                <i class="icon-folder-open"></i>
                                <span class="hidden-tablet"> Subjects</span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>

                    </ul>
                </div><!--/.well -->
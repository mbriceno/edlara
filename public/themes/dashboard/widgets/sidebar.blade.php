
<?php

defined('ROOT' )|| die('Restricted Access');

?>                <div class="well nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-sm">Dashboard</li>
                        <li class="">
                            <a href="/">
                                <i class="icon-home"></i>
                                <span class="hidden-sm"> Dashboard</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="/tutorials">
                                <i class="icon-copy"></i>
                                <span class="hidden-sm"> Tutorials</span>
                            </a>
                        </li>      
                        <li class="">
                            <a href="/assessments">
                                <i class="icon-file-alt"></i>
                                <span class="hidden-sm"> Assessments</span>
                            </a>
                        </li> 
                        <li class="">
                            <a class="" href="/exams">
                                <i class="icon-newspaper"></i>
                                <span class="hidden-sm"> Exams</span>
                            </a>
                        </li>                       
                        <li class="">
                            <a class="" href="/students">
                                <i class="icon-user-5"></i>
                                <span class="hidden-sm"> Students</span>
                            </a>
                        </li>

                        <?php
                        $user = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if($user->ingroup($admingroup)){
                        ?>
                        <li class="nav-header hidden-sm"> Administration</li>
                        
                        <li class="">
                            <a class="" href="/settings">
                                <i class="icon-cog"></i>
                                <span class="hidden-sm"> Settings</span>
                            </a>
                        </li>                        
                        <li class="">
                            <a class="" href="/teachers">
                                <i class="icon-user-4"></i>
                                <span class="hidden-sm"> Teachers</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="/users">
                                <i class="icon-users"></i>
                                <span class="hidden-sm"> Users</span>
                            </a>
                        </li>
                        <li class="">
                            <a class="" href="/subjects">
                                <i class="icon-folder-open"></i>
                                <span class="hidden-sm"> Subjects</span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>

                    </ul>
                </div><!--/.well -->
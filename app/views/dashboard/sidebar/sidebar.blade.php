            <!-- left menu starts -->
            <div class="span2 main-menu-span">
                <div class="well nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li class="nav-header hidden-tablet">Main</li>
                        <li><a class="ajax-link" href="/"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li><a class="ajax-link" href="/tutorials"><i class="icon-edit"></i><span class="hidden-tablet"> Tutorials</span></a></li>      
                        <li><a class="ajax-link" href="/assessments"><i class="icon-edit"></i><span class="hidden-tablet"> Assessments</span></a></li>                       
                        <li><a class="ajax-link" href="/students"><i class="icon-user icon-blue"></i><span class="hidden-tablet">Students</span></a></li>

                        <?php
                        $user = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if($user->ingroup($admingroup)){
?>
                        <li class="nav-header hidden-tablet">Admin</li>
                        
                        <li><a class="ajax-link" href="/settings"><i class="icon-cog"></i><span class="hidden-tablet"> Settings</span></a></li>                        
                        <li><a class="ajax-link" href="/teachers"><i class="icon-user icon-red"></i><span class="hidden-tablet">Teachers</span></a></li>

                        <li><a class="ajax-link" href="/users"><i class="icon-user"></i><span class="hidden-tablet">Users</span></a></li>
                        <?php
                            }
                        ?>

                    </ul>
                    <label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
                </div><!--/.well -->
            </div><!--/span-->
            <!-- left menu ends -->
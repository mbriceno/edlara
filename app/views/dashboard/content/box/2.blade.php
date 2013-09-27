    <div class="box span4">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Member Activity</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="box-content">
                            <ul class="dashboard-list">
                                <?php
$users =  DB::select(DB::raw('SELECT id,email,first_name,last_name,created_at,activated FROM `users` WHERE (`created_at` >= CURDATE() - INTERVAL 7 DAY) ORDER BY `id` DESC LIMIT 5'));
foreach($users as $user){
                            // user email
                            $email = $user->email;

                            // create some gravatarer object 
                            $url = Gravatarer::make( [
                            'email' => $email, 
                            'size' => 50, 
                            'defaultImage' => 'mm',
                            'rating' => 'g',
                            ])->url();
                            echo "<li>";
                            echo "<a href='#'>";
                            echo "<img class='dashboard-avatar' alt='".$email."' src='".$url."'></a><strong>Name:</strong><a href='/user/".$user->id."/view/'>".$user->first_name.' '.$user->last_name.'</a><br>';
                            echo "<strong>Since:</strong>".$user->created_at.'<br>';
                            echo "<strong>Status:</strong>";
                            if($user->activated == 1){
                                echo '<span class="label label-success">Activated</span>';
                            }
                            else {                                
                                echo '<span class="label label-danger">Not Activated</span>';
                            }
                            echo "</li>";
                            // get gravatar <img> html code
                            // $html = $gravatar->html();
                        }
                            ?>   
    
            
                                
                            </ul>
                        </div>
                    </div>
                </div><!--/span-->
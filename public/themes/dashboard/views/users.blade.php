<?php

defined('ROOT' )|| die('Restricted Access');

?>
            		<table id="datatable" class="table table-striped table-bordered bootstrap-datatable datatable">
            			<thead>
            				<tr>
            					<th>#ID</th>
            					<th>First Name</th>
            					<th>Last Name</th>
            					<th>Date Joined</th>
            					<th>Last Login</th>
            					<th>Status</th>
            					<th>Actions</th>
            				</tr>
            			</thead>
            			<tbody>
            				<?php
            				$users = User::all();
            				foreach ($users as $user){echo "<tr>";
            					echo "<td>";
            					echo $user->id;
            					echo "</td>";
            					echo "<td class='center'>";
            					echo $user->first_name;
            					echo "</td>";
            					echo "<td class='center'>";
            					echo $user->last_name;
            					echo "</td>";
            					echo "<td class='center'>";
            					echo $user->created_at;
            					echo "</td>";
            					echo "<td class='center'>";
            					echo $user->last_login;
            					echo "</td>";
            					echo "<td class='center'>";
            					if($user->activated){
            						echo "<span class='label label-success'>Activated</span>";
            					}
            					else
            					{
            						echo "<span class='label label-failure'>Not Activated</span>";
            					}
            					echo "</td>";
                                echo '<td class="center">
                                    <a class="btn btn-success" href="/user/'.$user->id.'/view">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="/user/'.$user->id.'/edit">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>
                                    <a class="btn btn-danger" href="/user/'.$user->id.'/delete">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>&nbsp;';
                                    $throttle = Sentry::findThrottlerByUserId($user->id);

                                    if($suspended = $throttle->isSuspended())
                                    {
                                       echo '<a class="btn btn-success" href="/user/'.$user->id.'/unsuspend">
                                        <i class="icon icon-unlocked icon-white"></i> 
                                        Unsuspend
                                    </a>';
                                    }
                                    else
                                    {
                                        echo '<a class="btn btn-warning" href="/user/'.$user->id.'/suspend">
                                        <i class="icon icon-locked icon-white"></i> 
                                        Suspend
                                    </a>';
                                    }
                                echo '</td>';

            					echo "</tr>";
            				}
            				?>
            			</tbody>
            		</table>
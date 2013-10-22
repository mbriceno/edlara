<?php

defined('ROOT' )|| die('Restricted Access');

?>        <div class="sortable pull-right">
            <a href="/tutorial/edit/0">
             <span class="btn btn-primary">New</span>
            </a>

        </div>
            <table id="datatable" class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        <th>Created Date</th>
                        <th>Modified Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $tutorial_list = Cache::remember('tutorial_listing_dash'.Sentry::getUser()->id,20,function(){
                    $tutorials = Tutorials::all();
                    $out ='';
                    foreach ($tutorials as $tutorial){
                        $subject = Subject::find($tutorial->subjectid);
                        $teacher = User::find($tutorial->createdby);
                        $username = Sentry::findUserByLogin($teacher->email);
                        if(Sentry::getUser()->inGroup(Sentry::findGroupByName('admin')) || Sentry::getUser()->id == $tutorial->createdby){
                        $out .= "<tr>";
                        $out .= "<td>";
                        $out .= $tutorial->id;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $tutorial->name;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $subject->subjectname;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $subject->grade;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $tutorial->created_at;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $tutorial->updated_at;
                        $out .= "</td>";
                        $out .= "<td>";
                        $out .= $username->first_name.' '.$username->last_name;
                        $out .= "</td>";
                        $out .= "<td>";
                        if($tutorial->published){
                        $out .= "<a class='ajax-link' href='/tutorial/unpub/$tutorial->id/'><div class='btn btn-success'>Published</div></a>";
                        }
                        else {
                        $out .= "<a class='ajax-link' href='/tutorial/pub/$tutorial->id/'><div class='btn btn-warning'>Unpublished</div></a>";
                        }
                        $out .= "</td>";
                        $out .= '<td class="center">
                                    <a class="btn btn-success" href="/tutorial/view/'.$tutorial->id.'/">
                                        <i class="icon-zoom-in icon-white"></i>  
                                        View                                            
                                    </a>
                                    <a class="btn btn-info" href="/tutorial/edit/'.$tutorial->id.'">
                                        <i class="icon-edit icon-white"></i>  
                                        Edit                                            
                                    </a>&nbsp;';

                        $cuser = Sentry::getUser();
                        $admingroup = Sentry::findGroupByName('admin');
                        if ($cuser->inGroup($admingroup))
                        {
                        $out .= '<a class="btn btn-danger" href="/tutorial/delete/'.$tutorial->id.'/">
                                        <i class="icon-trash icon-white"></i> 
                                        Delete
                                    </a>';
                        }
                        }
                        $out .= "</td>";
                        $out .= "</tr>";
                    }
                    return $out;
                    });
echo $tutorial_list;
                    ?>

                </tbody>

            </table>
            
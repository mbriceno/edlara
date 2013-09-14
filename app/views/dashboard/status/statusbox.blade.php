<?php

$todayusercount = User::where('created_at', '=', 'CURDATE()')->count();
$usercountall = User::all()->count();
$usercountall -= 1;
$todaystudentcount = Student::where('created_at', '=', 'CURDATE()')->count();
$studentcountall = Student::all()->count();
$studentcountall -=1;
?>

<div class="sortable row-fluid">
                <a data-rel="tooltip" title="{{ $todayusercount }} new members." class="well span3 top-block" href="#">
                    <span class="icon32 icon-red icon-user"></span>
                    <div>Total Members</div>
                    <div>{{ $usercountall }}</div>
                    <span class="notification">{{ $todayusercount }}</span>
                </a>

                <a data-rel="tooltip" title="{{ $todaystudentcount }} new students." class="well span3 top-block" href="#">
                    <span class="icon32 icon-blue icon-user"></span>
                    <div>Students</div>
                    <div>{{ $studentcountall }} </div>
                    <span class="notification blue">{{ $todaystudentcount }}</span>
                </a>

                <a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
                    <span class="icon32 icon-color icon-cart"></span>
                    <div>Sales</div>
                    <div>$13320</div>
                    <span class="notification yellow">$34</span>
                </a>
                
                <a data-rel="tooltip" title="12 new messages." class="well span3 top-block" href="#">
                    <span class="icon32 icon-color icon-envelope-closed"></span>
                    <div>Messages</div>
                    <div>25</div>
                    <span class="notification red">12</span>
                </a>
</div>
 <?php
                            $no1 = mt_rand(1,9);
                            $no2 = mt_rand(1,9);
                            $no3 = mt_rand(0,1);
                            $randomno = mt_rand(1,18);
                            if($no3 == 0){
                                $sum = $no1 +$no2;
                                $output = $no1." plus ".$no2." equals to ".$randomno;
                                if($randomno === $sum){
                                    Session::put('checkbox_captcha_store',true);
                                }
                                else
                                {

                                    Session::put('checkbox_captcha_store',false);
                                }
                            }

                            elseif($no3 == 1){
                                $divider = $no1 -$no2;
                                $output = $no1." minus ".$no2." equals to ".mt_rand(-8,8);
                                if($randomno === $divider){
                                    Session::put('checkbox_captcha_store',true);
                                }
                                else
                                {

                                    Session::put('checkbox_captcha_store',false);
                                }
                            }                
                        echo $output;
                        echo "<br>Tell True or False to Prove that you are human<br>";
                        echo "<input type='radio' name='checkbox_captcha' value='1'>True<br>
                        <input type='radio' name='checkbox_captcha' value='0'>False<br/>";
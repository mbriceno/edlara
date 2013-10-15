<div class='row'>
                <div class="col-md-6 offset-md-3">
                    <h5>If Any Problems persist. Contact our team at </h5>
                        <?php
                        if(Sentry::check()){
                            ?>
                        <a href='mailto:gransjhc@gmail.com'>gransjhc@gmail.com</a></h4>
                        <?php } else {
                            echo "TO SEE EMAIL. PLEASE LOGIN.";
                        } ?>
                </div>
            </div>
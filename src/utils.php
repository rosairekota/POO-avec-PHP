<?php



if (!function_exists('dumpLocal')) {
    function dumpLocal($datas)
    { ?>
        <pre style="color:darkgray;background-color: rgb(5, 3, 14); margin:40px;padding:40px;">


            <p style="color:red;">
                <?= var_dump($datas); ?>
            </p>
           
      
       </pre>
<?php
        // die();
    }
}

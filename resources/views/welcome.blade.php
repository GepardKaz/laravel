@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Задача 1</div>

                <div class="card-body">
                   <?php
                    $form="<form name=\"input\" method=\"GET\"  target=\"_self\">
                    Введите число: <input name=\"i\" size=\"10\" /> <input type=\"submit\" name=\"\" value=\"Посчитать\" /></form>";
                    print "$form";
                    if (isset($_GET['i']) && $_GET['i'] != null) {
                      $i=$_GET['i'];
                    $a=$_GET['i'];
                 
                    print "<hr>Число: $i, в обратном: ";
                             $c = 1;
                            do {
                                $c *=10;
                                if ($a%$c < $c/10) {
                                    echo 0;
                                }
                                else {
                                    echo ($a%$c - $a%($c/10)) / ($c/10);
                                }
                            }
                            while ($a/$c >= 1);  
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<?php

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.covid19api.com/summary');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, true);
$global = $result['Global'];
$temp_All = $global;
$temp_persent = $temp_All["TotalRecovered"]/$temp_All["TotalConfirmed"]*100;
$persent_temp = $temp_All["TotalDeaths"]/$temp_All["TotalConfirmed"]*100;
$countries = $result["Countries"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
            integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
            crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Dashboard Pemantauan Covid-19</title>
</head>
<body style="margin-top: 50px; margin-bottom: 50px;">
    
<div class="container">
    <div class="row">
        <div class="col-2 border rounded bg-info">
            <center>
                <a href="http://zenweb.freesite.vip/portofolio/"><center><img style="margin-top: 30px;" class="rounded-circle" src="/asset/img/foto.png" alt="" width="100px"></center></a>
                <hr class="mt-4">
                <h6>&copy; Copyright by</h6>
                <p style="color: white;" class="mt-4">Muhammad Zainuddin Basyar</p>
                <hr>
                <p>
                    Coronavirus disease (COVID-19) is an infectious disease caused by a newly discovered coronavirus.
                    Most people infected with the COVID-19 virus will experience mild to moderate respiratory illness 
                    and recover without requiring special treatment.  Older people, and those with underlying medical 
                    problems like cardiovascular disease, diabetes, chronic respiratory disease, and cancer are more 
                    likely to develop serious illness. The best way to prevent and slow down transmission is to be well 
                    informed about the COVID-19 virus, the disease it causes and how it spreads.
                </p>
                <a class="btn btn-outline-danger shadow" href="https://www.who.int/health-topics/coronavirus#tab=tab_1">Source</a> <br>
                <a style="color: black; text-decoration: none;" href="https://github.com/zainuddin25"><i style="font-size: 50px;" class="fab fa-github mt-5"></i></a> <br>
                <a class="text-success" style="text-decoration: none;" href="https://wa.me/6285156970093"><i style="font-size: 50px;" class="fab fa-whatsapp mt-4"></i></a> <br>
                <a href="https://gitlab.com/zainuddin25" style="text-decoration: none; color: rgb(255, 107, 1);;"><i style="font-size: 50px;" class="fab fa-gitlab mt-4 mb-4"></i></a>
            </center>
        </div>
        <div class="col-9 border rounded ml-2">
            <center class="mt-3"><a style="text-decoration: none; color: black;" href="index.php">Dashboard</a></center>
            <hr style="width: 100%;">
            <!-- Card Contents -->
            <div class="col-4 float-left">
                <div class="card mb-3 bg-secondary shadow" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <i style="font-size: 50px;" class="fas fa-procedures mt-4 ml-3"></i>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <p>Total Confirmed</p>
                            <h5><?php echo number_format($temp_All["TotalConfirmed"]); ?></h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 float-left">
                <div class="card mb-3 bg-danger shadow" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <i style="font-size: 50px;" class="fas fa-skull-crossbones mt-4 ml-3"></i>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <p>Total Deaths</p>
                            <h5><?php echo number_format($temp_All["TotalDeaths"]); ?></h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 float-left">
                <div class="card mb-3 bg-success shadow" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <i style="font-size: 50px;" class="fas fa-hand-holding-medical mt-4 ml-3"></i>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <p>Total Recovered</p>
                            <h5><?php echo number_format($temp_All["TotalRecovered"]); ?></h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- Diagram Content -->
            <div class="col-12">
                <div class="container-fluid">
                    <div class="row">
                        <h5>Graphics Recovered</h5>
                        <canvas id="myChart" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-9 float-left mt-4">
                <div class="col-12 border-right">
                    <div class="container-fluid">
                        <div class="row">
                            <h5>Graphics Recovered</h5>
                            <canvas id="mySecondChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 border-right">
                    <div class="container-fluid">
                        <div class="row">
                            <h5>Graphics Deaths</h5>
                            <canvas id="myThridChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 float-left mt-4">
                <div class="card border-success mb-3 bg-transparent" style="max-width: 18rem;">
                    <div class="card-body text-dark shadow">
                        <center><p class="card-title">Percentage Cure</p></center>
                        <center><h5><?php echo substr($temp_persent, 0, 4); ?> %</h5></center>
                    </div>
                </div>
                <div class="card border-success mb-3 bg-transparent" style="max-width: 18rem;">
                    <div class="card-body text-dark shadow">
                        <center><p class="card-title">Percentage Deaths</p></center>
                        <center><h5><?php echo substr($persent_temp, 0, 4); ?> %</h5></center>
                    </div>
                </div>
                <h5>State Data</h5>
                <div id="overflow">
                    <div class="form-group">
                        <?php foreach($countries as $key): ?>
                            <li class="nav-item dropdown">
                                <p class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $key["Country"]; ?>
                                    <hr>
                                </p>
                                <div class="dropdown-menu" id="option" aria-labelledby="navbarDropdown">
                                    <p class="dropdown-item "><i style="font-size: 20px;" class="fas fa-procedures mr-2"></i><?php echo $key["TotalConfirmed"] ?></p>
                                    <p class="dropdown-item"><i style="font-size: 20px;" class="fas fa-skull-crossbones mr-2"></i><?php echo $key["TotalDeaths"] ?></p>
                                    <P class="dropdown-item"><i style="font-size: 20px;" class="fas fa-hand-holding-medical mr-2"></i><?php echo $key["TotalRecovered"] ?></P>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var ctx = document.getElementById('myChart').getContext('2d')
    var cty = document.getElementById('mySecondChart').getContext('2d');
    var ctz = document.getElementById('myThridChart').getContext('2d');

    var covid = $.ajax({
        url: "https://api.covid19api.com/summary",
        cache : false
    })
    .done(function (canvas) {
        function getContries(canvas) {
            var show_country=[];

            canvas.Countries.forEach(function(el) {
                show_country.push(el.Country);
            })
            return show_country;
        }
        function getHealth(canvas) {
            var recovered=[];

            canvas.Countries.forEach(function(el) {
                recovered.push(el.TotalRecovered)
            })
            return recovered;
        } 
        function getDeath(canvas) {
            var death=[];

            canvas.Countries.forEach(function(el) {
                death.push(el.TotalDeaths)
            })
            return death;
        }
        function getConirm(canvas) {
            var confirm=[];

            canvas.Countries.forEach(function(el) {
                confirm.push(el.TotalConfirmed)
            })
            return confirm;
        }
        var colors=[];
        function color_random(canvas){
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r +","+ g +","+ b +")";
        }
        for(var i in canvas.Countries) {
            colors.push(color_random(canvas));
        }
        var myChart = new Chart(ctx,{
            type: 'bar',
            data: {
                labels: getContries(canvas),
                datasets : [{
                    label: 'Recovered',
                    data: getHealth(canvas),
                    borderWidth: 1,
                    backgroundColor: colors,
                }],
            },
            options: {
                legend: {
                    display: false
                }
            }
        })
        var mySecondChart = new Chart(cty,{
            type: 'bar',
            data: {
                labels: getContries(canvas),
                datasets : [{
                    label: 'Death',
                    data: getDeath(canvas),
                    borderWidth: 1,
                    backgroundColor: colors,
                }],
            },
            options: {
                legend: {
                    display: false
                }
            }
        })
        var myThridChart = new Chart(ctz,{
            type: 'bar',
            data: {
                labels: getContries(canvas),
                datasets : [{
                    label: 'Confirmed',
                    data: getConirm(canvas),
                    borderWidth: 1,
                    backgroundColor: colors,
                }],
            },
            options: {
                legend: {
                    display: false
                }
            }
        })
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
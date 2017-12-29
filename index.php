<!DOCTYPE html>


<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <canvas id="tempChart"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h2>Records</h2>
                <table class="table table-striped table-bordered table-sm">
                    <tr>
                        <th>Id</th>
                        <th>Sensor</th>
                        <th>Fahrenheit</th>
                        <th>Celsius</th>
                        <th>Date</th>
                    </tr>
                    <?php
                        error_reporting(E_ALL);
                        ini_set('display_errors', 'on');

                        $db = new SQLite3('TemperatureReadings.db');

                        $result = $db->query('SELECT * FROM Temperatures ORDER BY Id DESC');
                        $temperatureReadings = array();
                        while ($row = $result->fetchArray()) {
                            array_push($temperatureReadings, $row);
                            $datetime = new DateTime($row['CreatedOn'], new DateTimeZone('UTC'));
                            $datetime->setTimezone(new DateTimeZone('America/New_York'));
                            echo "<tr><td>".$row['Id']."</td><td>".$row['SensorId']."</td><td>". ($row['Celsius'] * 1.8 + 32) ."°F</td><td>".$row['Celsius'] . "°C</td><td>". $datetime->format('m/d/Y g:i:s A')."</td></tr>";
                        }

                        echo '<script type="text/javascript">var _temperatureReadings = ' . json_encode($temperatureReadings) . '</script>';


                ?>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script src="chart.js"></script>


</body>

</html>

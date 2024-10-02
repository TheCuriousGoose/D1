<?php

$currentDate = new DateTime();
$displayedDate = new DateTime($_GET['date'] ?? '');
$currentDateForButtons = new DateTime($_GET['date'] ?? '');
$days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

$firstDayOfMonth = new DateTime($displayedDate->format('Y-m') . '-01');

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="calendar.css">
</head>

<body>


    <div class="custom-calendar-wrap">
        <div class="custom-inner">
            <div class="custom-header clearfix">
                <nav>
                    <a href="?date=<?= $currentDateForButtons->sub(DateInterval::createFromDateString('1 month'))->format('Y-m') ?>" class="custom-btn custom-prev"></a>
                    <a href="?date=<?= $currentDateForButtons->add(DateInterval::createFromDateString('2 month'))->format('Y-m') ?>" class="custom-btn custom-next"></a>
                </nav>
                <h2 id="custom-month" class="custom-month"><?= $displayedDate->FORMAT('M') ?></h2>
                <h3 id="custom-year" class="custom-year"><?= $displayedDate->FORMAT('Y') ?></h3>
            </div>
            <div id="calendar" class="fc-calendar-container">
                <div class="fc-calendar fc-five-rows">
                    <div class="fc-head">
                        <?php foreach ($days as $day) { ?>
                            <div><?= ucwords($day) ?></div>
                        <?php } ?>
                    </div>
                    <div class="fc-body">
                        <?php
                        $index = 0;
                        $lastDateNumber = 0;

                        for ($i = 0; $i < 5; $i++) { ?>
                            <div class="fc-row">
                                <?php foreach ($days as $day) { ?>
                                    <?php if ($day === strtolower($firstDayOfMonth->format('l')) && $firstDayOfMonth->format('d') > $lastDateNumber) { ?>
                                        <div <?= $currentDate->format('Y-m-d') === $firstDayOfMonth->format('Y-m-d') ? 'class="fc-today"' : '' ?>><span class="fc-date"><?= $firstDayOfMonth->format('d') ?></span></div>
                                        <?php
                                        $lastDateNumber = $firstDayOfMonth->format('d');
                                        $firstDayOfMonth->add(DateInterval::createFromDateString("1 day"))
                                        ?>
                                    <?php } else { ?>
                                        <div><span class="fc-date"></span></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
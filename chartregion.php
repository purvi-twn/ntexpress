<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> 
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> 
<div id="morris-line-chart"></div>
<script>Morris.Line({
    // ID of the element in which to draw the chart.
    element: 'morris-line-chart',
    // Chart data records -- each entry in this array corresponds to a point
    // on the chart.
    data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
    ],
    // The name of the data record attribute that contains x-values.
    xkey: 'cron_time',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['images_processed'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Images Processed'],
    lineColors: ['#0b62a4'],
    xLabels: 'hour',
    // Disables line smoothing
    smooth: true,
    resize: true
});</script> 
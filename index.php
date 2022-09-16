<?php
require ('channels.php');
require ('req_protocol.php');

$host = $_SERVER['HTTP_HOST'];
$dir = dirname($_SERVER['SCRIPT_NAME']);
$channels = getChannelList();

echo <<<'HEADER'
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JIOTV-PLUS</title>
<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/37fVLxB/f4027915ec9335046755d489a14472f2.png">
<meta name="robots" content="noindex"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.1.3/dist/simplex/bootstrap.min.css">
</head>
<style>
.modal-dialog {
	top:50px;
max-width: 100%;
margin: 0 auto;
}
.modal-body {
padding: 2px;
}
#jtvh1 {
text-align: center;
font-size: 15px;
margin: 15px;
padding-bottom: 10px;
font-family: 'Holtwood One SC', serif;
background-color: #fff000;
background-image: linear-gradient(315deg, #fff000 0%, #ed008c 74%);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
}
</style>
<body>
	<div id="jtvh1">
<h1>VARUN114-LIVE <br>{JIOTV-PLUS}</h1> 
</div>
<div class="py-5">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="form-floating">
<input type="text" class="form-control" id="channelSearch" placeholder="Search">
<label for="channelSearch">Search</label>
</div>
</div>
</div>
</div>
</div>
<div class="py-2">
<div class="container">
<div class="row" id="channelCards">
HEADER;


foreach ($channels as $channel) {

$logo = $channel['logoUrl'];
$name = $channel['channel_name'];
$category = $GENRE_MAP[$channel['channelCategoryId']];
$language = $LANG_MAP[$channel['channelLanguageId']];
$id = $channel['channel_id'];

echo <<<CHANNELS

<div class="card-parent col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 mb-3">
<div class="card border-primary h-100">
<img class="lazyload card-img-top" data-src="https://jiotv.catchup.cdn.jio.com/dare_images/images/$logo">
<div align="center" class="card-body flex-grow-0 mt-auto">
<h5 class="card-title">$name</h5>
<p class="card-text"><span class="badge rounded-pill bg-dark"><span class="iconify-inline" data-icon="ic:round-category"></span> $category</span> <span class="badge rounded-pill bg-dark"><span class="iconify-inline" data-icon="ic:round-translate"></span> $language</span></p>
<button type="button" class="btn btn-primary video-btn" data-bs-toggle="modal" data-src="$protocol://$host$dir/play.php?id=$id" data-bs-target="#watchModal"><span class="iconify-inline" data-icon="ic:baseline-smart-display"></span> Watch</button>
</div>
</div>
</div>
CHANNELS;
}

echo <<<'FOOTER'

</div>
</div>
</div>
<div class="modal fade" id="watchModal">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body">
<div class="ratio ratio-16x9">
<iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script>
$(document).ready(function(){
// Searchbar logic
$('#channelSearch').on("keyup", function() {
var value = $(this).val().toLowerCase();
$(".card-parent").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
// Gets the video src from the data-src on each button
var $videoSrc;
$('.video-btn').click(function () {
$videoSrc = $(this).data("src");
});
// when the modal is opened, play it
$('#watchModal').on('shown.bs.modal', function (e) {
$("#video").attr('src', $videoSrc);
});
// stop playing the video when modal is closed
$('#watchModal').on('hide.bs.modal', function (e) {
// a poor man's stop video
$("#video").removeAttr('src');
});
});
</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@iconify/iconify@2.1.2/dist/iconify.min.js"></script>
</html>
FOOTER;
?>

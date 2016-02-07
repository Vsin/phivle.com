<?php
	require_once 'config.php';

$photos = $facebook->api('/10150146071791729/photos/');
?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />	
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/jquery.masonry.min.js"></script>
	<script src="http://ricostacruz.com/jquery.transit/jquery.transit.min.js"></script>
	<script src="js/jquery.infinitescroll.min.js"></script>
	<script src="js/jquery.hoverIntent.minified.js"></script> 

  </head>
	<body>

<div>
<div id="container" >

<?php
	$count = 0;
foreach($photos['data'] as $photo)
{
	$id = $photo['id'];
	$num_likes = $facebook->api("/{$id}/likes/?limit=10000000");
	$likes = sizeof($num_likes['data']);
	$count = $count + 1;
	if($likes > 100){
?>
	<div id="<?=$count?>" class="item width3"> <img src="<?=$photo['source']?>" /><div id="caption">Likes: <?=$likes?></div> </div>
<?php
	}
	else if($likes >= 50){
?>
		<div id="<?=$count?>" class="item width2"> <img src="<?=$photo['source']?>" /><div id="caption">Likes: <?=$likes?></div>  </div>
<?php
		}
	else{
?>
	<div id="<?=$count?>" class="item"> <img src="<?=$photo['source']?>" /><div id="caption">Likes: <?=$likes?></div> </div>
 <?php
	}
}
?>

</div>
	<nav id="page-nav">
 	 <a href="page2.html"></a>
	</nav>
	</body>
</html>


<script>

var $container = $('#container');
$container.imagesLoaded(function(){
  $container.masonry({
    itemSelector : '.item',
    columnWidth : 202
  });
});

$(function(){
  $('#container').masonry({
    // options
    itemSelector : '.item',
    isAnimated: true,
      animationOptions: {
    duration:00,
    easing: 'linear',
    queue: true
  }

  });
});


	var clickedBox;
	var $divItem = $('div.item');
	$(".item").hoverIntent(
		function(){			
			//Set css of clicked box			
			clickedBox = $(this).attr('id');
			$(this).transition({scale: 1.5});
			//$(this).toggleClass('clicked');
			$(this).css('opacity','1.0');
			$(this).css('z-index','5');

			//Darken everything else
			$divItem.each(function() {
				if($(this).attr('id') != clickedBox){
					$(this).css('opacity','0.5');
				}
			});
			$(this).find("#caption").css('display','block');			
		},
		function(){
			//Shrink old clicked box
			$(this).transition({scale: 1.0});
			$(this).css('z-index','1');
			$(this).find("#caption").css('display','none');

			//Ligthen everything
			$divItem.each(function() {
				$(this).css('opacity','1.0');
			});
	});	
	
/*var $container = $('#container');
$container.infinitescroll({
    // infinite scroll options...
    loadingImg : "pictures/halo720.png"
  },
  // trigger Masonry as a callback
  function( newElements ) {
    var $newElems = $( newElements );
    $container.masonry( 'appended', $newElems );
  }
);*/

/*
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation 
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.item',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: 'No more pages to load.',
          img: 'http://i.imgur.com/6RMhx.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
      }
    );
*/
</script>
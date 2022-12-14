jQuery(document).ready(function() {		
		
  jQuery("tr.toggle-more").hide();
  jQuery("a.show-less").hide();
  
  jQuery("a.show-more").click(function(){
    jQuery("tr.toggle-more").toggle();
	jQuery("a.show-less").toggle();
	jQuery("a.show-more").toggle();
  });

  jQuery("a.show-less").click(function(){
    jQuery("tr.toggle-more").toggle();
	jQuery("a.show-less").toggle();
	jQuery("a.show-more").toggle();
  });
  
});



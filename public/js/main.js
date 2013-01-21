$(window).load(function() {
    $('#featuredContent').orbit({
        bulletThumbs:true,
        fluid: '12x3',
        bullets:true,
        directionalNav: true
    });
});



$(document).ready(function() {

    $('.tabs').foundationTabs();

    $('#menu-register').click(function(event) {
        event.preventDefault();
        var $div = $('#registerModal').addClass('reveal-modal').appendTo('body'),
        $this = $(this);
        //$div.empty().html('').append('×').reveal();
        $.get($this.attr('href'), function(data) {
            // alert($div.toSource());
            return $div.empty().html(data).append('<a class="close-reveal-modal">&#215;</a>').reveal();
        });

    });

    $('#menu-login').click(function(){
        $('#loginModal').reveal();
        return false;
    });

/*/ text animation for slider
$('#featuredContent').on('click',"img",function(event){
    // container is the DOM element;
    // userText is the textbox
    alert('1');

/*var container = $("#text_anim")
		userText = $('#userText');
	// Shuffle the contents of container
	container.shuffleLetters();
	// Bind events
	userText.click(function () {
	  userText.val("");
	}).bind('keypress',function(e){
		if(e.keyCode == 13){
			// The return key was pressed
			container.shuffleLetters({
				"text": userText.val()
			});
			userText.val("");
		}
	}).hide();
	// Leave a 4 second pause
	setTimeout(function(){
		// Shuffle the container with custom text
		container.shuffleLetters({
			"text": "Test it for yourself!"
		});
		userText.val("type anything and hit return..").fadeIn();
	},5000);
});*/
});
//-------------------------------

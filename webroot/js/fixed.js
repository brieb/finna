// Set a namespace for our code
window.iPhone = window.iPhone || {};


var currentPage;
var prevPage;
var scrolling = false;
var currentHeader;
var prevHeader;

/* FUNCTIONS */
var gotoPage;
var addLITouchListeners;


(function() {

	// Local shorthand variable
	var $i = this;

	var menuHeights = 102;

	// Shared variables
	$i.vars = {};

	// Shared utilities
	$i.utils = {

		// Adds class name to element
		addClass : function(element, elClass) {
			var curr = element.className;
			if (!new RegExp(("(^|\\s)" + elClass + "(\\s|$)"), "i").test(curr)) {
				element.className = curr + ((curr.length > 0) ? " " : "") + elClass;
			}
			return element;
		},

		// Removes class name from element
		removeClass : function(element, elClass) {
			if (elClass) {
				element.className = element.className.replace(elClass, "");
			} else {
				element.className = "";
				element.removeAttribute("class");
			}
			return element;
		},
		
		// Hide the annoying load bar
		hideURLBar : function() {
			setTimeout(function() {
				window.scrollTo(0, 1);

				var debug = document.querySelector("#debug");
				document.querySelector("#footer").style.top = (window.innerHeight-58)+"px";
				$("#container").css('height', (window.innerHeight-102)+"px");
				$("#content").css('min-height', (window.innerHeight-102)+"px");
			}, 0);
		},
		
		// updateOrientation checks the current orientation, sets the body's class attribute to portrait,
		updateOrientation : function() {
			var orientation = window.orientation;
			
			switch (orientation) {
				
				// If we're horizontal
				case 90:
				case -90:
				
				// Set orient to landscape
				document.body.setAttribute("orient", "landscape");
				break;	
				
				// If we're vertical
				default:
				
				// Set orient to portrait
				document.body.setAttribute("orient", "portrait");
				break;
			}
			
		},
		
		scrollToY : function(y) {
			var ms = 350; // number of milliseconds
			var content = document.querySelector("#content");
			
			// Grab current offset
			var top = parseFloat(content.style.top);
			
			// Convert negative to positive if need be
			var currentTop = (top < 0) ? -(top) : top;
			
			// Divide offset by 250 (more offset = more scroll time)
			var chunks = (currentTop / 100);
			
			// Calculate total time
			var totalTime = (ms * chunks);
			
			// Make sure time does not exceed 750ms
			totalTime = (totalTime > 750) ? 750 : totalTime;
			
			// Prep for animation
			content.style.webkitTransition = "top " + totalTime + "ms cubic-bezier(0.1, 0.25, 0.1, 1.0)";
			
			// Animate to specified Y point
			content.style.top = y + "px";
			
			// Clean up after ourselves
			setTimeout(function() {
				content.style.webkitTransition = "none";
			}, totalTime);
		}
		
	};

	var onTouchEnd = function(){
	  if (this.tagName.toLowerCase()=='li'){
	     $(this).removeClass('selected');
	  }
	  if (scrolling) return;
	  var loc = this.getAttribute('loc');
	  var header = this.getAttribute('header');
	  $i.gotoPage(loc, header);
	}
	var onTouchStart = function(){
	  $(this).addClass('selected');
	}
	
	// Initialize
	$i.init = function() {

		// Sniff for orientation property
		if (typeof window.orientation !== "undefined") {
			
			// Fire events in onload namespace
			for (var key in $i.onload) {
				$i.onload[key]();
			}
			
			// Can't prevent user from tapping status bar
			// So instead, readjust fixed positions
			window.addEventListener("scroll", function() {
				$i.utils.addClass(document.body, "scrolled");
			}, false);
			
			// Remove scroll class on orientation change
			window.addEventListener("orientationchange", function() {
				$i.utils.removeClass(document.body, "scrolled");
			}, false);
			
			// Hide pesky URL bar
			$i.utils.hideURLBar();
			window.addEventListener("orientationchange", $i.utils.hideURLBar, false);
			
			// Point to the updateOrientation function when iPhone switches between portrait and landscape modes.
			$i.utils.updateOrientation();
			window.addEventListener("orientationchange", $i.utils.updateOrientation, false);

			currentPage = $('#due-content');
			currentHeader = $('#main-header');

			var listEntries = $('a[loc]');
			for(var i = 0; i < listEntries.length; i++){
			  listEntries[i].addEventListener("touchend", onTouchEnd, true); 
			}

			var listEntries = $('div[loc]');
			for(var i = 0; i < listEntries.length; i++){
			  listEntries[i].addEventListener("touchend", onTouchEnd, true); 
			}

			var listEntries = $('li[loc]');
			for(var i = 0; i < listEntries.length; i++){
			  listEntries[i].addEventListener("touchend", onTouchEnd, true);
			  listEntries[i].addEventListener("touchstart", onTouchStart, true); 
			}
		}
	};
	
	$i.addLITouchListeners = function(id){
		var listEntries = $('#'+id+' li[loc]');
		for(var i = 0; i < listEntries.length; i++){
		  listEntries[i].addEventListener("touchend", onTouchEnd, true);
		  listEntries[i].addEventListener("touchstart", onTouchStart, true); 
		}
	};
	addLITouchListeners = $i.addLITouchListeners;
	
	
	$i.gotoPage	= function (loc, header){
	    if (loc=="BACK"){
		    loc = prevPage;
		    header = prevHeader;
		} else {
		    loc = $('#'+loc);
		    header = $('#'+header);
		}

	    loc.removeClass("hidden");
	    currentPage.addClass("hidden");
	    header.removeClass("hidden");
	    currentHeader.addClass("hidden");
	    if (currentPage.hasClass("parent-page")){
			$('#main-header').addClass("hidden");
			$('#footer').addClass("hidden");
		}
		prevPage = currentPage;
		currentPage = loc;
		prevHeader = currentHeader;
		currentHeader = header;
	  
		if (currentPage.hasClass("parent-page")){
			$('#main-header').removeClass("hidden");
			$('#footer').removeClass("hidden");
	    }
	};
	gotoPage = $i.gotoPage;
	
	$i.onload = {
		// Disable flick events
		disableScrollOnBody : function() {
			document.body.addEventListener("touchmove", function(e) {
				e.preventDefault();
			}, false);
		},

		scrollToTop : function() {
//			// Header
//			var header = document.querySelector("#header");
//			if (header) {
//				
//				// Cancel event if user drags finger off
//				header.addEventListener("touchmove", function() {
//					this.cancel = true;
//				}, false);
//			}
		},
		
		// Enable area for scrolling
		enableScrollOnContent : function() {
			
			// Grab elements
			var content = false;//document.querySelector("#content");
			var container = document.querySelector("#container");
			
			if (content) {
				
				// Set shared variables
				var startY, startTime, endY, endTime;
				
				// Log starting Y-point and time stamp
				content.addEventListener("touchstart", function(e) {
					startY = e.touches[0].clientY;
					startTime = e.timeStamp;
				}, false);
				
				// Scroll on finger drag
				content.addEventListener("touchmove", function(e) {
					
					scrolling = true;
					// Current Y-point
					var posY = e.touches[0].pageY;
					
					// Set previous position
					$i.vars.oldY = $i.vars.oldY || posY;
					
					// Set a top value (if none exists)
					if (!this.style.top) {
						this.style.top = 0 + "px";
					}
					
					// Make sure we don't scroll past boundaries
					var value;
					var boundary = (container.offsetHeight - this.offsetHeight);
					
					// If current position is greater than old position
					if (posY > $i.vars.oldY) {
						
						// Value = current position + (Y-point - old position)
						value = parseFloat(this.style.top) + (posY - $i.vars.oldY);
						
						// If value is negative
						if (value <= 0) {
							
							// We're good
							this.style.top = value + "px";
							
						// Otherwise, we're over the limit
						} else {
							
							// So mimic the 'snap' to top
							this.style.top = (value * 0.9) + "px";
						}
					
					// If current position is less than old position
					} else if (posY < $i.vars.oldY) {
						
						// Value = current position - (old position - Y-point)
						value = parseFloat(this.style.top) - ($i.vars.oldY - posY);
						
						// If value is greater than or equal to boundary
						if (value >= boundary) {
							
							// We're good
							this.style.top = value + "px";

					        // Otherwise, we're over the limit
						} else {

							// So mimic the 'snap' to bottom
							this.style.top = (value * 0.95) + "px";
						}
					}
					
					// Done with function, current position is now old
					$i.vars.oldY = posY;
					
					// Prevent default action
					e.preventDefault();
				}, false);
				
				// Ease movement when finger is removed
				content.addEventListener("touchend", function(e) {
				    setTimeout("scrolling = false;",100);
					
					// Log current Y-point
					endY = e.changedTouches[0].clientY;
					
					// Log timestamp
					endTime = e.timeStamp;
					
					// Log current Y offset
					var posY = parseFloat(this.style.top);
					
					// Set boundary
					//alert(currentPage.attr('id') + currentPage.height());
					//var scrollContent = document.querySelector("#due-content");
					var contentHeight;
					if (currentPage.hasClass("parent-page")){
					  contentHeight = currentPage.height() > window.innerHeight-menuHeights ? currentPage.height() : window.innerHeight-menuHeights;
					} else {
					  contentHeight = currentPage.height() > window.innerHeight ? currentPage.height() : window.innerHeight;
					}
					var boundary = container.offsetHeight - contentHeight;

					// If offset is greater than 0
					if (posY > 0) {
						
						// Scroll to 0
						$i.utils.scrollToY(0);
					} else {
						
						// Do all the math
						var distance = startY - endY;
						var time = endTime - startTime;
						var speed = Math.abs(distance / time);
						
						// y = current position - (distance * speed)
						var y = parseFloat(this.style.top) - (distance * speed);
						
						if ((time < 600) && distance > 50) {
							// Flicks should go farther
							y = y + (y * 0.2);
						}

						y = (posY <= boundary) ? boundary : (posY > 0) ? 0 : posY;

						// Scroll to specified point
						$i.utils.scrollToY(y);
					}
					
					// Clean up after ourselves
					delete $i.vars.oldY;
				}, false);

			}
		},
		
		// Mimic native footer UI
		nativeFooter : function() {
			
			// Target element
			var footer = document.querySelector("#footer");
			if (footer) {
				
				// Grab all 'tabs'
				var tabs = footer.getElementsByTagName("li");
				for (var i = 0, j = tabs.length; i < j; i++) {
					var tab = tabs[i];
					
					// Add active class on touch
					tab.addEventListener("touchend", function() {
						
						// Remove classes from other active nodes
						for (var k = 0, l = tabs.length; k < l; k++) {
							$i.utils.removeClass(tabs[k], "active");
						}
						
						// Add active to self
						$i.utils.addClass(this, "active");

						$("#main-header div.title").html("Assignments");
						var addBtn = $("#addObjectButton");
						addBtn.attr('loc',"add-assignment");
						addBtn.attr('header',"add-assignment-header");
						$("#priority-content").css("display", "none");
						$("#due-content").css("display", "none");
						$("#course-list").css("display", "none");
						$("#done-content").css("display", "none");
						switch(this.id){
							case "duedate-sort":
							    currentPage = $("#due-content");
								currentPage.css("display", "block");
							break;
							case "priority-sort":
							    currentPage = $("#priority-content");
								currentPage.css("display", "block");
							break;
							case "course-sort":
								$("#main-header div.title").html("My Courses");
								addBtn.attr('loc',"add-course");
								addBtn.attr('header',"add-course-header");
							    currentPage = $("#course-list");
								currentPage.css("display", "block");
								$("#assignment-sort-buttons").css("display", "none");
								$("#view-assignments-button").css("display", "block");
							break;
							case "done-sort":
							    currentPage = $("#done-content");
								currentPage.css("display", "block");
							break;
						}

						content.style.top = "0px";
						return false;			
						
						
					}, false);
				}
			}
			
		}
	};
	
	// Fire on load
	window.addEventListener("load", $i.init, false);
	scrollRef = $i;
	
}).call(window.iPhone); // Initialize

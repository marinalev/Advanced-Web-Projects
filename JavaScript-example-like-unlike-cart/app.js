//http://jsbin.com/bikovasu/36/edit
//http://jsbin.com/minabodi/12/edit


console.log('loading app.js');

//custom object
//function Item(obj) {
	//copy obj props to this
function Tea(obj) {
	var self = this;
	$.each(obj, function(key, value) {
		self[key] = value;
	});

	//this.display = function()
	this.display = function() {
		var template = $('#template').html();
		var compiled = Handlebars.compile(template);
		var finishedHtml = compiled(this);
		return finishedHtml;
	};
}
//end of custom object

//static object start
var staticObj = {

	data : [],

	cart : [],
	
	outlet : $('#outlet'),

	getCart : function() {
		//parses window.localStorage.cart to an array
		//call addToCart on each ID in array
		//returns the array
		var tempArr = JSON.parse(window.localStorage.cart);
		$.each(tempArr, function(ix, id){
			staticObj.addToCart(id);
		});	
		return tempArr;
	},

	saveCart : function() {
		//stringifies the Static Objects cart and sets it to window.localStorage.cart	
		window.localStorage.cart = JSON.stringify(staticObj.cart);
	},
	
	//insert: function(item, tag)
	insert: function(obj, tag) {
		var toAppendHtml = obj.display();
		var $appended = $(tag).append(toAppendHtml);
	},

	//load: function(callback)
	load: function(callback) {
		//register handlebars partials
		Handlebars.registerPartial('addButton', $('#addButtonTemplate').html());
		Handlebars.registerPartial('removeButton', $('#removeButtonTemplate').html());
		
		//restore cart (if any was previously saved)
		staticObj.getCart();
	
		var apiKey = '1WSu0bLINVnI-G6EVBIA9n4VoqBMgF77X_79sTYZF9vI';
		var googleUrl = 'https://spreadsheets.google.com/feeds/list/@apiKey/od6/public/values?alt=json-in-script';
		//loadGoogleData: function(callback) {
	
	function parseGoogleData(data) {
			var tempArr = [];
			$.each(data.feed.entry, function(ix, val) {
				var tempObj = {};
				for(var key in val) {
					var matched = key.match(/gsx\$/);
					if(matched) {
						tempObj[key.slice(4)] = val[key].$t;
					}   
				}
				tempObj.inCart = isInCart(tempObj.id);
				tempArr.push(new Tea(tempObj));
				staticObj.sort('name', staticObj.data);
			});
			return tempArr;
		}
		function isInCart(id) {
			return $.inArray(id, staticObj.cart) >= 0;
		}
		$.ajax({
			url : googleUrl.replace('@apiKey', apiKey),
			dataType : 'jsonp',
			success : function(data) {
				staticObj.data = parseGoogleData(data);
				staticObj.sort('name', staticObj.data);
			if(callback)
				callback(data);
			}
		});
	},
	
	//sort: function(prop, arr)
	sort : function(propToSortBy, arrayToSort) {
		arrayToSort.sort(function(a,b) {
			return b[propToSortBy].toLowerCase() < a[propToSortBy].toLowerCase();
		}) 
	},
	
	//display: function()
	//for each element in data
    //insert(obj, '#outlet')
	//add animation
	display: function() {
		$.each (staticObj.data, function (ix, obj){
			staticObj.insert(obj, '#outlet');
		});
		$('.panel-heading').click(function() {
			$(this).next().slideToggle();
		}); 
		//attach button clicks
		staticObj.attachButtonClick($('button'));		
    },

	//displayCart: function()
    //for each element in data
    //check if the id is in StaticObject.cart
    //insert(see above) 
	displayCart: function() {
	  $.each(staticObj.data, function(ix, obj){
		if ($.inArray(obj.id, staticObj.cart) != -1){
			staticObj.insert(obj, '#outlet');
		}
	  });	  
	  //attach button clicks
	  staticObj.attachButtonClick($('button'));
    },	

	attachButtonClick: function(element) {
		function makeButton(templateId) {
			//unimplemented
		}

		function switchButton(element, templ) {
			//unimplemented
		}

		element.click(function(ev) { 
			//unimplemented
		});
	},
	
	attachButtonClick: function(element) {
		function makeButton(templateId) {
			var source =$(templateId).html();
			var compiled= Handlebars.compile(source);
			return compiled();
		}

		function switchButton(element, templ) {
			element.find('button').remove();
			var buttonHtml = makeButton(templ);
			element.append(buttonHtml);
			staticObj.attachButtonClick(element.find('button'));
		}

		element.click(function(ev) { 
			var el = $(ev.currentTarget).parent();
			var id = el.attr('data-item-id');
			var isInCart = el.find('button').hasClass('inCart');
			if(isInCart) {
				staticObj.removeFromCart(id);
				switchButton(el, '#addButtonTemplate');
			} else{
				staticObj.addToCart(id);
				switchButton(el, '#removeButtonTemplate');
			}
			staticObj.saveCart();
		});
	},
	
	//addToCart: function(itemId)
    //check if itemId is in StaticObject.cart
    //can use $.inArray()
    //if it's not, push into StaticObject.cart
	addToCart: function(itemId) {
		if ($.inArray(itemId, staticObj.cart) == -1){
			staticObj.cart.push(itemId);
			//find item and set inCart property to true
			$.each(staticObj.data, function(){
				if(this.id == itemId)
					this.inCart = true;
			});
		}
    },
	removeFromCart : function(itemId) {
		//opposite of add to cart
		var ix= $.inArray(itemId, staticObj.cart);
		if(ix >= 0) {
			staticObj.cart.splice(ix, 1);
			//find item and set inCart property to true
			$.each(staticObj.data, function(){
				if(this.id == itemId)
					this.inCart = false;
			});
		}
	}
};
//end of static object

$('#everything').click(function(){
	$('#outlet').empty();
	staticObj.display();
});

$('#cart').click(function(){
	$('#outlet').empty();
	staticObj.displayCart();
});

//call load with callback
staticObj.load(staticObj.display);
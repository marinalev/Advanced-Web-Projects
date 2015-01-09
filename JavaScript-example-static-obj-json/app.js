console.log('loading app.js');

//static object starts here

var StaticObj= {

//pretty print function: function(obj, jsonObjToInsertInto)
prettyPrint:function (obj, jsonObjToInsertInto) {
	var html = jsonObjToInsertInto.replace('{{title}}',obj.name).
		replace('{{creator}}', obj.creator).
		replace(/{{website}}/g, obj.website).
		replace('{{curVersion}}', obj.curVersion).
		replace('{{releaseDate}}', obj.releaseDate);
	$('#items').append(html);
},
//megaparse function: function(jsonString, jsonObjToInsertInto)
megaParse: function(jsonString, jsonObjToInsertInto) {
	var items = $('#items');
	var jsonObj = JSON.parse(jsonString);
	var jsonObjToInsertInto = $("#template").html();
	
	if(jsonObj instanceof Array) {
		//sort();
		var sorted = StaticObj.sort("creator", jsonObj);
		$.each(sorted, function(index, val) {
			StaticObj.prettyPrint(val, jsonObjToInsertInto);
		});
	} else {
		StaticObj.prettyPrint(jsonObj, jsonObjToInsertInto);
	}
},
//sort function: function(propertyToSortyBy, arrayToSort)
sort : function(propToSortBy,arrayToSort) {
  var arrayToSort = arrayToSort.sort(function(a,b) {
    return b[propToSortBy] < a[propToSortBy];
  }); 
  return arrayToSort;
}
}

//static object ends

//json string goes here
var jsLibraries = '[' +
	'{"name":"jQuery",' +
		'"creator":"John Resig",' + 
		'"website":"jquery.com",' + 
		'"curVersion":"2.1.0",' + 
		'"releaseDate":"Jan. 2006"},' +
	'{"name":"handlebars",' + 
		'"creator":"Yehuda Katz",' +
		'"website":"handlebarsjs.com",' +
		'"curVersion":"1.3.0",' +
		'"releaseDate":"2010"},' +
	'{"name":"Garlic.js",' +
		'"creator":"Guillaume Potier",' +
		'"website":"garlicjs.org",' +
		'"curVersion":"1.2.2",' +
		'"releaseDate":"2012"},' +
	'{"name":"Masonry",' +
		'"creator":"David DeSandro",' +
		'"website":"masonry.desandro.com/",' +
		'"curVersion":"3.1.2",' +
		'"releaseDate":"2009"},' +
	'{"name":"Bower",' +
		'"creator":"Twitter",' +
		'"website":"bower.io/",' +
		'"curVersion":"1.3.2",' +
		'"releaseDate":""},' +
	'{"name":"Grunt",' +
		'"creator":"Ben Alman",' +
		'"website":"gruntjs.com/",' +
		'"curVersion":"0.4.4",' +
		'"releaseDate":"2011"}' +
	']';
	
var jsonObjToInsertInto = $("#template").html();

//call megaParse here with json string and $('#items')
StaticObj.megaParse(jsLibraries,jsonObjToInsertInto);


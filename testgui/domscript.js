//
// doku
// http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings

$(document).ready(function(){

	// clean text blocks
	$('p textarea').attr('value','');

	// list command
	$('p input#list').click(function(){
		resource=$(this).parent().attr("class");
		url = "../web/api/v1/resource/" + resource
//		console.log("#Click list '" + resource + "', URL:'" + url + "'");

		$.ajax({
			url: url,
			context: $(this),
			dataType: "json",
			type: "GET",
			cache: false,
			success: function(data, textStatus, jqXHR){
				$(this).parent().find('textarea').attr('value', data.toSource());
			},
			error: function(jqXHR, textStatus, errorThrown){
//				console.log( "ajax error: " + textStatus + " - " + errorThrown + "Result:");
//				console.log( jqXHR);
				$(this).parent().find('textarea').attr('value', 
					"ajax error: " + textStatus + " - " + errorThrown + 
					"\n\nResult:\n" + jqXHR.responseText);
			}
		});
	});

	// create command
	$('p input#create').click(function(){
/*
		resource=$(this).parent().attr("class");
		url = "../web/api/v1/resource/" + resource
		console.log("#Click create '" + resource + "', URL:'" + url + "'");
*/
		$(this).parent().find('textarea').attr('value', "NIY");
	});

	// get command
	$('p input#get').click(function(){
		resource = $(this).parent().attr("class");
		id = $(this).next().attr("value");
		url = "../web/api/v1/resource/" + resource + "/" + id;
		console.log("#Click get '" + resource + "' ID: '" + id + "', URL:'" + url + "'");

		$.ajax({
			url: url,
			context: $(this),
			dataType: "json",
			type: "GET",
			cache: false,
			success: function(data, textStatus, jqXHR){
				$(this).parent().find('textarea').attr('value', data.toSource());
			},
			error: function(jqXHR, textStatus, errorThrown){
				$(this).parent().find('textarea').attr('value', 
					"ajax error: " + textStatus + " - " + errorThrown + 
					"\n\nResult:\n" + jqXHR.responseText);
			}
		});
	});

	// update command
	$('p input#update').click(function(){
/*
		resource=$(this).parent().attr("class");
		url = "../web/api/v1/resource/" + resource
		console.log("#Click update '" + resource + "', URL:'" + url + "'");
*/
		$(this).parent().find('textarea').attr('value', "NIY");
	});

	// delete command
	$('p input#delete').click(function(){

		resource=$(this).parent().attr("class");
		id = $(this).next().attr("value");
		url = "../web/api/v1/resource/" + resource + "/" + id;
		console.log("#Click delete '" + resource + "', URL:'" + url + "'");

		$.ajax({
			url: url,
			context: $(this),
			dataType: "json",
			type: "DELETE",
			cache: false,
			success: function(data, textStatus, jqXHR){
				$(this).parent().find('textarea').attr('value', data.toSource());
			},
			error: function(jqXHR, textStatus, errorThrown){
				$(this).parent().find('textarea').attr('value', 
					"ajax error: " + textStatus + " - " + errorThrown + 
					"\n\nResult:\n" + jqXHR.responseText);
			}
		});
	});
});

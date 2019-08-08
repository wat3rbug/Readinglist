// remove reading list item

function removeReadingItem(id) {
	$.ajax({ 
		url: "removeListing.php", 
		type: "post",
		async: false,
		data: {"id": id },
		success: function() {
			$('#listingdiv ul').empty();
			$.ajax({
				url: "getlistings.php", 
				success: function(result) {
					$('#listingdiv ul').append(result);
			}});
		}
	});
}

function removeCategory(id) {
	$.ajax({
		url: "removeCatById.php",
		type: "post",
		async: false,
		data: {"id": id},
		success: function() {
			$('#addCategory').modal('hide');
			showAddCategoryPopup();
		}
	});
}

function showAddCategoryPopup() {
	$('#addCategory').modal('show');
	$.ajax({
		url: "getCategories.php",
		type: "get",
		async: false,
		success: function(result) {
			$('#catListingdiv').empty();
			$('#catListingdiv').append(result);
		}
	});
}

$(document).ready(function(){

	$.ajax({url: "getlistings.php", success: function(result) {
		$('#listingdiv ul').append(result);
	}});
	
	// add category section
	
	$('#addCategoryBtn').on("click", function() {
		showAddCategoryPopup();
	});
	
	$('#pushCategory').on("click", function() {
		var category = $('#category').val();
		$.ajax({
			url: "addCategory.php",
			type: "post",
			async: false,
			data: {
				"category": category
			}, 
			success: function() {
				$('#addCategory').modal('hide');
				$('#addCatSuccess').modal('show');
				$('#addCatMsg').text(category + " category was added");
			}
		});
	});
	
	// display the modal to add a link to the reading list
	
	$("#addRecordBtn").on("click", function() {
		$('#addListing').modal('show');
	});
	
	$('#cancelCategory').on("click", function() {
		$('#addCategory').modal('hide');	
	});
	
	// add new link to reading list

	$('#pushToDb').on("click", function() {
		var title = $('#title').val();
		var link = $('#link').val();
		var id = 0;
		$.ajax({
			url: "addLink.php",
			type: "post",
			async: false,
			data: {
				"title" : title,
				"link": link
			},
			success: function(id) {
				$('#addListing').modal('hide');
				var id = $.ajax({
					url: "getlastId.php",
					type: "post",
					async: false,
					success: function(result) {
						id = result;
					}
				});
				var li = "<li id='" + id + "><div class='form-check'><input type='checkbox' onclick='removeReadingItem(" + id;
				li += ")' class='form-check-input' id='item" + id;
				li += "><label class='form-check-label' for='item" + id + "'>";
				li += "<a target='_blank' href='" + link + "'>" + title + "</a></label></div><br>\n";
				$('#listing').add(li);
			}
		});
	});
});
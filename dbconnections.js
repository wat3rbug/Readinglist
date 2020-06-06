// remove reading list item

function removeReadingItem(id) {
	$.ajax({ 
		url: "removeListing.php", 
		type: "post",
		data: {"id": id },
		success: function() {
			$('#listingdiv ul').empty();
			$.ajax({
				url: "getListings.php", 
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
		success: function(result) {
			$('#catListingdiv').empty();
			$('#catListingdiv').append(result);
		}
	});
}

$(document).ready(function(){

	$.ajax({
		url: "getListings.php", 
		success: function(result) {
			$('#listingdiv ul').append(result);
		}
	});
	
	$.ajax({
		url: "getCatForButtons.php", success: function(result) {
			$('#quicklink').append(result);
		}
	});
	// edit category section
	
	$('#editCategoryBtn').on("click", function() {
		$('#editCategory').modal('show');
		$.ajax({
			url: "getCatForDropDown.php",
			type: "get",
			success: function(result) {
				$('#catEditSelector').empty();
				$('#catEditSelector').append(result);
			}
		});
	});
	
	$('#pushAlteredCategory').on("click", function () {
		var category = $('#editCategoryInput').val();
		var catId = $('#catEditSelector').val();
		$.ajax({
			url: "editCategory.php",
			type: "post",
			data: {
				"category": category,
				"catId": catId
			},
			success: function() {
				$('#editCategory').modal('hide');
				$('#editCatSuccess').modal('show');
				$('#editCatMsg').text("Category is name now '" + category + "'.");
			}
		});
	});
	
	
	$('#editCatSuccessBtn').on('click', function() {
		window.parent.window.location.reload();
	});
	
	// add category section
	
	$('#addCategoryBtn').on("click", function() {
		showAddCategoryPopup();
	});
	
	$('#pushCategory').on("click", function() {
		var category = $('#category').val();
		$.ajax({
			url: "addCategory.php",
			type: "post",
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
		$('#title').val();
		$('#link').val();
		$.ajax({
			url: "getCatForDropDown.php",
			type: "post",
			success: function(result)	{
				$('#catSelector').empty();
				$('#catSelector').append(result);
			}
		});
	});
	
	$('#cancelCategory').on("click", function() {
		$('#addCategory').modal('hide');	
	});
	
	$('#cancelAlteredCategory').on("click", function() {
		$('#editCategory').modal('hide');
	});
	
	$('#cancelLink').on("click", function() {
		$('#addListing').modal('hide');
	});
	
	$('#addCatSuccessBtn').on("click", function() {
		$('#addCatSuccess').modal('hide');	
	});
	
	// add new link to reading list

	$('#pushToDb').on("click", function() {
		var title = $('#title').val();
		var link = $('#link').val();
		var category = $("#catSelector").val();
		var id = 0;
		$.ajax({
			url: "addLink.php",
			type: "post",
			data: {
				"title" : title,
				"link": link,
				"category": category
			},
			success: function(id) {
				$('#addListing').modal('hide');
				$("#listingdiv ul").empty();
				$.ajax({url: "getListings.php", success: function(result) {
					$('#listingdiv ul').append(result);
				}});
			}
		});
	});
});
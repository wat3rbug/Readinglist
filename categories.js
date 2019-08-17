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

$(document).ready(function () {
	
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
	
	$('#cancelAlteredCategory').on("click", function() {
		$('#editCategory').modal('hide');
	});
	
	$('#cancelCategory').on("click", function() {
		$('#addCategory').modal('hide');	
	});
});
// public/js/dynamicDropdowns.js

$(document).ready(function(){
    // On change of Product Category
    $('#prod_cat').on('change', function(){
        var prodCatId = $(this).val();
        
        // Make an AJAX request to get subcategories based on the selected product category
        $.ajax({
            url: '/getSubcategories/' + prodCatId,
            type: 'GET',
            success: function(data){
                // Update the Subcategory dropdown with the received data
                $('#subcategory_id').html(data);
            }
        });
    });

    // On change of Subcategory
    $('#subcategory_id').on('change', function(){
        var subcategoryId = $(this).val();
        
        // Make an AJAX request to get variations based on the selected subcategory
        $.ajax({
            url: '/getVariations/' + subcategoryId,
            type: 'GET',
            success: function(data){
                // Update the Variation dropdown with the received data
                $('#variation_id').html(data);
            }
        });
    });
});

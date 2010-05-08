/** 
 * VideoLibrary_HTMLPage.js
 * Using JQuery
 */

$(function() { 
        var $search_forms = $('form.search-form');
        var search_forms = new VideoLibrary_SearchForms({
                $search_forms: $search_forms
            });
        search_forms.construct();
});


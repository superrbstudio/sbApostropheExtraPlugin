/**
 * Auto complete for search
 */
function sbEnhancedSearch(fieldId, source) {
  if($(fieldId).length != 0) {
    $(fieldId).autocomplete({ 'source': source });
  }
}
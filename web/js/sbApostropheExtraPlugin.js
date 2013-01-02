/**
 * Auto complete for search
 */
function sbEnhancedSearch(fieldId, source) {
  if($(fieldId).length != 0) {
    $(fieldId).autocomplete({ 'source': source });
  }
}

/**
 * Set up link tracking
 */
function sbExternalLinkClickTrack(saveUri, saveToGoogle) {
  $('a').each(function() {
    var a = new RegExp('/' + window.location.host + '/');
    if(!a.test(this.href) && this.href != '') {
      $(this).addClass('sb-external-link-click');
      $(this).click(function(event) {
        event.preventDefault();
        event.stopPropagation();
        trackLink(saveUri, this.href, document.URL);
        
        if(saveToGoogle) {
          _gaq.push(['_trackEvent', 'External Link Click', this.href, document.URL]);
        }
        
        window.open(this.href, '_blank');
      });
    }
  });
  
  function trackLink(saveUri, externalUri, referrerUri) {
    $.post(saveUri, { external_uri: externalUri, referrer_uri: referrerUri } );
  }
}
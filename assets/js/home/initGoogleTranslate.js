function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,tr',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
      gaTrack: true,
      gaId: 'UA-12345678-9',
      autoDisplay: false,
      multilanguagePage: true,
      // Add the following code to add country map icons
      layout: google.translate.TranslateElement.InlineLayout.DROPDOWN,
      layout_opts: {
        showCountryFlags: true,
        showLanguageNames: true
      }
    }, 'google_translate_element');
  }
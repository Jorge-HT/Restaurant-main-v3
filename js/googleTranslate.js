// Google Translate functionality
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        { pageLanguage: 'en', includedLanguages: 'es' },
        'google_translate_element'
    );
}
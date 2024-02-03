function getLanguageDetails(){
    
    try {
        let currentLanguagePairString = readCookie('googtrans');
        let currentLanguagePair = currentLanguagePairString.split("/")
        currentLanguagePair.shift();

        return {
            original: currentLanguagePair[0],
            current: currentLanguagePair[1]
        }
    }catch(error){
        return {
            original: "en",
            current: "en",
        }
    }

    function readCookie(name) {
        let cookies = document.cookie.split('; ')
        let cookiesObject = {}

        cookies.forEach( cookie => {
            let cookieItem = cookie.split("=");
            cookiesObject[cookieItem[0]] = cookieItem[1];
        })
    
        return cookiesObject[name];
    }
}


setTimeout(() => {
    let languageButtons = document.querySelectorAll('.nturl');
    let body = document.querySelector("body");
    let result = getLanguageDetails();
    body.className = result.current;

    console.log(languageButtons);

    languageButtons.forEach( button => {
        button.addEventListener("click", () => { 
            let result = getLanguageDetails();
            body.className = result.current;
        });
    })
}, 2000)
//Console parsing category names
//With debugging (слева Run с параметром "Run Current File")
//Withщге debugging (справа Run Code)

const jsdom = require("jsdom");
const { JSDOM } = jsdom;

let xhr = require("xmlhttprequest").XMLHttpRequest;

//Create new XMLHttpRequest (bypassing CORS restrictions)
let request = new xhr();
request.open('GET', 'https://shtory-tanova.com.ua', true);
request.responseType = 'document';

request.onload = function () {
    if (this.status >= 200 && this.status < 400) {
        //console.log('OK request!');
        const dom = new JSDOM(this.responseText);
        const document = dom.window.document;

        const images = document.querySelectorAll('.cs-product-groups-gallery__image-link');
        
        if (isValid(images)) {
            images.forEach(item => {
                const title = item.getAttribute('title');
                if (isValid(title)) {
                    console.log(replaceSpacesToDashes(title));
                }
            });
        }
    } else {
        console.log('Server return error!');
    }
};

request.onerror = function () {
    console.log('Error load url!');
};

request.send();

/**
 * @param {string} text
 * @return {string}
 */
function replaceSpacesToDashes(text)
{
    return text.replace(/ /g, '-');
}

/**
 * @param {*} data 
 * @return {boolean}
 */
function isValid(data)
{
    return typeof data !== 'undefined' && data;
}